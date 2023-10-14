<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>SRD | Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="{{ asset('admin/css/bootstrap.min.css') }}" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="{{ asset('admin/css/style.css')}}" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="{{ asset('admin/css/morris.css')}}" type="text/css"/>
<!-- Graph CSS -->
<link href="{{ asset('admin/css/font-awesome.css')}}" rel="stylesheet">
<!-- jQuery -->
<script src="{{ asset('admin/js/jquery-2.1.4.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="{{ asset('admin/css/icon-font.min.css')}}" type='text/css' />
<!-- //lined-icons -->
 <!-- Theme style -->
 <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css')}}">

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>



</head>
<body>
<div class="page-container">
<!--/content-inner-->

<div class="left-content">
    <div class="mother-grid-inner">
<!--header start here-->
<script>
    @if($errors->has('error_msg'))
        let errorMessage = "{{ $errors->first('error_msg') }}";
        alert(errorMessage); // You can replace this with your preferred popup method (e.g., a modal).
    @endif
    @if($errors->has('save_msg'))
        let errorMessage = "{{ $errors->first('save_msg') }}";
        alert(errorMessage); // You can replace this with your preferred popup method (e.g., a modal).
    @endif
    @if($errors->has('updated_msg'))
        let errorMessage = "{{ $errors->first('updated_msg') }}";
        alert(errorMessage); // You can replace this with your preferred popup method (e.g., a modal).
    @endif
    @if($errors->has('delete_msg'))
        let errorMessage = "{{ $errors->first('delete_msg') }}";
        alert(errorMessage); // You can replace this with your preferred popup method (e.g., a modal).
    @endif
</script>



<!--header end here-->
    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a> <i class="fa fa-angle-right"></i></li>
            <li class="breadcrumb-item active" style="text-transform: capitalize;color:#2471A3;">{{Route::currentRouteName()}}</li>
    </ol>




<div class="inner-block">
<!--/sidebar-menu-->
<div class="sidebar-menu">
    <header class="logo1"><a href="#" class="sidebar-icon" > <span class="fa fa-bars"></span></a></header>
        <div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
            <div class="menu">
                    <ul id="menu" >
                        <li><a href="dashboard.php"><i class="fa fa-tachometer"></i> <span>{{ __('Dashboard') }}</span><div class="clearfix"></div></a></li>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                {{ __('Welcome') }}<br> {{Auth::user()->name}}
                            </div>
                        <li id="menu-academico" ><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Services</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                                <ul id="menu-academico-sub" >
                                <li id="menu-academico-avaliacoes" ><a href="{{route('Classification')}}">Add Classification</a></li>
                                <li id="menu-academico-avaliacoes" ><a href="{{route('Services')}}">Add Services</a></li>
                                </ul>
                        </li>

                        <li><a href="{{route('showbooking')}}"><i class="fa fa-user" aria-hidden="true"></i>  <span>Booking</span><div class="clearfix"></div></a></li>


                        <li id="menu-academico" ><a href="#"><i class="fa fa-files-o" aria-hidden="true"></i><span>Employee</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                                <ul id="menu-academico-sub" >
                                    <li id="menu-academico-avaliacoes" ><a href="{{route('addEmployee')}}">Add Employee</a></li>
                                    <li id="menu-academico-avaliacoes" ><a href="">Add Users</a></li>
                                </ul>
                        </li>
                        <li><a href="manage-enquires.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>  <span>Notifications</span><div class="clearfix"></div></a></li>

                        @guest
                            @if (Route::has('login'))
                                <li><a href="{{ route('login') }}"><i class="fa fa-user" aria-hidden="true"></i>  <span>{{ __('Login') }}</span><div class="clearfix"></div></a></li>
                            @endif

                            @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}"><i class="fa fa-user" aria-hidden="true"></i>  <span>{{ __('Register') }}</span><div class="clearfix"></div></a></li>
                            @endif
                        @else
                        <li id="menu-academico" ><a href="#"><i class="fa fa-user" aria-hidden="true"></i><span>Settings</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                            <ul id="menu-academico-sub" >
                            <li id="menu-academico-avaliacoes" ><a href="about.php">Change Password</a></li>
                            <li id="menu-academico-avaliacoes">
                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                 Logout
                             </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            <input type="userid" name="user_id" value="{{Auth::user()->id}}">
                                @csrf
                            </form>
                            </li>

                            </ul>
                        </li>
                        @endguest
                    </ul>
            </div>
    </div>

<!--end sidebar-->
</div>
<!--inner block end here-->
@yield('content')
<!--copy rights start here-->


</div>



<div class="copyrights">
    <p>© <?php echo date('Y');?> SRD. All Rights Reserved |  <a href="#">SRD</a> </p>
</div>
</div>


                        <div class="clearfix"></div>
                        </div>
                        <script>
                        var toggle = true;

                        $(".sidebar-icon").click(function() {
                            if (toggle)
                            {
                            $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                            $("#menu span").css({"position":"absolute"});
                            }
                            else
                            {
                            $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
                            setTimeout(function() {
                                $("#menu span").css({"position":"relative"});
                            }, 400);
                            }

                                        toggle = !toggle;
                                    });
                        </script>
<!--js -->
<script src="{{ asset('admin/js/jquery.nicescroll.js')}}"></script>
<script src="{{ asset('admin/js/scripts.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('admin/js/bootstrap.min.js')}}"></script>
<!-- /Bootstrap Core JavaScript -->

<!-- Bootstrap -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- AdminLTE -->
<script src="{{asset('admin/dist/js/adminlte.js')}}"></script>

<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- page script -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard-polyfill/2.8.6/clipboard-polyfill.js"></script>
  <script src="http://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
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
$(document).ready(function() {
    //BOX BUTTON SHOW AND CLOSE
    jQuery('.small-graph-box').hover(function() {
        jQuery(this).find('.box-button').fadeIn('fast');
    }, function() {
        jQuery(this).find('.box-button').fadeOut('fast');
    });
    jQuery('.small-graph-box .box-close').click(function() {
        jQuery(this).closest('.small-graph-box').fadeOut(200);
        return false;
    });

    //CHARTS
    function gd(year, day, month) {
        return new Date(year, month - 1, day).getTime();
    }

    graphArea2 = Morris.Area({
        element: 'hero-area',
        padding: 10,
    behaveLikeLine: true,
    gridEnabled: false,
    gridLineColor: '#dddddd',
    axes: true,
    resize: true,
    smooth:true,
    pointSize: 0,
    lineWidth: 0,
    fillOpacity:0.85,
        data: [
            {period: '2014 Q1', iphone: 2668, ipad: null, itouch: 2649},
            {period: '2014 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
            {period: '2014 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
            {period: '2014 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
            {period: '2015 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
            {period: '2015 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
            {period: '2015 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
            {period: '2015 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
            {period: '2016 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
            {period: '2016 Q2', iphone: 8442, ipad: 5723, itouch: 1801}
        ],
        lineColors:['#ff4a43','#a2d200','#22beef'],
        xkey: 'period',
        redraw: true,
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });


});
</script>
<script>
    // Sample data (replace with your actual data)
    const months = ["January", "February", "March"];
    const serviceAData = [5000, 6000, 7500];
    const serviceBData = [3000, 4500, 5500];
    const serviceCData = [2000, 3500, 4800];

    // Create a chart using Chart.js
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Service A',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    data: serviceAData,
                },
                {
                    label: 'Service B',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    data: serviceBData,
                },
                {
                    label: 'Service C',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1,
                    data: serviceCData,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>
</body>
</html>
