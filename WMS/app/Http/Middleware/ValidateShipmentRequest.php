<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ValidateShipmentRequest
{
    public function handle(Request $request, Closure $next)
    {
        $validator = validator()->make($request->all(), [
            'shipment_date' => 'required|date_format:Y-m-d|after:yesterday',
            'shipment_type' => 'required|in:IN,OUT',
            'location_select' => 'required',
            'sector_select' => 'required',
            'selected_products' => 'required|array|min:1',
        ], [
            'shipment_date.after' => 'The shipment date must either be today or in the future.',
            'shipment_type.required' => 'Select a shipment type.',
            'location_select.required' => 'A location must be selected.',
            'sector_select.required' => 'A sector must be selected.',
            'selected_products.required' => 'Select at least one product.'
        ]);

        // Validate product quantities if selected
        $selected_products = $request->input('selected_products', []);
        foreach ($selected_products as $product_id) {
            if ($request->input($product_id) < 1 || empty($request->input($product_id))) {
                return redirect()->back()->withInput()->withErrors(["Product quantity cannot be empty or less than 1"]);
            }
        }

        if ($request->shipment_type === 'OUT') {
            // Check stock for each selected product
            $productQuantities = $request->except('_token', 'shipment_date', 'shipment_type', 'location_select', 'sector_select');
            foreach ($selected_products as $productId) {
                // Retrieve product quantity in stock for the specified location and sector
                $stock = DB::table('stocks')
                    ->where('product_id', $productId)
                    ->where('location_id', $request->location_select)
                    ->where('sector_id', $request->sector_select)
                    ->value('product_quantity');

                // Check if enough stock is available
                $quantityRequested = $productQuantities[$productId];
                if ($stock < $quantityRequested) {
                    // Return error response if stock is insufficient
                    $product = Product::where('product_id', $productId)->first(); 
                    return redirect()->back()->withInput()->withErrors(["Not enough stock available for ({$product->product_name})"]);
                }
            }
        }

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors()->all());
        }

        return $next($request);
    }
}