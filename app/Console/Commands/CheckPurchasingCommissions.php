<?php

namespace App\Console\Commands;

use App\Models\Commission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckPurchasingCommissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commission:checkpurchasing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks the status of purchasing commissions';

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
        foreach (Commission::where('status', 'Purchasing')->get() as $commission) {
            Log::info('Checking the status of ' . $commission->displayTitle);
            $commission->checkInvoiceStatus();
        };
        return 0;
    }
}
