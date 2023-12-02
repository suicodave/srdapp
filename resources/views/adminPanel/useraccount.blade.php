@extends('adminPanel.adminpanel-layout')

@section('content')
<<div class="main-content-inner">
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
                    <a href="#" title="Add" style="float: right;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">Add User Account</a>
                </div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">
                                #
                            </th>
                            <th>Employee</th>
                            <th>Branch</th>
                            <th>Designation</th>
                            <th>Salary Grade</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php $x=1;?>
                    <tbody>
                        @foreach ($accounts as $itemclass)
                        <tr>
                            <td  style="text-align: center;">{{$x++;}}</td>
                            <td>{{$itemclass->name }}</td>
                            <td>{{$itemclass->branch_name }}</td>
                            <td>{{$itemclass->position }}</td>
                            <td>{{$itemclass->amount }}</td>
                            <td>{{$itemclass->status }}</td>
                            <td style="text-align: center;"><a data-toggle="modal"
                                    data-id="{{$itemclass->id}}"
                                    data-name="{{$itemclass->employeeid}}"
                                    data-branch_name="{{$itemclass->branchid}}"
                                    data-position="{{$itemclass->designationid}}"
                                    data-amount="{{$itemclass->salarygrade}}"
                                    data-status="{{$itemclass->status}}"
                                    class="btn btn-xs btn-info text-danger passingID" data-toggle="modal" data-target="#MyModal" title="Edit">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i></a> | <a class="btn btn-xs btn-danger" href="{{route('deleteUserAccount',['cid' => $itemclass->id])}}">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!---start add modal-->
<form action="{{route('addUserAccount')}}" method="POST">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add User Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>

                <div class="modal-body">
                        <div class="row justify-content-md-center" >
                                <div  class="col-md-6">
                                    <label class="col-form-label" for="employeeid">Employee <small style="color: red;font-weight:bold;">*</small></label>
                                    <select name="employeeid" id="" class="form-control">
                                        <option value="">Select Employee</option>
                                        @foreach($users as $itemuser)
                                        <option value="{{$itemuser->id}}">{{$itemuser->name}}</option>
                                        @endforeach
                                    </select>
                                    {{ $errors->first('employeeid') }}
                                </div>
                                <div  class="col-md-6">
                                    <label class="col-form-label" for="branch">Branch <small style="color: red;font-weight:bold;">*</small></label>
                                    <select name="branchid" id="" class="form-control">
                                        <option value="">Select Branch</option>
                                        @foreach($branches as $itembranch)
                                        <option value="{{$itembranch->id}}">{{$itembranch->branch_name}}</option>
                                        @endforeach
                                    </select>
                                    {{ $errors->first('branch') }}
                                </div>
                        </div>
                        <div class="row justify-content-md-center pt-4" >
                            <div  class="col-md-6">
                                <label class="col-form-label" for="designation">Designation <small style="color: red;font-weight:bold;">*</small></label>
                                <select name="designationid" id="" class="form-control">
                                    <option value="">Select Designation</option>
                                    @foreach($designations as $itemdesignation)
                                    <option value="{{$itemdesignation->id}}">{{$itemdesignation->position}}</option>
                                    @endforeach
                                </select>
                                {{ $errors->first('designation') }}
                            </div>
                            <div  class="col-md-6">
                                <label class="col-form-label" for="salary">Salary Grade <small style="color: red;font-weight:bold;">*</small></label>
                                <select name="salaryid" id="" class="form-control">
                                    <option value="">Select Salary Code</option>
                                    @foreach($salaries as $itemsalary)
                                    <option value="{{$itemsalary->sgid}}">{{$itemsalary->description}}  </option>
                                    @endforeach
                                </select>
                                {{ $errors->first('salary') }}
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
<form action="{{route('updateUserAccount')}}" method="POST">
    <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="my_modalLabel">Update User Account</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-md-center" >
                        <div  class="col-md-6">
                            <label class="col-form-label" for="employeeid">Employee <small style="color: red;font-weight:bold;">*</small></label>

                            <select id="csname" name="employeeid"  class="form-control">
                                @foreach($users as $itemuser)
                                <option value="{{$itemuser->id}}">{{$itemuser->name}}</option>
                                @endforeach
                            </select>
                            {{ $errors->first('employeeid') }}
                        </div>
                        <div  class="col-md-6">
                            <label class="col-form-label" for="branchid">Branch <small style="color: red;font-weight:bold;">*</small></label>
                            <select id="csbranchname" name="branchid" class="form-control">
                                @foreach($branches as $itembranch)
                                <option value="{{$itembranch->id}}">{{$itembranch->branch_name}}</option>
                                @endforeach
                            </select>
                            {{ $errors->first('branchid') }}
                        </div>
                    </div>
                    <div class="row justify-content-md-center pt-4" >
                        <div  class="col-md-6">
                            <label class="col-form-label" for="designationid">Designation <small style="color: red;font-weight:bold;">*</small></label>
                            <select id="csposition" name="designationid"  class="form-control">
                                @foreach($designations as $itemdesignation)
                                <option value="{{$itemdesignation->id}}">{{$itemdesignation->position}}</option>
                                @endforeach
                            </select>
                            {{ $errors->first('designationid') }}
                        </div>
                        <div  class="col-md-6">
                            <label class="col-form-label" for="salaryid">Salary Grade <small style="color: red;font-weight:bold;">*</small></label>
                            <select  id="csamount" name="salaryid" class="form-control">
                                @foreach($salaries as $itemsalary)
                                <option value="{{$itemsalary->sgid}}">{{$itemsalary->description}}  </option>
                                @endforeach
                            </select>
                            {{ $errors->first('salaryid') }}
                        </div>
                    </div>
                    <div class="row justify-content-md-center pt-4" >
                        <div  class="col-md-6">
                            <label class="col-form-label" for="status">Status <small style="color: red;font-weight:bold;">*</small></label>
                            <select id="cstatus" name="status" class="form-control">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            {{ $errors->first('status') }}
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="rid" id="csid" value="">
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
        var c_branch_name = $(this).attr('data-branch_name');
        var c_position = $(this).attr('data-position');
        var c_amount = $(this).attr('data-amount');
        var c_status = $(this).attr('data-status');
        $("#csid").val( c_id );
        $("#csname").val( c_name );
        $("#csbranchname").val( c_branch_name );
        $("#csposition").val( c_position );
        $("#csamount").val( c_amount );
        $("#csstatus").val( c_status );
        $('#myModal').modal('show');
    });
    </script>
    <!--end update-->


@endsection
