<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Location;
use App\Models\Sector;

class LocationController extends Controller 
{
    public function index(Request $request) {
        $query = Sector::with(['location']);

        // Apply search filters
        $this->applySearchFilters($query, $request);

        $sectors = $query->get();

        $groupedSectors = $sectors->groupBy('location_id');

        $locations = Location::all();

        $rowCount = $groupedSectors->count();

        // Query to get the total sectors for each location
        $totalSectors = Sector::select('location_id', DB::raw('COUNT(sector_id) as total_sectors'))
                            ->groupBy('location_id')
                            ->pluck('total_sectors', 'location_id');

        return view('location.index', compact('sectors', 'rowCount', 'totalSectors', 'groupedSectors', 'locations'));
    }

    public function create() {
        return view('location.create');
    }

    public function store(Request $request) {
        $request->validate([
            'locationName' => 'required',
            'sectorQuantity' => 'required|numeric|min:1',
        ]);

        $location = Location::withTrashed()->firstOrCreate(
            ['location_name' => $request->locationName]
        );

        if ($location->trashed()) {
            $location->restore();
        }

        for ($i = 0; $i < $request->sectorQuantity; $i++) {
            $location->sectors()->create([]);
        }

        return redirect('/locations');
    }

    public function edit($locationId) {
        $location = Location::findOrFail($locationId);
        return view('location.edit', compact('location'));
    }

    public function update(Request $request, $locationId) {
        $location = Location::findOrFail($locationId);

        $request->validate([
            'locationName' => 'required|string|max:255',
        ]);

        $location->update(['location_name' => $request->input('locationName')]);

        return redirect('/locations');
    }

    public function delete($locationId) {
        $location = Location::findOrFail($locationId);
        return view('location.delete', compact('location'));
    }
    
    public function deleteConfirmed($locationId) {
        $location = Location::findOrFail($locationId);
        $location->delete(); 
        return redirect('/locations');
    }

    private function applySearchFilters($query, $request) {
        $searchLocationId = $request->input('search_location_id');
        $searchLocationName = $request->input('search_location_name');
        $searchSectorId = $request->input('search_sector_id');

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
    }
}
