<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/campaign_logos.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RAFFLE TOOL</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheel"> -->
    <link href="{{asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/draw.css') }}">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- Datatables css -->
     <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet">

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
<body style="background-size:cover; background-position:top;">
    <div id="apps">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm navbar-custom">
            <div class="container-fluid">
              <a class="navbar-brand mx-5 pl-5" href="#" style="margin-right: 13rem !important">
                <img src="{{asset('images/sag.svg')}}" class="img-responsive"  style="height: 5em">
              </a>
              <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-right: 14rem !important;">
                  <li class="nav-item">
                    <a class="nav-link pl-3" href="#">
                        {{-- <img src="{{asset('images/lottery-jackpot.jpg')}}" class="img-responsive bounce" style="height: 100px; margin-top: 2.5rem !important; border-radius: 10px;"> --}}
                    </a>
                  </li>
                </ul>
                <span class="navbar-text">
                    @guest
                    <img src="{{asset('images/smartnology.png')}}" class="img-responsive" style="height: 43px; object-fit:contain; margin-top: 2rem !important; margin-left: 14rem">
                    @else
                    <img src="{{asset('images/smartnology.png')}}" class="img-responsive" style="height: 43px; object-fit:contain; margin-top: 2rem !important; margin-left: 14rem" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    <a class="dropdown-menu" aria-labelledby="dropdownMenuButton" href="{{ route('logout') }}" style="text-decoration: none;color:black;font-weight:bold;margin-top:-16px;margin-left: 1115px;"
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
          </nav>

        <main class="main-bg">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabledata').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
            $('#tabledata2').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
        } );
    </script>
</body>
</html>
