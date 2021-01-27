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
            $table->foreign('preset_id')->references('id')->on('commission_presets')
                ->nullOnDelete();
            $table->foreignId('buyer_id')->nullable();
            $table->foreign('buyer_id')->references('id')->on('users')
                ->nullOnDelete();
            $table->foreignId('creator_id')->nullable();
            $table->foreign('creator_id')->references('id')->on('users')
                ->nullOnDelete();
            $table->string('title');
            $table->string('description');
            $table->string('note');
            $table->decimal('price',8,2,true);
            $table->integer('days_to_complete')->default(3);
            $exp = new \DateTime('now + 7 day',new DateTimeZone('America/Chicago'));
            $table->dateTime('expiration_date')->default($exp->format('Y-m-d H:i:s'));
            $table->enum('status',['Proposed', 'Declined', 'Unpaid', 'Active', 'Canceled', 'Completed', 'Disputed', 'Archived', 'Refunded'])
                ->default('Proposed');
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