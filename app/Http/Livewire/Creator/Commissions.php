<?php

namespace App\Http\Livewire\Creator;

use Livewire\Component;

class Commissions extends Component
{
    public $user;

    public function render()
    {
        return view('livewire.creator.commissions');
    }
}
