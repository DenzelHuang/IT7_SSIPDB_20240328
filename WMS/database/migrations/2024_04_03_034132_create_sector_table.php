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
        Schema::create('sector', function (Blueprint $table) {
            $table->unsignedInteger('sector_id')->autoIncrement();
            $table->unsignedInteger('location_id')->notNullable();
            $table->foreign('location_id')->references('location_id')->on('location');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sector');
    }
};
