<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Update product name
        $product->product_name = $request->input('productName');

        // Update product image if provided
        if ($request->hasFile('productImage')) {
            $imagePath = $request->file('productImage')->store('products', 'public');
            $product->product_image = $imagePath;
        }

        $product->save();

        return redirect('/products')->with('success-' . $productId, 'Product updated successfully.');
    }
}
