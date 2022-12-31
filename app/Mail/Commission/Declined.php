<?php

namespace App\Mail\Commission;

use App\Models\Commission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Declined extends Mailable
{
    use Queueable;
    use SerializesModels;

    public Commission $commission;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($commission)
    {
        $this->commission = $commission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.commission.declined', ['commission' => $this->commission])
            ->subject('Commission Declined');
    }
}
