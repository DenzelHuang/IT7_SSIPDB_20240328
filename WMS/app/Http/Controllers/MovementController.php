<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Location;
use App\Models\Sector;
use App\Models\Monitoring;

class MovementController extends Controller {
    public function index() {
        $products = Product::all();
        $locations = Location::all();
        return view('movement.index', compact('products', 'locations'));
    }

    public function store(Request $request) {
        // Validate the request data
        $request->validate([
            'productName' => 'required|exists:products,product_name',
            'productQuantity' => 'required|integer|min:1',
            'originLocation' => 'required|exists:locations,location_id',
            'originSector' => 'required|exists:sectors,sector_id',
            'targetLocation' => 'required|exists:locations,location_id',
            'targetSector' => 'required|exists:sectors,sector_id',
            'date' => 'required',
        ]);
    
        // Retrieve input data
        $productName = $request->productName;
        $productQuantity = $request->productQuantity;
        $originLocationId = $request->originLocation;
        $originSectorId = $request->originSector;
        $targetLocationId = $request->targetLocation;
        $targetSectorId = $request->targetSector;
        $date = $request->date;
    
        // Query the available quantity in the origin sector
        $product = Product::where('product_name', $productName)->firstOrFail();
        $productId = $product->product_id;
        $availableQuantity = Stock::where('product_id', $productId)
                                    ->where('location_id', $originLocationId)
                                    ->where('sector_id', $originSectorId)
                                    ->value('product_quantity');
    
        // Check if the available quantity is null (no stock records found)
        if ($availableQuantity === null) {
            return back()->withInput()->withErrors(['originSector' => 'No stock records found for the specified product and sector.']);
        }
    
        // Check if the requested quantity is not more than the available quantity from the origin sector
        if ($productQuantity > $availableQuantity) {
            return back()->withInput()->withErrors(['productQuantity' => 'Requested quantity exceeds available quantity in the origin sector.']);
        }
    
        // Deduct the product quantity from the origin sector
        Stock::where('product_id', $productId)
            ->where('location_id', $originLocationId)
            ->where('sector_id', $originSectorId)
            ->decrement('product_quantity', $productQuantity);
    
        // Check if a stock record associated with the target sector exists
        $existingStock = Stock::where('product_id', $productId)
                            ->where('location_id', $targetLocationId)
                            ->where('sector_id', $targetSectorId)
                            ->first();
    
        // If no stock record exists for the target sector, create a new one
        if (!$existingStock) {
            $newStock = new Stock();
            $newStock->product_id = $productId;
            $newStock->location_id = $targetLocationId;
            $newStock->sector_id = $targetSectorId;
            $newStock->product_quantity = $productQuantity;
            $newStock->save();
        } else {
            // Otherwise, add the product quantity to the existing stock record
            $existingStock->increment('product_quantity', $productQuantity);
        }
    
        // Create a new Monitoring record
        $monitoring = new Monitoring();
        $monitoring->product_id = $productId;
        $monitoring->product_quantity = $productQuantity;
        $monitoring->origin_location = $originLocationId;
        $monitoring->origin_sector = $originSectorId;
        $monitoring->target_location = $targetLocationId;
        $monitoring->target_sector = $targetSectorId;
        $monitoring->date = $date;
        $monitoring->save();
    
        return redirect('/movement');
    }    
    
}