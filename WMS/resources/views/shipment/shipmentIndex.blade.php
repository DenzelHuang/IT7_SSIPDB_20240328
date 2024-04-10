<!-- He who is contented is rich. - Laozi -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/Stylesheet.css') }}">
    <style>
        /* Shipment */
        .shipment-body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            align-items: center;
        }
        .shipment-box {
            padding: 20px;
            border: 1px solid black;
            background-color: ghostwhite;
            border-radius: 20px;
            overflow: hidden;
            overflow-x: scroll;
            overflow-y: scroll;
        }
        .shipment-list {
            height: 100%;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            border-collapse: collapse;
            overflow: hidden;
            overflow-y: scroll;
        }
        .shipment-box::-webkit-scrollbar,
        .shipment-list::-webkit-scrollbar {
            display: none;
        } 
        .shipment-list table,
        .shipment-list tr,
        .shipment-list th,
        .shipment-list td {
            border: 1px solid black;
        }
        .shipment-list table {
            margin-top: -1px;
            margin-bottom: -1px;
            padding: 0;
            width: 100%;
        }
        .shipment-list th, 
        .shipment-list td {
            text-align: center;
        }
    </style>
</head> 
<body class="shipment-body">
    @include('header')
    <div class="shipment-box container">
        <h3>Shipment Index</h3>
        <div class="shipment-list">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Origin_location</th>
                    <th>Origin_sector</th>
                    <th>Target_location</th>
                    <th>Target_sector</th>
                    <th>Action</th>
                </tr>
                @foreach ($shipments as $shipment)
                <tr>
                    <td>{{ $shipment->shipment_id }}</td>
                    <td>{{ $shipment->shipment_date }}</td>
                    <td>{{ $shipment->shipment_type }}</td>
                    <td>{{ $shipment->origin_location }}</td>
                    <td>{{ $shipment->origin_sector }}</td>
                    <td>{{ $shipment->target_location }}</td>
                    <td>{{ $shipment->target_sector }}</td>
                    <td><a href="{{ route('shipment.product', ['id' => $shipment->shipment_id]) }}">Show</a></td>
                </tr>
                @endforeach
            </table>
        </div>
        <a href="{{ route('shipment.form') }}" class="btn btn-primary mt-2">Add</a>
    </div>

    @include('footer')
</body>
</html>