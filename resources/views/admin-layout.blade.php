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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>

            .containerf {
                flex: 1;
                display: flex;
                flex-direction: column;
            }

            .footer {
                text-align: center;
            }
            .booking-date-picker {
  appearance: none;
  -webkit-appearance: none;
  border: 1px solid #ccc;
  padding: 8px;
  font-size: 16px;
  width: 200px;
}
        </style>
        <!-- Template Stylesheet -->
        <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    </head>

    <body>
        <!-- Top Bar Start -->
        <div class="top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12">
                        &nbsp;
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

        <div class="container pt-4 pb-3">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a href="{{route('index')}}" class="navbar-brand">SRD CAR SPA</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="{{route('index')}}" class="nav-item nav-link active">Home</a>
                            <a href="{{route('about')}}" class="nav-item nav-link">About</a>
                            <a href="{{route('services')}}" class="nav-item nav-link">Washing Plans</a>
                        </div>
                    </div>
            </nav>
        </div>
        <!-- Top Bar End -->
        @yield('content')



        <!-- Price Start -->
<div class="price">
    <div class="container">
        <div class="section-header text-center">
            <p>Washing Plan</p>
            <h2>Choose Your Plan</h2>
            <span class="small">Please select the services you want to book from the options below.</span>
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
                        <h3 style="text-align: left">{{$itemclass->vehicletype}}</h3>
                    </div>
                        <?php
                        $getservices = Services::where('classification',$itemclass->id)->where('status','Available')->select('sid','servicesname','price')->get();
                        ?>
                        @foreach($getservices as $itemservice)
                        <div class="price-body">
                            <div class="pl-3" style="text-align:left;">
                                <i class="far fa-check-circle"></i>&nbsp;
                                <a  data-toggle="modal" data-id="{{ $itemclass->id }}" data-sid="{{$itemservice->sid}}"  class="text-danger" id="passingID" data-toggle="modal" data-target="#MyModal">{{$itemservice->servicesname}} - {{$itemservice->price}}</a>
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Start Modal-->
<form action="{{route('bookednow')}}" method="POST">
    <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="my_modalLabel">Book Now!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <div class="container" >
                        <div class="row justify-content-md-center" >
                            <div class="row">
                                <div class="form-group pl-4 pr-4 pb-4">
                                    <label class="col-form-label" for="fullname">Fullname&nbsp;<small style="color: red;font-weight:bold;">*</small></label>
                                    <input type="text" class="form-control" name="fullname" style="width: 450px;" required autocomplete="fullanme">
                                    {{ $errors->first('fullname') }}

                                </div>
                                <div class="form-group pl-4 pr-4 pb-4">
                                    <label class="col-form-label" for="mobilenumber">Mobile Number&nbsp;<small style="color: red;font-weight:bold;">*</small></label>
                                    <input type="text" class="form-control" name="mobilenumber" pattern="[0-9]{10}" title="10 numeric characters only" style="width: 150px;" required autocomplete="mobilenumber">
                                    {{ $errors->first('mobilenumber') }}
                                </div>

                                <div class="form-group pl-4 pr-4 pb-4">
                                    <label class="col-form-label" for="pdate">Preferred Date&nbsp;<small style="color: red;font-weight:bold;">*</small></label>
                                    <input type="date" id="bookingDate" name="pdate"  class="form-control booking-date-picker" style="width: 150px;" required autocomplete="pdate">

                                    {{ $errors->first('pdate') }}
                                </div>
                                <div class="form-group pl-4 pr-4 pb-4">
                                    <label class="col-form-label" for="ptime">Preferred Time&nbsp;<small style="color: red;font-weight:bold;">*</small></label>
                                    <input type="time" class="form-control" name="ptime" style="width: 150px;" required autocomplete="ptime">
                                    {{ $errors->first('ptime') }}
                                </div>

                                <div class="form-group pl-4 pr-4 pb-4">
                                    <label class="col-form-label" for="ptime">Email ID&nbsp;<small style="color: red;font-weight:bold;">*</small></label>
                                    <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" class="form-control" name="email" style="width: 350px;" required autocomplete="email">
                                    {{ $errors->first('email') }}
                                </div>
                                <div class="form-group pl-4 pr-4 pb-4">
                                    <label class="col-form-label" for="message">Message&nbsp;(optional)</label>
                                    <textarea name="message" required autocomplete="false" class="form-control" cols="100" rows="2"></textarea>
                                    {{ $errors->first('message') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                    const today = new Date();
                    const currentMonthStart = new Date(today.getFullYear(), today.getMonth(), 1);
                    const bookingDate = document.getElementById("bookingDate");

                    // Set minimum selectable date to the first day of the current month
                    bookingDate.min = currentMonthStart.toISOString().split('T')[0];
                  });

                  </script>
                <div class="modal-footer">
                    <input type="hidden" name="rid" id="cid">
                    <input type="hidden" name="sid" id="csid">
                    <input type="submit" class="btn btn-danger btn-sm" value="Book Now">
                </div>

            </div>
        </div>
    </div>
    @csrf
</form>
    <script type="text/javascript">
    $(document).on("click", "#passingID", function() {
        var c_id = $(this).attr('data-id');
        var c_sid = $(this).attr('data-sid');
        $("#cid").val(c_id);
        $("#csid").val(c_sid);
        $('#myModal').modal('show');
    });
    </script>
    <!--end update-->
<!--end modal-->

    <!-- Footer Start -->


    <div class="containerf d-flex justify-content-center align-items-center">
        <footer class="mt-5 p-3 bg-white text-blue">
            <div class="row">
                <div class="col-md-6">
                    <h3>&nbsp;</h3>
                    <p style="text-align:center;">Copyright 2023 @ SRD CAR SPA</p>
                </div>
                <div class="col-md-6">
                    <h3>Quick Links</h3>
                    <ul class="list-unstyled">
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="{{route('about')}}">About Us</a></li>
                        <li><a href="{{route('services')}}">Washing Plans</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    <!-- Footer End -->        <!-- Back to top button -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- Pre Loader -->
    <div id="loader" class="show">
        <div class="loader"></div>
    </div>

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

