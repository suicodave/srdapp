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
            <div class="card-header">
                <a href="#" title="Add" style="float: right;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">Add Designation</a>
            </div>
            <div class="col-xs-12">

                <table id="example2" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">
                                #
                            </th>
                            <th>Designation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php $x=1;?>
                    <tbody>
                        @foreach ($designations as $itemclass)
                        <tr>
                            <td style="text-align: center;">{{$x++;}}</td>
                            <td>{{$itemclass->position }}</td>
                            <td style="text-align: center;"><a data-toggle="modal"
                                    data-id="{{$itemclass->id}}"
                                    data-position="{{$itemclass->position}}"
                                    class="btn btn-xs btn-info text-danger passingID" data-toggle="modal" data-target="#MyModal" title="Edit">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i></a> |
                                        <button class="btn btn-xs btn-danger dpassingID" data-did="{{$itemclass->id}}" onclick="openModal('exampleID')"><i class="ace-icon fa fa-trash-o bigger-120"></i></button>
                                    </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!---start add modal-->
<form action="{{route('addDesignations')}}" method="POST">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Designation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>

                <div class="modal-body">

                        <div class="row justify-content-md-center" >
                            <div  class="col-md-12">
                                <label class="col-form-label" for="designation">Position <small style="color: red;font-weight:bold;">*</small></label>
                                <input type="text" name="designation" id="" class="form-control">
                                {{ $errors->first('designation') }}
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
<form action="{{route('updateDesignations')}}" method="POST">
    <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="my_modalLabel">Update Designation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                        <div class="row justify-content-md-center" >
                            <div  class="col-md-12">
                                <label class="col-form-label" for="designation">Postion <small style="color: red;font-weight:bold;">*</small></label>
                                <input type="text" name="designation" id="cposition" class="form-control">
                                {{ $errors->first('designation') }}
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
        var c_position = $(this).attr('data-position');
        $("#cid").val( c_id );
        $("#cposition").val( c_position );
        $('#myModal').modal('show');

    });
    </script>
    <!--end update-->

<!--delete-->
<form action="{{route('deleteDesignations')}}" method="POST">
    <div id="deleteModal" class="modald">
        <div class="modald-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Delete Designation</h4>
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
