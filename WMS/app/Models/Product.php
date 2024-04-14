<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',
    ];

    public $timestamps = false; 

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        // Listen for the "deleted" event on the Product model
        static::deleted(function ($product) {
            // Soft delete associated stocks
            $product->stock()->delete();
        });
    }


    public function productImage() {
        return $this->hasOne(ProductImage::class, 'product_id');
    }

    public function stock() {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    
}
