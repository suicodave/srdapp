@extends('adminPanel.adminpanel-layout')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>
                <li class="active">Dashboard</li>
            </ul><!-- /.breadcrumb -->

            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Dashboard
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        {{Route::currentRouteName()}}
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->


                    <div class="row">
                        <div class="space-6"></div>

                        <div class="col-md-12 infobox-container">
                                <div class="widget-box">
                                    <h2 style="text-align: left;">
                                        &nbsp;&nbsp;<span class="fa fa-list"></span> Reports
                                    </h2>
                                    <div class="clearfix">
                                        <div class="grid4" style="background-color: #20A39E;">
                                            <h2 style="font-weight: bold;">Total Services</h2>
                                            <h2 class="bigger pull-right"><br><span>{{$numservices}}&nbsp;&nbsp;</span></h2>
                                        </div>
                                        <div class="grid4" style="background-color: #EF5B5B;">
                                            <h2 style="font-weight: bold;">Total Bookings</h2>
                                            <h2 class="bigger pull-right"><br><span>{{$numbooking}}&nbsp;&nbsp;</span></h2>
                                        </div>
                                        <div class="grid4" style="background-color: rgb(42, 156, 112);">
                                            <h2 style="font-weight: bold;">Total Employees</h2>
                                            <h2 class="bigger pull-right"><br><span>{{$numEmp}}&nbsp;&nbsp;</span></h2>
                                        </div>
                                        <div class="grid4" style="background-color: #FFD151;">
                                            <h2 style="font-weight: bold;">Total Users</h2>
                                            <h2 class="bigger pull-right"><br><span>{{$numUser}}&nbsp;&nbsp;</span></h2>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="clearfix pt-3">
                                        <div class="grid2">
                                            <h2 style="font-weight: bold;">Total Profit</h2>
                                            <h2 class="bigger pull-right">&#8369;&nbsp;<br><span>1,255</span></h2>
                                        </div>
                                        <div class="grid2">
                                            <h2 style="font-weight: bold;">Total Income</h2>
                                            <br>
                                                @foreach($TotalSales as $totsales)
                                                <h1 class="pull-right;">&#8369;&nbsp;{{number_format($totsales->total_sales,2)}}</h1>
                                                @endforeach

                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="vspace-12-sm"></div>
                        <div class="col-md-6">
                            <div class="widget-box">
                                <div class="widget-header widget-header-flat widget-header">
                                    <h3 class="widget-title">
                                        <i class="ace-icon fa fa-money"></i>
                                        Sales Report
                                    </h3>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div id="piechart-placeholder"></div>

                                        <div class="hr hr8 hr-double"></div>

                                        <div class="clearfix">

                                            <h1>Sales for Each Month for the {{date('Y')}}</h1>
                                            <div class="chart">
                                                <canvas id="salesChart" width="800" height="380"></canvas>
                                            </div>
                                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                                            <script>
                                                var salesData = {!! json_encode($salesByMonth) !!};

                                                var months = salesData.map(function(data) {
                                                // Mapping month numbers to month names
                                                var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                                return monthNames[data.month - 1];
                                                });

                                                var sales = salesData.map(function(data) {
                                                return data.total_sales;
                                                });

                                                var ctx = document.getElementById('salesChart').getContext('2d');
                                                var salesChart = new Chart(ctx, {
                                                type: 'bar',
                                                data: {
                                                    labels: months,
                                                    datasets: [{
                                                    label: 'Sales for Each Month',
                                                    data: sales,
                                                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                                    borderColor: 'rgba(54, 162, 235, 1)',
                                                    borderWidth: 1
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                    y: {
                                                        beginAtZero: true
                                                    }
                                                    }
                                                }
                                                });
                                            </script>
                                        </div>
                                    </div><!-- /.widget-main -->
                                </div><!-- /.widget-body -->
                            </div><!-- /.widget-box -->
                        </div><!-- /.col -->

                        <div class="col-md-6">
                            <div class="widget-box">
                                <div class="widget-header widget-header-flat widget-header">
                                    <h3 class="widget-title">
                                        <i class="ace-icon fa fa-calendar"></i>
                                        Schedule
                                    </h3>
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <div id="piechart-placeholder"></div>
                                                <div class="hr hr8 hr-double"></div>
                                                    <div class="clearfix">
                                                        <span>Note: The green color indicates booking dates for client/s exclusively within the current month.</span>
                                                        <div class="calendar">
                                                            <?php
                                                            use App\Models\Booking;
                                                            $getBookDates = Booking::select('washDate')->get();
                                                              // Assuming $dbDates is an array containing available dates fetched from the database
                                                            $dbDates = array();
                                                            foreach ($getBookDates as $key => $value) {
                                                                $dbDates[] = $value->washDate;
                                                            }

                                                            //dd($dbDates);

                                                              // Get current year and month
                                                              $currentYear = date("Y");
                                                              $currentMonth = date("n");

                                                              // Create a calendar for the current month
                                                              $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

                                                              echo "<div class='month'>$currentYear - " . date("F") . "</div>";
                                                              echo "<div class='days'>";
                                                              for ($i = 1; $i <= $daysInMonth; $i++) {
                                                                $date = "$currentYear-" . str_pad($currentMonth, 2, "0", STR_PAD_LEFT) . "-" . str_pad($i, 2, "0", STR_PAD_LEFT);
                                                                $isAvailable = in_array($date, $dbDates);
                                                                $class = $isAvailable ? "available" : "not-available";
                                                                echo "<div class='day $class'>$i</div>";
                                                              }
                                                              echo "</div>";
                                                            ?>
                                                          </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!-- /.row -->

                    <div class="hr hr32 hr-dotted"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
@endsection
