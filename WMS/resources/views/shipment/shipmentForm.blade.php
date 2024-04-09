<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shipment Form</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="{{ asset('css/Stylesheet.css') }}"> --}}
    
    <style>
        .selected-item {
            margin-top: 5px;
        }
        button {
            width: 100%;
        }
        .location-sector-group {
        display: none;
        }
    </style>
</head>
<body>
@include('header')

<div class="container mt-5">
    <div class="col-9 mx-auto border">
        <h2 class="text-center text-primary my-4">Add Shipment</h2>
        <div class="mx-5 py-3">
            <form id="dynamicForm" method="POST">
                @csrf
                <div class="form-group my-2">
                    <label for="shipmentDate">Shipment Date (YYYY-MM-DD)</label>
                    <input type="text" class="form-control" id="shipmentDate" name="shipmentDate" placeholder="Enter shipment date">
                </div>
                <div class="form-group">
                    <label>Type of Shipment</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="shipmentType" id="shipmentIn" value="IN">
                        <label class="form-check-label" for="shipmentIn">IN</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="shipmentType" id="shipmentOut" value="OUT">
                        <label class="form-check-label" for="shipmentOut">OUT</label>
                    </div>
                </div>
                <div class="form-group" id="location">
                    <label id="locationLabel">Target Location</label>
                    <select class="form-control" id="locationSelect" name="location">
                        <option value="" disabled selected hidden></option>
                        @foreach ($locations as $location)
                            <option value={{ $location->location_id }}>{{ $location->location_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="sector">
                    <label id="sectorLabel">Target Sector</label>
                    <select class="form-control" id="sectorSelect" name="sector">
                        <option value="" disabled selected hidden></option>
                    </select>
                </div>
                <div class="form-group my-2">
                    <label>Select Items</label><br>
                    @foreach ($products as $product)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id={{ $product->product_id }} value='{{ $product->product_name }}'>
                            <label class="form-check-label" for={{ $product->product_id }}>{{ $product->product_name }}</label>
                        </div><br>
                    @endforeach        
                </div>
                <div id="selectedItems"></div> <!-- Container for selected items -->
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>    
        </div>
    </div>
</div>

@include('footer')
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
        $('input[type="radio"][name="shipmentType"]').change(function(){
            // Get selected shipment type
            var shipmentType = $(this).val();
        // Update location and sector options based on the selected shipment type
        updateLocationSectorOptions(shipmentType);
        });



        // SHIPMENT LOCATION VISIBILITY FUNCTION
        // Initialize location and sector options based on the initial radio button selection
        var initialShipmentType = $('input[type="radio"][name="shipmentType"]:checked').val();
        updateLocationSectorOptions(initialShipmentType);

        // Function to dynamically update location and sector options based on radio button selection
        function updateLocationSectorOptions(shipmentType) {
            if (shipmentType === "IN") {
                $('#locationLabel').text('Target Location');
                $('#sectorLabel').text('Target Sector');
                $('#location').show();
            } else if (shipmentType === "OUT") {
                $('#locationLabel').text('Origin Location');
                $('#sectorLabel').text('Origin Sector');
                $('#location').show();
            } else {
                $('#location').hide();
                $('#sector').hide();
            }    
        }    



        // SECTOR ID DISPLAY FUNCTION
        // Event listener for location select change
        $('#locationSelect').change(function() {
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
                    $('#sectorSelect').empty(); // Clear previously selected sectors
                    if (data.length) {
                        data.forEach(function(sectors) {
                            $('#sectorSelect').append('<option value="' + sectors.sector_id + '">' + sectors.sector_id + '</option>');
                        });
                    } else {
                        $('#sectorSelect').append('<option value="" disabled selected hidden>No sectors found</option>');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }



        // PRODUCT QUANTITY INPUT FIELD FUNCTION 
        // Event listener for checkbox change
        $('.form-check-input[type="checkbox"]').change(function(){
            var selectedItems = []; // Array to store selected items
            $('.form-check-input[type="checkbox"]:checked').each(function() {
                selectedItems.push($(this).val()); // Add selected items to the array
            });
            addSelectedItems(selectedItems); // Add input fields for selected items
        });

        // Function to add input fields for selected items
        function addSelectedItems(selectedItems) {
        $('#selectedItems').empty(); // Clear previously selected items
        if(selectedItems) {
            selectedItems.forEach(function(item){
            $('#selectedItems').append('<div class="selected-item"><label>' + item + ':</label><input type="text" class="form-control" name="' + item + '" placeholder="Enter amount"></div>');
            });
        }};



        // SUBMIT BUTTON FUNCTION (To be removed) 
        // Prevent form submission for this example
        // $('#dynamicForm').submit(function(e){
        // e.preventDefault();
        // // Handle form submission logic here
        // // You can collect data from input fields and process it
        // });
    });
</script>

</body>
</html>
