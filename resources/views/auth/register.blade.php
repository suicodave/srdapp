<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SRD Car SPA | Dashboard</title>
    <style>
        .register{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    margin-top: 3%;
    padding: 3%;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 4%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    background: #f8f9fa;
    border-top-left-radius: 10% 50%;
    border-bottom-left-radius: 10% 50%;
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 25%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 10%;
    margin-top: 10%;
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #0062cc;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background: #0062cc;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    width: 100px;
    color: #0062cc;
    border: 2px solid #0062cc;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}
    </style>
</head>

<body>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <br><br><br>
                        <h3>Welcome SRD</h3>
                        <?php
                        $checkuser = App\Models\User::where('saStatus',1)->pluck('id')->first();
                        ?>
                        @if($checkuser == NULL)
                        <p>Note: As a super admin, it's essential to create your account before gaining access, as there are currently no records present in the database.</p>
                        @else
                            @if ($checkuser == 1)
                                <script>
                                    window.location.href = '{{ route('index') }}';
                                </script>
                            @endif
                        @endif
                    </div>
                    <div class="col-md-9 register-right">
                        <form method="POST" action="{{ route('register') }}">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <h3 class="register-heading">Super Admin Form</h3>
                                    <div class="row register-form">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input id="name" type="text" placeholder="Full Name *"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input id="email" type="email" placeholder="Email *" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <script>
                                                function validatePassword() {
                                                    var password = document.getElementById("password").value;
                                                    var password_confirm = document.getElementById("password_confirm").value;
                                                    var errorElement = document.getElementById("passwordError");
                                                    var strengthElement = document.getElementById("passwordStrength");
                                                    var inputPasswordElement = document.getElementById("inputPassword");
                                                    var alphanumericRegex = /^[0-9a-zA-Z]+$/; // Regular expression to check for alphanumeric characters

                                                    if (password !== password-confirm) {
                                                        errorElement.innerHTML = "Passwords do not match!";
                                                        strengthElement.innerHTML = "";
                                                    } else if (!alphanumericRegex.test(password) || password.length < 8) {
                                                        errorElement.innerHTML = "Password must contain both alphanumeric characters and be at least 8 characters long!";
                                                        strengthElement.innerHTML = "";
                                                    } else {
                                                        errorElement.innerHTML = "";
                                                        var passwordStrength = calculatePasswordStrength(password);
                                                        strengthElement.innerHTML = "Password Strength: " + passwordStrength;
                                                        inputPasswordElement.innerHTML = "Inputted Password: " + password;
                                                    }
                                                }

                                                function calculatePasswordStrength(password) {
                                                    var strength = "Weak";
                                                    if (password.length >= 12) {
                                                        strength = "Strong";
                                                    } else if (password.length >= 8) {
                                                        strength = "Moderate";
                                                    }
                                                    return strength;
                                                }
                                            </script>

                                            <div class="form-group">
                                                <input id="password" placeholder="Password *" oninput="validatePassword()" type="password" class="form-control" name="password" required autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input id="password_confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <input id="mobile_no" type="text" placeholder="Mobile Number *" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" required autocomplete="mobile_no" autofocus>
                                                @error('mobile_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="maxl">
                                                    <label class="radio inline">
                                                        <input type="radio" name="gender" value="Male" checked>
                                                        <span> Male </span>
                                                    </label>
                                                    <label class="radio inline">
                                                        <input type="radio" name="gender" value="Female">
                                                        <span>Female </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <select required class="form-control" name="secquestion">
                                                    <option class="hidden"  selected disabled>Please select your Sequrity Question</option>
                                                    <option>What is your Birthdate?</option>
                                                    <option>What is Your old Phone Number</option>
                                                    <option>What is your Pet Name?</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" required name="seckey" class="form-control" placeholder="Enter Your Answer *" value="" />
                                            </div>

                                            <button type="submit" class="btnRegister">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @csrf
                         </form>
                    </div>
                </div>

            </div>
</body>
</html>
