<?php

namespace App\Http\Controllers;

use App\Helpers\Paginator;
use App\Models\Commission;
use App\Models\CommissionPreset;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function commissions()
    {
        return view('commissions.index', [
            'title' => 'Commissions',
            'commissions' => Paginator::paginate(auth()->user()->commissions->sortBy(function ($commission) {
                return Commission::statusPriorityCommissions()[$commission->status];
            }), 10),
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function orders()
    {
        return view('commissions.index', [
            'title' => 'Orders',
            'commissions' => Paginator::paginate(auth()->user()->orders->sortBy(function ($commission) {
                return Commission::statusPriorityOrders()[$commission->status];
            }), 10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param User $user
     * @param CommissionPreset|null $commissionPreset
     * @return Application|Factory|View|Response
     */
    public function create(User $user, CommissionPreset $commissionPreset = null)
    {
        if ($user->id == auth()->id()) {
            return redirect()->back()->with(['error' => 'You can\'t commission yourself!']);
        }
        if (!$user->canBeCommissioned()) {
            return abort(403);
        }
        return view('commissions.create', compact([$user, $commissionPreset]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @param CommissionPreset|null $commissionPreset
     * @return RedirectResponse
     */
    public function store(Request $request, User $user, CommissionPreset $commissionPreset = null): RedirectResponse
    {
        if (!$user->canBeCommissioned()) {
            return abort(403);
        }

        $res = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'memo' => 'required|max:2048',
            'price' => 'required|numeric|max:1000|min:'
                .($commissionPreset ? $commissionPreset->price : '5'),

            'days_to_complete' => 'required|integer|min:'
                .($commissionPreset ? $commissionPreset->days_to_complete : '1'),
        ]);

        $commission = new Commission($res);
        $commission->creator_id = $user->id;
        $commission->buyer_id = auth()->user()->id;
        $commission->commission_preset_id = $commissionPreset;

        $commission->save();

        return redirect()
            ->to(route('commissions.show', $commission->fresh()))
            ->with(['success' => 'Commission created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param Commission $commission
     * @return Application|Factory|View|Response|void
     */
    public function show(Commission $commission)
    {
        return view('commissions.show', ['commission' => $commission]);
    }

    /**
     * Display the specified resource.
     *
     * @param Commission $commission
     * @return Application|Factory|View|RedirectResponse|Response|void
     */
    public function checkout(Commission $commission)
    {
        if ($commission->invoice_id != null) {
            return redirect()->to(route('commissions.orders'))->with(['success' => 'This order is already paid.']);
        }
        return view('commissions.checkout', ['commission' => $commission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Commission $commission
     * @return Response
     */
    public function edit(Commission $commission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Commission $commission
     * @return RedirectResponse|void
     */
    public function update(Request $request, Commission $commission)
    {
        if ($commission->status == 'Unpaid') {
            if (!$commission->isBuyer()) {
                abort(401);
            }
            $commission->attemptCharge();
            redirect()->back();
        } elseif ($commission->status == 'Pending') {
            if (!$commission->isCreator()) {
                abort(401);
            }
            $commission->accept();
            return redirect()->to(route('commissions.show', $commission))
                ->with(['success' => 'Commission accepted']);
        } elseif ($commission->status == 'Active') {
            if (!$commission->isCreator()) {
                abort(401);
            }
            if ($commission->attachments->count() < 1) {
                abort(401);
            }
            $commission->complete();
            return redirect()->to(route('commissions.index'))
                ->with(['success' => 'Commission completed']);
        } elseif ($commission->status == 'Completed') {
            if (!$commission->isBuyer()) {
                abort(401);
            }
            $commission->archive();
            return redirect()->to(route('commissions.orders'))
                ->with(['success' => 'Commission archived']);
        } elseif ($commission->status == 'Disputed') {
            if (Gate::allows('manage-users')) {
                $commission->resolve();
            // TODO: redirect for admin
            } else {
                abort(401);
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Commission $commission
     * @return RedirectResponse
     */
    public function destroy(Commission $commission): RedirectResponse
    {
        if ($commission->status == 'Unpaid') {
            if (!$commission->isBuyer()) {
                abort(401);
            }
            $commission->delete();
            return redirect()
                ->to(route('commissions.orders'))
                ->with(['success' => 'Commission deleted']);
        } elseif ($commission->status == 'Pending') {
            if (!$commission->isCreator()) {
                abort(401);
            }
            $commission->decline();
            return redirect()
                ->to(route('commissions.index'))
                ->with(['success' => 'Commission declined']);
        } elseif ($commission->status == 'Active') {
            if (!$commission->isBuyer()) {
                abort(401);
            }
            if ($commission->expires_at > now()) {
                abort(401);
            }

            $commission->expire();

            return redirect()
                ->to(route('commissions.orders'))
                ->with(['success' => 'Commission canceled']);
        } elseif ($commission->status == 'Completed') {
            if (!$commission->isBuyer()) {
                abort(401);
            }
            $commission->dispute();
            return redirect()
                ->to(route('commissions.orders'))
                ->with(['success' => 'Commission disputed']);
        } elseif ($commission->status == 'Disputed') {
            if (Gate::allows('manage-users')) {
                $commission->refund();
            // TODO: redirect for admin
            } else {
                abort(401);
            }
        } else {
            abort(500);
        }
    }
}
