<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_id', 'product_image'// Add any other columns you want to be fillable
    ];

    public $timestamps = false; // Disable timestamps

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
