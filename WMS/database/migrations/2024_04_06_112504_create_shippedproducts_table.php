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
        Schema::create('shippedproducts', function (Blueprint $table) {
            $table->unsignedInteger('shipment_id')->notNullable();
            $table->unsignedInteger('product_id')->notNullable();
            $table->unsignedInteger('product_quantity')->notNullable();
            $table->foreign('shipment_id')->references('shipment_id')->on('shipments');
            $table->foreign('product_id')->references('product_id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippedproducts');
    }
};
