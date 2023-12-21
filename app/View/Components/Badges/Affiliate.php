<?php

namespace App\View\Components\Badges;

use Illuminate\View\Component;

class Affiliate extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public string $text = 'Affiliate',
                                public string $title = 'This user is a verified affiliate',
                                public string $textColor = 'text-blue-700',
                                public string $bg = 'bg-blue-100',
                                public string $fill = 'fill-blue-500')
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
