@extends('layouts.app')

@section('content')
    <div class="container px-6 sm:p-0 mx-auto h-full" x-data="{
        chart: 'linear',
        changeChart: function (chart) {
            this.chart = chart;
            drawChart(chart);
        }
    }">
        <h2 class="text-lg sm:text-6xl text-center font-sans font-bold py-4">
            Confirmed Cases in: @include('locations._location-name', ['location' => $location])
        </h2>
        @include('locations._stats', ['stats' => $location['latest']])

        <div class="flex justify-center">
            <div class="inline-flex">
                <button
                    @click.prevent="changeChart('linear')"
                    :class="{
                        'bg-gray-400 hover:bg-gray-300': chart === 'linear',
                        'bg-gray-300 hover:bg-gray-400': chart !== 'linear'
                    }"
                    class="text-gray-800 font-bold py-2 px-4 rounded-l"
                >
                    Linear Scale
                </button>
                <button
                    @click.prevent="changeChart('log')"
                    :class="{
                        'bg-gray-400 hover:bg-gray-300': chart === 'log',
                        'bg-gray-300 hover:bg-gray-400': chart !== 'log'
                    }"
                    class="text-gray-800 font-bold py-2 px-4 rounded-r"
                >
                    Logarithm Scale
                </button>
            </div>
        </div>

        <div class="block" style="height:100%;width:100%;" id="chart" x-if="chart === 'linear'"></div>
        <div class="block" style="height:100%;width:100%;" id="logChart" x-if="chart === 'log'"></div>
    </div>

    <footer class="mt-6 bg-gray-200 border-t border-gray-400 h-20 flex items-center justify-center font-mono">
        <p class="text-gray-900">
            Stay safe. Wash your hands.
        </p>
    </footer>
    <script type="text/javascript">
        function drawChart(type = 'linear') {
            var data = google.visualization.arrayToDataTable(@json($chartData));
            var chart = new google.visualization.AreaChart(document.getElementById('chart'));

            const titles = {
                'linear': 'Linear Scale',
                'log': 'Logarithmic Scale',
            };

            chart.draw(data, {
                title: `${titles[type]}`,
                legend: {position: 'bottom'},
                width: '100%',
                height: '900',
                vAxis: {
                    logScale: type === 'log',
                    minValue: 0,
                },
            });
        }

        document.addEventListener('turbolinks:load', function () {
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);
        });
    </script>
@endsection
