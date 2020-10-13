<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('preset_id')->nullable();
            $table->foreignId('buyer_id');
            $table->foreign('buyer_id')->references('id')->on('users');
            $table->foreignId('creator_id');
            $table->foreign('creator_id')->references('id')->on('users');
            $table->string('title');
            $table->string('description');
            $table->string('note');
            $table->decimal('price',8,2,true);
            $table->integer('days_to_complete')->default(3);
            $table->dateTime('expiration_date')->default(DB::raw('DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 7 DAY)'));
            $table->enum('status',['Unpaid', 'Pending', 'Declined', 'Active', 'Canceled', 'Completed', 'Disputed', 'Archived', 'Refunded'])
                ->default('Unpaid');
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
        Schema::dropIfExists('commissions');
    }
}
