<?php

namespace App\Http\Livewire\Commission;

use App\Models\Commission;
use Livewire\Component;

class History extends Component
{
    public Commission $commission;
    public $events;

    protected $listeners = [
        'refresh' => 'refresh'
    ];

    public function mount() {
        $this->refresh();
    }

    public function refresh() {
        $this->commission = $this->commission->fresh();
        $this->events = $this->commission->messages->merge($this->commission->events)
            ->sortBy('created_at')
            ->values()
            ->all();
    }

    public function render()
    {
        return view('livewire.commission.history');
    }
}
