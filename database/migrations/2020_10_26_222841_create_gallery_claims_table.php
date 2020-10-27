<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->cascadeOnDelete();
            $table->foreignId('gallery_id')->nullable();
            $table->foreign('gallery_id')->references('id')->on('galleries')
                ->nullOnDelete();
            $table->string('claimant_name');
            $table->string('claimant_email');
            $table->string('claimant_address');
            $table->string('claimant_phone');
            $table->enum('status', ['Pending', 'Active', 'Overturned'])->default('Pending');
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
        Schema::dropIfExists('gallery_claims');
    }
}
