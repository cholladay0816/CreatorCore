<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\CommissionPreset;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index()
    {
        $commissions = Commission::where('creator_id', auth()->user()->id)
            ->whereNotIn('status', ['Unpaid', 'Declined', 'Expired', 'Canceled'])
            ->latest()
            ->get();
        return view('commission.list', ['title'=>'Commissions','commissions'=>$commissions]);
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

    public function create(?CommissionPreset $preset)
    {
        return view('commission.create');
    }

    public function store()
    {
        request()->validate([
            'title' => 'required|max:255|min:3',
            'description' => 'required|max:255|min:3',
            'note' => 'required|max:255|min:3',
            'price'=> 'required|min:5|max:1000',
            'days_to_complete' => 'required|min:1|max:365',
        ]);
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
        if($commission->isBuyer() && $commission->status == 'Unpaid')
        {
            // TODO: Don't use this for live version
            $commission->pay();
            return redirect(url('/commission/'.$commission->id));
        }
        if($commission->isCreator() && $commission->status == 'Pending')
        {
            $commission->accept();
            return redirect(url('/commission/'.$commission->id));
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
        if($commission->isBuyer() && ($commission->status == 'Unpaid' || $commission->status == 'Pending'))
        {
            $commission->remove();
            return redirect(route('orders'));
        }
        //Declined
        else if($commission->isCreator() && ($commission->status == 'Pending'))
        {
            $commission->decline();
            return redirect(route('commissions'));
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
