<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $table = 'product'; // Specify the custom table name, otherwise table names will be assumed in its plural form of the Model

    protected $fillable = [
        'product_name', 'product_image'// Add any other columns you want to be fillable
    ];

    // Define any relationships with other models
    // For example, if a product has many stocks
    // public function stocks()
    // {
     //   return $this->hasMany(Stock::class);
    //}
}
