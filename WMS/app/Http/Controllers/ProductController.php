<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $products = Product::query();

    // Filter products if search query is present
    if ($search) {
        $products->where('product_name', 'LIKE', "%{$search}%");
    }

    $products = $products->get();

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

}
