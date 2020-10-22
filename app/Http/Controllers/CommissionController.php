<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\CommissionPreset;
use App\Models\Creator;
use App\Models\User;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index()
    {
        $commissions = Commission::where('creator_id', auth()->user()->id)
            ->whereNotIn('status', ['Declined', 'Expired', 'Canceled'])
            ->latest()
            ->get();
        return view('commission.list', ['title'=>'Commissions','commissions'=>$commissions]);
    }
    public function timeline()
    {
        $commissions = Commission::where('creator_id', auth()->user()->id)
            ->whereNotIn('status', ['Unpaid', 'Declined', 'Expired', 'Canceled'])
            ->latest()
            ->get();
        return view('commission.timeline', ['title'=>'Commissions','commissions'=>$commissions]);
    }
    public function orders()
    {
        $commissions = Commission::where('buyer_id', auth()->user()->id)
            ->latest()
            ->get();
        return view('commission.list', ['title'=>'My Orders','commissions'=>$commissions]);
    }

    public function view(Commission $commission)
    {
        return view('commission.view', ['commission'=>$commission]);
    }

    public function create($name)
    {
        $creator = Creator::find($name);
        if($creator)
        {
            return $this->createCustom($creator);
        }
        $preset = CommissionPreset::find($name);
        if($preset)
        {
            return $this->createPreset($preset);
        }
        abort(404);
    }
    public function createCustom(Creator $creator)
    {
        if($creator->allows_custom_commissions == '0' || $creator->accepting_commissions == '0')
            abort(401);
        return view('commission.create', ['creator'=>$creator]);
    }
    public function createPreset(CommissionPreset $commissionPreset)
    {
        if($commissionPreset->user->creator->accepting_commissions == '0')
            abort(401);
        return view('commission.create', ['commissionPreset'=>$commissionPreset]);
    }
    public function store()
    {
        request()->validate([
            'title' => 'required|max:255|min:3',
            'description' => 'required|max:255|min:3',
            'note' => 'required|max:255|min:3',
            'price'=> 'numeric|required|min:5|max:1000',
            'days_to_complete' => 'required|min:1|max:365',
            'creator_id' => 'required',
        ]);
        $creator = Creator::where('id', '=', request('creator_id'))->first();
        $preset = CommissionPreset::find(request('preset_id'));
        $use_preset=false;
        if($preset)
        {
            $use_preset = (
                request('title') == $preset->title &&
                request('description') == $preset->description &&
                request('days_to_complete') >= $preset->min_days_to_complete
            );
        }

        $commission = new Commission();
        $commission->buyer_id = auth()->user()->id;
        $commission->creator_id = $creator->user_id;
        $commission->title = $use_preset ? $preset->title : request('title');
        $commission->description = $use_preset ? $preset->description : request('description');
        $commission->note = request('note');
        $commission->price = request('price');
        $commission->days_to_complete = request('days_to_complete');
        $commission->save();
        return redirect(route('orders'));
    }
    public function update(Commission  $commission)
    {
        if($commission->isCreator() && $commission->status == 'Proposed')
        {
            $commission->accept();
            return redirect(url('/commission/'.$commission->id));
        }
        if($commission->isBuyer() && $commission->status == 'Unpaid')
        {
            return redirect(url('/payment/'.$commission->id));
        }
        if($commission->isCreator() && $commission->status == 'Active')
        {
            $commission->complete();
            return redirect(url('/commission/'.$commission->id));
        }
        if($commission->isBuyer() && $commission->status == 'Completed')
        {
            $commission->archive();
            return redirect(route('orders'));
        }
    }
    public function delete(Commission $commission)
    {
        //Deleting the orders (Literally)
        if($commission->isBuyer() && ($commission->status == 'Unpaid' || $commission->status == 'Proposed'))
        {
            $commission->remove();
            return redirect(route('orders'));
        }
        //Expired by Buyer
        else if($commission->isBuyer() && ($commission->status == 'Active') && $commission->isExpired())
        {
            $commission->expire();
            return redirect(route('orders'));
        }
        //Canceled by Creator
        else if($commission->isCreator() && ($commission->status == 'Active'))
        {
            $commission->cancel();
            return redirect(route('commissions'));
        }
        if($commission->isBuyer() && $commission->status == 'Completed')
        {
            $commission->dispute();
            return redirect(route('orders'));
        }

        return redirect(route('orders'));
    }
}
