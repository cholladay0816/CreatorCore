<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionPreset extends Model
{
    use HasFactory;

    public function commissions()
    {
        return $this->hasMany(Commission::class, 'preset_id');
    }

    public function view(CommissionPreset $commissionPreset)
    {
        return view('commissionpreset.view', ['commissionPreset'=>$commissionPreset]);
    }
    public function create()
    {
        return view('commissionpreset.create');
    }
    public function store()
    {
        request()->validate([
            'title' => 'required|max:255|min:3',
            'description' => 'required|max:255|min:3',
            'price'=> 'required|min:5|max:1000',
            'min_days_to_complete' => 'required|min:1|max:365',
            'days_to_complete' => 'required|min:1|max:365',
        ]);
    }
    public function change(CommissionPreset $commissionPreset)
    {
        return view('commissionpreset.edit', ['commissionPreset'=>$commissionPreset]);
    }
    public function edit(CommissionPreset $commissionPreset)
    {
        request()->validate([
            'title' => 'required|max:255|min:3',
            'description' => 'required|max:255|min:3',
            'price'=> 'required|min:5|max:1000',
            'min_days_to_complete' => 'required|min:1|max:365',
            'days_to_complete' => 'required|min:1|max:365',
        ]);
        return redirect(url('/commission'));
    }
    public function remove(CommissionPreset $commissionPreset)
    {
        return redirect(url('/commission'));
    }

}
