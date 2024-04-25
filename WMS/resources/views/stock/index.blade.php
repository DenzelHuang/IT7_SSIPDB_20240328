@extends('header')

@section('title', 'Stock')

@section('stock_active', 'active')
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('content')
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
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p id="result-count">Showing {{ $rowCount }} results</p>
            <a href="{{ route('stock.index') }}" class="btn btn-link" role="button" id="see-all-link">See all stocks</a>
        </div>
        <div id="table-container" class="container-flex border px-3 py-3">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product ID</th>
                        <th scope="col">Total Stock</th>
                        <th scope="col">Warehouse Stock</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach($groupedStocks as $productId =>$stocksGroup)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                @if(isset($stocksGroup->first()->product->productImage->product_image))
                                    <img src="{{ asset('storage/' . $stocksGroup->first()->product->productImage->product_image) }}" alt="Product Image" class="img-fluid img-thumbnail" style="max-width: 100px;">
                                @else
                                    <p>Image Not Available</p>
                                @endif
                            </td>
                            <td>{{ $stocksGroup->first()->product->product_name }}</td>
                            <td>{{ $productId }}</td>
                            <td>{{ $totalStocks[$productId] ?? 0 }}</td>
                            <td>
                                <div class="accordion" id="accordionLocations{{ $productId }}">
                                    @foreach($stocksGroup->groupBy('location_id') as $locationId => $locationStocks)
                                        @php $location = $locationStocks->first()->location; @endphp
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingLocation{{ $locationId }}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLocation{{ $productId }}_{{ $locationId }}" aria-expanded="false" aria-controls="collapseLocation{{ $productId }}_{{ $locationId }}">
                                                    {{ $location->location_name }}: {{ $locationStocks->sum('product_quantity') }}
                                                </button>
                                            </h2>
                                            <div id="collapseLocation{{ $productId }}_{{ $locationId }}" class="accordion-collapse collapse" aria-labelledby="headingLocation{{ $locationId }}" data-bs-parent="#accordionLocations{{ $productId }}">
                                                <div class="accordion-body">
                                                    <ul>
                                                        @foreach($locationStocks->groupBy('sector_id') as $sectorId => $sectorStocks)
                                                            <li>
                                                                @foreach($sectorStocks as $stock)
                                                                    Sector {{ $sectorId }} : {{ $stock->product_quantity }}
                                                                @endforeach
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('footer')
@endsection