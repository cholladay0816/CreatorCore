<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommissionPresetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CommissionPreset::factory(10)->create();
    }
}
