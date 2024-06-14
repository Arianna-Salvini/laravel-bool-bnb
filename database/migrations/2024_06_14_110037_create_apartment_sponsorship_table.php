<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('apartment_sponsorship', function (Blueprint $table) {
            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id')
            ->references('id')
            ->on('apartments')
            ->cascadeOnDelete();

            $table->unsignedBigInteger('sponsorship_id');
            $table->foreign('sponsorship_id')
            ->references('id')
            ->on('sponsorships')
            ->cascadeOnDelete();

            $table->timestamp('start_date');
            $table->timestamp('expiration_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartment_sponsorship');
    }
};
