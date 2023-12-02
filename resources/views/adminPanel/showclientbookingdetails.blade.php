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
            <div class="col-sm-10 col-sm-offset-1">
                <div class="widget-box transparent" id="printableArea">
                    <div class="widget-header widget-header-large">
                        <h3 class="widget-title grey lighter">
                            Priority Order
                            @foreach($bookings as $bookinginfo)
                            <span class="red"># {{$bookinginfo->dateprocess}}{{$bookinginfo->prioritynumber}}</span>
                            @endforeach
                        </h3>
                        <div class="widget-toolbar no-border invoice-info">
                            <span class="invoice-info-label">Transaction#:</span>
                            <span class="red">{{$bookinginfo->txnNumber}}</span>
                            <br />
                            <span class="invoice-info-label">Date:</span>
                            <span class="blue">{{now()}}</span>
                        </div>

                        <div class="widget-toolbar hidden-480">
                            <a href="#" onclick="printDiv('printableArea')">
                                <i class="ace-icon fa fa-print"></i>
                            </a>
                        </div>
                    </div>
                    @foreach($bookings as $bookinginfo)
                    <?php
                    $time = $bookinginfo->washTime;
                    $hours = substr($time, 0, 2);
                    $hour = intval($hours);
                    ?>
                    <div class="widget-body">
                        <div class="widget-main padding-24">
                            <div class="row">
                                <input type="hidden" name="bid" value="{{$bookinginfo->id}}">
                                <input type="hidden" name="pid" value="{{$bookinginfo->pid}}">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div style="text-align: left;" class="col-xs-12 label label-lg label-success arrowed-in arrowed-right">
                                            <b>Customer Info</b>
                                        </div>
                                    </div>

                                    <div>
                                        <ul class="list-unstyled spaced">
                                            <li>
                                                <i class="ace-icon fa fa-caret-right green"></i>{{$bookinginfo->fullName}}
                                            </li>

                                            <li>
                                                <i class="ace-icon fa fa-caret-right green"></i>Mobile #:&nbsp;{{$bookinginfo->mobileNumber}}
                                            </li>

                                            <li>
                                                <i class="ace-icon fa fa-caret-right green"></i>Booking #:&nbsp;{{$bookinginfo->bookingnumber}}
                                            </li>
                                            <li>
                                                <i class="ace-icon fa fa-caret-right green"></i>Preffered Date:&nbsp;{{$bookinginfo->washDate}}
                                            </li>
                                            <li>
                                                <i class="ace-icon fa fa-caret-right green"></i>Preffered Time:&nbsp;{{$bookinginfo->washTime}}  @if ($hour >= 12) {{'PM'}} @else {{'AM'}} @endif
                                            </li>
                                            <li>
                                                <i class="ace-icon fa fa-caret-right green"></i>Contact Info:&nbsp;{{$bookinginfo->email}}
                                            </li>
                                            <li>
                                                <i class="ace-icon fa fa-caret-right green"></i>Booking Status:&nbsp;{{$bookinginfo->statusname}}
                                            </li>
                                            <li>
                                                <i class="ace-icon fa fa-caret-right green"></i>Branch:&nbsp;{{$bookinginfo->branch_name}}
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- /.col -->
                            </div><!-- /.row -->

                            <div class="space"></div>

                            <div>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>SERVICES TYPE</th>
                                            <th class="hidden-xs">BOOKED DATE</th>
                                            <th>TOTAL</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td class="center">#</td>

                                            <td><a href="#">{{$bookinginfo->servicesid}} for {{$bookinginfo->classid}}</a></td>
                                            <td class="hidden-xs">{{$bookinginfo->created_at}}</td>

                                            <td>&#x20B1;&nbsp;{{$bookinginfo->price}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="text-align: center;"><small>Nothing follows!</small></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="hr hr8 hr-double hr-dotted"></div>

                            <div class="row">
                                <div class="col-sm-5 pull-right">
                                    <h4 class="pull-right">
                                        Total amount :
                                        <span class="red">&#x20B1;&nbsp;{{$bookinginfo->price}}</span>
                                    </h4>
                                </div>

                            </div>

                            <div class="space-6"></div>
                        </div>
                    </div>
                    @if($bookinginfo->bookingstatus == 2)
                    <div>

                        <a data-toggle="modal"
                                    data-bid="{{$bookinginfo->id}}"
                                    data-pid="{{$bookinginfo->pid}}"
                                    class="btn btn-sm btn-danger text-danger passingID" data-toggle="modal" data-target="#MyModal" title="Edit">Accept Booking Order</a>
                    </div>
                    @else
                    <div><a href="{{route('finishedbooking',['bid' => $bookinginfo->id, 'pid' => $bookinginfo->pid])}}" class="btn btn-danger btn-sm">Done</a></div>
                    @endif
                    @endforeach
                </div>


            </div>
        </div>
    </div>
</div>

<form action="{{route('proceedclientbooking')}}" method="POST">
<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="my_modalLabel">Accept Booking</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <div class=" justify-content-md-center" >
                    <div class="form-group">
                        <label class="col-form-label" for="classification">Set Max Time Process <small style="color: red;font-weight:bold;">*</small></label>
                        <input type="number" name="maxnumtime" placeholder="Number of Hours" class="form-control">
                        {{ $errors->first('classification') }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="text" name="browid" id="bid" value="">
                <input type="text" name="prowid" id="pid" value="">
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
    var c_id = $(this).attr('data-bid');
    var c_pid = $(this).attr('data-pid');
    $("#bid").val( c_id );
    $("#pid").val( c_pid );
    $('#myModal').modal('show');

});
</script>
@endsection
