<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/wheel-spinner.jpg') }}">

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
        {{-- <nav class="navbar navbar-expand-md navbar-dark shadow-sm navbar-custom">
            <div class="container-fluid">
              <a class="navbar-brand mx-5 pl-5" href="#" style="margin-right: 13rem !important">
                <img src="{{asset('images/sag.svg')}}" class="img-responsive"  style="height: 5em">
              </a>
              <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-right: 14rem !important;">
                  <li class="nav-item">
                    <a class="nav-link pl-3" href="#">
                        {{-- <img src="{{asset('images/lottery-jackpot.jpg')}}" class="img-responsive bounce" style="height: 100px; margin-top: 2.5rem !important; border-radius: 10px;"> --}}
                    {{-- </a>
                  </li>
                </ul>
                <span class="navbar-text">
                    @guest
                    <img src="{{asset('images/smartnology.png')}}" class="img-responsive" style="height: 43px; object-fit:contain; margin-top: 2rem !important; margin-left: 14rem">
                    @else
                    <img src="{{asset('images/smartnology.png')}}" class="img-responsive" style="height: 43px; object-fit:contain; margin-top: 2rem !important; margin-left: 14rem" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    <a class="dropdown-menu" aria-labelledby="dropdownMenuButton" href="{{ route('logout') }}" style="text-decoration: none;color:black;font-weight:bold;margin-top:-100px;margin-left:250px;"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <img src="{{asset('images/logout.png')}}"  style="height: 16px;object-fit:contain">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @endguest
                </span>
              </div>
            </div>
        </nav> --}} 

        <main class="main-bg">
            @yield('content')
        </main>
    </div>

    @env('local')
        <script src="http://localhost:35729/livereload.js"></script>
    @endenv
</body>
</html>
