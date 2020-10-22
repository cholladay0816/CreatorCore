<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commission_id');
            $table->foreign('commission_id')->references('id')->on('commissions');
            $table->decimal('value');
            $table->decimal('tax');
            $table->decimal('total');
            $table->string('transaction_id');
            $table->enum('status', ['Pending', 'Accepted', 'Declined', 'Expired'])->default('Pending');
            $table->string('body');

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
        Schema::dropIfExists('payments');
    }
}
