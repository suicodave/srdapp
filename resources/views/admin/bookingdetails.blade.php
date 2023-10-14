@extends('admin.apps')

@section('content')
<div class="card" style="margin-top:5px;">
    <div class="card-header">
        <h3 class="card-title">Booking Details</h3>
    </div>
    <div class="card-body">
        <table id="example2" class="table table-bordered table-striped" style="font-size: 14px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Booking Number</th>
                    <th>Client</th>
                    <th>Package Type</th>
                    <th>Branch</th>
                    <th>Preffered Date and Time</th>
                    <th>Booked Date</th>
                    <th>Action</th>
            </thead>
            <?php $x = 1;?>
            @foreach($bookings as $key => $value)
            <?php
            $packagetype = $value->classid.' - '.$value->servicesid;
            ?>
                <tr>
                    <td>{{$x++;}}</td>
                    <td>{{$value->bookingnumber }}</td>
                    <td>{{$value->fullName }}</td>
                    <td>{{$packagetype }}</td>
                    <td>{{$value->branchcode }}</td>
                    <td>{{$value->washDate }} - {{$value->washTime}}</td>
                    <td>{{$value->created_at }}</td>
                    <td> <a data-toggle="modal"
                        data-id = "{{$value->id}}"
                        data-bookingnumber = "{{$value->bookingnumber}}"
                        data-fullName = "{{$value->fullName}}"
                        data-classid = "{{$packagetype}}"
                        data-branchcode = "{{$value->branchcode}}"
                        data-washDate = "{{$value->washDate}}"
                        data-washTime = "{{$value->washTime}}"
                        data-message = "{{$value->message}}"
                        data-mobileNumber = "{{$value->mobileNumber}}"
                        data-status="{{$value->bookingstatus}}"
                        data-created_at = "{{$value->created_at}}"
                        class="text-danger passingID" data-toggle="modal" data-target="#MyModal" title="Edit">
                    View Details</a></td>
                </tr>
            @endforeach
            <tbody>
            </tbody>
        </table>

    </div>
</div>

