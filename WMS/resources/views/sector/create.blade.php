@extends('header')
@section('title', 'Add Sector')
@section('styling')
    h1, #result-count {
        color: white;
        text-shadow: black 0px 0px 5px;
    }
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection
@section('content')
    <div class="container mt-5">
        <div class="col-9 mx-auto border" id="form-container">
            <h2 class="text-center text-primary my-4">Add Sector</h2>
            <div class="mx-5 py-3">
                <form action="{{ route('sector.store', ['locationId' => $location->location_id]) }}" method="POST" class="needs-validation">
                    @csrf
                    <div class="mb-3">
                        <label for="locationName" class="form-label">Location Name</label>
                        <input class="form-control" id="locationName" name="locationName" value="{{ $location->location_name }}" disabled>
                    </div>
                    <div class="invalid-feedback">Please enter a location name.</div>
                    <div class="mb-3">
                        <label for="sectorQuantity" class="form-label">Number of Sectors</label>
                        <input type="number" class="form-control" id="sectorQuantity" name="sectorQuantity" min="0" step="1" pattern="\d+" required>
                        <div class="invalid-feedback">Please enter a number.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Sector</button>
                    <a href="{{ route('location.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    @include('footer')
@endsection