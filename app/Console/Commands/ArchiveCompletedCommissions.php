<?php

namespace App\Console\Commands;

use App\Mail\Commission\ArchiveFailed;
use App\Models\Commission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ArchiveCompletedCommissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commissions:archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archives completed commissions that exceed the review threshold';

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
        $commissions = Commission::where('status', 'Completed')
            ->where(
                'completed_at',
                '<',
                now()->subDays(config('commission.days_to_archive'))
            )->get();

        foreach ($commissions as $commission) {
            Log::info('Archiving ' . $commission->displayTitle);
            try {
                $commission->archive();
            } catch(\Exception $exception) {
                Mail::to(config('mail.support'))
                    ->queue(new ArchiveFailed($commission, $exception));
            }
        };
        return 0;
    }
}
