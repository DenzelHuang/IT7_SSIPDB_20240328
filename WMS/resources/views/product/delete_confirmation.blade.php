<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Confirmation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Confirm Deletion</h1>
        <p>Are you sure you want to delete {{ $product->product_name }}?</p>
        <form action="{{ route('product.deleteConfirmed', ['productId' => $product->product_id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="/products" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>