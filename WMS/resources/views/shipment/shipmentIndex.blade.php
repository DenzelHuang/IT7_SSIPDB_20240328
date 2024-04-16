<!-- He who is contented is rich. - Laozi -->
@extends('header')
@section('title', 'Shipment Index')
@section('styling')
    <style>
        /* Shipment */
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
    </style>
@endsection
@section('scripts')
@endsection

@section('shipment_active', 'active')

@section('content')
<div class="shipment-body">
    <div class="shipment-box container">
        <h3>Shipment Index</h3>
        <a href="{{ route('shipment.form') }}" class="btn btn-primary mt-1 mb-2">Add New Shipment</a>
        <div class="shipment-list">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Origin_location</th>
                    <th>Origin_sector</th>
                    <th>Target_location</th>
                    <th>Target_sector</th>
                    <th>Action</th>
                </tr>
                @foreach ($shipments as $shipment)
                <tr>
                    <td>{{ $shipment->shipment_id }}</td>
                    <td>{{ $shipment->shipment_date }}</td>
                    <td>{{ $shipment->shipment_type }}</td>
                    <td>{{ $shipment->origin_location }}</td>
                    <td>{{ $shipment->origin_sector }}</td>
                    <td>{{ $shipment->target_location }}</td>
                    <td>{{ $shipment->target_sector }}</td>
                    <td><a href="{{ route('shipment.product', ['id' => $shipment->shipment_id]) }}">Show</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@include('footer')
@endsection