<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class NotificationBadge extends Component
{
    public $existingNotifications;
    public $pushedNotifications;
    public $notifications;

    public function mount()
    {
        $this->notifications = collect();
        $this->pushedNotifications = collect();
        $this->existingNotifications = collect(auth()->user()->notifications);
    }

    public function fetchNotifications()
    {
        $this->existingNotifications->merge($this->pushedNotifications)->unique('id');
//        $this->pushedNotifications = collect();
        $notifications = auth()->user()->notifications;

        $toAdd = $notifications->whereNotIn('id', $this->existingNotifications->pluck('id'));
//        dd($notifications, $toAdd);
        $this->pushedNotifications = $this->pushedNotifications->merge($toAdd)->unique('id');
    }
    public function removeNotification($id)
    {
        $this->existingNotifications = $this->existingNotifications->merge(auth()->user()->notifications->where('id', $id));
        $this->pushedNotifications = $this->pushedNotifications->filter(function ($notification) use ($id) {
            return $notification['id'] != $id;
        });
    }

    public function render()
    {
        return view('livewire.notification-badge');
    }
}
