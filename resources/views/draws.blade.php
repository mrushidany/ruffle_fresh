@extends('layouts.app2')

@section('content')
<div style="height:100px;"></div>
<div class="container my-5 py-5" style="margin-top: 5em !important;">
    <div class="well mt-3" style="padding:20px; background:#ddd;">
        <h2>Draws</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="drw_nav">
                    <a href="{{url('draw/weekly/mc_draw')}}" style="display:block; padding:30px; text-align:center;">Weekly Draw</a>
                    <a href="{{url('draw/monthly/mc_draw')}}" style="display:block; padding:30px; text-align:center;">Monthly Draw</a>
                    <a href="{{url('draw/gp_draw/grand_prize')}}" style="display:block; padding:30px; text-align:center;">Grand Prize Draw</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
        $(function () {
        $('.form').on('submit', function (e) {
          var url = $(this).attr("action");
          var formData = new FormData($(this)[0]);
          $("#nextt").val("Processing...");
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
              $('.form').trigger("reset");
              $('.sms').html(data);
              console.log(data);
            }
          });
        });
    });
</script>
@endsection