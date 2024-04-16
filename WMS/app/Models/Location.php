<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'location_id';

    protected $fillable = [
        'location_name',
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    protected static function boot() {
        parent::boot();

        // Listen for the "deleted" event on the Location model
        static::deleted(function ($location) {
            // Soft delete associated stocks
            $location->stocks()->delete();
            $location->sectors()->delete();
        });
    }

    public function stocks() {
        return $this->hasMany(Stock::class, 'location_id');
    }

    public function sectors(){
        return $this->hasMany(Sector::class, 'location_id');
    }
}
