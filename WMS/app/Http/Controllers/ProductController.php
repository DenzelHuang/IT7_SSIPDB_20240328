<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Stock;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');
        $products = Product::query();
    
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

    public function edit($productId) {
        $product = Product::findOrFail($productId);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, $productId) {
        $product = Product::findOrFail($productId);

        // Update product name
        $product->product_name = $request->input('productName');

        // Update product image if provided
        if ($request->hasFile('productImage')) {
            $imagePath = $request->file('productImage')->store('products', 'public');

            $productImage = ProductImage::where('product_id', $productId)->first();

            if ($productImage) {
                $productImage->product_image = $imagePath;
                $productImage->save(); // Save the updated product image record
            } else {
                // If product image doesn't exist, create a new one
                $productImage = new ProductImage();
                $productImage->product_id = $productId;
                $productImage->product_image = $imagePath;
                $productImage->save(); // Save the new product image record
            }
        }

        $product->save();

        return redirect('/products')->with('success-' . $productId, 'Product updated successfully.');
    }

    public function destroy($productId) {
        $product = Product::findOrFail($productId);
        return view('product.delete_confirmation', compact('product'));
    }

    public function deleteConfirmed($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();
        return redirect('/products')->with('success', 'Product deleted successfully.');
    }

    public function create() {
        return view('product.create');
    }

    public function store(Request $request) {
        // Validate the request data
        $request->validate([
            'productName' => 'required|string|max:255',
            'productImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();
        $product->product_name = $request->input('productName');
        $product->save();

        if ($request->hasFile('productImage')) {
            $imagePath = $request->file('productImage')->store('products', 'public');

            $productImage = new ProductImage();
            $productImage->product_id = $product->product_id;
            $productImage->product_image = $imagePath;
            $productImage->save();
        }        

        // Redirect back to the products page with a success message
        return redirect('/products')->with('success', 'Product added successfully.');
    }
}
