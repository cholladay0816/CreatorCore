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
        \App\Models\Creator::factory()->create(['displayname'=>'Cholladay0816','user_id'=>'1']);

        \App\Models\Tag::factory()->create(['title'=>'Digital Art','art_type'=>'Image']);
        \App\Models\Tag::factory()->create(['title'=>'Drawing','art_type'=>'Image']);
        \App\Models\Tag::factory()->create(['title'=>'Photography','art_type'=>'Image']);

        //\App\Models\Tag::factory()->create(['title'=>'Voice Acting','art_type'=>'Audio']);
        //\App\Models\Tag::factory()->create(['title'=>'Music','art_type'=>'Audio']);

        //\App\Models\Tag::factory()->create(['title'=>'Editing','art_type'=>'Video']);

        //\App\Models\Tag::factory()->create(['title'=>'Web Design','art_type'=>'Code']);
        //\App\Models\Tag::factory()->create(['title'=>'Programming','art_type'=>'Code']);

        //\App\Models\Tag::factory()->create(['title'=>'Essay','art_type'=>'Text']);
        //\App\Models\Tag::factory()->create(['title'=>'Poem','art_type'=>'Text']);

        \App\Models\Tag::factory()->create(['title'=>'18+','art_type'=>'Any']);

        \App\Models\CommissionPreset::factory(12)->create(['user_id'=>'1']);



    }
}
