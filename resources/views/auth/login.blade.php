@extends('layouts')
@section('content')
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <h2 class="active"> Sign In </h2>
        <!-- Icon -->
        <div class="fadeIn first">
        SRD CAR SPA
        </div>


        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
        <input type="text"  id="email" class="fadeIn second @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        <input type="text" id="password" placeholder="Password" class="fadeIn third @error('password') is-invalid @enderror" name="password"  required autocomplete="current-password">

        @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


            <div class="form-check pb-4">
                <input class="form-check-input pl-4" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>



            <div class="col-md-4 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

        @csrf
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
        <a class="underlineHover" href="{{ route('otp.login') }}">Login with OTP</a>
        </div>

    </div>
</div>
@endsection
