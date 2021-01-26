<?php

use App\Models\CommissionPreset;
use App\Models\User;
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
            $table->foreignId('buyer_id')->nullable();
            $table->foreign('buyer_id')->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->foreignId('creator_id')->nullable();
            $table->foreign('creator_id')->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->foreignId('commission_preset_id')->nullable();
            $table->foreign('commission_preset_id')->references('id')
                ->on('commission_presets')
                ->nullOnDelete();
            $table->string('title');
            $table->string('description');
            $table->decimal('price');
            $table->integer('days_to_complete')
                ->unsigned()
                ->default(7);
            $table->dateTime('expiration_date')->nullable();
            $table->enum(
                'status',
                [
                    'Unpaid',
                    'Pending',
                    'Declined',
                    'Purchasing',
                    'Failed',
                    'Active',
                    'Overdue',
                    'Expired',
                    'Completed',
                    'Disputed',
                    'Refunded',
                    'Archived',
                ]
            )->default('Unpaid');
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
