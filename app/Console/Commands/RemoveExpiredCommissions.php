<?php

namespace App\Console\Commands;

use App\Models\Commission;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveExpiredCommissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commissions:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes Expired Commissions';

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
        Commission::where('expiration_date', '<', Carbon::now())->whereIn('status', ['Unpaid', 'Pending'])->each(function ($commission) {
            $commission->remove();
        });
    }
}
