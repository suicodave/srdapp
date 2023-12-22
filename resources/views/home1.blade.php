@extends('admin.apps')

@section('content')
<!--four-grids here-->
<div class="four-grids">
    <a href="all-bookings.php" target="_blank">
        <div class="col-md-3 four-grid">
            <div class="four-agileits">
                <div class="icon">
                        <i class="glyphicon glyphicon-cog" aria-hidden="true"></i>
                </div>
                <div class="four-text">
                    <h3>Services</h3>
                </div>
            </div>
        </div>
    </a>

    <a href="new-booking.php" target="_blank">
        <div class="col-md-3 four-grid">
            <div class="four-agileinfo">
                <div class="icon">
                    <i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
                </div>
                <div class="four-text">
                    <h3>Bookings</h3>
                </div>

            </div>
        </div>
    </a>

    <a href="completed-booking.php" target="_blank">
        <div class="col-md-3 four-grid">
            <div class="four-wthree">
                <div class="icon">
                <i class="glyphicon glyphicon-user" aria-hidden="true"></i>
                </div>
                <div class="four-text">
                    <h3>Employee</h3>
                </div>
            </div>
        </div>
    </a>

    <a href="manage-enquires.php" target="_blank">
        <div class="col-md-3 four-grid">
            <div class="four-agiledan">
                <div class="icon">
                    <i class="glyphicon glyphicon-calendar" aria-hidden="true"></i>
                </div>
                <div class="four-text">
                    <h3>Schedule</h3>
                </div>
            </div>
        </div>
    </a>
    <div class="clearfix"></div>
</div>

<div class="four-grids">
    <a href="managecar-washingpoints.php" target="_blank">
        <div class="col-md-3 four-grid">
            <div class="four-w3ls">
                <div class="icon">
                    <i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i>
                </div>
                <div class="four-text">
                    <h3>Reports</h3>
                </div>

            </div>
        </div>
    </a>
    <a href="managecar-washingpoints.php" target="_blank">
        <div class="col-md-3 four-grid">
            <div class="four-agilewarn">
                <div class="icon">
                    <i class="glyphicon glyphicon-lock" aria-hidden="true"></i>
                </div>
                <div class="four-text">
                    <h3>User</h3>
                </div>

            </div>
        </div>
    </a>
    <div class="clearfix"></div>
</div>

<div class="two-grids" style="border: 1px solid;">
    <div class="row" style="border: 1px solid;">
            <div style="float:left; width: 800px; margin: 0 auto;">
                <!-- Create a canvas element for the chart -->
                <canvas id="salesChart"></canvas>
            </div>
            <div>
            a
            </div>

    </div>
</div>
<div class="clearfix"></div>
<!--//four-grids here-->


@endsection
