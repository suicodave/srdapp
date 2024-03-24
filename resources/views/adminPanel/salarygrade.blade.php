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
                <a href="#" title="Add" style="float: right;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">Add Salary</a>
            </div>
            <div class="col-xs-12">

                <table id="example2" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">
                                #
                            </th>
                            <th>Salary Code</th>
                            <th>Description</th>
                            <th>Period</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php $x=1;?>
                    <tbody>
                        @foreach ($salaries as $itemclass)
                        <tr>
                            <td style="text-align: center;">{{$x++;}}</td>
                            <td>{{$itemclass->sgcode }}</td>
                            <td>{{$itemclass->description }}</td>
                            <td>{{$itemclass->period }}</td>
                            <td style="text-align: right;">&#8369;&nbsp;{{number_format($itemclass->amount,2) }}</td>
                            <td style="text-align: center;"><a data-toggle="modal"
                                    data-sgid="{{$itemclass->sgid}}"
                                    data-sgcode="{{$itemclass->sgcode}}"
                                    data-description="{{$itemclass->description}}"
                                    data-period="{{$itemclass->period}}"
                                    data-amount="{{$itemclass->amount}}"
                                    class="btn btn-xs btn-info text-danger passingID" data-toggle="modal" data-target="#MyModal" title="Edit">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i></a> |
                                        <button class="btn btn-xs btn-danger dpassingID" data-did="{{$itemclass->sgid}}" onclick="openModal('exampleID')"><i class="ace-icon fa fa-trash-o bigger-120"></i></button>
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
<form action="{{route('addSalary')}}" method="POST">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Salary</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>

                <div class="modal-body">

                        <div class="row justify-content-md-center" >
                            <div  class="col-md-6">
                                <label class="col-form-label" for="scode">Salary Code <small style="color: red;font-weight:bold;">*</small></label>
                                <input type="text" name="scode" id="" class="form-control">
                                {{ $errors->first('scode') }}
                            </div>
                            <div  class="col-md-6">
                                <label class="col-form-label" for="description">Description <small style="color: red;font-weight:bold;">*</small></label>
                                <input type="text" name="description" id="" class="form-control">
                                {{ $errors->first('description') }}
                            </div>
                        </div>
                        <div class="row justify-content-md-center" >
                            <div  class="col-md-6">
                                <label class="col-form-label" for="period">Period <small style="color: red;font-weight:bold;">*</small></label>
                                <input type="text" name="period" id="" class="form-control">
                                {{ $errors->first('period') }}
                            </div>
                            <div  class="col-md-6">
                                <label class="col-form-label" for="amount">Amount <small style="color: red;font-weight:bold;">*</small></label>
                                <input type="number" name="amount" id="" class="form-control">
                                {{ $errors->first('amount') }}
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
<form action="{{route('updateSalary')}}" method="POST">
    <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="my_modalLabel">Update Salary</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-md-center" >
                        <div  class="col-md-6">
                            <label class="col-form-label" for="scode">Salary Code <small style="color: red;font-weight:bold;">*</small></label>
                            <input type="text" name="scode" id="csgcode" class="form-control">
                            {{ $errors->first('scode') }}
                        </div>
                        <div  class="col-md-6">
                            <label class="col-form-label" for="description">Description <small style="color: red;font-weight:bold;">*</small></label>
                            <input type="text" name="description" id="cdescription" class="form-control">
                            {{ $errors->first('description') }}
                        </div>
                    </div>
                    <div class="row justify-content-md-center" >
                        <div  class="col-md-6">
                            <label class="col-form-label" for="period">Period <small style="color: red;font-weight:bold;">*</small></label>
                            <input type="text" name="period" id="cperiod" class="form-control">
                            {{ $errors->first('period') }}
                        </div>
                        <div  class="col-md-6">
                            <label class="col-form-label" for="amount">Amount <small style="color: red;font-weight:bold;">*</small></label>
                            <input type="number" name="amount" id="camount" class="form-control">
                            {{ $errors->first('amount') }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="rid" id="csgid" value="">
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
        var c_sgid = $(this).attr('data-sgid');
        var c_sgcode = $(this).attr('data-sgcode');
        var c_description = $(this).attr('data-description');
        var c_period = $(this).attr('data-period');
        var c_amount = $(this).attr('data-amount');
        $("#csgid").val( c_sgid );
        $("#csgcode").val( c_sgcode );
        $("#cdescription").val( c_description );
        $("#cperiod").val( c_period );
        $("#camount").val( c_amount );
        $('#myModal').modal('show');

    });
    </script>
    <!--end update-->

<!--delete-->
<form action="{{route('deleteSalary')}}" method="POST">
    <div id="deleteModal" class="modald">
        <div class="modald-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Delete Salary Grade</h4>
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
