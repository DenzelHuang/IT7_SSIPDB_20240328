<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $table = 'monitorings';

    protected $fillable = [
        'product_id', 'product_quantity', 'origin_location', 'origin_sector', 'target_location', 'target_sector','date',
    ];

    public $timestamps = false;

    // Define the relationships
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function originLocation()
    {
        return $this->belongsTo(Location::class, 'origin_location', 'location_id');
    }

    public function targetLocation()
    {
        return $this->belongsTo(Location::class, 'target_location', 'location_id');
    }

    public function originSector()
    {
        return $this->belongsTo(Sector::class, 'origin_sector', 'sector_id');
    }

    public function targetSector()
    {
        return $this->belongsTo(Sector::class, 'target_sector', 'sector_id');
    }

}
