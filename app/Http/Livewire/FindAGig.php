<?php

namespace App\Http\Livewire;

use App\Models\CommissionPreset;
use Livewire\Component;

class FindAGig extends Component
{
    public $search = "";
    private $commissions = [];

    public function mount()
    {
        $this->commissions = CommissionPreset::where('active', 1)
            ->orderBy('rating', 'DESC')
            ->paginate();
    }

    public function render()
    {
        return view('livewire.find-a-gig', ['commissions' => $this->commissions]);
    }

    public function updatedSearch()
    {
        $this->commissions = CommissionPreset::where('title', 'LIKE', "%{$this->search}%")
            ->orderBy('rating', 'DESC')
            ->paginate();
    }
}
