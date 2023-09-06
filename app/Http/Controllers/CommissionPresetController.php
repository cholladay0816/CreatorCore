<?php

namespace App\Http\Controllers;

use App\Models\CommissionPreset;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CommissionPresetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('commissionpresets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $res = $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'days_to_complete' => 'required|min:1',
            'price' => 'required|numeric|min:5|max:1000',
            'image' => CommissionPreset::$IMAGE_RULES
        ]);
        $commissionPreset = CommissionPreset::create([
            'user_id' => auth()->id(),
            'title' => $res['title'],
            'description' => $res['description'],
            'days_to_complete' => $res['days_to_complete'],
            'price' => $res['price']
        ]);
        # Optional File Upload
        $res = $request->image->store('commission-presets', 'do_public');
        $commissionPreset->forceFill(['image_path' => $res])->save();

        return redirect()->to(route('creator.show', [auth()->user(), 'commissions']))
            ->with(['success' => 'Your Commission Preset has been created!']);
    }

    /**
     * Display the specified resource.
     *
     * @param CommissionPreset $commissionPreset
     * @return Response
     */
    public function show(CommissionPreset $commissionPreset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CommissionPreset $commissionPreset
     * @return Response
     */
    public function edit(CommissionPreset $commissionPreset)
    {
        return \view('commissionpresets.create', ['commissionPreset' => $commissionPreset]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param CommissionPreset $commissionPreset
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, CommissionPreset $commissionPreset)
    {
        if($commissionPreset->user_id != auth()->id()) {
            abort(403);
        }
        $res = $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'days_to_complete' => 'required|min:1',
            'price' => 'required|numeric|min:5|max:1000',
            'image' => CommissionPreset::$IMAGE_RULES
        ]);

        $commissionPreset->fill([
            'title' => $res['title'],
            'description' => $res['description'],
            'days_to_complete' => $res['days_to_complete'],
            'price' => $res['price']
        ])->save();

        # Optional File Upload
        $res = $request->image->store('commission-presets', 'do_public');
        $commissionPreset->forceFill(['image_path' => $res])->save();

        return redirect()->to(route('creator.show', [auth()->user(), 'commissions']))
            ->with(['success' => 'Your Commission Preset has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommissionPreset $commissionPreset
     * @return Response
     */
    public function destroy(CommissionPreset $commissionPreset)
    {
        if($commissionPreset->user_id != auth()->id()) {
            abort(403);
        }
        $commissionPreset->delete();

        return redirect()->to(route('creator.show', [auth()->user(), 'commissions']))
            ->with(['success' => 'Your Commission Preset has been deleted']);
    }
}
