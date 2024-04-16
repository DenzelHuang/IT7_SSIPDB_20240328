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
        $sectors = Sector::where('location_id', $request->locationId)->get();
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
        $request->validate([
            'sectorQuantity' => 'required|numeric|min:1',
        ]);

        $sectorQuantity = $request->input('sectorQuantity');

        for ($i = 0; $i < $sectorQuantity; $i++) {
            Sector::create(['location_id' => $locationId]);
        }

        return redirect('/locations');
    }

    public function deleteConfirmed(Request $request) {
        $sector = Sector::findOrFail($request->input('sectorSelect'));

        $sector->delete();

        return redirect('/locations');
    }
}
