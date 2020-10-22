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
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('invoice_id');
            $table->string('customer_id');
            $table->foreignId('commission_id');
            $table->foreign('commission_id')->references('id')->on('commissions');
            $table->decimal('value');
            $table->decimal('total');
            $table->enum('status', ['Pending', 'Accepted', 'Declined', 'Expired'])->default('Pending');
            $table->string('body')->nullable;
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
