@extends('layouts.app')

@section('content')
    <div class="container px-6 sm:p-0 mx-auto h-full">
        <h2 class="text-lg sm:text-6xl text-center font-sans font-bold py-4">Confirmed Cases in: {{ $location->country }} <span class="text-gray-600">({{ $location->country_code }})</span></h2>
        <div style="height:100%;width:100%;" id="chart"></div>
    </div>

    <footer class="mt-6 bg-gray-200 border-t border-gray-400 h-20 flex items-center justify-center font-mono">
        <p class="text-gray-900">
            Stay safe. Wash your hands.
        </p>
    </footer>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(@json($chartData));
                var chart = new google.visualization.AreaChart(document.getElementById('chart'));
                chart.draw(data, {
                    title: 'Corona cases in {{ $location->country_code }}',
                    legend: {position: 'bottom'},
                    width: '100%',
                    height: '900'
                });
            }
        });
    </script>
@endsection
