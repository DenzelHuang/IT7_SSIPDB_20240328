<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Products</h1>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-4 mb-4">
                    <div class="card h-100"> <!-- Add h-100 class to make cards occupy full height -->
                        <div class="card-body d-flex flex-column"> <!-- Use flexbox to make card body fill available space -->
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                                <img src="{{ asset('storage/' . $product->product_image) }}" alt="Product Image" class="img-fluid w-100"> <!-- Set width to 100% to ensure image fills its container -->
                            </div>
                            <div class="mt-auto"> <!-- Use mt-auto to push the buttons to the bottom -->
                                <a href="{{ route('product.edit', ['productId' => $product->product_id]) }}" class="btn btn-primary">Edit</a>
                                <a href="#" class="btn btn-primary">Show Stock</a>
                            </div>
                            @if(session('success-' . $product->product_id))
                                <div class="alert alert-success mt-3"> <!-- Add margin to separate the success message -->
                                    {{ session('success-' . $product->product_id) }}
                                </div>
                            @endif
                        </div>
                     </div>
                 </div>
            @endforeach
        </div>
    </div>
</body>
</html>