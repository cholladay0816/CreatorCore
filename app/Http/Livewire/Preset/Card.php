<?php

namespace App\Http\Livewire\Preset;

use Livewire\Component;

class Card extends Component
{
    public $preset;
    public function render()
    {
        return view('livewire.preset.card');
    }
}
