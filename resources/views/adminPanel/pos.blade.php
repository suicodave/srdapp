
                @extends('adminPanel.adminpanel-layout')

                @section('content')
                <form action="{{route('postPayments')}}" method="POST">

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
                            <div class="col-md-12">
                                <div class="card-header">
                                    <input type="submit" class="btn btn-info btn-sm" name="req" value="Proceed">
                                    <?php
                                    use App\Models\PendingForPayment;
                                    $pending = PendingForPayment::select('statusid')->count();
                                    ?>
                                    @if($pending>0)
                                    <input type="submit" class="btn btn-danger btn-sm" name="req" value="Cancel">
                                    @endif
                                </div>
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-striped" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" onclick="toggle(this);"  class="form-control" /></th>
                                                <th>Transaction Number</th>
                                                <th>Booking Number</th>
                                                <th>Client</th>
                                                <th>Package Type</th>
                                                <th>Branch</th>
                                                <th>Preffered Date and Time</th>
                                                <th>Posting Date</th>
                                                <th>Status</th>
                                        </thead>
                                        <tbody>
                                        @foreach($clientsbooking as $itemcb)
                                         <tr>
                                            <td><input type="checkbox" name="salesid[]" value="{{$itemcb->salesid}}" class="form-control" id=""></td>
                                            <td>{{$itemcb->bookingnumber}}</td>
                                            <td>{{$itemcb->bookingnumber}}</td>
                                            <td>{{$itemcb->clients}}</td>
                                            <td>{{$itemcb->servicesname}} for {{$itemcb->vehicletype}}</td>
                                            <td>{{$itemcb->branch_name}}</td>
                                            <td>{{$itemcb->washDate}} {{$itemcb->washTime}}</td>
                                            <td>{{$itemcb->postingdate}}</td>
                                            <td>{{$itemcb->status}}</td>
                                         </tr>
                                         @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @csrf
                </form>
                @endsection

