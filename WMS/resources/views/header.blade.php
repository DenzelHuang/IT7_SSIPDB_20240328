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
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('styling')
    @yield('scripts')
</head>
<body>
    <div class="container-flex col-12 sticky-top" style="background-color: white">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="{{ url('/home') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-2">Warehouse Management System</span>
            </a>
        
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link @yield('home_active')" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="{{ url('/products') }}" class="nav-link @yield('product_active')">Products</a></li>
                <li class="nav-item"><a href="{{ url('/stocks') }}" class="nav-link @yield('stock_active')">Stock</a></li>
                <li class="nav-item"><a href="{{ url('/shipment/index') }}" class="nav-link @yield('shipment_active')">Shipments</a></li>
                <li class="nav-item"><a href="" class="nav-link @yield('location_active')">Locations</a></li>
                <li class="nav-item"><a href="" class="nav-link @yield('intmvt_active')">Internal Movement</a></li>
                <li class="nav-item"><a href="" class="nav-link @yield('monitoring_active')">Monitoring</a></li>
                <li class="nav-item"><a href="{{ url('account/edit') }}" class="nav-link @yield('account_active')">Accounts</a></li>
            </ul>
        </header>
    </div>
    @yield('content')
</body>
</html>