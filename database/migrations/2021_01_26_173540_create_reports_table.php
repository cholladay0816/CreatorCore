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
            $table->foreignIdFor(\App\Models\User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('model')
                ->default(\App\Models\User::class);
            $table->bigInteger('model_id')
                ->unsigned();
            $table->string('title', 128);
            $table->string('description', 2048);
            $table->enum('status', ['Submitted', 'Resolved', 'Closed'])
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
