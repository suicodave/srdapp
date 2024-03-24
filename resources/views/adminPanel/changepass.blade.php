@extends('adminPanel.adminpanel-layout')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>
                <li class="active">Dashboard</li>
            </ul><!-- /.breadcrumb -->

            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>
        <?php 
        use App\Models\User;
        $ids = Auth::user()->id;
        $getsecq = User::where('id',$ids)->pluck('secquestion')->first();
        ?>
        <form action="{{route('changepassword')}}" method="POST">
        <div class="page-content">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 style="text-align: left;">
                                &nbsp;&nbsp;<span class="glyphicon glyphicon-cog"></span> Change Password
                            </h2>
                                <div class="widget-box">
                                    <div class="mt-5">
                                        <div class="col-lg-8">
                                            <div class="panel-body">
                                                    <div style="margin-top:20px;" class="col-xs-6 col-sm-6 col-md-6 login-box">
                                                    <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                                        <input class="form-control" name="currpass" id="previousPassword" autocomplete="false" required type="password" placeholder="Current Password">
                                                        <div id="previousPasswordError" style="color: red;"></div>
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                                        <input class="form-control" name="newpass" id="newPassword" autocomplete="false" required type="password" placeholder="New Password (max of 8 character)">
                                                        <div id="newPasswordError" style="color: red;"></div>
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                                        <input class="form-control" name="confirmpass" id="confirmPassword" autocomplete="false" required type="password" placeholder="Confirm Password">
                                                        <div id="confirmPasswordError" style="color: red;"></div>
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><span class="glyphicon glyphicon-info-sign"></span></div>
                                                        <input class="form-control" disabled type="text" required value="{{$getsecq}}" placeholder="Security Question">
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><span class="glyphicon glyphicon-wrench"></span></div>
                                                        <input class="form-control" name="seckey" autocomplete="false" required type="text" placeholder="Security Key">
                                                    </div>
                                                    <script>
                                                        document.getElementById('newPassword').addEventListener('input', validatePasswords);
                                                        document.getElementById('confirmPassword').addEventListener('input', validatePasswords);
                                                
                                                        function validatePasswords() {
                                                            var newPassword = document.getElementById('newPassword').value;
                                                            var confirmPassword = document.getElementById('confirmPassword').value;
                                                            var previousPassword = document.getElementById('previousPassword').value;
                                                            var newPasswordError = document.getElementById('newPasswordError');
                                                            var confirmPasswordError = document.getElementById('confirmPasswordError');
                                                            var previousPasswordError = document.getElementById('previousPasswordError');
                                                
                                                            if (newPassword === confirmPassword) {
                                                                newPasswordError.textContent = ''; // Clear error message
                                                                confirmPasswordError.textContent = ''; // Clear error message
                                                            } else {
                                                                newPasswordError.textContent = 'Passwords do not match!'; // Display error message
                                                                confirmPasswordError.textContent = 'Passwords do not match!'; // Display error message
                                                            }
                                                
                                                            // Check if new password starts with the first five characters of the previous password
                                                            if (newPassword.substr(0, 5) === previousPassword.substr(0, 5)) {
                                                                newPasswordError.textContent = 'New password must not contain the characters of the previous password!'; // Display error message
                                                            } else {
                                                                newPasswordError.textContent = ''; // Clear error message
                                                            }
                                                        }
                                                    </script>
                                                    </div> 
                                                    <div class="form-group pull-left">
                                                        <button  type="submit" class="btn btn-danger btn-sm">Change Password </button>
                                                    </div>
                                                   
                                                    </div>
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="hr hr32 hr-dotted"></div>
                </div><!-- /.col -->
        </div><!-- /.page-content -->
        @csrf
        </form>
    </div>
</div><!-- /.main-content -->
@endsection
