
@extends('adminPanel.adminpanel-layout')

@section('content')
<?PHP
use Illuminate\Support\Facades\DB;
?>
<script>
    function selectElementContents(el) {
        var body = document.body,
            range, sel;
        if (document.createRange && window.getSelection) {
            range = document.createRange();
            sel = window.getSelection();
            sel.removeAllRanges();
            range.selectNodeContents(el);
            sel.addRange(range);
        }
        document.execCommand("Copy");
    }
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
                <h3 class="pull-left">View Booking</h3>
                <div class="select-wrapper pull-right">

                        <form action="" method="GET">
                                <select name="status" class="inline-select" id="select1">
                                    <option value="">Select Status</option>
                                    @foreach($status as $itemstatus)
                                    <option value="{{$itemstatus->statusid}}">{{$itemstatus->statusname}}</option>
                                    @endforeach
                                </select>
                                <select name="vehicle" class="inline-select" id="select2">
                                    <option value="">Select Vehicle</option>
                                    @foreach($vehicletype as $itemvehicletype)
                                    <option value="{{$itemvehicletype->id}}">{{$itemvehicletype->vehicletype}}</option>
                                    @endforeach
                                </select>
                            <input type="submit" name="find" class="filter-button" value="Filter" id=""> |
                            <a href="#" class="filter-button" onclick="selectElementContents( document.getElementById('example2') );">&nbsp;Copy to Clipboard</a> |&nbsp;
                            <a href="" style="float: right;"  class="filter-button" placeholder="Export Data">&nbsp;Export Data&nbsp;</a>
                            @csrf
                        </form>
                </div>
                <br> <hr>
                <?php

                $check = request()->get('find');
                if($check == NULL){
                   echo "No data search!";
                }else{
                    $statusid = request()->get('status');
                    $vehicleid = request()->get('vehicle');
                    $getbookingdata = DB::table('viewbookiing')->where('bookingstatus',$statusid)->where('classid',$vehicleid)
                    ->select('branch_name','bookingnumber','statusname','fullName','mobileNumber','classid','bookingstatus',
                    'washDate','washTime','email','txnNumber','postingDate','amount','paymentMode','vehicletype','servicesname','detailer')->get();

                ?>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th style="text-align: center;">#</th>
                                <th>Client</th>
                                <th>Vehicle Type</th>
                                <th>Services Type</th>
                                <th>Transaction Number</th>
                                <th>Amount (PHP)</th>
                                <th>Booking Number</th>
                                <th>Status</th>
                                <th>Branch</th>
                                <th>Detailer</th>
                        </thead>
                        <tbody>
                            <?php $x=1;?>
                            @foreach($getbookingdata as $itembooking)
                            <tr>
                                <td>{{$x++;}}</td>
                                <td>{{ $itembooking->fullName }}</td>
                                <td>{{ $itembooking->vehicletype }}</td>
                                <td>{{ $itembooking->servicesname }}</td>
                                <td>{{ $itembooking->txnNumber }}</td>
                                <td>{{ $itembooking->amount }}</td>
                                <td>{{ $itembooking->bookingnumber }}</td>
                                <td>{{ $itembooking->statusname }}</td>
                                <td>{{ $itembooking->branch_name }}</td>
                                <td>{{ $itembooking->detailer }}</td>
                            </tr>
                             @endforeach
                        </tbody>
                    </table>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>



@endsection
