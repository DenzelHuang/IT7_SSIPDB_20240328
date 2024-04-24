@extends('header')
@section('title', 'Shipment Form')
@section('styling')
    .selected-item {
        margin-top: 5px;
    }
    button {
        width: 100%;
    }
    .location-sector-group {
    display: none;
    }
@endsection
@section('scripts')
    <!-- Bootstrap JS, jQuery, and custom script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            // DATE FUNCTION
            // Validate date format as user types
            $('#shipmentDate').on('input', function() {
                var value = $(this).val();
                var regex = /^\d{4}-\d{2}-\d{2}$/;
                if (!regex.test(value)) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });



            // RADIO BUTTON FUNCTION
            // Event listener for radio button change
                $('input[type="radio"][name="shipment_type"]').change(function(){
                    var shipment_type = $(this).val();
                    updateLocationSectorOptions(shipment_type);
                });



            // SHIPMENT LOCATION VISIBILITY FUNCTION
            // Initialize location and sector options based on the initial radio button selection
            var initial_shipment_type = $('input[type="radio"][name="shipment_type"]:checked').val();
            updateLocationSectorOptions(initial_shipment_type);

            // Function to dynamically update location and sector options based on radio button selection
            function updateLocationSectorOptions(shipment_type) {
                if (shipment_type === "IN") {
                    $('#location_label').text('Target Location');
                    $('#sector_label').text('Target Sector');
                    $('#location').show();
                } else if (shipment_type === "OUT") {
                    $('#location_label').text('Origin Location');
                    $('#sector_label').text('Origin Sector');
                    $('#location').show();
                } else {
                    $('#location').hide();
                    $('#sector').hide();
                }    
            }


            // SECTOR ID DISPLAY FUNCTION
            // Event listener for location select change
            $('#location_select').change(function() {
                if ($(this).val()) {
                    $('#sector').show(); // Show sector div if an option is selected
                    fetchSectors($(this).val()); // Fetch sectors based on the selected location
                } else {
                    $('#sector').hide(); // Hide sector div if no option is selected
                }
            });

            // Function to fetch sectors based on the selected location
            function fetchSectors(locationId) {
                console.log('Fetching sectors for location ID:', locationId);
                console.log('URL:', '/sectors/' + locationId);
                $.ajax({
                    url: '/sectors/' + locationId, // New route to fetch sectors
                    method: 'GET',
                    success: function(data) {
                        console.log('Fetched sectors:', data);
                        $('#sector_select').empty(); // Clear previously selected sectors
                        if (data.length) {
                            data.forEach(function(sectors) {
                                $('#sector_select').append('<option value="' + sectors.sector_id + '">' + sectors.sector_id + '</option>');
                            });
                        } else {
                            $('#sector_select').append('<option value="" disabled selected hidden>No sectors found</option>');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }



            // PRODUCT QUANTITY INPUT FIELD FUNCTION 
            // JavaScript code for showing/hiding quantity input fields
            $('.form-check-input[type="checkbox"]').change(function(){
                var productId = $(this).val();
                if ($(this).is(':checked')) {
                    $('#quantityInput' + productId).show();
                } else {
                    $('#quantityInput' + productId).hide();
                }
            });
        });
    </script>
@endsection

@section('shipment_active', 'active')

@section('content')
    <div class="container my-5">
        <div class="col-9 mx-auto border" id="form-container">
            <h2 class="text-center text-primary my-4">Add Shipment</h2>
            <div class="mx-5 my-5">
                <form id="dynamicForm" method="POST">
                    @csrf
                    @if(session('errors'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Date Field --}}
                    <div class="form-group my-2">
                        <label for="shipment_date">Shipment Date</label>
                        <input type="date" max="9999-12-31" class="form-control" id="shipment_date" name="shipment_date" required>
                        <!-- Add error message -->
                        @error('shipment_date')
                            <div class="text-danger">Do not leave blank</div>
                        @enderror
                    </div>

                    {{-- Shipment Type Radio Buttons --}}
                    <div class="form-group">
                        <label>Type of Shipment</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="shipment_type" id="shipment_in" value="IN">
                            <label class="form-check-label" for="shipment_in">IN</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="shipment_type" id="shipment_out" value="OUT">
                            <label class="form-check-label" for="shipment_out">OUT</label>
                        </div>
                        <!-- Add error message -->
                            @error('shipment_type')
                            <div class="text-danger">Do not leave blank</div>
                        @enderror
                    </div>

                    {{-- Location Selection --}}
                    <div class="form-group" id="location">
                        <label id="location_label">Target Location</label>
                        <select class="form-control" id="location_select" name="location_select">
                            <option value="" disabled selected hidden></option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->location_id }}">{{ $location->location_name }}</option>
                            @endforeach
                        </select>
                        <!-- Add error message -->
                        @error('location_select')
                        <div class="text-danger">Do not leave blank</div>
                        @enderror
                    </div>

                    {{-- Sector Selection --}}
                    <div class="form-group" id="sector">
                        <label id="sector_label">Target Sector</label>
                        <select class="form-control" id="sector_select" name="sector_select">
                            <option value="" disabled selected hidden></option>
                        </select>
                        @error('sector_select')
                        <div class="text-danger">Do not leave blank</div>
                        @enderror
                    </div>

                    {{-- Product Checkboxes --}}
                    <div class="form-group my-2">
                        <label>Select Items</label><br>
                        @foreach ($products as $product)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="{{ $product->product_id }}" value="{{ $product->product_id }}" name="selected_products[]">
                                <label class="form-check-label" for="{{ $product->product_id }}">{{ $product->product_name }}</label>
                            </div><br>
                            <div id="quantityInput{{ $product->product_id }}" class="quantity-input" style="display: none;">
                                <input type="number" class="form-control" name="{{ $product->product_id }}" placeholder="Enter quantity">
                                <!-- Add error message for quantity field -->
                                @error($product->product_id)
                                    <div class="text-danger">Do not leave blank</div>
                                @enderror
                            </div><br>
                        @endforeach        
                    </div>

                    {{-- Submit Button --}}
                    <div id="selectedItems"></div> <!-- Container for selected items -->
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>    
            </div>
        </div>
    </div>
    @include('footer')
@endsection
