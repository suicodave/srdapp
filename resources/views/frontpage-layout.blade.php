<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Car Wash management System | Home Page</title>


        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
                <!-- Top Bar Start -->
                <div class="top-bar">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-4 col-md-12">
                                <div class="logo">
                                    <a href="index.php">
                                        <h1>CAR <span>Wash</span></h1>
                                        <!-- <img src="img/logo.jpg" alt="Logo"> -->
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
                                                <p></p>
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
                                                <p>+</p>
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
                                                <p></p>
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
                                    <a href="index.php" class="nav-item nav-link active">Home</a>
                                    <a href="about.php" class="nav-item nav-link">About</a>
                                    <a href="washing-plans.php" class="nav-item nav-link">Washing Plans</a>
                                    <a href="location.php" class="nav-item nav-link">Washing Points</a>

                                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                                    <a href="admin" class="nav-item nav-link">admin</a>
                                </div>
                                <div class="ml-auto">
                                    <a class="btn btn-custom" href="contact.php">Get Appointment</a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- Nav Bar End -->







        <!-- Footer Start -->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="footer-contact">
                            <h2>Get In Touch</h2>
                            <p><i class="fa fa-map-marker-alt"></i></p>


                            <div class="footer-social">
                                <a class="btn" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn" href=""><i class="fab fa-youtube"></i></a>
                                <a class="btn" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="footer-link">
                            <h2>Popular Links</h2>
                              <a href="index.php">Home</a>
                            <a href="about.php">About Us</a>
                            <a href="washing-plans.php">Washing Plans</a>
                            <a href="location.php">Washing Points</a>
                            <a href="contact.php">Contact Us</a>



                        </div>
                    </div>

                </div>
            </div>
            <div class="container copyright">
                <p>Car Wash Management System</p>
            </div>
        </div>
        <!-- Footer End -->        <!-- Back to top button -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- Pre Loader -->
        <div id="loader" class="show">
            <div class="loader"></div>
        </div>



<!--Model-->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Car Wash Booking</h4>
        </div>
        <div class="modal-body">
<form method="post">
  <p>
            <select name="packagetype" required class="form-control">
                <option value="">Package Type</option>
                <option value="1">BASIC CLEANING ($10.99)</option>
                 <option value="2">PREMIUM CLEANING ($20.99)</option>
                  <option value="3 ">COMPLEX CLEANING($30.99)</option>
              </select>

          <p>
            <select name="washingpoint" required class="form-control">

            </select></p>
            <p><input type="text" name="fname" class="form-control" required placeholder="Full Name"></p>
            <p><input type="text" name="contactno" class="form-control" pattern="[0-9]{10}" title="10 numeric characters only" required placeholder="Mobile No."></p>
            <p>Wash Date <br /><input type="date" name="washdate" required class="form-control"></p>
             <p>Wash Time <br /><input type="time" name="washtime" required class="form-control"></p>
             <p><textarea name="message"  class="form-control" placeholder="Message if any"></textarea></p>
             <p><input type="submit" class="btn btn-custom" name="book" value="Book Now"></p>
      </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>

        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
