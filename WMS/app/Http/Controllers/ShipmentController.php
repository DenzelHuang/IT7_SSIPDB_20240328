<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Shipment;
use App\Models\Product;
use App\Models\Sector;
use App\Models\ShippedProduct;
use App\Models\Stock;
use App\Models\Monitoring;
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
            // Retrieve shipment data from form
            $shipment_date = $request->shipment_date;
            $shipment_type = $request->shipment_type;
            $location = $request->location_select;
            $sector = $request->sector_select;

            $shipment = new Shipment();
            $shipment->timestamps = false;
            $shipment->shipment_date = $shipment_date;
            $shipment->shipment_type = $shipment_type;
            if ($shipment_type === "IN") {
                $shipment->target_location = $location;
                $shipment->target_sector = $sector;
            } elseif ($shipment_type === "OUT") {
                $shipment->origin_location = $location;
                $shipment->origin_sector = $sector;
            }
            $shipment->save();
            
            // Create new entries in the shipped_products and monitoring tables and increment or decrement from stock
            $selected_products = $request->input('selected_products', []);
            foreach ($selected_products as $product_id) {
                // Retrieve data from selected products
                $product_quantity = $request->input($product_id);

                // Increment or decrement stock
                if ($shipment_type === "IN") {
                    Stock::where('product_id', $product_id)
                    ->where('location_id', $location)
                    ->where('sector_id', $sector)
                    ->increment('product_quantity', $product_quantity);
                } elseif ($shipment_type === "OUT") {
                    Stock::where('product_id', $product_id)
                    ->where('location_id', $location)
                    ->where('sector_id', $sector)
                    ->decrement('product_quantity', $product_quantity);
                }

                // Create new entry in the shipped_products table
                $shipped_product = new ShippedProduct();
                $shipped_product->timestamps = false;
                $shipped_product->shipment_id = $shipment->id;
                $shipped_product->product_id = $product_id;
                $shipped_product->product_quantity =  $product_quantity;// Assuming quantity input field names are dynamically created
                $shipped_product->save();

                $monitoring = new Monitoring();
                $monitoring->product_id = $product_id;
                $monitoring->product_quantity = $product_quantity;
                if ($shipment_type === "IN") {
                    $monitoring->target_location = $location;
                    $monitoring->target_sector = $sector;
                } elseif ($shipment_type === "OUT") {
                    $monitoring->origin_location = $location;
                    $monitoring->origin_sector = $sector;
                }
                $monitoring->date = $shipment_date;
                $monitoring->save();
        
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

    public function shipmentProduct(int $id) {
        // Find all shipped products for the given shipment ID
        $shippedProducts = ShippedProduct::with('product')->where('shipment_id', $id)->get();
        return view("shipment/shipmentProduct", [
            "id" => $id,
            "shippedProducts" => $shippedProducts
        ]);
    }
}
