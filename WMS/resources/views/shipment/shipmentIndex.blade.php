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
            height: 420px;
        }
        .shipment-box {
            padding: 20px;
            border: 1px solid black;
            background-color: ghostwhite;
            border-radius: 20px;
            overflow: hidden;
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
        .shipment-list * {
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
        <div class="shipment-list">
            <table>
                <tr>
                    <th>shipment_id</th>
                    <th>product_id</th>
                    <th>product_quantity</th>
                    <th>shipment_date</th>
                    <th>shipment_type</th>
                    <th>origin_location</th>
                    <th>origin_sector</th>
                    <th>target_location</th>
                    <th>target_sector</th>
                </tr>
                @foreach ($shipments as $shipment)
                <tr>
                    <td>{{ $shipment->shipment_id }}</td>
                    <td>{{ $shipment->product_id }}</td>
                    <td>{{ $shipment->product_quantity }}</td>
                    <td>{{ $shipment->shipment_date }}</td>
                    <td>{{ $shipment->shipment_type }}</td>
                    <td>{{ $shipment->origin_location }}</td>
                    <td>{{ $shipment->origin_sector }}</td>
                    <td>{{ $shipment->target_location }}</td>
                    <td>{{ $shipment->target_sector }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    @include('footer')
</body>
</html>