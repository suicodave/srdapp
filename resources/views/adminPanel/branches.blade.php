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
        <div class="card-header">
            <a href="#" title="Add" style="float: right;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">Add Branches</a>
        </div>
        <div class="row">
            <div class="col-xs-12">

                <table id="example2" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">
                                #
                            </th>
                            <th>Classification</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php $x=1;?>
                    <tbody>
                        @foreach ($databranches as $itemclass)
                        <tr>
                            <td style="text-align: center;">{{$x++;}}</td>
                            <td>{{$itemclass->branch_name }}</td>
                            <td>{{$itemclass->status}}</td>
                            <td style="text-align: center;"><a data-toggle="modal"
                                    data-id="{{$itemclass->id}}"
                                    data-branch_name="{{$itemclass->branch_name}}"
                                    data-status="{{$itemclass->status}}"
                                    class="text-danger passingID btn btn-xs btn-info" data-toggle="modal" data-target="#MyModal" title="Edit">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i></a> | <a class="btn btn-xs btn-danger" href="{{route('deleteBranches',['cid' => $itemclass->id])}}">
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
<form action="{{route('addBranches')}}" method="POST">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Branches</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>

                <div class="modal-body">

                        <div class="row justify-content-md-center" >
                            <div  class="col-md-12">
                                <label class="col-form-label" for="branch">Branches <small style="color: red;font-weight:bold;">*</small></label>
                                <input type="text" name="branch" id="" class="form-control">
                                {{ $errors->first('branch') }}
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
<form action="{{route('updateBranches')}}" method="POST">
    <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="my_modalLabel">Update Branch</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                        <div class="row justify-content-md-center" >
                            <div  class="col-md-12">
                                <label class="col-form-label" for="classification">Branch <small style="color: red;font-weight:bold;">*</small></label>
                                <input type="text" name="branch" id="cbranch_name" class="form-control">
                                {{ $errors->first('classification') }}
                            </div>
                        </div>

                        <div class="row justify-content-md-center" >
                            <div  class="col-md-12">
                                <label class="col-form-label" for="classification">Availability <small style="color: red;font-weight:bold;">*</small></label>
                                <select name="availability" class="form-control" id="cstatus">
                                    <option value="">Select Availability</option>
                                    <option value="Available">Available</option>
                                    <option value="Unavailable">Unavailable</option>
                                </select>
                            </div>
                        </div>
                </div><br>
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
        var c_branch_name = $(this).attr('data-branch_name');
        var c_status = $(this).attr('data-status');
        $("#cid").val( c_id );
        $("#cbranch_name").val( c_branch_name );
        $("#cstatus").val( c_status );
        $('#myModal').modal('show');

    });
    </script>
    <!--end update-->


@endsection
