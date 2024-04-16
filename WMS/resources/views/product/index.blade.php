@extends('header')
@section('title', 'Product')
@section('product_active', 'active')
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center mb-4">Products</h1>
                <p class="text-end mb-3">{{ $rowCount }} results found</p>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="mb-3">
                        <a href="{{ route('product.create') }}" class="btn btn-primary">
                            <img src="{{ asset('images/green-add-icon.png') }}" alt="Add Icon" style="width: 20px; height: auto;">
                            <span>Add Product</span>
                        </a>
                    </div>
                    <form action="{{ route('product.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by product name" name="search">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Display products in cards -->
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column"> 
                            <div class="d-flex align-items-center justify-content-between">
                                <div style="flex-grow: 1;">
                                    <h5 class="card-title mb-0">{{ $product->product_name }}</h5>
                                </div>
                                <div class="ms-2" style="display: grid; grid-template-columns: auto auto;">
                                    <a href="{{ route('product.edit', ['productId' => $product->product_id]) }}" class="btn">
                                        <img src="{{ asset('images/edit-pencil-icon.png') }}" alt="Edit Icon" style="width: 20px; height: auto; filter: grayscale(100%);">
                                    </a>
                                    <a href="{{ route('product.delete', ['productId'=> $product->product_id]) }}"class="btn">
                                        <img src="{{ asset('images/delete-icon.png') }}" alt="Delete Icon" style="width: 20px; height: auto; filter: grayscale(100%);">
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mt-4" style="height: 100%;">
                                @if(isset($product->productImage->product_image))
                                    <img src="{{ asset('storage/' . $product->productImage->product_image) }}" alt="Product Image" class="card-img-top">
                                @else
                                    <span>No image available</span>
                                @endif
                            </div>
                            @if (isset($totalStocks[$product->product_id]))
                                <p class="card-text mt-4">In Stock: {{ $totalStocks[$product->product_id] }}</p>
                            @else
                                 <p class="card-text mt-4">Out of Stock</p>
                            @endif
                            <div class="mt-auto">
                                <a href="{{ route('stock.index') }}?search_product_id={{ $product->product_id }}" class="btn btn-primary">Stock Details</a>
                            </div>
                            @if(session('success-' . $product->product_id))
                                <div class="alert alert-success mt-3">
                                    {{ session('success-' . $product->product_id) }}
                                </div>
                            @endif
                        </div>
                     </div>
                 </div>
            @endforeach
        </div>
    </div>
    @include('footer')
@endsection