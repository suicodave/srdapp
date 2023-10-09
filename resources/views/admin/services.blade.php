@extends('admin.apps')

@section('content')
<div class="card" style="margin-top:5px;">
    <div class="card-header">
        <h3 class="card-title">Services</h3>
    </div>
    <div class="card-header">
        <a href="#" title="Add" style="float: right;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">Add Services</a>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped" style="font-size: 14px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Vehicle Type</th>
                    <th>Services Description</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php $x = 1;?>
            @foreach($services as $itemservices)

            <tr>
                <td>{{$x++;}}</td>
                <td>{{$itemservices->vehicletype}}</td>
                <td>{{ $itemservices->servicesname }}</td>
                <td style="text-align: right;"><span class="peso"></span>{{ number_format($itemservices->price,2) }}</td>
                <td>{{$itemservices->status}}</td>
                <td style="text-align: center;"><a data-toggle="modal"
                    data-sid="{{$itemservices->sid}}"
                    data-servicesname="{{$itemservices->servicesname}}"
                    data-classification="{{$itemservices->id }}"
                    data-price="{{$itemservices->price }}"
                    data-status = "{{$itemservices->status}}"
                    class="text-danger passingID" data-toggle="modal" data-target="#MyModal" title="Edit">
                <i class="fa fa-edit"></i></a> | <a data-toggle="modal" data-id="{{ $itemservices->sid }}"  class="text-danger del_passingID" data-toggle="modal" data-target="#deleteModal">
                <i class="fa fa-trash"></i></td>
            </tr>
            @endforeach
            <tbody>
            </tbody>
        </table>

    </div>
</div>

<form action="{{route('addServices')}}" method="POST">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Serices</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>

                <div class="modal-body">
                    <div class="container" >
                        <div class="row" style="margin-left: 2px;">
                            <div class="form-group">
                                <label class="col-form-label" for="servicesname">Services Description <small style="color: red;font-weight:bold;">*</small></label>
                                <textarea name="servicesname" class="form-control" cols="100" rows="2"></textarea>
                                {{ $errors->first('servicesname') }}
                            </div>
                            <div class="form-group pr-3">
                                <label for="version" class="col-form-label"></i> Classification</label>
                                <select name="classid" id="" class="form-control is-warning" autocomplete="off" style="text-align:left;color:red;">
                                    <option value="">Select Classification</option>
                                @foreach($classes as $itemclass)
                                    <option value="{{$itemclass->id}}">{{$itemclass->vehicletype}}</option>
                                @endforeach
                                </select>
                                {{ $errors->first('classid') }}
                            </div>
                            <div class="form-group pr-3">
                                <label class="col-form-label" for="price"><i class="far fa-bell"></i> Price <small style="color: red;font-weight:bold;">*</small></label>
                                <input type="number" min="0" step="1" class="form-control is-warning" placeholder="" name="price" required="true" autocomplete="off" style="text-align:right;color:red;">
                                {{ $errors->first('price') }}
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

<!--Update modal-->
<form action="{{route('updateServices')}}" method="POST">
    <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Update Services</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row" style="margin-left: 2px;">
                            <div class="form-group">
                                <label class="col-form-label" for="servicesname">Services Description <small style="color: red;font-weight:bold;">*</small></label>
                                <textarea name="servicesname" id="cservicesname" class="form-control" cols="100" rows="2"></textarea>
                                {{ $errors->first('servicesname') }}
                            </div>
                            <div class="form-group pr-3">
                                <label for="version" class="col-form-label"></i> Classification</label>
                                <select name="classid" id="cclassification" class="form-control is-warning" autocomplete="off" style="text-align:left;color:red;">
                                        <option value="">Select Classification</option>
                                        @foreach($classes as $itemclass)
                                            <option value="{{$itemclass->id}}">{{$itemclass->vehicletype}}</option>
                                        @endforeach
                                </select>
                                {{ $errors->first('classid') }}
                            </div>
                            <div class="form-group pr-3">
                                <label class="col-form-label" for="price"><i class="far fa-bell"></i> Price <small style="color: red;font-weight:bold;">*</small></label>
                                <input type="number" min="0" step="1" class="form-control is-warning" placeholder="" name="price" id="cprice" required="true" autocomplete="off" style="text-align:right;color:red;">
                                {{ $errors->first('price') }}
                            </div>
                            <div class="form-group pr-3">
                                <label class="col-form-label" for="price"><i class="far fa-bell"></i> Status <small style="color: red;font-weight:bold;">*</small></label>
                                <select name="status" id="cstatus" class="form-control is-warning">
                                        <option value="">Select Status</option>
                                        <option value="Available">Available</option>
                                        <option value="Unavailable">Unavailable</option>
                                </select>
                                {{ $errors->first('price') }}
                            </div>

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
        var c_sid = $(this).attr('data-sid');
        var c_servicesname = $(this).attr('data-servicesname');
        var c_classification = $(this).attr('data-classification');
        var c_price = $(this).attr('data-price');
        var c_status = $(this).attr('data-status');
        $("#csid").val( c_sid );
        $("#cservicesname").val( c_servicesname );
        $("#cclassification").val( c_classification );
        $("#cprice").val( c_price );
        $("#cstatus").val( c_status );
        $('#myModal').modal('show');

    });

    </script>
    <!--end update-->

    <!--delete-->
<form action="{{route('deleteservices')}}" method="POST">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Delete Services</h4>
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

