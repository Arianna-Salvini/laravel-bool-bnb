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
        Schema::table('statistics', function (Blueprint $table) {
            $table->unsignedBigInteger('apartment_id')->nullable()->after('id');
            $table->foreign('apartment_id')
            ->references('id')
            ->on('apartments')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('statistics', function (Blueprint $table) {
            $table->dropForeign('statistics_apartment_id_foreign');
            $table->dropColumn('apartment_id');
        });
    }
};
