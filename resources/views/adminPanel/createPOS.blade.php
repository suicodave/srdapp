
@extends('adminPanel.adminpanel-layout')

@section('content')
<form action="{{route('savePayment')}}" method="POST" id="myForm">
    <script>
        window.onbeforeunload = function() {
            return "Are you sure you want to leave?";
        };
    </script>
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
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="space-6"></div>

                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="widget-box transparent">
                                <div class="widget-header widget-header-large">
                                    <h3 class="widget-title grey lighter">
                                        <i class="ace-icon fa fa-leaf green"></i>
                                        Customer Invoice
                                    </h3>

                                    <div class="widget-toolbar no-border invoice-info">
                                        <span class="invoice-info-label">Invoice:</span>
                                        <?php
                                        use App\Models\SRDSales;
                                        $countsales = SRDSales::latest('invoicenumber')->first();

                                        if($countsales->invoicenumber == NULL){
                                            $invoice1 = '1000';
                                        }else{
                                            $invoice1 = $countsales->invoicenumber + 1;
                                        }
                                        ?>
                                        <span class="red"><input type="hidden" name="invoice" value="{{$invoice1}}">{{$invoice1}}</span>

                                        <br />
                                        <span class="invoice-info-label">Date:</span>
                                        <span class="blue">04/04/2014</span>
                                    </div>

                                    <div class="widget-toolbar hidden-480">
                                        <a href="#">
                                            <i class="ace-icon fa fa-print"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main padding-24">

                                        <div class="space"></div>

                                        <div>
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="center">#</th>
                                                        <th>Booking Number</th>
                                                        <th>Clients</th>
                                                        <th class="hidden-xs">Transaction Number</th>
                                                        <th class="hidden-480">Description</th>
                                                        <th>Washing Date and Time</th>
                                                        <th>Performed By</th>
                                                        <th>Sub Total</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $tot = 0;
                                                    $x = 1;
                                                    ?>
                                                    @foreach($salesid as $itemid)

                                                    <tr>
                                                        <td class="center">{{$x++;}}<input type="hidden" name="bookingid[]" value="{{$itemid->bookingid}}" id="">  <input type="hidden" name="salesid[]" value="{{$itemid->salesid}}"></td>
                                                        <td><a href="#">{{$itemid->bookingnumber}}</a></td>
                                                        <td>{{$itemid->clients}}</td>
                                                        <td class="hidden-xs">{{$itemid->bookingnumber}}</td>
                                                        <td class="hidden-480">{{$itemid->servicesname}} for {{$itemid->vehicletype}}</td>
                                                        <td>{{$itemid->postingdate}}</td>
                                                        <td>{{$itemid->performedby}}</td>
                                                        <td style="text-align: right;">&#x20B1;&nbsp;{{number_format($itemid->price,2)}}</td>
                                                    </tr>
                                                    <?php
                                                    $tot += $itemid->price;
                                                    ?>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="hr hr8 hr-double hr-dotted"></div>
                                        <div class="row">
                                            <div class="col-sm-5 pull-right">
                                                <h4 class="pull-right">
                                                    Payment Type:
                                                    <span class="red">
                                                        <select  name="paymentmode" required style="width: 300px;text-align:right;" id="select1">
                                                            <option disabled>Select Payment Type</option>
                                                            <option value="C">Cash</option>
                                                            <option value="CG">GCash</option>

                                                        </select>
                                                        </select>
                                                    </span>
                                                </h4>
                                            </div>
                                            <div class="col-sm-7 pull-left"> &nbsp; </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-5 pull-right">
                                                <h4 class="pull-right">
                                                    Enter Amount:
                                                    <span class="red">
                                                        <input type="text" style="width: 300px;text-align:right;" required autofocus name="initialamount" id="input1" onkeyup="calculateDifference()">
                                                    </span>
                                                </h4>
                                            </div>
                                            <div class="col-sm-7 pull-left"> &nbsp; </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-5 pull-right">
                                                <h4 class="pull-right">
                                                    Total Amount Due:
                                                    <span class="red">
                                                    <input type="text" name="amountdue" readonly style="width:300px; text-align:right;" value="{{number_format($tot,2)}}" id="input2" onkeyup="calculateDifference()">
                                                    </span>
                                                </h4>
                                            </div>
                                            <div class="col-sm-7 pull-left"> &nbsp; </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-5 pull-right">
                                                <h4 class="pull-right">
                                                    Total Amount Change:
                                                    <span class="red">
                                                        <input type="text" readonly style="width: 300px;text-align:right;" name="amtchange" id="input3">
                                                    </span>
                                                </h4>
                                            </div>
                                            <div class="col-sm-7 pull-left"> &nbsp; </div>
                                        </div>
                                        <div class="space-6"></div>
                                        <div class="well">
                                            Thank you for choosing SRD CAR SPA Services.
                                            We believe you will be satisfied by our services.
                                        </div>
                                    </div>
                                    <div>
                                        <input type="submit" class="btn btn-success btn-sm" name="req" value="SavePayment">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@csrf
</form>
@endsection

