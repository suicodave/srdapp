<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>SRD CAR SPA System</title>

    <meta name="description" content="Static &amp; Dynamic Tables" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}} " />
    <link rel="stylesheet" href="{{asset('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />


    <link rel="stylesheet" href="{{asset('assets/css/fonts.googleapis.com.css')}}" />

    <!-- ace styles -->
    <link rel="stylesheet" href="{{asset('assets/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />


    <link rel="stylesheet" href="{{asset('assets/css/ace-skins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/ace-rtl.min.css')}}" />




    <script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/ace-extra.min.js')}}"></script>


</head>
<style>

.grid4 {
  background-color: #f3f3f3; /* Light gray background */
  padding: 20px;
  text-align: center;
  border: 1px solid #ddd; /* Light border */
  border-radius: 10px; /* Rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow effect */
  position: relative; /* Required for pseudo-element */
}

/* Glossy effect using pseudo-element */
.grid4::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 50%;
  background: linear-gradient(to bottom, rgba(255, 255, 255, 0.4), transparent); /* Gradient overlay */
  border-radius: 10px 10px 0 0; /* Matching top border-radius */
  pointer-events: none; /* Allow clicks to pass through */
}

body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 20px;
}

h1 {
  text-align: center;
}

.calendar {
  max-width: 800px;
  margin: 20px auto;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
}

.month {
  text-align: center;
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.days {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 5px;
}

.day {
  text-align: center;
  padding: 5px;
  border: 1px solid #eee;
}

.available {
  background-color: #4CAF50;
  color: #fff;
}

.not-available {
  background-color: #ddd;
  color: #777;
}
.chart {
  max-width: 800px;
  margin: 20px auto;
}
/* This styles the flash message div */
.flash-message {
    display: none;
    position: fixed;
    top: 20%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 15px; /* Change this to your desired background color */
    color: rgb(13, 13, 13); /* Change this to your desired text color */
    border-rgb(13, 6, 6)s: 5px;
    animation: flash 1s ease-in-out; /* Adjust the duration as needed */
}

/* Keyframes for the flashing animation */
@keyframes flash {
    0%, 100% { opacity: 1; }
    50% { opacity: 0; }
}


/* Modal Styles */
.modald {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
}

.modald-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
}

