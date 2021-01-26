<?php

namespace Tests\Unit;

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function reports_have_a_model_that_can_be_accessed()
    {
        $user = User::factory()->create();
        $report = Report::factory()->create([ 'model' => get_class($user), 'model_id' => $user->id ]);

        $this->assertEquals($report->target->id, $user->id);
    }

    /** @test */
    public function a_report_has_a_user()
    {
        $user = User::factory()->create();
        $report = Report::factory()->create([ 'user_id' => $user->id ]);

        $this->assertEquals($report->user->id, $user->id);
    }

    /** @test */
    public function a_report_can_be_resolved()
    {
        $report = Report::factory()->create();

        $report->resolve('User was banned.');

        $this->assertEquals('Resolved', $report->status);

        $this->assertEquals('User was banned.', $report->action_description);
    }

    /** @test */
    public function a_report_can_be_closed()
    {
        $report = Report::factory()->create();

        $report->close();

        $this->assertEquals('Closed', $report->status);
        $this->assertNull($report->action_description);

        $report = Report::factory()->create();

        $report->close('No violation found.');

        $this->assertEquals('Closed', $report->status);
        $this->assertEquals('No violation found.', $report->action_description);
    }
}
