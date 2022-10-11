@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center py-5">
        <div class="col-md-6 py-2">
            <div class="card login-card" style="background: url('{{ asset('images/confetti.jpg')}}') repeat; background-position: center center; background-size: cover;">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="login-description white">Please login to your dashboard to continue</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                            <div class="col-md-12" style="position: relative">
                                <img src="{{asset('images/username.png')}}" class="login-input-icon">
                                <input id="email" type="email" class="form-control login-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="col-md-12">
                                <img src="{{asset('images/password.png')}}" class="login-input-icon">
                                <input id="password" type="password" class="form-control login-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block py-3 cta-button" style="background-color: #0D1D2B !important;">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
