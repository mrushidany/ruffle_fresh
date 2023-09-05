@extends('layouts.app2')

@section('content')
<div style="height:30px;"></div>
<div class="container">
    <div class="row rw0">
        <div class="col-md-12 lr0"><h2 style="background:#e1e1e1; margin-bottom:15px; padding:10px;">DRAWS</h2></div>
        <div class="col-md-3 lr0">
            <div class="draw_nav">
                <a href="{{url('draw/weekly/mc_draw')}}" class="<?php if($period === 'weekly'){ echo "dactive"; }?>">Weekly Draw</a>
                <a href="{{url('draw/monthly/mc_draw')}}" class="<?php if($period === 'monthly'){ echo "dactive"; }?>">Monthly Draw</a>
                <a href="{{url('draw/gp_draw/grand_prize')}}" class="<?php if($period === 'gp_draw'){ echo "dactive"; }?>">Grand Prize Draw</a>
            </div>
        </div>
   
        <div class="col-md-9 lr0">
            <div class="" style="background:#e1e1e1; margin-bottom:15px;">
                <div class="main-title">{!!$main_title!!}</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="drw_nav">
                            @if($period == 'monthly')
                            {{-- <a href="{{url('draw/'.$period.'/mc_draw')}}" class="<?php if($title === 'Motorcycle'){ echo "dactive"; }?>">Motorcycle</a> --}}
                            <a href="{{url('draw/'.$period.'/mc_draw')}}" class="<?php if($title === 'Bi Monthly'){ echo "dactive"; }?>">Bi Monthly</a>
                            <a href="{{url('draw/'.$period.'/cp_draw')}}"  class="<?php if($title === 'Monthly'){ echo "dactive"; }?>">Monthly</a>
                            @endif
                            @if($period == 'monthly' && $period != 'gp_draw')
                                {{-- <a href="{{url('draw/'.$period.'/ds_draw')}}" class="<?php if($title === 'Double Saving'){ echo "dactive"; }?>">Double Saving</a> --}}
                            @endif
                            @if($period == 'gp_draw')
                                <a href="{{url('draw/'.$period.'/grand_prize')}}" class="<?php if($title === 'Grand Prize'){ echo "dactive"; }?>">Grand Prize</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div style="background:#e6e6e6; min-height:300px; padding-bottom:30px;">
                        @if(@$msg)
                            <div style="background:#ddd; padding:5px 5px 0 5px;">
                                <div class="row rw0">
                                    <div class="col-6 lr0"><h5 class="alert alert-info">{!!$title!!}</h5></div>
                                    <div class="col-6 lr0">{!!$msg!!}</div>
                                </div>
                            </div>
                            <div id="drow-section">
                            @if($draw_winners)
				@if($count > 0)
                                <center><h2 class="mt-4">Run the Draw</h2></center>
                                <div class="number-diy mb-3">
                                    <div class="data" data-number="0754675434" style="font-size:3.52rem; letter-spacing:2.6rem; font-family: LetsgoDigital; text-align:center;">0000000000</div>
                                </div>
                                <form action="{{url('spin_draw')}}" method="post" class="form">
                                    @csrf
                                    <input type="hidden" name="draw_id" value="{{$draw_id}}"> 
                                    <input type="hidden" name="count" value="{{$count}}">
                                    <div style="text-align:center; margin-bottom:30px;">
                                        <button type="submit" name="submit" class="btn btn-success" id="spinme"><i class="fa-solid fa-hourglass-start"></i> Spin the draw</button> <a href="" class="btn btn-danger"><i class="fa-solid fa-ban"></i> Stop</a>
                                    </div>
                                    <h1 style="text-align:center;margin:25px 0 5px;"><span id="itrts">0</span>-Winners</h1>
                                </form>
                                @endif
                                <div class="m-title">Winners</div>
                                <div class="mt-3 mb-3" style="padding:10px;">
                                    <table class="table table-striped table-bordered" id="tabledata">
                                        <thead style="background-color: #1485c9; color: #fff;">
                                        <tr>
                                            <th>#</th>
                                            <th>Participant</th>
                                            <th>Code</th>
                                            <th>Prize</th>
					    @if($draw_id == 5)
                                            <th>Deposited Amount</th>
                                            <th>Amount Rewarded</th>
                                            @endif
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1;?>
                                        @foreach($draw_winners as $winner)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$winner->phone_number}}</td>
                                            <td>{{$winner->name}}</td>
                                            <td>{{$title}}</td>
					    @if($draw_id == 5)
                                            <td>{{number_format($winner->amount)}}</td>
                                            <td>{{number_format($winner->double_amount)}}</td>
                                            @endif
                                            <td><a href="{{url('disqualify_winner/'.$winner->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Disqualify</a></td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
					<form action="" method="post" class="sendEmail">
						@csrf
						<input type="hidden" name="prize" value="{{$title}}">
						<input type="hidden" name="draw_category" value="{{$period}}">
						<input type="hidden" name="draw_id" value="{{$draw_id}}">
						<button type="submit" name="submit" class="btn btn-success float-left" id="sentt"><i class="fa-solid fa-envelope"></i> Send Email</button>
						<div class="sentd"></div>
					</form>
					<a href="{{url('discard_result/'.$draw_id)}}" class="btn btn-md btn-warning float-right"><i class="fa fa-trash"></i> Discard Results</a>
				</div>
                                </div>
                            @else
                                <center><h2 class="mt-4">Run the Draw</h2></center>
                                <div class="number-diy mb-3">
                                    <div class="data" data-number="0754675434" style="font-size:3.52rem; letter-spacing:2.6rem; font-family: LetsgoDigital; text-align:center;">0000000000</div>
                                </div>
                                <form action="{{url('spin_draw')}}" method="post" class="form">
                                    @csrf
                                    <input type="hidden" name="draw_id" value="{{$draw_id}}"> 
				    <input type="hidden" name="count" value="{{$count}}">
                                    <div style="text-align:center;">
                                        <button type="submit" name="submit" class="btn btn-success" id="spinme"><i class="fa-solid fa-hourglass-start"></i> Spin the draw</button> <a href="" class="btn btn-danger"><i class="fa-solid fa-ban"></i> Stop</a>
                                    </div>
                                    <h1 style="text-align:center;margin:25px 0 5px;"><span id="itrts">0</span>-Winners</h1>
                                </form>
                            </div>
                            @endif
                        @else
                        <div class="sms">
                        <form action="{{url('/upoload/file')}}" method="post" class="form" enctype="multipart/form-data"> 
                            @csrf
                            <p>
                                {{-- <label>Upload {{$title}} CSV File</label> --}}
                                <label>Upload participants CSV File</label>
                                <input type="file" name="file" value="" class="form-control" required>
                            </p>
                            <p><input type="hidden" name="drow_type_id" value="{{$draw_id}}" class="form-control"></p>
                            <p><button type="submit" name="submit" value="submit" class="btn btn-success" id="nextt">Upload CSV</button></p>
                        </form>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-5"><img class="transparent" src="{{ asset('images/blue-logo.svg') }}" /></div>

