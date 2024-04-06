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
    </style>
</head>
<body>
@include('header')

<div class="container mt-5">
    <div class="col-9 mx-auto border">
        <h2 class="text-center text-primary my-4">Add Shipment</h2>
        <div class="mx-5">
            <form id="dynamicForm">
                <div class="form-group">
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
    // Function to add input fields for selected items
    function addSelectedItems(selectedItems) {
    $('#selectedItems').empty(); // Clear previously selected items
    if(selectedItems) {
        selectedItems.forEach(function(item){
        $('#selectedItems').append('<div class="selected-item"><label>' + item + ':</label><input type="text" class="form-control" name="' + item + '" placeholder="Enter amount"></div>');
        });
    }
    }

    // Event listener for checkbox change
    $('.form-check-input').change(function(){
    var selectedItems = []; // Array to store selected items
    $('.form-check-input:checked').each(function() {
        selectedItems.push($(this).val()); // Add selected items to the array
    });
    addSelectedItems(selectedItems); // Add input fields for selected items
    });

    // Prevent form submission for this example
    $('#dynamicForm').submit(function(e){
    e.preventDefault();
    // Handle form submission logic here
    // You can collect data from input fields and process it
    });
});
</script>

</body>
</html>
