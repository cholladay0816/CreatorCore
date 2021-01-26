<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->string('model')
                ->default(\App\Models\User::class);
            $table->bigInteger('model_id')
                ->unsigned();
            $table->string('title', 128);
            $table->string('description', 2048);
            $table->foreignId('administrator_id')
                ->nullable();
            $table->foreign('administrator_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->enum('status', ['Submitted', 'Active', 'Resolved', 'Closed'])
                ->default('Submitted');
            $table->string('action_description')
                ->nullable();
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
        Schema::dropIfExists('reports');
    }
}
