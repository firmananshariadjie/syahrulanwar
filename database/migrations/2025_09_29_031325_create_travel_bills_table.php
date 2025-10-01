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
        Schema::create('travel_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travelgroup_id')->constrained('travel_groups')->cascadeOnDelete();
            $table->integer('fee_in_out');
            $table->integer('fee_snack');
            $table->integer('quota_add');
            $table->integer('trip');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_bills');
    }
};
