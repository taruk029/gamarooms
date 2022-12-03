@extends('backend.layout.app')
@section('title', 'Home')
@section('content')
    <div class="banner home-5" style="background-image:url(assets/img/6604.jpg);">
        <div class="container">
            <div class="banner-caption">
                <div class="col-md-12 col-sm-12 banner-text">
                    <h1>7,000+ Jobs</h1><br>
                    <h1>5,00+ Satisfied Clients</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <section class="wp-process">
        <div class="container">
            <div class="row">
                <div class="main-heading">
                    <p>How We Work</p>

                    <h2>Our Work <span>Process</span></h2>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="work-process">
                    <div class="work-process-icon"><span class="icon-search"></span></div>
                    <div class="work-process-caption">
                        <h4>Hiring Employers</h4>

                        <p>Hiring Employers Register and update position they would like to fill.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="work-process">
                    <div class="work-process-icon"><span class="icon-mobile"></span></div>
                    <div class="work-process-caption">
                        <h4>Seperating Employer</h4>

                        <p>Seperating Employer Register himself.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="work-process">
                    <div class="work-process-icon"><span class="icon-mobile"></span></div>
                    <div class="work-process-caption">
                        <h4>Seperating Employer</h4>

                        <p>Seperating Employer upload details of employees they would like to outplace.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="work-process">
                    <div class="work-process-icon"><span class="icon-layers"></span></div>
                    <div class="work-process-caption">
                        <h4>Hiring Employee</h4>

                        <p>Employee receives system generated trigger basis matching cv to open positions.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="work-process">
                    <div class="work-process-icon"><span class="icon-profile-male"></span></div>
                    <div class="work-process-caption">
                        <h4>Seperating Employer</h4>

                        <p>Seperating Employer gets regular update on outplacement activity.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="work-process">
                    <div class="work-process-icon"><span class="icon-profile-male"></span></div>
                    <div class="work-process-caption">
                        <h4>Mentors </h4>

                        <p>Mentors help job seekers to crack future job interviews.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <section class="testimonial" id="testimonial">
        <div class="container">
            <div class="row">
                <div class="main-heading">
                    <p>What Say Our Client</p>

                    <h2>Our Success <span>Stories</span></h2>
                </div>
            </div>
            <div class="row">
                <div id="client-testimonial-slider" class="owl-carousel">
                    <div class="client-testimonial">
                        <div class="pic"><img src="assets/img/client-1.jpg" alt=""></div>
                        <p class="client-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor et dolore magna aliqua.</p>

                        <h3 class="client-testimonial-title">Lacky Mole</h3>
                        <ul class="client-testimonial-rating">
                            <li class="fa fa-star-o"></li>
                            <li class="fa fa-star-o"></li>
                            <li class="fa fa-star"></li>
                        </ul>
                    </div>
                    <div class="client-testimonial">
                        <div class="pic"><img src="assets/img/client-2.jpg" alt=""></div>
                        <p class="client-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor et dolore magna aliqua.</p>

                        <h3 class="client-testimonial-title">Karan Wessi</h3>
                        <ul class="client-testimonial-rating">
                            <li class="fa fa-star-o"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                        </ul>
                    </div>
                    <div class="client-testimonial">
                        <div class="pic"><img src="assets/img/client-3.jpg" alt=""></div>
                        <p class="client-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor et dolore magna aliqua.</p>

                        <h3 class="client-testimonial-title">Roul Pinchai</h3>
                        <ul class="client-testimonial-rating">
                            <li class="fa fa-star-o"></li>
                            <li class="fa fa-star-o"></li>
                            <li class="fa fa-star"></li>
                        </ul>
                    </div>
                    <div class="client-testimonial">
                        <div class="pic"><img src="assets/img/client-4.jpg" alt=""></div>
                        <p class="client-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor et dolore magna aliqua.</p>

                        <h3 class="client-testimonial-title">Adam Jinna</h3>
                        <ul class="client-testimonial-rating">
                            <li class="fa fa-star-o"></li>
                            <li class="fa fa-star-o"></li>
                            <li class="fa fa-star"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection