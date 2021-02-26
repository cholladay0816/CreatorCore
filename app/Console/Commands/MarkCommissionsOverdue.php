<?php

namespace App\Console\Commands;

use App\Models\Commission;
use Illuminate\Console\Command;

class MarkCommissionsOverdue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commissions:markoverdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets the status of all overdue commissions to \'Overdue\'';

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
        $commissions = Commission::where('status', 'Active')->where('expires_at', '<', now()->toDateString())->get();
        foreach ($commissions as $commission) {
            $commission->overdue();
        }
        return 0;
    }
}
