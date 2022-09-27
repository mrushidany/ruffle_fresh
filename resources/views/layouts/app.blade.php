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
            <div class="container ">
                <!-- Authentication Links -->
                <div class="row" style="padding: 0 9rem !important;">
                    <div class="col-md-4 pr-5">
                        <img src="{{asset('images/sag.svg')}}" class="img-responsive" style="height: 90px; object-fit:contain; margin-top: 5.5rem !important">
                    </div>
                    <div class="col-md-4">
                        <img src="{{asset('images/campaign_logos.png')}}" class="img-responsive bounce" style="height: 220px; object-fit:contain; margin-top: 2.5rem !important">
                    </div>
                    @guest
                    <div class="col-md-4">
                        <img src="{{asset('images/smartnology.png')}}" class="img-responsive" style="height: 40px; object-fit:contain; margin-top: 8rem !important">
                    </div>
                    @else
                    <div class="col-md-4">
                        <img src="{{asset('images/smartnology.png')}}" class="img-responsive" style="height: 40px; object-fit:contain; margin-top: 8rem !important" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
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
        </nav> --}}
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm navbar-custom">
            <div class="container-fluid">
              <a class="navbar-brand mx-5 pl-5" href="#" style="margin-right: 13rem !important">
                <img src="{{asset('images/sag.svg')}}" class="img-responsive"  style="height: 5em">
              </a>
              <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-right: 14rem !important;">
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                        <img src="{{asset('images/campaign_logos.png')}}" class="img-responsive bounce" style="height: 220px; object-fit:contain; margin-top: 2.5rem !important">
                    </a>
                  </li>
                </ul>
                <span class="navbar-text">
                    <img src="{{asset('images/smartnology.png')}}" class="img-responsive" style="height: 43px; object-fit:contain; margin-top: 3rem !important">
                </span>
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
