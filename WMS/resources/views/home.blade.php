@extends('header')
@section('title', 'Home')
@section('styling')
    <style>
        .segments {
            background-color: #999;
        }
        .pie-chart-container {
            width: 400px;
            height: 400px;
        }
        table {
            margin-bottom: 20px;
        }
        th {
            background-color: grey;
        }
        .locations-data-tables {
            gap: 20px;
        }
        .locations-data-tables table {
            border: 1px solid black;
        }
    </style>
@endsection

@section('home_active', 'active')

@section('content')
<div class="container-flex mx-5">
    <div class="text-center">
        <h1>Home Page</h1>
        <h3>This is a home page</h3>
        <p class="m-0">Dummy Text Dummy Text Dummy Text</p>
        <p class="m-0">Dummy Text Dummy Text Dummy Text</p>
        <p class="m-0">Dummy Text Dummy Text Dummy Text</p>
    </div>

    <div class="container col-9">
        <h4 class="chart-segments-title mt-4">Location Stocks Chart</h4>
        <div id="chart-segment-1" class="segments mt-2 mb-4 d-flex justify-content-center align-item-center">
            <svg id="pie-chart-container" class="pie-chart-container"></svg>
        </div>    
    </div>

    <div class="container col-9">
        <h3 id="container mt-4">Locations Data</h3>
        @foreach ($locationData as $locationName => $locationItem)
        <h4 class="container">{{ $locationName }} Data</h4>
        <div class="locations-data-tables d-flex container">
            <!-- Table 1 -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locationItem['products'] as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Table 2 -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Sector ID</th>
                        <th>Total Product Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locationItem['sectors']->groupBy('sector_id') as $sectorId => $sectors)
                        <tr>
                            <td>{{ $sectorId }}</td>
                            <td>{{ $sectors->sum('product_quantity') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    
    </div>    
</div>

<!-- Include the footer -->
@include('footer')

<script>
    // Data
    var data = {!! json_encode($getQtyByLocations) !!};

    // Width and height
    var width = 400;
    var height = 400;
    var radius = Math.min(width, height) / 2;

    // Color scale
    var color = d3.scaleOrdinal()
        .domain(data.map(function(d) { return d.location_name; }))
        .range(d3.schemeCategory10);

    // Arc
    var arc = d3.arc()
        .outerRadius(radius - 10)
        .innerRadius(0);

    // Pie layout
    var pie = d3.pie()
        .sort(null)
        .value(function(d) { return d.total_quantity; });

    // Format for percentage
    var formatPercent = d3.format(".1%"); // Show one digit after the decimal point

    // SVG element
    var svg = d3.select("#pie-chart-container")
        .attr("width", width)
        .attr("height", height)
        .append("g")
        .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

    // Draw arcs
    var g = svg.selectAll(".arc")
        .data(pie(data))
        .enter().append("g")
        .attr("class", "arc");

    g.append("path")
        .attr("d", arc)
        .style("fill", function(d) { return color(d.data.location_name); });

    // Add labels
    g.append("text")
        .attr("transform", function(d) { 
            var centroid = arc.centroid(d);
            return "translate(" + centroid + ")";
        })
        .attr("dy", ".35em")
        .attr("text-anchor", "middle")
        .text(function(d) { 
            return d.data.location_name + " (" + d.data.total_quantity + ", " + formatPercent(d.data.total_quantity / d3.sum(data, function(d) { return d.total_quantity; })) + ")";
        });

    // Add legend
    var legend = svg.selectAll(".legend")
        .data(data.map(function(d) { return d.location_name; }))
        .enter().append("g")
        .attr("class", "legend")
        .attr("transform", function(d, i) { return "translate(0," + i * 20 + ")"; });

    legend.append("rect")
        .attr("x", width - 18)
        .attr("width", 18)
        .attr("height", 18)
        .style("fill", color);

    legend.append("text")
        .attr("x", width - 24)
        .attr("y", 9)
        .attr("dy", ".35em")
        .style("text-anchor", "end")
        .text(function(d) { return d; });
</script>

@endsection
