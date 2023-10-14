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

									Classification
								</a>
							</li>

							<li class="">
								<a href="{{route('Services')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Services
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
						</ul>
					</li>

					<li class="">
						<a href="{{route('addEmployee')}}">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> Employee </span>
						</a>
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
		<script type="text/javascript">
			jQuery(function($) {

            /* initialize the external events
                -----------------------------------------------------------------*/

                $('#external-events div.external-event').each(function() {

                    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    };

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject);

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 999,
                        revert: true,      // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    });

                });




                /* initialize the calendar
                -----------------------------------------------------------------*/

                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();


                var calendar = $('#calendar').fullCalendar({
                    //isRTL: true,
                    //firstDay: 1,// >> change first day of week

                    buttonHtml: {
                        prev: '<i class="ace-icon fa fa-chevron-left"></i>',
                        next: '<i class="ace-icon fa fa-chevron-right"></i>'
                    },

                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    <?php
                    $getbooking = DB::table('booking')->where('bookingstatus','New')->where('txnNumber',NULL)
                                ->leftJoin('classification_services','classification_services.id','booking.classid')
                                ->leftJoin('srdservices','srdservices.sid','booking.servicesid')
                                ->select('booking.id','booking.bookingnumber','booking.fullName','classification_services.vehicletype as classid','booking.mobileNumber','srdservices.servicesname as servicesid','srdservices.price','booking.branchcode','booking.washDate','booking.washTime','booking.message','booking.bookingstatus','booking.created_at','booking.email')->get();

                    $dateString = "11-13-2023"; // Your date string in the format MM-DD-YYYY

                    // Convert the date string to a DateTime object
                    $endDate = DateTime::createFromFormat('m-d-Y', $dateString);

                    // Get the current date as a DateTime object
                    $currentDate = new DateTime();

                    // Calculate the difference in days
                    $interval = $currentDate->diff($endDate);
                    $daysDifference = $interval->days;

                    //dd($daysDifference);
                    ?>
                    @foreach ($getbooking as $key => $bookedvalue)

                    events: [
                            {
                                title: ['{{$bookedvalue->bookingnumber}}'],
                                start: new Date(y, m, $daysDifference),
                                className: 'label-important'
                            },
                    ]
                    ,
                    @endforeach
                    /**eventResize: function(event, delta, revertFunc) {

                        alert(event.title + " end is now " + event.end.format());

                        if (!confirm("is this okay?")) {
                            revertFunc();
                        }

                    },*/

                    editable: true,
                    droppable: true, // this allows things to be dropped onto the calendar !!!
                    drop: function(date) { // this function is called when something is dropped

                        // retrieve the dropped element's stored Event Object
                        var originalEventObject = $(this).data('eventObject');
                        var $extraEventClass = $(this).attr('data-class');


                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject);

                        // assign it the date that was reported
                        copiedEventObject.start = date;
                        copiedEventObject.allDay = false;
                        if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];

                        // render the event on the calendar
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                        // is the "remove after drop" checkbox checked?
                        if ($('#drop-remove').is(':checked')) {
                            // if so, remove the element from the "Draggable Events" list
                            $(this).remove();
                        }

                    }
                    ,
                    selectable: true,
                    selectHelper: true,
                    select: function(start, end, allDay) {

                        bootbox.prompt("New Event Title:", function(title) {
                            if (title !== null) {
                                calendar.fullCalendar('renderEvent',
                                    {
                                        title: title,
                                        start: start,
                                        end: end,
                                        allDay: allDay,
                                        className: 'label-info'
                                    },
                                    true // make the event "stick"
                                );
                            }
                        });


                        calendar.fullCalendar('unselect');
                    }
                    ,
                    eventClick: function(calEvent, jsEvent, view) {

                        //display a modal
                        var modal =
                        '<div class="modal fade">\
                        <div class="modal-dialog">\
                        <div class="modal-content">\
                            <div class="modal-body">\
                            <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
                            <form class="no-margin">\
                                <label>Change event name &nbsp;</label>\
                                <input class="middle" autocomplete="off" type="text" value="' + calEvent.title + '" />\
                                <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Save</button>\
                            </form>\
                            </div>\
                            <div class="modal-footer">\
                                <button type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i> Delete Event</button>\
                                <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
                            </div>\
                        </div>\
                        </div>\
                        </div>';


                        var modal = $(modal).appendTo('body');
                        modal.find('form').on('submit', function(ev){
                            ev.preventDefault();

                            calEvent.title = $(this).find("input[type=text]").val();
                            calendar.fullCalendar('updateEvent', calEvent);
                            modal.modal("hide");
                        });
                        modal.find('button[data-action=delete]').on('click', function() {
                            calendar.fullCalendar('removeEvents' , function(ev){
                                return (ev._id == calEvent._id);
                            })
                            modal.modal("hide");
                        });

                        modal.modal('show').on('hidden', function(){
                            modal.remove();
                        });


                    }

                });


            })
		</script>
	</body>
</html>
