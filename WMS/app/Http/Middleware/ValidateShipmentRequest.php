<?php

namespace App\Http\Middleware;

use App\Models\Shipment;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateShipmentRequest
{
    public function handle(Request $request, Closure $next)
    {
        // $validator = validator()->make($request->all(), [
        //     'shipment_date' => 'required|date_format:Y-m-d',
        //     'shipment_type' => 'required|in:IN,OUT',
        //     'origin_location' => ($request->shipment_type === 'OUT') ? 'required' : '',
        //     'origin_sector' => ($request->shipment_type === 'OUT') ? 'required' : '',
        //     'target_location' => ($request->shipment_type === 'IN') ? 'required' : '',
        //     'target_sector' => ($request->shipment_type === 'IN') ? 'required' : '',
        //     'selected_products' => 'required|array|min:1',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withInput()->withErrors($validator->errors()->all());
        // }

        $shipment_date = $request->shipment_date;
        $shipment_type = $request->shipment_type;
        if ($request->shipment_type === 'OUT') {
            $origin_location = $request->origin_location;
            $origin_sector = $request->origin_sector;
        } elseif ($request->shipment_type === 'IN') {
            $target_location = $request->target_location;
            $target_sector = $request->target_sector;
        }
        


        return $next($request);
    }
}