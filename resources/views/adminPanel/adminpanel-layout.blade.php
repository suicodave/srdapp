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

    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>

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

                            Type of Services
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

            @yield('content')
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

    <script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.select.min.js')}}"></script>

    <!-- ace scripts -->
    <script src="{{asset('assets/js/ace-elements.min.js')}}"></script>
    <script src="{{asset('assets/js/ace.min.js')}}"></script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($) {
            var myTable =
            $('#dynamic-table')
            .DataTable( {
                bAutoWidth: false,
                "aoColumns": [
                    { "bSortable": false },
                    null, null,null, null, null,
                    { "bSortable": false }
                ],
                "aaSorting": [],
                select: {
                    style: 'multi'
                }
            } );
            $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

            new $.fn.dataTable.Buttons( myTable, {
                buttons: [
                    {
                    "extend": "colvis",
                    "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                    "className": "btn btn-white btn-primary btn-bold",
                    columns: ':not(:first):not(:last)'
                    },
                    {
                    "extend": "copy",
                    "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                    "extend": "csv",
                    "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                    "extend": "excel",
                    "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                    "extend": "pdf",
                    "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                    "extend": "print",
                    "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                    "className": "btn btn-white btn-primary btn-bold",
                    autoPrint: false,
                    message: 'This print was produced using the Print button for DataTables'
                    }
                ]
            } );
            myTable.buttons().container().appendTo( $('.tableTools-container') );

            var defaultCopyAction = myTable.button(1).action();
            myTable.button(1).action(function (e, dt, button, config) {
                defaultCopyAction(e, dt, button, config);
                $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
            });


            var defaultColvisAction = myTable.button(0).action();
            myTable.button(0).action(function (e, dt, button, config) {

                defaultColvisAction(e, dt, button, config);


                if($('.dt-button-collection > .dropdown-menu').length == 0) {
                    $('.dt-button-collection')
                    .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                    .find('a').attr('href', '#').wrap("<li />")
                }
                $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
            });
            setTimeout(function() {
                $($('.tableTools-container')).find('a.dt-button').each(function() {
                    var div = $(this).find(' > div').first();
                    if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
                    else $(this).tooltip({container: 'body', title: $(this).text()});
                });
            }, 500);

            myTable.on( 'select', function ( e, dt, type, index ) {
                if ( type === 'row' ) {
                    $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
                }
            } );
            myTable.on( 'deselect', function ( e, dt, type, index ) {
                if ( type === 'row' ) {
                    $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
                }
            } );

            $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

            $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
                var th_checked = this.checked;//checkbox inside "TH" table header

                $('#dynamic-table').find('tbody > tr').each(function(){
                    var row = this;
                    if(th_checked) myTable.row(row).select();
                    else  myTable.row(row).deselect();
                });
            });

            //select/deselect a row when the checkbox is checked/unchecked
            $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
                var row = $(this).closest('tr').get(0);
                if(this.checked) myTable.row(row).deselect();
                else myTable.row(row).select();
            });

            $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();
            });
            var active_class = 'active';
            $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
                var th_checked = this.checked;//checkbox inside "TH" table header

                $(this).closest('table').find('tbody > tr').each(function(){
                    var row = this;
                    if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                    else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
                });
            });

            $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
                var $row = $(this).closest('tr');
                if($row.is('.detail-row ')) return;
                if(this.checked) $row.addClass(active_class);
                else $row.removeClass(active_class);
            });

            $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

            //tooltip placement on right or left
            function tooltip_placement(context, source) {
                var $source = $(source);
                var $parent = $source.closest('table')
                var off1 = $parent.offset();
                var w1 = $parent.width();

                var off2 = $source.offset();
                //var w2 = $source.width();

                if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                return 'left';
            }
            /***************/
            $('.show-details-btn').on('click', function(e) {
                e.preventDefault();
                $(this).closest('tr').next().toggleClass('open');
                $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
            });

        })
    </script>
</body>
</html>
