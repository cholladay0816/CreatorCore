<?php

namespace Tests\Unit;

use App\Models\Commission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class OverdueCommandTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_marks_overdue_commissions()
    {
        $commission = Commission::factory()->create(['status' => 'Active', 'expires_at' => now()->addDays(-1)]);
        $this->artisan('commissions:markoverdue');
        $this->assertEquals('Overdue', $commission->fresh()->status);
    }
}
