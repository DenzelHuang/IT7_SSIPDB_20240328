@extends('header')
@section('title', 'Warehouse Locations')
@section('location_active', 'active')
@section('styling')
    h1, #result-count {
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
        <h1 class="text-center mb-4">Warehouse Locations</h1>
        <!-- Search form -->
        <form action="{{ route('location.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Warehouse ID" name="search_location_id">
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
            <div>
                <a href="{{ route('location.create') }}" class="btn btn-primary btn-sm">
                    <img src="{{ asset('images/green-add-icon.png') }}" alt="Add Icon" style="width: 20px; height: auto;">
                    <span>Add Location</span>
                </a>
            </div>
        </div>
        <div id="table-container" class="container-flex border px-3 py-3">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Warehouse ID</th>
                        <th scope="col">Location</th>
                        <th scope="col">Total Sectors</th>
                        <th scope="col">Sector ID</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td>{{ $location->location_id }}</td>
                            <td>{{ $location->location_name }}</td>
                            <td>{{ $totalSectors[$location->location_id] ?? 0 }}</td>
                            <td>
                                @if(isset($groupedSectors[$location->location_id]))
                                    @php $sectorIds = $groupedSectors[$location->location_id]->pluck('sector_id')->implode(', '); @endphp
                                    {{ $sectorIds }}
                                @else
                                    No sectors
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="{{ route('location.edit', ['locationId' => $location->location_id]) }}">Edit Location Name</a></li>
                                        <li><a class="dropdown-item" href="{{ route('location.delete', ['locationId' => $location->location_id]) }}">Delete Location</a></li>
                                        <li><a class="dropdown-item" href="{{ route('sector.create', ['locationId' => $location->location_id]) }}">Add Sectors</a></li>
                                        <li><a class="dropdown-item" href="{{ route('sector.delete', ['locationId' => $location->location_id]) }}">Remove Sector</a></li>
                                    </ul>
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