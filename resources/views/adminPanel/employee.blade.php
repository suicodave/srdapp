@extends('adminPanel.adminpanel-layout')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card-header">
            <a href="#" title="Add" style="float: right;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">Add Employee</a>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped" style="font-size: 14px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fullname</th>
                        <th>Phone Number</th>
                        <th>Status</th>
                        <th>Login Attempt</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php $x=1;?>
                @foreach ($usersdetails as $itemuser)
                    <tr>
                        <td>{{$x++;}}</td>
                        <td>{{$itemuser->name }}</td>
                        <td>{{$itemuser->mobile_no }}</td>
                        <td>{{$itemuser->status }}</td>
                        <td>{{$itemuser->loginattemp }}</td>
                        <td>Edit | Delete</td>
                    </tr>
                @endforeach



                <tbody>
                </tbody>
            </table>

        </div>
    </div>
</div>


<!---start add modal-->
<form action="{{route('addemployee')}}" method="POST">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="container" >
                        <div class="row justify-content-md-center" >

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
                                            var alphanumericRegex = /^[0-9a-zA-Z]+$/;

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
                                           <select name="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Male">Female</option>
                                           </select>
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
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-danger btn-sm" value="Submit">
                </div>

            </div>
        </div>
    </div>
    @csrf
</form>
<!---end add modal-->

    <!--Update modal-->
<form action="" method="POST">
    <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="my_modalLabel">Update Classification</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <div class="container" >
                        <div class="row justify-content-md-center" >
                            <div class="form-group">
                                <label class="col-form-label" for="classification">Services Classification <small style="color: red;font-weight:bold;">*</small></label>
                                <textarea name="classification" id="cvehicletype" required autocomplete="false" class="form-control" cols="100" rows="2"></textarea>
                                {{ $errors->first('classification') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="rid" id="cid" value="">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-info btn-sm" value="Update">
                </div>

            </div>
        </div>
    </div>
    @csrf
</form>
    <script type="text/javascript">
    $(".passingID").click(function () {
        var c_id = $(this).attr('data-id');
        var c_vehicletype = $(this).attr('data-vehicletype');
        $("#cid").val( c_id );
        $("#cvehicletype").val( c_vehicletype );
        $('#myModal').modal('show');

    });
    </script>
    <!--end update-->

    <!--delete-->
    <form action="" method="POST">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Delete Classification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                        Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                        <input type="hidden" name="rowid" id="rid" value="">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-danger" value="Delete">

                </div>
            </div>
        </div>
    </div>
    @csrf
    </form>
    <script type="text/javascript">
    $(".del_passingID").click(function () {
        var del_id = $(this).attr('data-id');
        $("#rid").val( del_id );
        $('#deleteModal').modal('show');
    });
    </script>
    <!--end delete-->
@endsection

