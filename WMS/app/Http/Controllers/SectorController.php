<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\Location;

class SectorController extends Controller
{
    public function fetchSectors($location_id)
    {
        $sectors = Sector::where('location_id', $location_id)->get();

        return response()->json($sectors);
    }
    
    // Method to get sectors dynamically upon changes in location selection
    public function getSectors(Request $request) {
        $locationId = $request->locationId;
        $sectors = Sector::where('location_id', $locationId)->whereNull('deleted_at')->get();
        return response()->json($sectors);
    }

    public function create($locationId) {
        $location = Location::findOrFail($locationId);
        return view('sector.create', compact('location'));
    }

    public function delete($locationId) {
        $location = Location::findOrFail($locationId);
        $sectors = Sector::where('location_id', $locationId)->get();

        return view('sector.delete', compact('location', 'sectors'));
    }

    public function store(Request $request, $locationId) {
        // Validate the request data
        $request->validate([
            'sectorQuantity' => 'required|numeric|min:1',
        ]);
        $sectorQuantity = $request->sectorQuantity;

        for ($i = 0; $i < $sectorQuantity; $i++) {
            $sector = new Sector();
            $sector->location_id = $locationId;
            $sector->save();
        }
        return redirect('/locations');
    }

    public function deleteConfirmed(Request $request) {
        $sectorIds = $request->input('sectorCheckbox');

        foreach($sectorIds as $sectorId) {
            $sector = Sector::where('sector_id', $sectorId);
            $sector->delete();
        }
        return redirect('/locations');
    }
}
