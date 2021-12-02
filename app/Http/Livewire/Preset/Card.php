<?php

namespace App\Http\Livewire\Preset;

use App\Models\CommissionPreset;
use Livewire\Component;

class Card extends Component
{
    public CommissionPreset $preset;
    public string $url;
    public function render()
    {
        return view('livewire.preset.card');
    }
}
