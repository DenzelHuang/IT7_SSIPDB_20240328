<!-- He who is contented is rich. - Laozi -->
@extends('header')
@section('title', 'Product Shipment')
@section('shipment_active', 'active')

@section('content')
    <div class="container my-5">
        <div id="table-container" class="container-flex border px-3 py-3">
            <h3>Shipment ID: {{ $id }}</h3>
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shippedProducts as $product)
                        <tr>
                            <td>{{ $product->product_id }}</td>
                            <td>{{ $product->product ? $product->product->product_name : 'N/A' }}</td>
                            <td>{{ $product->product_quantity }}</td>
                        </tr>
                    @endforeach    
                </tbody>
            </table>
        </div>
        <a href="{{ route('shipment.index') }}" class="btn btn-primary mt-2">Back</a>
    </div>
    @include('footer')
@endsection
