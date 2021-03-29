<?php

namespace App\Http\Livewire\Gallery;

use Livewire\Component;

class Gallery extends Component
{
    public $gallery;
    public function render()
    {
        return view('livewire.gallery.gallery');
    }
}
