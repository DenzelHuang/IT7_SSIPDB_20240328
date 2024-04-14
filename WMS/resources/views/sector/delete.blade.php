@extends('header')
@section('title', 'Remove Sector')
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection
@section('content')
    <div class="container mt-5">
        <div class="col-9 mx-auto border">
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
                        <label class="form-label">List of Sector ID</label>
                        @foreach($sectors as $sector)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sectorCheckbox{{ $sector->sector_id }}" name="sectorCheckbox[]" value="{{ $sector->sector_id }}" required>
                                <label class="form-check-label" for="sectorCheckbox{{ $sector->sector_id }}">{{ $sector->sector_id}}</label>
                            </div>
                        @endforeach
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