<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use Livewire\Component;

class DashboardStats extends Component
{
    public ?Affiliate $affiliate;
    public function mount()
    {
        $this->affiliate = \App\Models\Affiliate::where('user_id', auth()->id())->first();
    }
    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}
