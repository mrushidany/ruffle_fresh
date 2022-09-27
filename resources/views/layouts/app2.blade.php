<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/campaign_logos.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NCBA | M-PAWA DRAW 2022</title>

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
            <div class="container ">
                <!-- Authentication Links -->
                <div class="row">
                    <div class="col-md-4 pr-5">
                        <a href="{{url('draws')}}">
                        <img src="{{asset('images/ncba_mpawa_logo_white.png')}}" class="img-responsive" style="height: 300px; object-fit:contain; margin-top: 1.5rem !important">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <img src="{{asset('images/campaign_logos.png')}}" class="img-responsive bounce" style="height: 220px; object-fit:contain; margin-top: 4.5rem !important">
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
