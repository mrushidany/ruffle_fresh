@extends('layouts.app2')

@section('content')
<div style="height:100px;"></div>
<div class="container">
    <div class="well" style="padding:20px; background:#ddd;">
        <h2>Week 1 Motorcycle Draw</h2>
        <div class="sms">
            @if(@$msg)
                {!!$msg!!}
                <h2>Run the drow</h2>
            @else
            <form action="{{url('/upoload/file')}}" method="post" class="form" enctype="multipart/form-data"> 
                @csrf
                <p>
                    <label>Upload CSV File</label>
                    <input type="file" name="file" value="" class="form-control" >
                </p>
                <p><input type="hidden" name="drow_type_id" value="2" class="form-control"></p>
                <p><button type="submit" name="submit" value="submit" class="btn btn-success" id="nextt" >Upload CSV</button></p>
            </form>
            @endif
        </div>
    </div>
    <div class="row justify-content-center mt-5"><img class="transparent" src="{{ asset('images/blue-logo.svg') }}" /></div>
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