<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Location;
use App\Models\Sector;
use App\Models\Stock;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller 
{
    public function index(Request $request) {
        $search = $request->input('search');
        $products = Product::with('productImage');

        // Filter products if search query is present
        if ($search) {
            $products->where('product_name', 'LIKE', "%{$search}%");
        }

        $products = $products->get();

        // Get the count of rows
        $rowCount = $products->count();

        // Query to get the total stock for each product
        $totalStocks = Stock::select('product_id', DB::raw('SUM(product_quantity) as total_stock'))
                        ->groupBy('product_id')
                        ->pluck('total_stock', 'product_id');

        return view('product.index', compact('products', 'totalStocks', 'rowCount'));
    }

    public function create() {
        return view('product.create');
    }

    public function store(Request $request) {
        $request->validate([
            'productName' => 'required|string|max:255',
            'productImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if there's a soft-deleted product with the same name
        $product = Product::withTrashed()->firstOrCreate(
            ['product_name' => $request->input('productName')]
        );

        if ($product->trashed()) {
            // Restore the soft-deleted product
            $product->restore();
        }

        if ($request->hasFile('productImage')) {
            $imagePath = $request->file('productImage')->store('products', 'public');

            $product->productImage()->create(['product_image' => $imagePath]);
        }

        return redirect('/products')->with('success-' . $product->product_id, 'Product added successfully.');
    }

    public function edit($productId) {
        $product = Product::findOrFail($productId);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, $productId) {
        $product = Product::findOrFail($productId);
    
        $request->validate([
            'productName' => 'required|string|max:255',
            'productImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Check if there's an existing product (including soft-deleted) with the same name
        $existingProduct = Product::withTrashed()
                                  ->where('product_name', $request->input('productName'))
                                  ->first();
    
        // Return error if exists
        if ($existingProduct) {
            return redirect()->back()->withErrors(['productName' => 'A product with this name already exists.']);
        }
    
        // Update product name
        $product->update(['product_name' => $request->input('productName')]);
    
        // Update product image if a new image file is provided
        if ($request->hasFile('productImage')) {
            $imagePath = $request->file('productImage')->store('products', 'public');
    
            // Check if product has an existing image
            if ($product->productImage) {
                // Update existing product image
                $product->productImage->update(['product_image' => $imagePath]);
            } else {
                // Create new product image if it doesn't exist
                $product->productImage()->create(['product_image' => $imagePath]);
            }
        }
    
        return redirect('/products')->with('success-' . $productId, 'Product updated successfully.');
    }
    
    public function delete($productId) {
        $product = Product::findOrFail($productId);

        return view('product.delete', compact('product'));
    }

    public function deleteConfirmed(Request $request, $productId) {
        $product = Product::findOrFail($productId);
        $product->delete(); // Soft delete the product
        return redirect('/products');
    }

    public function getDataForHomePage() {
        // Get data for pie chart
        $getQtyByLocations = Stock::select('locations.location_name as location_name', DB::raw('SUM(product_quantity) as total_quantity'))
            ->join('locations', 'stocks.location_id', '=', 'locations.location_id')
            ->groupBy('stocks.location_id', 'locations.location_name')
            ->get();
    
        // Fetch all locations
        $locations = Location::all();
    
        // Initialize an empty array to store data for each location
        $locationData = [];
    
        // Loop through each location
        foreach ($locations as $location) {
            // Fetch sectors and their quantities for the current location
            $sectors = Sector::join('stocks', 'sectors.sector_id', '=', 'stocks.sector_id')
                ->where('stocks.location_id', $location->location_id)
                ->select('sectors.sector_id', 'stocks.product_quantity')
                ->get();
    
            // Fetch products and their quantities for the current location
            $products = Product::join('stocks', 'products.product_id', '=', 'stocks.product_id')
                ->where('stocks.location_id', $location->location_id)
                ->select('products.product_name', 'stocks.product_quantity')
                ->get();
    
            // Store the data for the current location
            $locationData[$location->location_name] = [
                'location' => $location,
                'sectors' => $sectors,
                'products' => $products,
            ];
        }
    
        // Pass all data to the view
        return view('home', compact('getQtyByLocations', 'locationData'));
    }
}