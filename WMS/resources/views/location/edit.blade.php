@extends('header')
@section('title', 'Edit Warehouse Location')
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
            <h2 class="text-center text-primary my-4">Edit Location</h2>
            <div class="mx-5 py-3">
                <form action="{{ route('location.update', ['locationId' => $location->location_id]) }}" method="POST" class="needs-validation">
                    @csrf
                    @method('PUT')
                    @if ($errors->has('locationName'))
                        <div class="alert alert-danger">
                            {{ $errors->first('locationName') }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="locationName" class="form-label">Location Name</label>
                        <input class="form-control" id="locationName" name="locationName" value="{{ $location->location_name }}"required>
                        <div class="invalid-feedback">Please enter a location.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('location.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    @include('footer')
@endsection