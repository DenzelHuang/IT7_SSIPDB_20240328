<!-- He who is contented is rich. - Laozi -->
@extends('header')
@section('title', 'Product Shipment')
@section('styling')
    .shipment-body {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .shipment-box {
        padding: 20px;
        border: 1px solid black;
        background-color: ghostwhite;
        border-radius: 20px;
        overflow: hidden;
        overflow-x: scroll;
        overflow-y: scroll;
    }
    .shipment-list {
        height: 100%;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        border-collapse: collapse;
        overflow: hidden;
        overflow-y: scroll;
    }
    .shipment-box::-webkit-scrollbar,
    .shipment-list::-webkit-scrollbar {
        display: none;
    } 
    .shipment-list table,
    .shipment-list tr,
    .shipment-list th,
    .shipment-list td {
        border: 1px solid black;
    }
    .shipment-list table {
        margin-top: -1px;
        margin-bottom: -1px;
        padding: 0;
        width: 100%;
    }
    .shipment-list th, 
    .shipment-list td {
        text-align: center;
    }
@endsection

@section('shipment_active', 'active')

@section('content')
<div class="shipment-body my-5">
    <div class="shipment-box container">
        <h3>Product Shipment ID: {{ $id }}</h3>
        <div class="shipment-list">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                </tr>
                @foreach ($shippedProducts as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td>{{ $product->product ? $product->product->product_name : 'N/A' }}</td>
                    <td>{{ $product->product_quantity }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <a href="{{ route('shipment.index') }}" class="btn btn-primary mt-2">Back</a>
    </div>
</div>
@include('footer')
@endsection
