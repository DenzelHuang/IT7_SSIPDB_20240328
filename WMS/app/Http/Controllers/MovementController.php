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
        $productName = $request->input('productName');
        $productQuantity = $request->input('productQuantity');
        $originLocationId = $request->input('originLocation');
        $originSectorId = $request->input('originSector');
        $targetLocationId = $request->input('targetLocation');
        $targetSectorId = $request->input('targetSector');
        $date = $request->input('date');
    
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
    
       // Find or create a stock record associated with the target sector
        $existingStock = Stock::firstOrCreate(
            [
                'product_id' => $productId,
                'location_id' => $targetLocationId,
                'sector_id' => $targetSectorId
            ],
            ['product_quantity' => $productQuantity]
        );

        // If the stock record already exists, increment the product quantity
        if (!$existingStock->wasRecentlyCreated) {
            $existingStock->increment('product_quantity', $productQuantity);
        }

        // Create a new Monitoring record using mass assignment
        $monitoring = Monitoring::create([
            'product_id' => $productId,
            'product_quantity' => $productQuantity,
            'origin_location' => $originLocationId,
            'origin_sector' => $originSectorId,
            'target_location' => $targetLocationId,
            'target_sector' => $targetSectorId,
            'date' => $date,
        ]);
        
        return redirect('/movement');
    }    
}