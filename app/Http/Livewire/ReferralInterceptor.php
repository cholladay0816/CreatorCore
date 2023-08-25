<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ReferralInterceptor extends Component
{
    public function mount()
    {
        if(request()->get('aref'))
        {
            request()->session()->put('affiliate_code', request()->get('aref'));
        }
    }
    public function render()
    {
        return view('livewire.referral-interceptor');
    }
}
