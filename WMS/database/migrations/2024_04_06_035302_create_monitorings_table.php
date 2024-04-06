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
        Schema::create('monitorings', function (Blueprint $table) {
            $table->unsignedInteger('product_id')->unsigned();
            $table->unsignedInteger('product_quantity');
            $table->unsignedInteger('origin_location')->unsigned()->nullable();
            $table->unsignedInteger('origin_sector')->unsigned()->nullable();
            $table->unsignedInteger('target_location')->unsigned()->nullable();
            $table->unsignedInteger('target_sector')->unsigned()->nullable();
            $table->date('date');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('origin_location')->references('location_id')->on('locations');
            $table->foreign('origin_sector')->references('sector_id')->on('sectors');
            $table->foreign('target_location')->references('location_id')->on('locations');
            $table->foreign('target_sector')->references('sector_id')->on('sectors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitorings');
    }
};
