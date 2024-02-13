@extends('layouts')
@section('content')
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <h2 class="active"> {{ __('OTP Login') }} </h2>
        <!-- Icon -->
        <div class="fadeIn first">
        SRD CAR SPA
        </div>

        <!-- Login Form -->
        @if (session('error'))
        <div class="alert alert-danger" role="alert"> {{session('error')}}
        </div>
        @endif

        <form method="POST" action="{{ route('otp.generate') }}">
        <input type="text"  id="mobile_no" class="fadeIn second @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" required autocomplete="mobile_no" autofocus placeholder="Enter Your Registered Mobile Number">
            @error('mobile_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="form-check pb-4">
                <button type="submit"  class="btn btn-primary">
                    {{ __('Generate OTP') }}
                </button>
            </div>
        @csrf
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            @if (Route::has('login'))<a class="underlineHover" href="{{ route('login') }}">{{ __('Login With Email') }}</a>@endif
        </div>

    </div>
</div>
@endsection
