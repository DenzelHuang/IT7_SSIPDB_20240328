<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Header</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container-flex col-12 sticky-top" style="background-color: white">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-2">Warehouse Management System</span>
            </a>
        
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="{{ url('/products') }}" class="nav-link">Products</a></li>
                <li class="nav-item"><a href="{{ url('/shipment/form') }}" class="nav-link">Shipments</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Locations</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Internal Movement</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Monitoring</a></li>
                <li class="nav-item"><a href="{{ url('account/edit') }}" class="nav-link">Accounts</a></li>
            </ul>
        </header>
    </div>
</body>
</html>