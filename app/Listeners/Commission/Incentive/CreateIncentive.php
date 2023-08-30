<?php

namespace App\Listeners\Commission\Incentive;

use App\Models\Affiliate;
use App\Models\Commission;
use App\Models\Incentive;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateIncentive
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        /** @var Commission $commission */
        $commission = $event->commission;
        /** @var Affiliate $affiliate */
        $affiliate = $commission->creator->affiliate;

        if(!$affiliate?->incentive_amount || !$affiliate?->uses)
        {
            return;
        }

        Incentive::create([
            'user_id' => $affiliate->user_id,
            'amount'  => $affiliate->incentive_amount,
            'reason'  => 'Completed commission: ' . $commission->displayTitle() . ' - using affiliate: ' . $affiliate->code,
        ]);
        $affiliate->forceFill([
            'uses' => $affiliate->uses - 1
        ])->save();
    }
}
