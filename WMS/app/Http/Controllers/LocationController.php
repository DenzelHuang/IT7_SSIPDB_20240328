<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Location;
use App\Models\Sector;

class LocationController extends Controller
{
    public function index(Request $request) {
        $searchLocationId = $request->input('search_location_id');
        $searchLocationName = $request->input('search_location_name');
        $searchSectorId = $request->input('search_sector_id');

        $query = Sector::query();

        // Apply search filters
        if ($searchLocationId) {
            $query->where('location_id', $searchLocationId);
        }

        if ($searchLocationName) {
            $query->whereHas('location', function ($query) use ($searchLocationName) {
                $query->where('location_name', 'like', "%$searchLocationName%");
            });
        }

        if ($searchSectorId) {
            $query->where('sector_id', $searchSectorId);
        }

        $sectors = $query->with(['location'])->get();

        $groupedSectors = $sectors->groupBy('location_id');

        $rowCount = $groupedSectors->count();

        // Query to get the total sectors for each location
        $totalSectors = Sector::select('location_id', DB::raw('COUNT(sector_id) as total_sectors'))
                            ->groupBy('location_id')
                            ->pluck('total_sectors', 'location_id');

        return view('location.index', compact('sectors', 'rowCount', 'totalSectors', 'groupedSectors'));
    }

    public function create() {
        return view('location.create');
    }

    public function store(Request $request) {
        // Validate the request data
        $request->validate([
            'locationName' => 'required',
            'sectorQuantity' => 'required|numeric|min:1', // Ensure sector quantity is at least 1
        ]);
    
        $locationName = $request->locationName;
        $sectorQuantity = $request->sectorQuantity;
    
        // Check if the location with the given name exists, including soft-deleted locations
        $location = Location::withTrashed()
                        ->where('location_name', $locationName)
                        ->first();
    
        if($location) {
            // If the location exists and it's soft-deleted, restore it
            if ($location->trashed()) {
                $location->restore();
            }
        } else {
            // If the location doesn't exist or it's not soft-deleted, create a new location
            $location = new Location();
            $location->location_name = $locationName;
            $location->save();
        }
    
        // Create sectors for the location
        for ($i = 0; $i < $sectorQuantity; $i++) {
            $sector = new Sector();
            $sector->location_id = $location->location_id;
            $sector->save();
        }
    
        return redirect('/locations');
    }    

    // Edit Page
    public function edit($locationId) {
        $location = Location::findOrFail($locationId);
        return view('location.edit', compact('location'));
    }

    // Update Location
    public function update(Request $request, $locationId) {
        $location = Location::findOrFail($locationId);

        $request->validate([
            'locationName' => 'required|string|max:255',
        ]);

        // Update locationname
        $location->location_name = $request->input('locationName');

        $location->save();

        return redirect('/locations');
    }

    // Delete Page
    public function delete($locationId) {
        $location = Location::findOrFail($locationId);

        return view('location.delete', compact('location'));
    }
    
    // Delete Location
    public function deleteConfirmed($locationId) {
        $location = Location::findOrFail($locationId);
        $location->delete(); 
        return redirect('/locations');
    }
}
