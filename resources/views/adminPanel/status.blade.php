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
                    <a href="#" title="Add" style="float: right;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">Add Status</a>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div>
                            <table id="example2" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center"></th>
                                        <th>Status</th>
                                        <th>Descrition</th>
                                        <th>Maker</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php $x=1;?>
                                <tbody>
                                    @foreach ($status as $itemstatus)
                                    <tr>
                                        <td style="text-align: center;">{{$x++;}}</td>
                                        <td>{{$itemstatus->statusname }}</td>
                                        <td>{{$itemstatus->description }}</td>
                                        <td>{{$itemstatus->maker }}</td>
                                        <td style="text-align: center;"><a data-toggle="modal"
                                                data-statusid="{{$itemstatus->statusid}}"
                                                data-statusname="{{$itemstatus->statusname}}"
                                                data-description="{{$itemstatus->description}}"
                                                class="btn btn-xs btn-info text-danger passingID" data-toggle="modal" data-target="#MyModal" title="Edit">
                                            <i class="ace-icon fa fa-pencil bigger-120"></i></a> |
                                            <a class="btn btn-xs btn-danger dpassingID" data-did="{{$itemstatus->statusid}}" onclick="openModal('exampleID')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->
</div>
<!---start add modal-->
<form action="{{route('addStatus')}}" method="POST">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>

                <div class="modal-body">
                        <div class="justify-content-md-center" >
                            <div class="form-group">
                                <label class="col-form-label" for="statusname">Name<small style="color: red;font-weight:bold;">*</small></label>
                                <input type="text" name="statusname" class="form-control" id="">
                                {{ $errors->first('statusname') }}
                            </div>
                        </div>
                        <div class="justify-content-md-center" >
                            <div class="form-group">
                                <label class="col-form-label" for="description">Descrition<small style="color: red;font-weight:bold;">*</small></label>
                                <textarea name="description" required autocomplete="false" class="form-control" cols="100" rows="2"></textarea>
                                {{ $errors->first('description') }}
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
<form action="{{route('updateStatus')}}" method="POST">
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
                            <label class="col-form-label" for="statusname">Name<small style="color: red;font-weight:bold;">*</small></label>
                            <input type="text" name="statusname" class="form-control" id="cstatusname">
                            {{ $errors->first('statusname') }}
                        </div>
                    </div>
                    <div class="justify-content-md-center" >
                        <div class="form-group">
                            <label class="col-form-label" for="description">Descrition<small style="color: red;font-weight:bold;">*</small></label>
                            <textarea name="description" required autocomplete="false" id="cdescription" class="form-control" cols="100" rows="2"></textarea>
                            {{ $errors->first('description') }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="rowstatusid" id="cstatusid" value="">
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
        var c_statusid = $(this).attr('data-statusid');
        var c_statusname = $(this).attr('data-statusname');
        var c_description = $(this).attr('data-description');
        $("#cstatusid").val( c_statusid );
        $("#cstatusname").val( c_statusname );
        $("#cdescription").val( c_description );
        $('#myModal').modal('show');

    });
    </script>
    <!--end update-->

<!--delete-->
<form action="{{route('deleteStatus')}}" method="POST">
<div id="deleteModal" class="modald">
    <div class="modald-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Delete Status</h4>
            <button type="button" class="closed" onclick="closeModal()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete the data?
        </div>
        <div class="modal-footer">
            <input type="hidden" name="rowid" id="statid">
            <button type="button" class="btn btn-default btn-sm" onclick="closeModal()" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
        </div>
    </div>
</div>
@csrf
</form>
<script type="text/javascript">
var modal = document.getElementById("deleteModal");
$(".dpassingID").click(function () {
        var did = $(this).attr('data-did');

        $("#statid").val( did );
        $('#myModal').modal('show');

    });
// Function to open the modal
function openModal() {
  modal.style.display = "block";
}
function closeModal() {
  modal.style.display = "none";
}
</script>
<!--end delete-->

@endsection
