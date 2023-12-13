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
                                <th>PN#</th>
                                <th>Booking Number</th>
                                <th>Client</th>
                                <th>Package Type</th>
                                <th>Branch</th>
                                <th>Preffered Date and Time</th>
                                <th>Booked Date</th>
                                <th>Transaction Number</th>
                                <th>Category</th>
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
                                <td>{{$value->branch_name }}</td>
                                <td>{{$value->washDate }} - {{$value->washTime}}</td>
                                <td>{{$value->created_at }}</td>
                                <td style="text-align: center;">
                                    @if($value->txnNumber == NULL)
                                        {{'Not available yet!'}}
                                    @else
                                        {{" TN#:".$value->txnNumber }}
                                    @endif
                                </td>
                                <td>{{$value->statusname}}</td>
                                <td><a href="{{route('viewbookingdetails',['bid' => $value->id])}}">View</a></td>
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
@endsection