<form action="" method="POST">
    <div class="modal fade bd-example-modal-xl modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
        <div class="modal-dialog modal-xl" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="my_modalLabel">Booking Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <div class="container" >
                        <div class="row justify-content-md-center" >
                            <div class="col col-lg-8">
                              <label class="col-form-label" for="requestno" > BOOKING ORDER </label>
                            </div>
                            <?php
                            use App\Models\Booking;
                            $booking= Booking::select('id')->get()->last();
                            $pnid = 'TN#100'.$booking->id;
                            ?>
                            <div style="float:right;" class="col col-lg-4">
                                <label class="col-form-label" for="requestno"> TRANSACTION NUMBER: {{$pnid}}</label>
                            </div>
                        </div>

                        <div class="row justify-content-md-center" >
                            <div class="col col-lg-12 pt-2" style="font-style:italic;font-weight:bold;font-size:14px;">
                              <label class="col-form-label" for="requestno"> <i class='fa fa-bell blue-color'></i> NOTE: IT MUST BE APPROVED BY THE BRANCH MANAGER </label>
                            </div>
                        </div>
                        <div class="row justify-content-md-center" >
                            <div class="col col-lg-12 pt-2" style="font-style:italic;font-weight:bold;font-size:14px;">
                                <label class="col-form-label" for="kindofasset"><i class='fa fa-bell blue-color'></i> CLIENT NAME </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="fullname" id="cfname" readonly class="form-control" id="">
                            </div>
                        </div>
                        <div class="row justify-content-md-center" >
                                <div style="float:right;" class="col col-lg-4 pt-2">
                                    <label class="col-form-label" for="kindofasset"><i class="far fa-bell"></i> BOOKING # </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' class="form-control" name ='bookingnumber' id="cbn" readonly/>
                                </div>
                                <div style="float:right;" class="col col-lg-4 pt-2">
                                    <label class="col-form-label" for="quanitity"><i class="far fa-bell"></i> BOOKED DATE </label>
                                    &nbsp;&nbsp;<input type="text" name="" class="form-control" readonly id="cdatecreated">
                                </div>
                                <div style="float:right;" class="col col-lg-4 pt-2">
                                    <label class="col-form-label" for="requestno"><i class="far fa-bell"></i> MOBILE NUMBER </label>
                                    <input type="text" name="mobilenumber" class="form-control" readonly id="cmnumber">
                                </div>
                        </div>
                        <div class="row justify-content-md-center" >
                            <div style="float:right;" class="col col-lg-4 pt-2">
                                <label class="col-form-label" for="kindofasset"><i class="far fa-bell"></i> SERVICES TYPE </label>
                                <input type='text' name ='bookingOrder' class="form-control" id="ccid" value='' readonly/>
                            </div>
                            <div style="float:right;" class="col col-lg-4 pt-2">
                                <label class="col-form-label" for="quanitity"><i class="far fa-bell"></i> WASHING DATE </label>
                                <input type="text" name="washdate" class="form-control" readonly id="cwdate">
                            </div>
                            <div style="float:right;" class="col col-lg-4 pt-2">
                                <label class="col-form-label" for="requestno"><i class="far fa-bell"></i> WASHING TIME </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="form-control" readonly name="washtime" id="cwtime">
                            </div>
                        </div>

                        <div class="row justify-content-md-center" >
                            <div style="float:right;" class="col col-lg-4 pt-2">
                                <label class="col-form-label" for="kindofasset"><i class="far fa-bell"></i> STATUS </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' class="form-control" name ='status' id="cstatus" readonly/>
                            </div>
                            <div style="float:right;" class="col col-lg-4 pt-2">
                                <label class="col-form-label" for="quanitity"><i class="far fa-bell"></i> BRANCH </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="form-control" readonly name="branch" id="cbcode">
                            </div>
                            <div style="float:right;" class="col col-lg-4 pt-2">
                                <label class="col-form-label" for="requestno"> &nbsp; </label>
                            </div>
                        </div>

                        <div class="row justify-content-md-center">


                            <div style="float:right;" class="col col-lg-12 pt-2">
                                <label class="col-form-label" for="requestno"><i class="far fa-bell"></i>  MESSAGE  </label>
                            </div>
                            <div style="float:right;" class="col col-lg-12">
                                <textarea name="message" id="cmsg" readonly required="true" class="form-control is-warning" id="" cols="30" rows="2"></textarea>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="rid" id="cid" value="">
                    <input type="submit" class="btn btn-info btn-sm" value="PROCEED">
                </div>

            </div>
        </div>
    </div>
    @csrf
</form>
    <script type="text/javascript">
    $(".passingID").click(function () {
        var c_id = $(this).attr('data-id');
        var c_bn = $(this).attr('data-bookingnumber');
        var c_fname = $(this).attr('data-fullName');
        var c_cid = $(this).attr('data-classid');
        var c_bcode = $(this).attr('data-branchcode');
        var c_wdate = $(this).attr('data-washDate');
        var c_wtime = $(this).attr('data-washTime');
        var c_msg = $(this).attr('data-message');
        var c_mnumber = $(this).attr('data-mobileNumber');
        var c_status = $(this).attr('data-status');
        var c_datecreated = $(this).attr('data-created_at');

        $("#cid").val( c_id );
        $("#cbn").val( c_bn );
        $("#cfname").val( c_fname );
        $("#ccid").val( c_cid );
        $("#cbcode").val( c_bcode );
        $("#cwdate").val( c_wdate );
        $("#cwtime").val( c_wtime );
        $("#cmsg").val( c_msg );
        $("#cmnumber").val( c_mnumber );
        $("#cstatus").val( c_status );
        $("#cdatecreated").val( c_datecreated );
        $('#myModal').modal('show');

    });
    </script>
@endsection
