@extends('adminPanel.adminpanel-layout')

@section('content')
<div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{route('home')}}">Home</a>
            </li>
        </ul>
    </div>
    <div class="page-content">
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
                                <td style="text-align: center;"><a data-toggle="modal"
                                    data-id="{{$itemuser->id}}"
                                    data-name="{{$itemuser->name}}"
                                    data-email="{{$itemuser->email}}"
                                    data-gender="{{$itemuser->gender}}"
                                    data-mobile_no="{{$itemuser->mobile_no}}"
                                    data-status="{{$itemuser->status}}"
                                    data-loginattemp="{{$itemuser->loginattemp}}"
                                    data-password="{{$itemuser->password}}"
                                    data-cpassword="{{$itemuser->cpassword}}"
                                    data-secquestion="{{$itemuser->secquestion}}"
                                    data-answer="{{$itemuser->answer}}"
                                    class="btn btn-xs btn-info text-danger passingID" data-toggle="modal" data-target="#MyModal" title="Edit">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i></a>  | <a class="btn btn-xs btn-danger" href="{{route('deleteEmployee',['eid' => $itemuser->id])}}"><i class="ace-icon fa fa-trash-o bigger-120"></i></td>
                            </tr>
                        @endforeach



                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>



<!---start add modal-->
<form action="{{route('storeEmployee')}}" method="POST">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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

                                    <div class="form-group">
                                        <input id="password" placeholder=" Temporary Password *" oninput="validatePassword()" type="password" class="form-control" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


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
<form action="{{route('editEmployee')}}" method="POST">
    <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="my_modalLabel">Update Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <div class="container" >
                        <div class="row justify-content-md-center" >

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" placeholder="Full Name *" id="cname" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input  type="email" placeholder="Email *" readonly class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="cemail" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <input  placeholder="Temporary Password " oninput="validatePassword()" type="password" class="form-control" name="password" autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input  type="text" placeholder="Mobile Number *" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" id="cmobile_no" value="{{ old('mobile_no') }}" required autocomplete="mobile_no" autofocus>
                                        @error('mobile_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <select name="status" id="cstatus" class="form-control">
                                         <option value="">Select Status</option>
                                         <option value="Active">Active</option>
                                         <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                           <select name="gender" id="cgender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Male">Female</option>
                                           </select>
                                    </div>
                                    <div class="form-group">
                                        <select required class="form-control" id="csecquestion" name="secquestion">
                                            <option class="hidden"  selected disabled>Please select your Sequrity Question</option>
                                            <option>What is your Birthdate?</option>
                                            <option>What is Your old Phone Number</option>
                                            <option>What is your Pet Name?</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" required name="seckey" class="form-control" id="canswer" placeholder="Enter Your Answer *" value="" />
                                    </div>
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
        var c_name = $(this).attr('data-name');
        var c_email = $(this).attr('data-email');
        var c_gender = $(this).attr('data-gender');
        var c_mobile_no = $(this).attr('data-mobile_no');
        var c_status = $(this).attr('data-status');
        var c_loginattemp = $(this).attr('data-loginattemp');
        var c_password = $(this).attr('data-password');
        var c_secquestion = $(this).attr('data-secquestion');
        var c_answer = $(this).attr('data-answer');
        $("#cid").val( c_id );
        $("#cname").val( c_name );
        $("#cemail").val( c_email );
        $("#cgender").val( c_gender );
        $("#cmobile_no").val( c_mobile_no );
        $("#cstatus").val( c_status );
        $("#cloginattemp").val( c_loginattemp );
        $("#cpassword").val( c_password );
        $("#csecquestion").val( c_secquestion );
        $("#canswer").val( c_answer );
        $('#myModal').modal('show');

    });
    </script>

@endsection

