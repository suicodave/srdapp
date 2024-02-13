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
    <div class="container">
        <div class="section-header text-left">
            <h2>Choose Your Plan</h2>
            <span class="small">Please select the services you want to book from the options below.</span>
        </div>
        <div class="row">
            <?php
            use App\Models\Classification;
            use App\Models\Services;
            $getclassifications = Classification::where('status',1)->select('id','vehicletype')->get();
            ?>
            @foreach($getclassifications as $itemclass)

            <div class="col-md-4">
                <div class="price-item">
                    <div class="price-header">
                        <h3 style="text-align: left">{{$itemclass->vehicletype}}</h3>
                    </div>
                        <?php

                        $getservices = Services::where('classification',$itemclass->id)->where('status','Available')->select('sid','servicesname','price')->get();
                        ?>
                        @foreach($getservices as $itemservice)
                        <div class="price-body">
                            <div class="pl-3" style="text-align:left;">
                                <i class="far fa-check-circle"></i>&nbsp;
                                <a  data-toggle="modal" data-id="{{ $itemclass->id }}" data-sid="{{$itemservice->sid}}"  class="text-danger custom-cursor" id="passingID" data-toggle="modal" data-target="#MyModal">{{$itemservice->servicesname}} - {{$itemservice->price}}</a>
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>
            @endforeach

        </div>
    </div>

</div>
<form action="{{route('bookednow')}}" method="POST">
    <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
        <div class="modal-dialog modal-dialog-centered" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="my_modalLabel">Book Now! <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4> 
                </div>
                <div class="modal-body">
                    <div class="container" >
                        <div class="row justify-content-md-center" >
                                <div class="form-group pl-4 pr-4 pb-4">
                                    <label class="col-form-label" for="fullname">Fullname&nbsp;<small style="color: red;font-weight:bold;">*</small></label>
                                    <input type="text" class="form-control" name="fullname" style="width: 450px;" required autocomplete="fullanme">
                                    {{ $errors->first('fullname') }}

                                </div>
                                <div class="form-group pl-4 pr-4 pb-4">
                                    <label class="col-form-label" for="mobilenumber">Mobile Number&nbsp;<small style="color: red;font-weight:bold;">*</small></label>
                                    <input type="text" class="form-control" name="mobilenumber" pattern="[0-9]{11}"  title="11 numeric characters only" style="width: 150px;" required autocomplete="mobilenumber">
                                    {{ $errors->first('mobilenumber') }}
                                </div>

                                <div class="form-group pl-4 pr-4 pb-4">
                                    <label class="col-form-label" for="pdate">Preferred Date&nbsp;<small style="color: red;font-weight:bold;">*</small></label>
                                    <input type="date" id="bookingDate" name="pdate"  class="form-control booking-date-picker" style="width: 150px;" required autocomplete="pdate">
                                    {{ $errors->first('pdate') }}
                                </div>
                                <div class="form-group pl-4 pr-4 pb-4">
                                    <label class="col-form-label" for="ptime">Preferred Time&nbsp;<small style="color: red;font-weight:bold;">*</small></label>
                                    <input type="time" class="form-control" name="ptime" style="width: 150px;" required autocomplete="ptime">
                                    {{ $errors->first('ptime') }}
                                </div>

                                <div class="form-group pl-4 pr-4 pb-4">
                                    <label class="col-form-label" for="numvehicle">Number of Vehicle&nbsp;<small style="color: red;font-weight:bold;">*</small></label>
                                    <input type="number"  class="form-control" name="numvehicle" style="width: 350px;" required autocomplete="off">
                                    {{ $errors->first('email') }}
                                </div>
                                <div class="form-group pl-4 pr-4 pb-4">
                                    <label class="col-form-label" for="ptime">Email ID&nbsp;<small style="color: red;font-weight:bold;">*</small></label>
                                    <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" class="form-control" name="email" style="width: 350px;" required autocomplete="email">
                                    {{ $errors->first('email') }}
                                </div>
                                <?php 
                                use App\Models\SRDBranch;
                                $branches = SRDBranch::where('status','Available')->select('id','branch_name')->get();
                                ?>
                                <div class="form-group pl-4 pr-4 pb-4">
                                    <label class="col-form-label" for="numvehicle">Nearest Branch&nbsp;<small style="color: red;font-weight:bold;">*</small></label>
                                    <select name="branchcode" class="form-control" style="width: 350px;" required autocomplete="off">
                                        <option value="">Select Branch</option>
                                        @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                        @endforeach
                                    </select>
                                    {{ $errors->first('email') }}
                                </div>
                                <div class="form-group pl-4 pr-4 pb-4">
                                    <label class="col-form-label" for="message">Message&nbsp;(optional)</label>
                                    <textarea name="message" required autocomplete="false" style="width: 550px;" class="form-control" cols="50" rows="2"></textarea>
                                    {{ $errors->first('message') }}
                                </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="rid" id="cid">
                    <input type="hidden" name="sid" id="csid">
                    <input type="submit" class="btn btn-danger btn-sm" value="Book Now">
                </div>

            </div>
        </div>
    </div>
    @csrf
</form>
    <script type="text/javascript">
    $(document).on("click", "#passingID", function() {
        var c_id = $(this).attr('data-id');
        var c_sid = $(this).attr('data-sid');
        $("#cid").val(c_id);
        $("#csid").val(c_sid);
        $('#myModal').modal('show');
    });
    </script>
    <!--end update-->
@endsection