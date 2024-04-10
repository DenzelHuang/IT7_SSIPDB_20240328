<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippedProduct extends Model
{
    use HasFactory;

    protected $table = 'shipped_products';

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
