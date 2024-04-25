@extends('header')
@section('title', 'Internal Movement')
@section('intmvt_active', 'active')
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
             // Event listener to update sector selection on location change
            $('#originLocation').on('change', function() {
                var locationId = $(this).val();
                var sectorSelect = $('#originSector');

                // Clear existing options
                sectorSelect.empty();
                sectorSelect.append($('<option>', {
                    value: '',
                    text: 'Select Sector'
                }));

                // Fetch sectors to the sector list
                getSectors(locationId, sectorSelect);
            });
            $('#targetLocation').on('change', function() {
                var locationId = $(this).val();
                var sectorSelect = $('#targetSector');

                // Clear existing options
                sectorSelect.empty();
                sectorSelect.append($('<option>', {
                    value: '',
                    text: 'Select Sector'
                }));

                // Fetch sectors to the sector list
                getSectors(locationId, sectorSelect);
            });
        });
    </script>
@endsection
@section('content')
    <div class="container my-5">
        <div class="col-9 mx-auto border" id="form-container">
            <h2 class="text-center text-primary my-4">Internal Movement</h2>
            <div class="mx-5 py-3">
                <form action="{{ route('movement.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" max="9999-12-31" class="form-control" id="date" name="date">
                        <div class="invalid-feedback">Please enter a date.</div>
                    </div>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input class="form-control" list="productList" id="productName" name="productName" placeholder="Type to search..." autocomplete="off">
                        <datalist id="productList">
                            @foreach($products as $product)
                                <option value="{{ $product->product_name }}">{{ $product->product_name }}</option>
                            @endforeach
                        </datalist>
                        <div class="invalid-feedback">Please choose a product from the list.</div>
                    </div>
                    <div class="mb-3">
                        <label for="productQuantity" class="form-label">Product Quantity</label>
                        <input type="number" class="form-control" id="productQuantity" name="productQuantity" min="0" step="1" pattern="\d+">
                        @if ($errors->has('productQuantity'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('productQuantity') }}
                            </div>
                        @endif
                        <div class="invalid-feedback">Please enter a quantity greater than 0.</div>
                    </div>
                    <div class="mb-3">
                        <label for="originLocation" class="form-label">Origin Location</label>
                        <select class="form-select location-select" id="originLocation" name="originLocation">
                            <option value="">Select Location</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->location_id }}">{{ $location->location_name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose a location from the list.</div>
                    </div>
                    <div class="mb-3">
                        <label for="originSector" class="form-label">Origin Sector</label>
                        <select class="form-select sector-select" id="originSector" name="originSector">
                            <option value="">Select sector</option>
                        </select>
                        @if ($errors->has('originSector'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('originSector') }}
                            </div>
                        @endif
                        <div class="invalid-feedback">Please choose a sector from the list.</div>
                    </div>
                    <div class="mb-3">
                        <label for="targetLocation" class="form-label">Target Location</label>
                        <select class="form-select location-select" id="targetLocation" name="targetLocation">
                            <option value="">Select Location</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->location_id }}">{{ $location->location_name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose a location from the list.</div>
                    </div>
                    <div class="mb-3">
                        <label for="targetSector" class="form-label">Target Sector</label>
                        <select class="form-select sector-select" id="targetSector" name="targetSector">
                            <option value="">Select sector</option>
                        </select>
                        <div class="invalid-feedback">Please choose a sector from the list.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
    @include('footer')
@endsection