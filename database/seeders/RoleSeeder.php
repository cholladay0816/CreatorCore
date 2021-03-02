<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = Role::factory()->create(['title'=>'Administrator']);
        $moderator = Role::factory()->create(['title'=>'Moderator']);

        $manage_users = Ability::factory()->create(['title' => 'Manage Users'])->id;
        $manage_content = Ability::factory()->create(['title' => 'Manage Content'])->id;
        $manage_admins = Ability::factory()->create(['title' => 'Manage Admins'])->id;
        $view_admin_dashboard = Ability::factory()->create(['title' => 'View Admin Dashboard'])->id;
        $manage_reports = Ability::factory()->create(['title' => 'Manage Reports'])->id;
        $manage_financials = Ability::factory()->create(['title' => 'Manage Financials'])->id;
        $manage_analytics = Ability::factory()->create(['title' => 'Manage Analytics'])->id;

        $administrator->abilities()->attach(
            [
                $manage_users,
                $manage_content,
                $view_admin_dashboard,
                $manage_reports,
                $manage_financials,
                $manage_analytics,
                $manage_admins
            ]
        );
        $moderator->abilities()->attach(
            [
                $manage_users,
                $manage_content,
                $view_admin_dashboard,
                $manage_reports
            ]
        );
    }
}
