<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/wheel-spinner.jpg') }}">

    {{-- Styles --}}
    <link rel="stylesheet" href="css/main.css">

      <!-- font awesome cdn link -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

      <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <title>RAFFLE | TOOL</title>
</head>
<body class="main-bg">
   <div class="home-bg">
      <section class="home">
        <div class="block" data-aos="fade-up" data-aos-duration="4000" data-aos-delay="5000" data-aos-easing="ease-in-out">
          <h3 class="">RAFFLE TOOL</h3>  
          <p>To proceed to the Raffle Tool, click the proceed button below</p> 
          <a class="button" href="{{ route('draws')}}">Proceed</a>
        </div>
        <div class="lottery-img">
          <img src="{{ asset('images/jackpot-lottery.png')}}" style="width: 50em;" class="bounce" />
        </div>
      </section>
      <div class="smart_logo"><img class="transparent" src="{{ asset('images/blue-logo.svg') }}" /></div>
   </div>
   <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
   <script>
     AOS.init();
   </script>
</body>
</html>