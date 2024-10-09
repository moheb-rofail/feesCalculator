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
        Schema::table('fee_percentages', function (Blueprint $table) {
            $table->unsignedBigInteger('process_id')->nullable(); // Adjust data type and nullability as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fee_percentages', function (Blueprint $table) {
            $table->dropColumn('process_id');
        });
    }
};
