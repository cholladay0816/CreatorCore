<?php

namespace App\Console\Commands;

use App\Models\Commission;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpirePayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expires payments that failed to process.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Commission::where('expiration_date', '<', Carbon::now())->whereIn('status', ['Pending'])->each(function ($payment) {
            $payment->expire();
        });
    }
}
