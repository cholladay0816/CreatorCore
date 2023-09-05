<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class FeedbackProgram extends Component
{
    public function dismiss()
    {
        Session::put('feedback_dismissed', true);
    }

    public function render()
    {
        return view('livewire.feedback-program');
    }
}
