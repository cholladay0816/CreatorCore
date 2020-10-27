<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministratorRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrator_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('administrator_id');
            $table->foreign('administrator_id')->references('id')->on('administrators')
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
        Schema::dropIfExists('administrator_role');
    }
}
