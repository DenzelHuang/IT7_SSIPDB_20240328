@extends('header')
@section('title', 'Add Product')
@section('styling')
    h1 {
        color: white;
        text-shadow: black 0px 0px 5px;
    }
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection
@section('content')
    <div class="container mt-5" id="page-container">
        <div class="col-9 mx-auto border" id="form-container">
            <h2 class="text-center text-primary my-4">Add Product</h2>
            <div class="mx-5 py-3">
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation">
                    @csrf
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName" required>
                    </div>
                    <div class="invalid-feedback">Please enter a name.</div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="productImage">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                    <a href="{{ route('product.index') }}" class="btn btn-secondary mt-3">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    @include('footer')
@endsection