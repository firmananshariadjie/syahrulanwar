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
        Schema::create('travel', function (Blueprint $table) {        
            $table->id();
            $table->string('travel_name');
            $table->string('description');
            $table->enum('status',['Open', 'Close'])->default('Open');
            $table->enum('status_payment',['Lunas', 'Belum Lunas'])->default('Belum Lunas');                    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel');
    }
};
