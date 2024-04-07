<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_quantity', 'location_id', 'sector_id',
    ];

    public $timestamps = false;

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function location() {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function sector() {
        return $this->belongsTo(Sector::class, 'sector_id');
    }
}
