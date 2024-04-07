<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',// Add any other columns you want to be fillable
    ];

    public $timestamps = false; // Disable timestamps

    public function productImage() {
        return $this->hasOne(ProductImage::class, 'product_id');
    }

    public function stock() {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
