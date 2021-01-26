<?php

namespace Tests\Unit;

use App\Models\Attachment;
use App\Models\Commission;
use App\Models\User;
use Tests\TestCase;

class AttachmentTest extends TestCase
{
    /** @test */
    public function an_attachment_has_a_creator()
    {
        $user = User::factory()->create();
        $attachment = Attachment::factory()->create(['user_id' => $user->id]);
        $this->assertEquals($attachment->creator->id, $user->id);
    }

    /** @test */
    public function an_attachment_has_a_commission()
    {
        $commission = Commission::factory()->create();
        $attachment = Attachment::factory()->create(['commission_id' => $commission->id]);
        $this->assertEquals($attachment->commission->id, $commission->id);
    }
}
