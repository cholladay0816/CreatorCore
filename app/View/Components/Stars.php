<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Stars extends Component
{
    public float|null $value;

    public function __construct(float|null $value = null)
    {
        $this->value = $value;
    }


    public function render()
    {
        return view('components.stars');
    }


}
