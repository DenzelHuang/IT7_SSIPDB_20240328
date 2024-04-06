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
        Schema::create('stocks', function (Blueprint $table) {
            $table->unsignedInteger('product_id')->notNullable();
            $table->unsignedInteger('product_quantity')->notNullable();
            $table->unsignedInteger('location_id')->notNullable();
            $table->unsignedInteger('sector_id')->notNullable();
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('location_id')->references('location_id')->on('locations');
            $table->foreign('sector_id')->references('sector_id')->on('sectors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
