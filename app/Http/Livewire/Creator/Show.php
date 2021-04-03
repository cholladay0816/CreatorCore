<?php

namespace App\Http\Livewire\Creator;

use Livewire\Component;

class Show extends Component
{
    public $page = 'about';

    public function render()
    {
        return view('livewire.creator.show');
    }
}
