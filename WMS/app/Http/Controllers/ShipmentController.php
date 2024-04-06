<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Product;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{

    public function getAll() {
        $shipments = Shipment::all();
        return view("shipment/index", [
            "shipments" => $shipments,
        ]);
    }

    public function insert(Request $request) {
        if ($request->method() == "POST") {
            $shipment = new Shipment();
            $shipment->shipment_date = $request->shipment_date;
            $shipment->shipment_type = $request->shipment_type;
            $shipment->origin_location = $request->origin_location;
            $shipment->origin_sector = $request->origin_sector;
            $shipment->target_location = $request->target_location;
            $shipment->target_sector = $request->target_sector;
            $shipment->save();
            return redirect("/shipment/record");
        } else {
            $products = Product::all();
            return view("shipment/shipmentForm", [
                "products" => $products
            ]);
        }
    }

}
