<?php

namespace App\Http\Livewire\Welcome;

use Livewire\Component;

class Navbar extends Component
{
    public $open = true;
    public function render()
    {
        return view('livewire.welcome.navbar');
    }
}
