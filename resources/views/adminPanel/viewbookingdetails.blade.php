@extends('adminPanel.adminpanel-layout')

@section('content')
<form action="{{route('createtnxnumber')}}" method="POST">
<div class="row">

    <div class="col-sm-10 col-sm-offset-1">
        <div class="widget-box transparent" id="printableArea">
            <div class="widget-header widget-header-large">
                <h3 class="widget-title grey lighter">
                    Booking Order
                </h3>
                <?php
                use App\Models\Booking;
                use App\Models\BookingPriority;
                $booking= Booking::latest('txnNumber')->first();

                $getpn = BookingPriority::where('status',2)->select('id')->count();
                $latestDates = BookingPriority::select(DB::raw('MAX(dateprocess) as max_date'))
                    ->groupBy(DB::raw('DATE(dateprocess)'))
                    ->get()->first();

                //$latestPriority = BookingPriority::max('prioritynumber');
                if($getpn == 0 ){
                    $counter = $getpn + 1;
                }elseif($latestDates->max_date == date('myd')){

                    $latestPriority = BookingPriority::latest('prioritynumber')->where('status',2)->where('dateprocess',date('myd'))
                    ->get()->first();
                    $counter =  $latestPriority->prioritynumber + 1;
                }else{
                    $counter =  0 + 1;
                }
                ?>

                <div class="widget-toolbar no-border invoice-info">
                    <span class="invoice-info-label">Transaction#:</span>

                        @if($booking->txnNumber == 'Null')
                           <?php  $pnid = '1000'.$booking->txnNumber;?>
                        @else
                            <?php  $pnid = $booking->txnNumber + 1; ?>
                        @endif

                        <span class="red"><input type="hidden" name="txnno" value="{{$pnid}}">{{$pnid}}</span><br />
                        <span class="red"><input type="hidden" name="pn" value="{{date('myd')}}{{$counter}}">PN# {{date('myd')}}{{$counter}}</span>

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
                        <input type="hidden" name="bookingid" value="{{$bookinginfo->id}}">
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
                                        <i class="ace-icon fa fa-caret-right green"><input type="hidden" name="mnum" value="{{$bookinginfo->mobileNumber}}"></i>Mobile #:&nbsp;{{$bookinginfo->mobileNumber}}
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
                                        <i class="ace-icon fa fa-caret-right green"><input type="hidden" name="bname" value="{{$bookinginfo->branch_name}}"></i>Branch:&nbsp;{{$bookinginfo->branch_name}}
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
                                    <th>NUMBER OF VEHICLE</th>
                                    <th>Amount Per Service Type</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="center">#</td>

                                    <td><a href="#">{{$bookinginfo->servicesid}} for {{$bookinginfo->classid}}</a></td>
                                    <td class="hidden-xs">{{$bookinginfo->created_at}}</td>
                                    <td style="text-align: center;">{{$bookinginfo->numbervehicle}}</td>
                                    <td style="text-align: right;">&#x20B1;&nbsp;{{number_format($bookinginfo->price,2)}}</td>
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
                            <?php
                                    $tot = 0;
                                    $tot = $bookinginfo->numbervehicle * $bookinginfo->price;
                                    ?>
                            <h4 class="pull-right">
                                Total amount :
                                <span class="red">&#x20B1;&nbsp;{{number_format($tot,2)}}</span>
                            </h4>
                        </div>

                    </div>

                    <div class="space-6"></div>

                    <div class="well" style="text-align: justify;color:red;font-style:italic;size:10px;">
                        <b>SRD Car Wash Booking Agreement</b> <br>

                        The Customer has the right to cancel this booking reservation without incurring any charges up to 24 hours before the scheduled.
                        To cancel the booking reservation, the Customer must provide a notice to the Provider via email (srdcarspa@gmail.com) or phone call(9789542635) at least 24 hours before the scheduled. The Customer will receive a confirmation of the cancellation from the Provider.
                        If the Customer fails to cancel the booking reservation within 24 hours of the scheduled or is a no-show at the scheduled time, the Provider reserves the right to retain the reservation fee as compensation for the missed service.
                    </div>
                </div>
            </div>
            @endforeach
        </div>


        <div>
            @foreach($bookings as $bookinginfo)
                @if($bookinginfo->txnNumber == NULL)
                    <input type="submit" name="submit" class="btn btn-danger btn-sm" value="Create Priority Number">
                @else
                    <span>{{$bookinginfo->statusname}}</span>
                @endif
            @endforeach
        </div>

    </div>

</div>
@csrf
    </form>
@endsection
