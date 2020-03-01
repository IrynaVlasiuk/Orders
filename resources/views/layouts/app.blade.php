<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">

    </nav>

    <main class="py-4">
        @yield('content')

        @if(isset($orderChart))
             {!! $orderChart->script() !!}
        @endif
    </main>
</div>
</body>
</html>
<script>
    {{--var url = "{{url('/order')}}";--}}
    {{--var Years = new Array();--}}
    {{--var Labels = new Array();--}}
    {{--var Prices = new Array();--}}
    {{--$(document).ready(function(){--}}
    {{--    $.get(url, function(response){--}}
    {{--        console.log(response);--}}
    {{--        response.forEach(function(data){--}}
    {{--            Years.push(data.stockYear);--}}
    {{--            Labels.push(data.stockName);--}}
    {{--            Prices.push(data.stockPrice);--}}
    {{--        });--}}
    {{--        var ctx = document.getElementById("canvas").getContext('2d');--}}
    {{--        var myChart = new Chart(ctx, {--}}
    {{--            type: 'bar',--}}
    {{--            data: {--}}
    {{--                labels:Years,--}}
    {{--                datasets: [{--}}
    {{--                    label: 'Infosys Price',--}}
    {{--                    data: Prices,--}}
    {{--                    borderWidth: 1--}}
    {{--                }]--}}
    {{--            },--}}
    {{--            options: {--}}
    {{--                scales: {--}}
    {{--                    yAxes: [{--}}
    {{--                        ticks: {--}}
    {{--                            beginAtZero:true--}}
    {{--                        }--}}
    {{--                    }]--}}
    {{--                }--}}
    {{--            }--}}
    {{--        });--}}
    {{--    });--}}
    {{--});--}}
</script>
