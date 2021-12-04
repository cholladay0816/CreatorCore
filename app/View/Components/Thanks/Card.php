<?php

namespace App\View\Components\Thanks;

use Illuminate\View\Component;

class Card extends Component
{
    public $name;
    public $description;
    public $image;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $description, $image)
    {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.thanks.card');
    }
}
