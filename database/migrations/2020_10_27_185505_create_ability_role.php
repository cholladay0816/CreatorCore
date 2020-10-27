<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbilityRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ability_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ability_id');
            $table->foreign('ability_id')->references('id')->on('abilities')
                ->cascadeOnDelete();
            $table->foreignId('role_id');
            $table->foreign('role_id')->references('id')->on('roles')
                ->cascadeOnDelete();
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
        Schema::dropIfExists('ability_role');
    }
}