<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"><strong>JACKPOT: <span style="text-transform:capitalize"> @if($period == 'gp_draw') Grand Prize @else {{$period}} @endif Draw</span></strong></h4>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div style="text-align:center; padding:20px; min-height:200px;">
                @if($winners)
                    @if($draw_id == 1)
                    <h1>Prize One</h1>
                    @elseif($draw_id == 3)
                    <h1>Bi Monthly</h1>
                    {{-- <img src="{{asset('/images/motorcycle.jpg')}}" style="height:160px;" /> --}}
                    @elseif($draw_id == 2 || $draw_id == 4)
                    <h1>Monthly</h1>
                    {{-- <img src="{{asset('/images/weekly_cash.jpg')}}" style="height:160px;" /> --}}
                    @elseif($draw_id == 5)
                    <h1>Double Saving</h1>
                    <img src="{{asset('/images/double_savings.jpg')}}" style="height:160px;" />
                    @else
                    <h1>Grand Prize</h1>
                    <img src="{{asset('/images/grand_prize.jpg')}}" style="height:160px;" />
                    @endif
                    <h2><strong><span class="winnerCount"></span>-Winners!</strong></h2>
                @endif
            </div>
            <center><button type="button" class="btn btn-success" style="min-width:100px;" data-dismiss="modal" onclick="closeModal()">Ok</button> <a href="" class="btn btn-danger"><i class="fa-solid fa-arrow-rotate-left"></i> Reset</a></center>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            &nbsp;
        </div>
        
      </div>
    </div>
  </div>
