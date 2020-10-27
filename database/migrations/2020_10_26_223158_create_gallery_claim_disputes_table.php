<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryClaimDisputesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_claim_disputes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_claim_id');
            $table->foreign('gallery_claim_id')->references('id')->on('gallery_claims')
                ->cascadeOnDelete();
            $table->string('uploader_name');
            $table->string('uploader_email');
            $table->string('uploader_address');
            $table->string('uploader_phone');
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
        Schema::dropIfExists('gallery_claim_disputes');
    }
}
