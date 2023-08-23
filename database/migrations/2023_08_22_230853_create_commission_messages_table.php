<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Commission::class)
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\User::class)
                ->constrained()->cascadeOnDelete();
            $table->string('message');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commissions_messages');
    }
}
