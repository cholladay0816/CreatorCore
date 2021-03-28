<?php


namespace Database\Seeders;


use App\Models\Commission;
use App\Models\CommissionEvent;
use App\Models\Creator;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DatabaseSeeder::class,
        ]);

        $admin = User::factory()->create(['name' => 'Admin', 'email' => 'admin@creator-core.com']);

        $adminRole = Role::where('title', 'Administrator')->first();
        $admin->roles()->attach($adminRole);

        $buyer = User::factory()->create(['email' => 'buyer@creator-core.com']);
        $creator = User::factory()->create(['email' => 'creator@creator-core.com']);
        Creator::factory()->create(['user_id' => $creator->id]);

        $commission = Commission::factory()->create(
            [
                'buyer_id' => $buyer->id,
                'creator_id' => $creator->id,
                'title' => 'I\'ll make a logo for your company',
                'description' => 'For $20, I\'ll draft a logo for you to review.
                Once you\'re satisfied, I\'ll build the final vector graphic and fill the order.',
                'memo' => 'Please make me a parody logo based off the Google logo.
                 I want the same band of colors and style but in a P shape instead of a G.',
                'price' => 20,
                'days_to_complete' => 14,
                'expires_at' => now()->addDays(12),
                'status' => 'Active'
            ]
        );
        CommissionEvent::create(
            [
                'commission_id' => $commission->id,
                'title' => 'Accepted by ' . $commission->creator->name, 'color' => 'bg-green-500', 'status' => 'Active',
                'created_at' => now()->addDays(2),
            ]
        );

    }
}
