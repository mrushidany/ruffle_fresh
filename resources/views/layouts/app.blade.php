<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/campaign_logos.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RAFFLE | TOOL</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/draw.css') }}">

    <style>
        #dropdownMenuButton:hover{
            cursor: pointer;
        }
        .img-responsive {
            width: 100%;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm navbar-custom">
            <div class="container ">
                <!-- Authentication Links -->
                <div class="row">
                    <div class="col-md-4 pr-5">
                        <img src="{{asset('images/ncba_mpawa_logo_white.png')}}" class="img-responsive" style="height: 300px; object-fit:contain; margin-top: 1.5rem !important">
                    </div>
                    <div class="col-md-4">
                        <img src="{{asset('images/campaign_logos.png')}}" class="img-responsive bounce" style="height: 220px; object-fit:contain; margin-top: 2.5rem !important">
                    </div>
                    @guest
                    <div class="col-md-4">
                        <img src="{{asset('images/vodacom-mpesa.png')}}" class="img-responsive" style="height: 120px; object-fit:contain; margin-top: 7.0rem !important">
                    </div>
                    @else
                    <div class="col-md-4">
                        <img src="{{asset('images/vodacom-mpesa.png')}}" class="img-responsive" style="height: 120px; object-fit:contain; margin-top: 7.0rem !important" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    	<a class="dropdown-menu" aria-labelledby="dropdownMenuButton" href="{{ route('logout') }}" style="text-decoration: none;color:black;font-weight:bold;margin-top:-100px;margin-left:250px;"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <img src="{{asset('images/logout.png')}}"  style="height: 16px;object-fit:contain">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    @endguest
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>

    @env('local')
        <script src="http://localhost:35729/livereload.js"></script>
    @endenv
</body>
</html>
