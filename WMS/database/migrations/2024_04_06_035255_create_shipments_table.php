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
        Schema::create('shipments', function (Blueprint $table) {
            $table->unsignedInteger('shipment_id')->autoIncrement();
            $table->date('shipment_date')->notNullable();
            $table->char('shipment_type', 3)->notNullable();
            $table->unsignedInteger('origin_location')->nullable();
            $table->unsignedInteger('origin_sector')->nullable();
            $table->unsignedInteger('target_location')->nullable();
            $table->unsignedInteger('target_sector')->nullable();
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
        Schema::dropIfExists('shipments');
    }
};
