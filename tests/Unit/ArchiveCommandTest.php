<?php

namespace Tests\Unit;

use App\Models\Commission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArchiveCommandTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_can_archive_completed_commissions_past_the_threshold()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = $this->getChargedCommission($buyer, $seller);
        $commission->accept();
        $commission->checkInvoiceStatus();
        $commission->complete();
        $commission->update([
            'completed_at' => now()->subDays(config('commission.days_to_archive') + 1)
        ]);

        $this->artisan('commissions:archive');

        $this->assertEquals('Archived', $commission->fresh()->status);
    }
    /** @test */
    public function it_does_not_affect_recent_completions()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = $this->getChargedCommission($buyer, $seller);
        $commission->accept();
        $commission->checkInvoiceStatus();
        $commission->complete();

        $this->artisan('commissions:archive');

        $this->assertCount(0, Commission::where('status', 'Archived')->get());
    }
}
