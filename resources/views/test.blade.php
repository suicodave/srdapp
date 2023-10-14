@extends('frontpage-layout')

@section('content')
 <!-- Carousel Start -->
 <div class="carousel">
    <div class="container-fluid">
        <div class="owl-carousel">
            <div class="carousel-item">
                <div class="carousel-img">
                    <img src="img/carousel-1.jpg" alt="Image">
                </div>
                <div class="carousel-text">
                    <h3>Washing & Detailing</h3>
                    <h1>Keep your Car Newer</h1>

                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-img">
                    <img src="img/carousel-2.jpg" alt="Image">
                </div>
                <div class="carousel-text">
                    <h3>Washing & Detailing</h3>
                    <h1>Quality service for you</h1>

                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-img">
                    <img src="img/carousel-3.jpg" alt="Image">
                </div>
                <div class="carousel-text">
                    <h3>Washing & Detailing</h3>
                    <h1>Exterior & Interior Washing</h1>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->


<!-- About Start -->
<div class="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-img">
                    <img src="img/about.jpg" alt="Image">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-header text-left">
                    <p>About Us</p>
                    <h2>car washing and detailing</h2>
                </div>
                <div class="about-content">
                    <p>
                        Lorem ipsum dolor sit amet elit. In vitae turpis. Donec in hendre dui, vel blandit massa. Ut vestibu suscipi cursus. Cras quis porta nulla, ut placerat risus. Aliquam nec magna eget velit luctus dictum
                    </p>
                    <ul>
                        <li><i class="far fa-check-circle"></i>Seats washing</li>
                        <li><i class="far fa-check-circle"></i>Vacuum cleaning</li>
                        <li><i class="far fa-check-circle"></i>Interior wet cleaning</li>
                        <li><i class="far fa-check-circle"></i>Window wiping</li>
                    </ul>
                    <a class="btn btn-custom" href="about.php">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Service Start -->
<div class="service">
    <div class="container">
        <div class="section-header text-center">
            <p>What We Do?</p>
            <h2>Premium Washing Services</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-car-wash-1"></i>
                    <h3>Exterior Washing</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-car-wash"></i>
                    <h3>Interior Washing</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-vacuum-cleaner"></i>
                    <h3>Vacuum Cleaning</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-seat"></i>
                    <h3>Seats Washing</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-car-service"></i>
                    <h3>Window Wiping</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-car-service-2"></i>
                    <h3>Wet Cleaning</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-car-wash"></i>
                    <h3>Oil Changing</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-brush-1"></i>
                    <h3>Brake Reparing</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->


<!-- Facts Start -->
<div class="facts" data-parallax="scroll" data-image-src="img/facts.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="fa fa-map-marker-alt"></i>
                    <div class="facts-text">
                        <h3 data-toggle="counter-up">25</h3>
                        <p>Service Points</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="fa fa-user"></i>
                    <div class="facts-text">
                        <h3 data-toggle="counter-up">350</h3>
                        <p>Engineers & Workers</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="fa fa-users"></i>
                    <div class="facts-text">
                        <h3 data-toggle="counter-up">1500</h3>
                        <p>Happy Clients</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="fa fa-check"></i>
                    <div class="facts-text">
                        <h3 data-toggle="counter-up">5000</h3>
                        <p>Projects Completed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Facts End -->


<!-- Price Start -->
<div class="price">
    <div class="container">
        <div class="section-header text-center">
            <p>Washing Plan</p>
            <h2>Choose Your Plan</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="price-item">
                    <div class="price-header">
                        <h3>Basic Cleaning</h3>
                        <h2><span>$</span><strong>10</strong><span>.99</span></h2>
                    </div>
                    <div class="price-body">
                        <ul>
                            <li><i class="far fa-check-circle"></i>Seats Washing</li>
                            <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                            <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                            <li><i class="far fa-times-circle"></i>Interior Wet Cleaning</li>
                            <li><i class="far fa-times-circle"></i>Window Wiping</li>
                        </ul>
                    </div>
                    <div class="price-footer">
                        <a class="btn btn-custom"  data-toggle="modal" data-target="#myModal">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="price-item featured-item">
                    <div class="price-header">
                        <h3>Premium Cleaning</h3>
                        <h2><span>$</span><strong>20</strong><span>.99</span></h2>
                    </div>
                    <div class="price-body">
                        <ul>
                            <li><i class="far fa-check-circle"></i>Seats Washing</li>
                            <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                            <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                            <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                            <li><i class="far fa-times-circle"></i>Window Wiping</li>
                        </ul>
                    </div>
                    <div class="price-footer">
                        <a class="btn btn-custom"  data-toggle="modal" data-target="#myModal">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="price-item">
                    <div class="price-header">
                        <h3>Complex Cleaning</h3>
                        <h2><span>$</span><strong>30</strong><span>.99</span></h2>
                    </div>
                    <div class="price-body">
                        <ul>
                            <li><i class="far fa-check-circle"></i>Seats Washing</li>
                            <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                            <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                            <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                            <li><i class="far fa-check-circle"></i>Window Wiping</li>
                        </ul>
                    </div>
                    <div class="price-footer">
                        <a class="btn btn-custom"  data-toggle="modal" data-target="#myModal">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Price End -->
@endsection
