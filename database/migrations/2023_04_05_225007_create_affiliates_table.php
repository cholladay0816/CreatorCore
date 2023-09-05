<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)
                ->nullable()->constrained()->nullOnDelete();
            $table->string('code')->unique();
            $table->unsignedInteger('uses')->default(500);
            $table->dateTime('expires_at')->nullable()->default(now()->addMonths(6));
            $table->float('percentage')->default(0.5);
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });

        Schema::table('commissions', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Affiliate::class)
                ->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affiliates');
        Schema::dropColumns('commissions', ['affiliate_id']);
    }
}
