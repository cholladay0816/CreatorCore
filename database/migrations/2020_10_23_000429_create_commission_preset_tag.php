<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionPresetTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_preset_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commission_preset_id');
            $table->foreign('commission_preset_id')->references('id')->on('commission_presets')
                ->onDelete('cascade');
            $table->foreignId('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commission_preset_tag');
    }
}

