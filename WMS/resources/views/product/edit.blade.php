@extends('header')
@section('title', 'Edit Product')
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection
@section('content')
    <div class="container mt-5">
        <div class="col-9 mx-auto border" id="form-container">
            <h2 class="text-center text-primary my-4">Edit Product</h2>
            <div class="mx-5 py-3">
                <form action="{{ route('product.update', ['productId' => $product->product_id]) }}" method="POST" enctype="multipart/form-data" class="needs-validation">
                    @csrf
                    @method('PUT') <!-- Use PUT method for updating data -->
                    @if ($errors->has('productName'))
                        <div class="alert alert-danger">
                            {{ $errors->first('productName') }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName" value="{{ $product->product_name }}" required>
                    </div>
                    <div class="invalid-feedback">Please enter a name.</div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="productImage">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                    <a href="{{ route('product.index') }}" class="btn btn-secondary mt-3">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    @include('footer')
@endsection