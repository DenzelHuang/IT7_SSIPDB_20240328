<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="{{ asset('css/Stylesheet.css') }}">
    <script src="https://d3js.org/d3.v7.min.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        html {
            background-color: #7882ae;
        }
        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            grid-template-rows: auto 1fr auto;
            background-color: #7882ae;
        }
        header {
            max-height: 6vh;
        }
        footer {
            max-height: 50px;
        }
        #form-container {
            background-color: white;
            border-radius: 10px;
        }
        h1, #result-count, #see-all-link, #search, .active {
        color: white;
        text-shadow: black 0px 0px 5px;
        }
        #table-container {
            background-color:white;
            border-radius: 10px; 
        }
        @yield('styling');
    </style>
    @yield('scripts')
</head> 
<body>
    <div class="container-flex col-12 sticky-top px-2" style="background-color: rgb(1, 47, 120)">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4">
            <a href="{{ url('/home') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-2" style="color: white">Warehouse Management System</span>
            </a>
        
            <ul class="nav nav-pills">
                <li class="nav-item"><a style="color: white" href="{{ url('/home') }}" class="nav-link @yield('home_active')" aria-current="page">Home</a></li>
                <li class="nav-item"><a style="color: white" href="{{ url('/products') }}" class="nav-link @yield('product_active')">Products</a></li>
                <li class="nav-item"><a style="color: white" href="{{ url('/stocks') }}" class="nav-link @yield('stock_active')">Stock</a></li>
                <li class="nav-item"><a style="color: white" href="{{ url('/shipment/index') }}" class="nav-link @yield('shipment_active')">Shipments</a></li>
                <li class="nav-item"><a style="color: white" href="{{ url('/locations')}}" class="nav-link @yield('location_active')">Locations</a></li>
                <li class="nav-item"><a style="color: white" href="{{ url('/movement') }}" class="nav-link @yield('intmvt_active')">Internal Movement</a></li>
                <li class="nav-item"><a style="color: white" href="{{ url('/monitoring') }}" class="nav-link @yield('monitoring_active')">Monitoring</a></li>
                <li class="nav-item"><a style="color: white" href="{{ url('/account/index') }}" class="nav-link @yield('account_active')">Accounts</a></li>
                <li class="nav-item"><a style="color: white" href="{{ url('/logout') }}" class="nav-link">Logout</a></li>
            </ul>
        </header>
    </div>
    @yield('content')
</body>
</html>