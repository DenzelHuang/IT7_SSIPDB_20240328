@extends('header')
@section('title', 'Remove Sector')
@section('styling')
    h1, #result-count {
        color: white;
        text-shadow: black 0px 0px 5px;
    }
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection
@section('content')
    <div class="container mt-5">
        <div class="col-9 mx-auto border" id="form-container">
            <h2 class="text-center text-primary my-4">Remove Sector</h2>
            <div class="mx-5 py-3">
                <form action="{{ route('sector.deleteConfirmed') }}" method="POST" class="needs-validation">
                    @csrf
                    @method('DELETE')
                    <div class="mb-3">
                        <label for="locationName" class="form-label">Location Name</label>
                        <input class="form-control" id="locationName" name="locationName" value="{{ $location->location_name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="sectorSelect" class="form-label">Sector ID</label>
                        <select class="form-select sector-select" id="sectorSelect" name="sectorSelect">
                            <option value="">Select sector</option>
                            @foreach($sectors as $sector)
                                <option value="{{ $sector->sector_id }}">{{ $sector->sector_id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="invalid-feedback">Please select at least one sector.</div>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSector">
                        Delete
                    </button>
                    <a href="{{ route('location.index') }}" class="btn btn-secondary">Cancel</a>
                    <!-- Modal Window to Confirm Deletion-->
                    <div class="modal fade" id="deleteSector" tabindex="-1" aria-labelledby="deleteSectorLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteSectorLabel">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this sector?</p>
                                    <p>Warning: This action will delete all stocks associated with the sectors and cannot be recovered.</p>
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