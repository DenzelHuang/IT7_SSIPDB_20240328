<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Location;

class StockController extends Controller
{
    public function index(Request $request) {
        $searchProductId = $request->input('search_product_id');
        $searchProductName = $request->input('search_product_name');
        $searchLocationName = $request->input('search_location_name');
        $searchSectorId = $request->input('search_sector_id');

        $query = Stock::query();

        // Apply search filters
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

        $stocks = $query->with(['product', 'location'])->get();

        $groupedStocks = $stocks->groupBy('product_id');

        $rowCount = $groupedStocks->count();

        // Query to get the total stock for each product
        $totalStocks = Stock::select('product_id', DB::raw('SUM(product_quantity) as total_stock'))
                            ->groupBy('product_id')
                            ->pluck('total_stock', 'product_id');

        return view('stock.index', compact('stocks', 'rowCount', 'totalStocks', 'groupedStocks'));
    }
}
