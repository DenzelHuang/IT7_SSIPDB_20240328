@extends('header')
@section('title', 'Delete Product')
@section('product_active', 'active')
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
@section('content')
    <div class="container mt-5">
        <div class="col-9 mx-auto border" id="form-container">
            <h2 class="text-center text-primary my-4">Delete Product</h2>
            <div class="mx-5 py-3">
                <form action="{{ route('product.deleteConfirmed', ['productId'=>$product->product_id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input class="form-control" id="productName" name="productName" value="{{ $product->product_name }}" disabled>
                    </div>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProduct">
                        Delete
                    </button>
                    <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
                    <!-- Modal Window to Delete Product-->
                    <div class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteProductLabel">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this product?</p>
                                    <p>Warning: This action will delete all stocks associated with the product and cannot be recovered.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('footer')
@endsection