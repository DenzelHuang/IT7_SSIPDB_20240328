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
        $query = Stock::with(['product','product.productImage','location', 'sector']);

        // Apply search filters
        $this->applySearchFilters($query, $request);

        // Fetch the stocks
        $stocks = $query->get();

        // Group the stocks by product_id
        $groupedStocks = $stocks->groupBy('product_id');

        // Query to get the total stock for each product
        $totalStocks = $groupedStocks->map(function ($stocks) {
            return $stocks->sum('product_quantity');
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
                $query->where('product_name', 'like', "%$searchProductName%");
            });
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
