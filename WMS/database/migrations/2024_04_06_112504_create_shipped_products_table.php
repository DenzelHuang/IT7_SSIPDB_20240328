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
        Schema::create('shipped_products', function (Blueprint $table) {
            $table->unsignedInteger('shipment_id')->notNullable();
            $table->unsignedInteger('product_id')->notNullable();
            $table->unsignedInteger('product_quantity')->notNullable();
            $table->foreign('shipment_id')->references('shipment_id')->on('shipments');
            $table->primary(['shipment_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipped_products');
    }
};
