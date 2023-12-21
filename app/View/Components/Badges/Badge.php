<?php

namespace App\View\Components\Badges;

use Illuminate\View\Component;

class Badge extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public string $text,
                                public ?string $title = null,
                                public string $textColor = 'text-purple-700',
                                public string $bg = 'bg-purple-100',
                                public string $fill = 'fill-purple-500')
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.badges.badge');
    }
}
