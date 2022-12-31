<?php

namespace App\Jobs;

use App\Models\Bonus;
use App\Models\Commission;
use App\Models\CommissionEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;

class TryBonusJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public Commission $commission;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($commission)
    {
        $this->commission = $commission;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->commission->creator->incentive <= 0) {
            return;
        }
        $total = min($this->commission->creator->incentive, $this->commission->price * 100);

        $bonus = Bonus::create([
            'user_id' => $this->commission->creator->id,
            'amount' => $total,
            'commission_id' => $this->commission->id
        ]);

        $stripe = new StripeClient(config('stripe.secret'));

        Log::info('Transferring bonus of $'. number_format($bonus->amount / 100, 2) .
        ' to: ' . $this->commission->creator->name);

        $transfer = $stripe->transfers->create(
            [
                'amount' => $bonus->amount,
                'currency' => 'usd',
                'destination' => $bonus->user->stripe_account_id,
                'description' => 'Incentive Bonus: $' . number_format($bonus->amount / 100, 2),
                'transfer_group' => $this->commission->slug,
            ]
        );
        CommissionEvent::create(
            [
                'commission_id' => $this->commission->id,
                'title' => 'Incentive bonus of $' . number_format($bonus->amount / 100, 2),
                'color' => 'bg-yellow-500',
                'status' => 'Archived'
            ]
        );
    }
}
