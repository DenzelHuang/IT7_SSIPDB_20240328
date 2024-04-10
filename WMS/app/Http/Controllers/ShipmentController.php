<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Shipment;
use App\Models\Product;
use App\Models\Sector;
use App\Models\ShippedProduct;
use Illuminate\Http\Request;

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
            $shipment->timestamps = false;
            $shipment->shipment_date = $request->shipment_date;
            $shipment->shipment_type = $request->shipment_type;
            if ($request->shipment_type === "IN") {
                $shipment->target_location = $request->target_location;
                $shipment->target_sector = $request->target_sector;
            } elseif ($request->shipment_type === "OUT") {
                $shipment->origin_location = $request->target_location;
                $shipment->origin_sector = $request->target_sector;
            }
            $shipment->save();
            
            // Create new entries in the shipped_products table
            $selected_products = $request->input('selected_products', []);
            foreach ($selected_products as $product_id) {
                $shipped_product = new ShippedProduct();
                $shipped_product->timestamps = false;
                $shipped_product->shipment_id = $shipment->id;
                $shipped_product->product_id = $product_id;
                $shipped_product->product_quantity = $request->input($product_id); // Assuming quantity input field names are dynamically created
                $shipped_product->save();
            }
            
            return redirect("/shipment/index");
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

}
