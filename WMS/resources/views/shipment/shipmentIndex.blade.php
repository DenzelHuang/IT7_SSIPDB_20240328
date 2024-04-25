<!-- He who is contented is rich. - Laozi -->
@extends('header')
@section('title', 'Shipment Index')
@section('shipment_active', 'active')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Shipments</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <a href="{{ route('shipment.form') }}" class="btn btn-primary mt-1 mb-2">
                    <img src="{{ asset('images/green-add-icon.png') }}" alt="Add Icon" style="width: 20px; height: auto;">
                    <span>Create New Shipment</span>
                </a>
            </div>
        </div>
        <div id="table-container" class="container-flex border px-3 py-3">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <th scope="col">ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Type</th>
                    <th scope="col">Origin_location</th>
                    <th scope="col">Origin_sector</th>
                    <th scope="col">Target_location</th>
                    <th scope="col">Target_sector</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody>
                    @foreach ($shipments as $shipment)
                        <tr>
                            <td>{{ $shipment->shipment_id }}</td>
                            <td>{{ $shipment->shipment_date }}</td>
                            <td>{{ $shipment->shipment_type }}</td>
                            <td>{{ $shipment->origin_location }}</td>
                            <td>{{ $shipment->origin_sector }}</td>
                            <td>{{ $shipment->target_location }}</td>
                            <td>{{ $shipment->target_sector }}</td>
                            <td><a href="{{ route('shipment.product', ['id' => $shipment->shipment_id]) }}">Show Products</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('footer')
@endsection