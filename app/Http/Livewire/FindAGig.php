<?php

namespace App\Http\Livewire;

use App\Models\CommissionPreset;
use Livewire\Component;

class FindAGig extends Component
{
    public $search = "";
    private $commissions = [];
    public $count = 20;

    public function mount()
    {
        $this->commissions = CommissionPreset::orderBy('rating', 'DESC')
            ->orderBy('price', 'ASC')
            ->paginate($this->count);
    }

    public function render()
    {
        return view('livewire.find-a-gig', ['commissions' => $this->commissions]);
    }

    public function updatedSearch()
    {
        $this->commissions = CommissionPreset::where('title', 'LIKE', "%{$this->search}%")
//            ->orderBy('rating', 'DESC')
            ->orderBy('price', 'ASC')
            ->paginate($this->count);
    }
}
