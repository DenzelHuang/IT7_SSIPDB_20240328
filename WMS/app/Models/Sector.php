<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sector extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'sector_id';

    protected $fillable = [
        'location_id',
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        // Listen for the "deleted" event on the Sector model
        static::deleted(function ($sector) {
            // Soft delete associated stocks
            $sector->stocks()->delete();
        });
    }

    public function stock() {
        return $this->hasMany(Stock::class, 'sector_id');
    }

    public function location() {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
