<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class Creator extends Component
{
    public $creator;

    public function mount()
    {
        if(!auth()->user()->creator)
        {
            \App\Models\Creator::create([
                'user_id' => auth()->user()->id,
            ]);
        }

        $this->creator = auth()->user()->fresh()->creator->toArray();
    }

    public function render()
    {
        return view('livewire.profile.creator');
    }

    public function updatedCreator($value, $key)
    {
        auth()->user()->creator->update([
            $key => $value
        ]);
    }
}
