@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center center-vertically">
            <p class="big-title">M-PAWA DRAW</p>
            <div class="row">
                <div class="col-md-12">
                    <animate-x-component/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="card-header">Upload Participants List (Currently {{$count}} participants)</div>

            <div class="card-body">
                <form action="{{route('participants.import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" type="file" name="participants" id="participants">
                    
                    <button class="btn btn-block btn-outline-danger mt-4" type="submit">Upload</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Select Draw Type</button>
    </div>
    @if ($activeDraw)
    <div class="col-md-8">
        <h3>Ongoing Draw</h3>
        <a href="{{route('start.draw')}}" class="btn btn-block btn-danger mt-4">Continue</a>
    </div>
    @endif
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Please select Draw Type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('start.draw')}}" method="post">
            @csrf
            <form-group>
                <label for="">Draw Type</label>
                <select name="draw_type" class="form-control" id="drawtype">
                    @foreach ($drawTypes as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-block btn-primary mt-4">Start Draw</button>
            </form-group>
          </form>
        </div>
      </div>
    </div>
  </div>
  
</div>