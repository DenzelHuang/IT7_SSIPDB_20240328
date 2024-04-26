<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monitoring;

class MonitoringController extends Controller
{
    public function index(Request $request) {
        $query = Monitoring::with(['product' => function ($query) {
                                    $query->withTrashed(); // Include soft-deleted products
                                }, 
                                'originLocation' => function ($query) {
                                    $query->withTrashed(); // Include soft-deleted origin locations
                                }, 
                                'targetLocation' => function ($query) {
                                    $query->withTrashed(); // Include soft-deleted target locations
                                }]);

        $this->applySearchFilters($query, $request);

        $monitorings = $query->get();

        $rowCount = $monitorings->count();

        return view('monitoring.index', compact('monitorings', 'rowCount'));
    }

    private function applySearchFilters($query, $request) {
        $productId = $request->input('search_product_id');
        $productName = $request->input('search_product_name');
        $originLocation = $request->input('search_origin_location');
        $originSector = $request->input('search_origin_sector');
        $targetLocation = $request->input('search_target_location');
        $targetSector = $request->input('search_target_sector');
        $date = $request->input('search_date');

        if ($productId) {
            $query->where('product_id', $productId);
        }

        if ($productName) {
            $query->whereHas('product', function ($query) use ($productName) {
                $query->where('product_name', 'like', "%$productName%");
            });
        }

        if ($originLocation) {
            $query->whereHas('originLocation', function ($query) use ($originLocation) {
                $query->where('location_name', 'like', "%$originLocation%");
            });
        }

        if ($originSector) {
            $query->where('origin_sector', $originSector);
        }

        if ($targetLocation) {
            $query->whereHas('targetLocation', function ($query) use ($targetLocation) {
                $query->where('location_name', 'like', "%$targetLocation%");
            });
        }

        if ($targetSector) {
            $query->where('target_sector', $targetSector);
        }

        if ($date) {
        $query->where('date', $date);
        }
    }
}