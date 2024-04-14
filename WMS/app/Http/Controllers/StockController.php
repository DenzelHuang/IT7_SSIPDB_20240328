<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Stock;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Location;
use App\Models\Sector;

class StockController extends Controller
{
    public function index(Request $request) {
        $query = Stock::query();
   
        $this->applySearchFilters($query, $request);
    
        // Include only active products, locations, and sectors in the stocks query
        $query->whereHas('product', function ($query) {
            $query->whereNull('deleted_at');
        })->whereHas('location', function ($query) {
            $query->whereNull('deleted_at');
        })->whereHas('sector', function ($query) {
            $query->whereNull('deleted_at');
        });
    
        // Fetch the stocks
        $stocks = $query->get();
    
        // Group the stocks by product_id
        $groupedStocks = $stocks->groupBy('product_id');
    
        // Query to get the total stock for each product
        $totalStocks = $groupedStocks->map(function ($item) {
            // Calculate the sum of product quantity for active records
            return $item->sum('product_quantity');
        });
    
        // Count the number of groups (i.e., distinct products)
        $rowCount = $groupedStocks->count();
    
        return view('stock.index', compact('rowCount', 'totalStocks', 'groupedStocks'));
    }
    

    private function applySearchFilters($query, $request) {
        $searchProductId = $request->input('search_product_id');
        $searchProductName = $request->input('search_product_name');
        $searchLocationName = $request->input('search_location_name');
        $searchSectorId = $request->input('search_sector_id');
    
        if ($searchProductId) {
            $query->where('product_id', $searchProductId);
        }
    
        if ($searchProductName) {
            $query->whereHas('product', function ($query) use ($searchProductName) {
                $query->where('product_name', 'like', "%$searchProductName%")->whereNull('deleted_at');
            });
        }
    
        if ($searchLocationName) {
            $query->whereHas('location', function ($query) use ($searchLocationName) {
                $query->where('location_name', 'like', "%$searchLocationName%")->whereNull('deleted_at');
            });
        }
    
        if ($searchSectorId) {
            $query->where('sector_id', $searchSectorId);
        }
    }
}

