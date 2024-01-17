
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
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Priority#</th>
                                <th>Transaction Number</th>
                                <th>Booking Number</th>
                                <th>Client</th>
                                <th>Package Type</th>
                                <th>Branch</th>
                                <th>Preffered Date and Time</th>
                                <th>Number of Hours Left</th>
                                <th>Status</th>
                                <th>Action</th>
                        </thead>
                        <?PHP
                        use App\Models\BookingPriority;
                        ?>
                        @foreach($clientbookings as $key => $value)
                        <?php

                        $packagetype = $value->classid.' - '.$value->servicesid;

                        $dt = $value->washDate.' '.$value->washTime;
                        $currentDate = new DateTime(); // Current date and time

                        $bookedDateTime = new DateTime($dt);

                        // Calculate the time difference
                        $timeDifference = $currentDate->diff($bookedDateTime);

                        // Get the total days and hours left
                        $daysLeft = $timeDifference->days;
                        $hoursLeft = $timeDifference->h;


                        ?>
                            <tr>
                                <td style="text-align: center;">PN#:@if($value->prioritynumber== '') {{'N/A'}} @else{{$value->dateprocess}}{{$value->prioritynumber}} @endif</td>

                                <td style="text-align: center;">@if($value->txnNumber == NULL) {{'Pending'}} @else TN#:{{$value->txnNumber }} @endif </td>

                                <td>{{$value->bookingnumber }}</td>
                                <td>{{$value->fullName }}</td>
                                <td>{{$packagetype }}</td>
                                <td>{{$value->branch_name }}</td>
                                <td>{{$value->washDate }}  - {{$value->washTime}} </td>
                                <td>{{$daysLeft }} @if($daysLeft <= 1) {{'day'}} @else {{'days'}} @endif and {{$hoursLeft}} @if($hoursLeft <= 1) {{'hour'}} @else {{'hours'}} @endif</td>
                                <td>{{$value->statusname}}</td>

                                <td>
                    
                                    @if($value->statusname == 'New-Reserved' || $value->statusname == "Pending" && $daysLeft == 1)
                                    <button class="btn btn-xs btn-danger dpassingID" data-did="{{$value->id}}" onclick="openModal('exampleID')">Cancel this booking!</button>

                                    @elseif($value->statusname == 'Cancelled')
                                    Nothing follows!
                                    @else
                                        @if($value->txnNumber == NULL)
                                        {{'TN is required'}}
                                        @else
                                        <a href="{{route('viewclientbookingdetails',['cid' => $value->id])}}">View</a>
                                        @endif
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{route('cancelbooking')}}" method="POST">
    <div id="deleteModal" class="modald">
        <div class="modald-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Booking Cancellation</h4>
                <button type="button" class="closed" onclick="closeModal()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel this booking?
            </div>
            <div class="modal-footer">
                <input type="hidden" name="rowid" id="statid">
                <input type="submit" class="btn btn-danger btn-sm" value="Cancel">
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

@endsection
