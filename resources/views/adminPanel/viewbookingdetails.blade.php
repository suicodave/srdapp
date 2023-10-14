@extends('adminPanel.adminpanel-layout')

@section('content')
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="widget-box transparent" id="printableArea">
            <div class="widget-header widget-header-large">
                <h3 class="widget-title grey lighter">
                    Booking Order
                </h3>
                <?php
                use App\Models\Booking;
                $booking= Booking::where('bookingstatus','New')->where('txnNumber',NULL)->select('txnNumber')->get();
                foreach ($booking as $key => $bookvalue) {
                    $pnid = $bookvalue->txnNumber;
                }

                ?>
                <div class="widget-toolbar no-border invoice-info">
                    <span class="invoice-info-label">Transaction#:</span>
                    <span class="red">{{$pnid}}</span>

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
                                        <i class="ace-icon fa fa-caret-right green"></i>Booking Status:&nbsp;{{$bookinginfo->bookingstatus}}
                                    </li>
                                    <li>
                                        <i class="ace-icon fa fa-caret-right green"></i>Branch:&nbsp;{{$bookinginfo->branchcode}}
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
            <input type="submit" name="" id="">
        </div>
    </div>
</div>

@endsection