.closed {
  float: right;
  cursor: pointer;
}
</style>
<body class="no-skin">
    <div id="navbar" class="navbar navbar-default          ace-save-state">
        <div class="navbar-container ace-save-state" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
            </button>

            <div class="navbar-header pull-left">
                <a href="index.html" class="navbar-brand">
                    <small>
                        <i class="fa fa-leaf"></i>
                        SRD Admin
                    </small>
                </a>
            </div>

            <div class="navbar-buttons navbar-header pull-right" role="navigation">
                <ul class="nav ace-nav">
                    <?php
                    use App\Models\Booking;
                    $bookingall = Booking::select('id')->get()->count();
                    $bookingnb = Booking::where('bookingstatus','New')->select('id')->get()->count();
                    ?>
                    <li class="purple dropdown-modal">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                            <span class="badge badge-important">{{$bookingall}}</span>
                        </a>

                        <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-exclamation-triangle"></i>
                                {{$bookingnb}} Notifications
                            </li>

                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar navbar-pink">
                                    <li>
                                        <a href="{{route('showbooking')}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
                                                    New Booking
                                                </span>
                                                <span class="pull-right badge badge-info">{{$bookingnb}}</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="light-blue dropdown-modal">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <img class="nav-user-photo" src="assets/images/avatars/user.jpg" alt="Jason's Photo" />
                            <span class="user-info">
                                <small>Welcome,</small>
                                {{Auth::user()->name}}
                            </span>

                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            @guest
                                @if (Route::has('login'))
                                <li><a href="#"><i class="ace-icon fa fa-cog"></i>{{ __('Login') }}</a></li>
                                @endif

                                @if (Route::has('register'))
                                <li><a href="#"><i class="ace-icon fa fa-cog"></i>{{ __('Register') }}</a></li>
                                @endif
                            @else
                            <li><a href="#"><i class="ace-icon fa fa-cog"></i>{{ __('Settings') }}</a></li>
                            <li class="divider"></li>

                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ace-icon fa fa-power-off"></i>{{ __('Logout') }}</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                <input type="userid" name="user_id" value="{{Auth::user()->id}}">
                                @csrf
                            </form>
                            @endguest
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.navbar-container -->
    </div>

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try{ace.settings.loadState('main-container')}catch(e){}
        </script>

        <div id="sidebar" class="sidebar responsive ace-save-state">
            <script type="text/javascript">
                try{ace.settings.loadState('sidebar')}catch(e){}
            </script>



            <ul class="nav nav-list">
            <li class="">
                <a href="{{route('home')}}">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard</span>
                </a>

                <b class="arrow"></b>
            </li>
            @if(Auth::user()->saStatus == 1)
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-desktop"></i>
                    <span class="menu-text">
                        Settings
                    </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="">
                        <a href="{{route('getStatus')}}">
                            <i class="menu-icon fa fa-caret-right"></i>

                            Status
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('getbranches')}}">
                            <i class="menu-icon fa fa-caret-right"></i>

                            Branches
                        </a>
                    </li>

                    <li class="">
                        <a href="{{route('getdesignation')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Designation
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('getSalaries')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Salary Grade
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('addEmployee')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Employee
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('addUserAccounts')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            User Account
                        </a>
                    </li>
                </ul>
            </li>

            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-desktop"></i>
                    <span class="menu-text">
                        Services
                    </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="">
                        <a href="{{route('Classification')}}">
                            <i class="menu-icon fa fa-caret-right"></i>

                            Type of Vehicle
                        </a>
                    </li>

                    <li class="">
                        <a href="{{route('Services')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Type of Services
                        </a>
                    </li>
                </ul>
            </li>

            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> Booking </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="">
                        <a href="{{route('scheduling')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Scheduling
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="{{route('showbooking')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Booking
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="{{route('showclientbooking')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Client Booking
                        </a>

                        <b class="arrow"></b>
                    </li>

                </ul>
            </li>
            <li class="">
                <a href="{{route('createPayment')}}">
                    <i class="menu-icon fa glyphicon-envelope"></i>
                    <span class="menu-text"> Sales </span>
                </a>
            </li>
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-users"></i>
                    <span class="menu-text"> Report </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="">
                        <a href="{{route('view-user-account')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            View User Account
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="{{route('view-booking')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            View Booking
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="">
                            <i class="menu-icon fa fa-caret-right"></i>
                            View Schedule
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="">
                            <i class="menu-icon fa fa-caret-right"></i>
                            View Sales
                        </a>
                        <b class="arrow"></b>
                    </li>

                </ul>
            </li>

            <li class="">
                <a href="">
                    <i class="menu-icon fa glyphicon-envelope"></i>
                    <span class="menu-text"> Notifications </span>
                </a>
            </li>
            @elseif(Auth::user()->saStatus == 2)

            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-book"></i>
                    <span class="menu-text"> Booking </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="">
                        <a href="">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Scheduling
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="{{route('showbooking')}}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Booking
                        </a>

                        <b class="arrow"></b>
                    </li>

                </ul>
            </li>
            <?php
            $pending = DB::table('srdsales')->where('status','Pending for Payment')->select('salesid')->count();
            ?>
            <li class="">
                <a href="{{route('createPayment')}}">
                    <i class="menu-icon fa glyphicon-envelope"></i>
                    <span class="menu-text"> For Payment ({{$pending}})  </span>
                </a>
            </li>
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> Report </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">

                    <li class="">
                        <a href="">
                            <i class="menu-icon fa fa-caret-right"></i>
                            View Booking
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="">
                            <i class="menu-icon fa fa-caret-right"></i>
                            View Schedule
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="">
                            <i class="menu-icon fa fa-caret-right"></i>
                            View Sales
                        </a>
                        <b class="arrow"></b>
                    </li>

                </ul>
            </li>
            @else
            <li class="">
                <a href="{{route('showclientbooking')}}">
                    <i class="menu-icon fa fa-book"></i>
                    Client Booking
                </a>

                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> Report </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">

                    <li class="">
                        <a href="">
                            <i class="menu-icon fa fa-caret-right"></i>
                            View Booking
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="">
                            <i class="menu-icon fa fa-caret-right"></i>
                            View Schedule
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="">
                            <i class="menu-icon fa fa-caret-right"></i>
                            View Sales
                        </a>
                        <b class="arrow"></b>
                    </li>

                </ul>
            </li>
            @endif
            </ul><!-- /.nav-list -->


        </div>

        <div class="main-content"><!-- /main content here -->

            @yield('content')
            @if($errors->any())
            @error('error_msg')
            <div class="flash-message alert alert-warning">{{ $message }}</div>
            @enderror

            @error('save_msg')
            <div class="flash-message alert alert-success">{{ $message }}</div>
            @enderror

            @error('updated_msg')
            <div class="flash-message alert alert-info">{{ $message }}</div>
            @enderror

            @error('delete_msg')
            <div class="flash-message alert alert-danger">{{ $message }}</div>
            @enderror
        @endif
        </div><!-- /.main-content -->

        <div class="footer">
            <div class="footer-inner">
                <div class="footer-content">
                    <span class="bigger-120">
                        <span class="blue bolder">SRD</span>
                        CAR SPA &copy; 2023
                    </span>

                    &nbsp; &nbsp;
                    <span class="action-buttons">
                        <a href="#">
                            <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                        </a>

                        <a href="#">
                            <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                        </a>

                        <a href="#">
                            <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->



    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

    <!-- page specific plugin scripts -->

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
    <script>
        $(function() {
          $("#example2").DataTable({
            "responsive": true,
            "autoWidth": false,
          });
          $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
      </script>
<script>
    // JavaScript to show the flash message div
window.onload = function() {
    var flashMessage = document.querySelector('.flash-message');
    if (flashMessage) {
        flashMessage.style.display = 'block';
        setTimeout(function() {
            flashMessage.style.display = 'none';
        }, 3000); // Adjust the duration to control how long the message displays
    }
}

</script>
    <!-- ace scripts -->
    <script src="{{asset('assets/js/ace-elements.min.js')}}"></script>
    <script src="{{asset('assets/js/ace.min.js')}}"></script>

    <!-- inline scripts related to this page -->

</body>
</html>
