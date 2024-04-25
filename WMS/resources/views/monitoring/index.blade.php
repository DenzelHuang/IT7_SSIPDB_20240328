@extends('header')
@section('title', 'Monitoring')
@section('monitoring_active', 'active')
@section('styling')
    h1, #result-count, #see-all-link {
        color: white;
        text-shadow: black 0px 0px 5px;
    }
    #table-container {
        background-color:white;
        border-radius: 10px; 
    }
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> 
@endsection
@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Monitoring</h1>
        <!-- Search form -->
        <form action="{{ route('monitoring.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Product ID" name="search_product_id">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Product Name" name="search_product_name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Origin Location" name="search_origin_location">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Target Location" name="search_target_location">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Origin Sector ID" name="search_origin_sector">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Target Sector ID" name="search_target_sector">
                </div>
                <div class="col">
                    <input type="date" max="9999-12-31" class="form-control" id="date" name="search_date">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p id="result-count">Showing {{ $rowCount }} results</p>
            <a href="{{ route('monitoring.index') }}" class="btn btn-link" role="button" id="see-all-link">See all records</a>
        </div>
        <div id="table-container" class="container-flex border px-3 py-3">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Product ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Quantity</th>
                        <th scope="col">Origin Location</th>
                        <th scope="col">Origin Sector</th>
                        <th scope="col">Target Location</th>
                        <th scope="col">Target Sector</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($monitorings as $monitoring)
                        <tr>
                            <td>{{ $monitoring->product_id }}</td>
                            <td>{{ $monitoring->product->product_name }}</td>
                            <td>{{ $monitoring->product_quantity }}</td>
                            @if($monitoring->originLocation)
                                <td>{{ $monitoring->originLocation->location_name }}</td>
                            @else
                                <td>N/A</td>
                            @endif
                            @if($monitoring->origin_sector)
                                <td>{{ $monitoring->origin_sector }}</td>
                            @else
                                <td>N/A</td>
                            @endif
                            @if($monitoring->targetLocation)
                                <td>{{ $monitoring->targetLocation->location_name }}</td>
                            @else
                                <td>N/A</td>
                            @endif
                            @if($monitoring->target_sector)
                                <td>{{ $monitoring->target_sector }}</td>
                            @else
                                <td>N/A</td>
                            @endif
                            <td>{{ $monitoring->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('footer')
@endsection