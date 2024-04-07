<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $primaryKey = 'location_id';

    protected $fillable = [
        'location_name',
    ];

    public $timestamps = false;

    public function stock(){
        return $this->hasMany(Stock::class, 'location_id');
    }
}
