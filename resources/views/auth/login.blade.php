@extends('layouts')
@section('content')

<div class="wrapper fadeInDown">
    <div id="formContent">
        <div class="container-fluid pt-5">
            <div class="row">
                <div class="col-12">
                    @error('error_msg')
                    <p class="alert alert-warning">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <!-- Tabs Titles -->
        <h2 class="active"> Sign In </h2>
        <!-- Icon -->
        <div class="fadeIn first">
        SRD CAR SPA
        </div>

        @if (session('throttleMessage'))
        <div class="alert alert-danger" role="alert">
            {{ session('throttleMessage') }} Please try again in {{ session('throttleSeconds') }} seconds.
        </div>
    @endif
        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
        <input type="text"  id="email" class="fadeIn second @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="false" autofocus placeholder="Email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
       
        <input type="text" id="password" placeholder="Password" style="border: 1px solid transparent;text-align:center;" class="fadeIn third @error('password') is-invalid @enderror" name="password"  required autocomplete="current-password">
        <script>
            var input = document.getElementById("password");

        input.addEventListener("input", function() {
            var currentType = input.type;

            // If the input field has text and the current type is 'text', switch to 'password'
            if (input.value && currentType === "text") {
                input.type = "password";
            }

            // If the input field is empty and the current type is 'password', switch to 'text'
            if (!input.value && currentType === "password") {
                input.type = "text";
            }
        });

        </script>
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

                <br>
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
