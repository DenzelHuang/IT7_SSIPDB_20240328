<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stocks</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('header')
    <div class="container my-5">
        <h1 class="text-center mb-4">Stocks</h1>
        <!-- Search form -->
        <form action="{{ route('stock.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Product ID" name="search_product_id">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Product Name" name="search_product_name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Location Name" name="search_location_name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Sector ID" name="search_sector_id">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
        <p class="text-muted">Showing {{ $rowCount }} results</p>
        <a href="{{ route('stock.index') }}" class="btn btn-link">See all stocks</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product ID</th>
                    <th scope="col">Warehouse</th>
                    <th scope="col">Sector ID</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groupedStocks as $productId => $stocksGroup)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $stocksGroup->first()->product->productImage->product_image) }}" alt="Product Image" class="img-fluid img-thumbnail" style="max-width: 100px;">
                    </td>
                    <td>{{ $stocksGroup->first()->product->product_name }}</td>
                    <td>{{ $productId }}</td>
                    <td>
                        @foreach($stocksGroup as $stock)
                            {{ $stock->location->location_name }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($stocksGroup as $stock)
                            {{ $stock->sector_id }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($stocksGroup as $stock)
                            {{ $stock->product_quantity }}<br>
                        @endforeach
                    </td>
                    <td>{{ $totalStocks[$stock->product_id] ?? 0 }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('footer')
</body>
</html>