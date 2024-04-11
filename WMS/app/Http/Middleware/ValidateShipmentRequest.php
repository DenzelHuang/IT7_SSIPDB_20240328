<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateShipmentRequest
{
    public function handle(Request $request, Closure $next)
    {
        $validator = validator()->make($request->all(), [
            'shipment_date' => 'required|date_format:Y-m-d',
            'shipment_type' => 'required|in:IN,OUT',
            'location_select' => 'required',
            'sector_select' => 'required',
            'selected_products' => 'required|array|min:1',
        ]);

        // Validate product quantities if selected
        $selectedProducts = $request->input('selected_products', []);
        foreach ($selectedProducts as $productId) {
            $validator->sometimes($productId, 'required|integer|min:1', function ($input) use ($productId) {
                return in_array($productId, $input['selected_products']);
            });
        }

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors()->all());
        }

        return $next($request);
    }
}