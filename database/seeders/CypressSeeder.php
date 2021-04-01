<?php

namespace Database\Seeders;

use App\Models\Creator;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class CypressSeeder extends Seeder
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


        $buyer = User::factory()->create(['email' => 'buyer@creator-core.com', 'name' => 'buyer']);
        $creator = User::factory()->create(['email' => 'creator@creator-core.com', 'name' => 'creator']);
        Creator::factory()->create(['user_id' => $creator->id]);

        $admin = User::factory()->create(['name' => 'Admin', 'email' => 'admin@creator-core.com']);

        $adminRole = Role::where('title', 'Administrator')->first();
        $admin->roles()->attach($adminRole);
    }
}
