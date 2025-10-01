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
        Schema::create('travel_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travel_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // nama group
            $table->integer('quota')->default(0); // misalnya kapasitas
            $table->date('start_date');  
            $table->date('end_date');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_groups');
    }
};
