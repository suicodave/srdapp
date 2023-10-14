@extends('adminPanel.adminpanel-layout')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped" style="font-size: 14px;">
                <thead>
                    <tr>
                        <th>PN#</th>
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
                        <td style="text-align: center;">{{$x++;}}</td>
                        <td>{{$value->bookingnumber }}</td>
                        <td>{{$value->fullName }}</td>
                        <td>{{$packagetype }}</td>
                        <td>{{$value->branchcode }}</td>
                        <td>{{$value->washDate }} - {{$value->washTime}}</td>
                        <td>{{$value->created_at }}</td>
                        <td><a href="{{route('viewbookingdetails',['bid' => $value->id])}}">View</a></td>
                    </tr>
                @endforeach
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
