
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
                                <th style="text-align: center;">#</th>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>Status</th>
                                <th>Position</th>
                                <th>Salary</th>
                                <th>Branch</th>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
