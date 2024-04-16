<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Stock extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query) {
        $query
            ->where('product_id', '=', $this->getAttribute('product_id'))
            ->where('sector_id', '=', $this->getAttribute('sector_id'));

        return $query;
    }
    
    protected $fillable = [
        'product_id', 'product_quantity', 'location_id', 'sector_id',
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
