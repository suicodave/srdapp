<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>SRD | Admin Dashboard</title>

		<meta name="description" content="with draggable and editable events" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />


		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />


		<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css')}}" />
		<link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.min.css')}}" />


		<link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css')}}" />


		<link rel="stylesheet" href="{{ asset('assets/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />


		<link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css')}}" />
		<link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css')}}" />


		<script src="{{ asset('assets/js/ace-extra.min.js')}}"></script>
        <script src="{{ asset('assets/js/jquery-2.1.4.min.js')}}"></script>

	</head>

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

						<li class="green dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
								<span class="badge badge-success">5</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-envelope-o"></i>
									5 Messages
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Alex:</span>
														Ciao sociis natoque penatibus et auctor ...
													</span>
												</span>
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
						<a href="index.html">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
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
						</ul>
					</li>

                    <li class="">
						<a href="">
							<i class="menu-icon fa glyphicon-envelope"></i>
							<span class="menu-text"> Notifications </span>
						</a>
					</li>
				</ul><!-- /.nav-list -->

			</div>

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
                        <script>
                            @if($errors->has('error_msg'))
                                <div class="alert alert-block alert-success">{{ $errors->first('error_msg') }}</div>
                            @endif
                            @if($errors->has('save_msg'))
                            <div class="alert alert-block alert-success">{{ $errors->first('error_msg') }}</div>
                            @endif
                            @if($errors->has('updated_msg'))
                            <div class="alert alert-block alert-success">{{ $errors->first('error_msg') }}</div>
                            @endif
                            @if($errors->has('delete_msg'))
                            <div class="alert alert-block alert-success">{{ $errors->first('error_msg') }}</div>
                            @endif
                        </script>
                        @yield('content')

                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->
			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Copyright</span>
							&copy; SRD CAR SPA 2023
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->





		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='"{{ asset('assets/js/jquery.mobile.custom.min.js')}}'>"+"<"+"/script>");
		</script>
		<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>

		<!-- page specific plugin scripts -->
		<script src="{{ asset('assets/js/jquery-ui.custom.min.js')}}"></script>
		<script src="{{ asset('assets/js/jquery.ui.touch-punch.min.js')}}"></script>
		<script src="{{ asset('assets/js/moment.min.js')}}"></script>
		<script src="{{ asset('assets/js/fullcalendar.min.js')}}"></script>
		<script src="{{ asset('assets/js/bootbox.js')}}"></script>

		<!-- ace scripts -->
		<script src="{{ asset('assets/js/ace-elements.min.js')}}"></script>
		<script src="{{ asset('assets/js/ace.min.js')}}"></script>
        <script type="text/javascript">
            function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
            }
        </script>
		<!-- inline scripts related to this page -->
		<script style="text/javascritp">
            document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid'],
                events: $jsondata, // This URL will fetch events from the PHP backend
            });

            calendar.render();
        });

        </script>
	</body>
</html>
