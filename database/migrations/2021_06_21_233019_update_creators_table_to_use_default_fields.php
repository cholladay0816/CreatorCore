<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCreatorsTableToUseDefaultFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('creators', function (Blueprint $table) {
            $table->string('title')->default('')->change();
            $table->string('headline')->default('')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('creators', function (Blueprint $table) {
            $table->string('title')->change();
            $table->string('headline')->change();
        });
    }
}
