<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->cascadeOnDelete();
            $table->foreignId('commission_id');
            $table->foreign('commission_id')->references('id')->on('commissions')
                ->cascadeOnDelete();
            $table->tinyInteger('positive')->default(1);
            $table->tinyInteger('anonymous')->default(1);
            $table->string('message')->nullable();
            $table->foreignId('attachment_id')->nullable();
            $table->foreign('attachment_id')->references('id')->on('attachments')
                ->nullOnDelete();
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
        Schema::dropIfExists('reviews');
    }
}
