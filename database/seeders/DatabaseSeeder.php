<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Tag::factory()->create(['title'=>'Digital Art','art_type'=>'Image']);
        \App\Models\Tag::factory()->create(['title'=>'Drawing','art_type'=>'Image']);
        \App\Models\Tag::factory()->create(['title'=>'Photography','art_type'=>'Image']);

        //Audio
        //\App\Models\Tag::factory()->create(['title'=>'Voice Acting','art_type'=>'Audio']);
        //\App\Models\Tag::factory()->create(['title'=>'Music','art_type'=>'Audio']);

        //Video
        //\App\Models\Tag::factory()->create(['title'=>'Editing','art_type'=>'Video']);

        //Code
        //\App\Models\Tag::factory()->create(['title'=>'Web Design','art_type'=>'Code']);
        //\App\Models\Tag::factory()->create(['title'=>'Programming','art_type'=>'Code']);

        //Text
        //\App\Models\Tag::factory()->create(['title'=>'Essay','art_type'=>'Text']);
        //\App\Models\Tag::factory()->create(['title'=>'Poem','art_type'=>'Text']);

        //Generic
        \App\Models\Tag::factory()->create(['title'=>'18+','art_type'=>'Any']);

        \App\Models\CommissionPreset::factory(12)->create(['user_id'=>'1']);

        $admin = \App\Models\Administrator::factory()->create(['user_id'=>1]);
        $edit = \App\Models\Ability::factory()->create(['title'=>'edit-users','label'=>'Manage Users']);
        $ban = \App\Models\Ability::factory()->create(['title'=>'ban-users','label'=>'Suspend Users']);

        $manager = \App\Models\Role::factory()->create(['title'=>'manager','label'=>'Manager']);
        $moderator = \App\Models\Role::factory()->create(['title'=>'moderator','label'=>'Moderator']);

        $manager->first()->abilities()->sync($edit);
        $moderator->first()->abilities()->sync($ban);

        $admin->first()->roles()->sync($manager);
    }
}
