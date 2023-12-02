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
                    <a href="#" title="Add" style="float: right;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">Add Classification</a>
                </div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
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
                        @foreach ($dataserclass as $itemclass)
                        <tr>
                            <td style="text-align: center;">{{$x++;}}</td>
                            <td>{{$itemclass->vehicletype }}</td>
                            <td>
                                @if($itemclass->status == 1)
                                {{"Available";}}
                                @else
                                    {{"Unavailable";}}
                                @endif
                            </td>
                            <td style="text-align: center;"><a data-toggle="modal"
                                    data-id="{{$itemclass->id}}"
                                    data-vehicletype="{{$itemclass->vehicletype}}"
                                    class="btn btn-xs btn-info text-danger passingID" data-toggle="modal" data-target="#MyModal" title="Edit">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i></a> | <a class="btn btn-xs btn-danger" href="{{route('deleteClassification',['cid' => $itemclass->id])}}">
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
<form action="{{route('addClassification')}}" method="POST">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Classification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>

                <div class="modal-body">
                        <div class="justify-content-md-center" >
                            <div class="form-group">
                                <label class="col-form-label" for="classification">Services Classification <small style="color: red;font-weight:bold;">*</small></label>
                                <textarea name="classification" required autocomplete="false" class="form-control"  cols="100" rows="2"></textarea>
                                {{ $errors->first('classification') }}
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
<form action="{{route('updateClassification')}}" method="POST">
    <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="my_modalLabel">Update Classification</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                        <div class="justify-content-md-center" >
                            <div class="form-group">
                                <label class="col-form-label" for="classification">Classification <small style="color: red;font-weight:bold;">*</small></label>
                                <textarea name="classification" id="cvehicletype" required autocomplete="false" class="form-control" cols="100" rows="2"></textarea>
                                {{ $errors->first('classification') }}
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
    <form action="#" method="POST">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="mydModalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="mydModalLabel">Delete Classification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                        Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                        <input type="text" name="rowid" id="rdid">
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
        var del_did = $(this).attr('data-ddid');
        $("#rdid").val( del_did );
        $('#deleteModal').modal('show');
    });
    </script>
@endsection
