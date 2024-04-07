<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;

class SectorController extends Controller
{
    public function getRelatedSectors($location_id)
    {
        $sectors = Sector::where('location_id', $location_id)->get();

        return response()->json($sectors);
    }
}
