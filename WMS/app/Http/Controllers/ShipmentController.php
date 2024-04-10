<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Shipment;
use App\Models\Product;
use App\Models\Sector;
use Illuminate\Http\Request;
use App\Models\ShippedProduct;

class ShipmentController extends Controller
{

    public function getAll() {
        $shipments = Shipment::all();
        return view("shipment/shipmentIndex", [
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
            $locations = Location::all();
            $sectors = Sector::all();
            return view("shipment/shipmentForm", [
                "products" => $products,
                "locations" => $locations,
                "sectors" => $sectors
            ]);
        }
    }

    public function shipmentProduct(int $id) {
        // Find all shipped products for the given shipment ID
        $shippedProducts = ShippedProduct::with('product')->where('shipment_id', $id)->get();
        return view("shipment/shipmentProduct", [
            "id" => $id,
            "shippedProducts" => $shippedProducts
        ]);
    }
}
