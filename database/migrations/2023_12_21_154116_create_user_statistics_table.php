<?php

use App\Models\UserStatistic;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->unsignedDecimal('rating', 8, 4)->nullable();
            $table->dateTime('last_login_at')->nullable();
            $table->dateTime('last_commission_at')->nullable();
            $table->timestamps();
        });

        foreach(\App\Models\User::all() as $user) {
            UserStatistic::firstOrCreate(['user_id' => $user->id], [
                'last_login_at' => now(),
                'rating' => $user->rating()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_statistics');
    }
};