<script>
        $(function () {
        $('.form').on('submit', function (e) {
          var url = $(this).attr("action");
          var formData = new FormData($(this)[0]);
          $("#nextt").html('<i class="fa-solid fa-circle-notch fa-spin"></i> Processing...');
          $("#spinme").html('<i class="fa-solid fa-cog fa-spin"></i> Running the Draw...');
          //alert(url);
          e.preventDefault();
          $.ajax({
            type: "post",
            url: url,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            data: $(this).serialize(),
            //crossDomain:true,
            data: formData,
            success: function (data) {
                //run_draw()
                setTimeout(function(){
                   $('.form').trigger("reset");
                    $('.sms').html(data);
                    $('.winnerCount').html(data.length);
                    spinInterval(data);
                   // console.log(data[0]['phone_number']);
                }, 2500);
            }
          });
        });
    });
</script>

<!-- send email -->
<script>
	$('.sendEmail').on('submit', function (e) {
          var url = '{{url('send_email')}}';
          var formData = new FormData($(this)[0]);
          $("#sentt").html('<i class="fa-solid fa-circle-notch fa-spin"></i> Processing...');
          //alert(url);
          e.preventDefault();
          $.ajax({
            type: "post",
            url: url,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            data: $(this).serialize(),
            //crossDomain:true,
            data: formData,
            success: function (data) {
	      $('.sendEmail').trigger("reset");
	      $("#sentt").html('<i class="fa-solid fa-envelope"></i> Send Email');
               $('.sentd').html(data);
            }
          });
        });

</script>

<script src="{{asset('js/rollNumber/rollNumber.js')}}"></script>
<script>
     function run_draw(number){
        $diy = $('.number-diy .data');
        //alert(number);
        $diy.rollNumber({
           // number: $diy[0].dataset.number, 
            number: number, 
            speed: 400, 
            interval: 150,
            rooms: 10,
            space: 70,
            delay: 200,
            //symbol: ',', 
            fontStyle: {
            'font-size': '3.5rem',
            'font-family': 'LetsgoDigital',
            }
        });
    }
    function openModal(){
        $('#myModal').addClass('show')
    }
    function closeModal(){
        $('#myModal').removeClass('show');
        $('#drow-section').addClass('hide-draw');
        $.ajax({
            type: "get",
            url: "{{url('save_draw')}}",
            data: 'save',
            success: function (data) {
                //$('.sms').html(data);
                location.reload(); 
                //console.log(data);
            }
        });
    }

    // ---set interval
    function spinInterval(data){
        var iterations = 0;
        var interval = setInterval(foo, 3000);
        function foo() {
            iterations++;
            if (iterations > data.length){
                openModal();
                clearInterval(interval);  
            }
            else {
                var number = data[iterations - 1]['phone_number'];
                //console.log(number);
                run_draw(number);
                setTimeout(function(){
                $('#itrts').text(iterations);
                }, 2000);
            }
        }
    }

</script>
@endsection
