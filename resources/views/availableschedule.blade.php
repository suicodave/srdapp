
@extends('calendarlayout')

@section('content')
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
@endsection

