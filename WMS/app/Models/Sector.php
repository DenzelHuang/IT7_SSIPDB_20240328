<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $primaryKey = 'sector_id';

    protected $fillable = [
        'location_id',
    ];

    public $timestamps = false;

    public function stock() {
        return $this->hasMany(Stock::class, 'sector_id');
    }
}
