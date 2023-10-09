<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SRD Car SPA | Home Page</title>


        <!-- Favicon -->
        <link href="{{ asset('img/favicon.ico')}}" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="{{ asset('lib/flaticon/font/flaticon.css')}}" rel="stylesheet">
        <link href="{{ asset('lib/animate/animate.min.css')}}" rel="stylesheet">
        <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    </head>

    <body>
        <!-- Top Bar Start -->
        <div class="top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="logo">
                            <a href="{{route('index')}}">
                                <h1>SRD CAR <span>SPA</span></h1>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 d-none d-lg-block">
                        <div class="row">
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Opening Hour</h3>
                                        <p>7:00 AM to 9:00 PM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="fa fa-phone-alt"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Call Us</h3>
                                        <p>+63-956-789-2456</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Email Us</h3>
                                        <p>info@srd.com.ph</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        <div class="nav-bar">
            <div class="container">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                    <a href="#" class="navbar-brand">MENU</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="{{route('index')}}" class="nav-item nav-link active">Home</a>
                            <a href="{{route('about')}}" class="nav-item nav-link">About</a>
                            <a href="{{route('services')}}" class="nav-item nav-link">Washing Plans</a>
                        </div>
                        <div class="ml-auto">
                            <a class="btn btn-custom" href="contact.php">Get Appointment</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Nav Bar End -->
        @yield('content')

        <!-- Price Start -->
<div class="price">
    <div class="container">
        <div class="section-header text-center">
            <p>Washing Plan</p>
            <h2>Choose Your Plan</h2>
        </div>
        <div class="row">
            <?php
            use App\Models\Classification;
            use App\Models\Services;
            $getclassifications = Classification::where('status',1)->select('id','vehicletype')->get();
            ?>
            @foreach($getclassifications as $itemclass)
            <div class="col-md-4">
                <div class="price-item">
                    <div class="price-header">
                        <h3>{{$itemclass->vehicletype}}</h3>
                    </div>
                    <?php

                    $getservices = Services::where('classification',$itemclass->id)->where('status','Available')->select('sid','servicesname','price')->get();
                    ?>
                    @foreach($getservices as $itemservice)
                    <div class="price-body center">
                        <ul>
                            <li><i class="far fa-check-circle"></i>{{$itemservice->servicesname}} - {{$itemservice->price}}</li>
                        </ul>
                    </div>
                    @endforeach
                    <div class="price-footer">
                        <a href="" data-toggle="modal" data-id="{{$itemclass->id}}"  class="btn btn-custom passingID" data-toggle="modal" data-target="#myModal">Book Now</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Price End -->

        <!-- Footer Start -->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="footer-contact">
                            <h2>Get In Touch</h2>


                            <p><i class="fa fa-map-marker-alt">&nbsp;&nbsp;Address</i></p>
                            <p><i class="fa fa-phone-alt">&nbsp;&nbsp;Phone</i></p>
                            <p><i class="fa fa-envelope">&nbsp;&nbsp;Email</i></p>


                            <div class="footer-social">
                                <a class="btn" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn" href=""><i class="fab fa-youtube"></i></a>
                                <a class="btn" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container copyright">
                <p>Copyright 2023 @ SRD CAR SPA</p>
            </div>
        </div>
        <!-- Footer End -->        <!-- Back to top button -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- Pre Loader -->
        <div id="loader" class="show">
            <div class="loader"></div>
        </div>


<!--Model-->
<form method="post">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Car Wash Booking</h4>
                </div>
            <div class="modal-body">
                <p>
                <select name="packagetype" required class="form-control">
                    <option value="">Package Type</option>
                    <?php
                    $getservices = Services::where('status','Available')->select('sid','servicesname','price')->get();
                    ?>
                    @foreach($getservices as $itemservice)
                        <option value="$itemclass->sid">{{$itemservice->servicesname }} - {{$itemservice->price}}</option>
                    @endforeach
                </select></p>

                <p>
                <select name="washingpoint" required class="form-control">
                    <option value="">Select Washing Point</option>
                </select></p>

                <p><input type="text" name="fname" class="form-control" required placeholder="Full Name"></p>
                <p><input type="text" name="contactno" class="form-control" pattern="[0-9]{10}" title="10 numeric characters only" required placeholder="Mobile No."></p>
                <p>Wash Date <br /><input type="date" name="washdate" required class="form-control"></p>
                <p>Wash Time <br /><input type="time" name="washtime" required class="form-control"></p>
                <p><textarea name="message"  class="form-control" placeholder="Message if any"></textarea></p>
                <p><input type="submit" class="btn btn-custom" name="book" value="Book Now"></p>

            </div>
            <div class="modal-footer">
                <input type="text" name="sid" id="cid">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@csrf
</form>
<script type="text/javascript">
    $(".passingID").click(function () {
        var c_id = $(this).attr('data-id');
        $("#cid").val( c_id );
        $('#myModal').modal('show');
    });
    </script>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('lib/easing/easing.min.js')}}"></script>
        <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
        <script src="{{ asset('lib/waypoints/waypoints.min.js')}}"></script>
        <script src="{{ asset('lib/counterup/counterup.min.js')}}"></script>

        <!-- Contact Javascript File -->


        <!-- Template Javascript -->
        <script src="{{ asset('js/main.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    </body>
</html>

