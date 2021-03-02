<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public $notifications;

    public function render()
    {
        return view('livewire.notifications');
    }

    public function read($id)
    {
        $notification = auth()->user()->notifications
            ->where('id', $id)
            ->first();
        $notification->read_at = now();
        $notification->save();
    }

    public function delete($id)
    {
        auth()->user()->notifications
            ->where('id', $id)
            ->first()
            ->delete();
    }
}
