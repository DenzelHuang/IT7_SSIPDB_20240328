<!-- He who is contented is rich. - Laozi -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/Stylesheet.css') }}">
    <style>
        /* Product */
        .product-body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            align-items: center;
        }
        .product-box {
            padding: 20px;
            border: 1px solid black;
            background-color: ghostwhite;
            border-radius: 20px;
            overflow: hidden;
            overflow-x: scroll;
            overflow-y: scroll;
        }
        .product-list {
            height: 100%;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            border-collapse: collapse;
            overflow: hidden;
            overflow-y: scroll;
        }
        .product-box::-webkit-scrollbar,
        .product-list::-webkit-scrollbar {
            display: none;
        } 
        .product-list th:nth-child(2),
        .product-list td:nth-child(2) {
            width: 75%;
        }
        .product-list th:nth-child(3),
        .product-list td:nth-child(3) {
            width: 15%;
        }
        .product-list table,
        .product-list tr,
        .product-list th,
        .product-list td {
            border: 1px solid black;
        }
        .product-list table {
            margin-top: -1px;
            margin-bottom: -1px;
            padding: 0;
            width: 100%;
        }
        .product-list th, 
        .product-list td {
            text-align: center;
        }
    </style>
</head> 
<body class="product-body">
    @include('header')

    <div class="product-box container">
        <h3>Product Shipment ID: {{ $id }}</h3>
        <div class="product-list">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                </tr>
                @foreach ($shippedProducts as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td>{{ $product->product ? $product->product->product_name : 'N/A' }}</td>
                    <td>{{ $product->product_quantity }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <a href="{{ route('shipment.index') }}" class="btn btn-primary mt-2">Back</a>
    </div>

    @include('footer')
</body>
</html>
