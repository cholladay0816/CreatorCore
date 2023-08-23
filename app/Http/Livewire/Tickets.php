<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Tickets extends Component
{
    public $tickets;

    public function render()
    {
        return view('livewire.tickets');
    }
}
