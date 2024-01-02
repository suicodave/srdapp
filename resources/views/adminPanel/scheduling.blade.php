@extends('adminPanel.adminpanel-layout')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }
    h1 {
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    td {
        height: 100px;
        vertical-align: top;
    }
    strong {
        color: #333;
    }
</style>
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
    <div class="page-header pull-left">
        <h1>
            Full Calendar
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-sm-12">
                    <h1 style="text-align: left;">Task Scheduler for <?php echo date('F Y'); ?></h1>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sunday</th>
                                <th>Monday</th>
                                <th>Tuesday</th>
                                <th>Wednesday</th>
                                <th>Thursday</th>
                                <th>Friday</th>
                                <th>Saturday</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $currentYear = date("Y");
                            $currentMonth = date("m");
                            $currentDayOfMonth = date('j');
                            $firstDayOfMonth = date('N', strtotime("$currentYear-$currentMonth-01"));
                            $numDays = date('t', strtotime("$currentYear-$currentMonth-01"));
                            $day = 1;
                            $calendar = array();

                            // Fill the calendar array with event data
                            for ($i = 1; $i <= 6; $i++) {
                                for ($j = 0; $j < 7; $j++) {
                                    if (($i == 1 && $j < $firstDayOfMonth) || $day > $numDays) {
                                        $calendar[$i][$j] = '';
                                    } else {
                                        $calendar[$i][$j] = $day;
                                        $day++;
                                    }
                                }
                            }

                            // Display the calendar
                            foreach ($calendar as $week) {
                                echo '<tr>';
                                foreach ($week as $day) {
                                    if ($day !== '') {
                                        echo '<td><strong>' . $day . '</strong><br>';

                                        // Display events for the current day
                                        foreach ($events as $event) {
                                            $yearsched = date('Y', strtotime($event->washDate));
                                            $daysched = date('j', strtotime($event->washDate));
                                            if ($day ==  $daysched && $currentYear == $yearsched) {
                                                $twelveHourTime = date("g:i A", strtotime($event->washTime));
                                            ?>
                                                {{$event->classid}} - {{$event->servicesid}} at {{$twelveHourTime}}
                                            <?php
                                            echo '<br>';
                                            }
                                        }

                                        echo '</td>';
                                    } else {
                                        echo '<td></td>';
                                    }
                                }
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
