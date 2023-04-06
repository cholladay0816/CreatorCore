<?php

namespace App\Events\Commission;

use App\Models\Commission;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Completed
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public Commission $commission;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($commission)
    {
        $this->commission = $commission;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
