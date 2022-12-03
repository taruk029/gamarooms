@extends('frontend.layout.app')
@section('title', 'Home')
@push('styles')
@endpush
@section('content')
<div class="theme-hero-area theme-hero-area-half">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url({{ asset('public/img/activity-adult-beach-beautiful-378152_1500x800.jpg') }});"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
        <div class="theme-hero-area-inner-shadow"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-md-offset-2 theme-page-header-abs">
              <div class="theme-page-header theme-page-header-lg">
                <h1 class="theme-page-header-title">Discover Gama Rooms</h1>
                <p class="theme-page-header-subtitle">The Story of Our Company</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-page-section theme-page-section-xl theme-page-section-gray">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="theme-about-us">
              <div class="theme-about-us-section sticky-parent">
                <div class="row row-col-static row-col-reverse">
                  <div class="col-md-4">
                    <div class="sticky-cols">
                      <h4 class="theme-about-us-section-title">About</h4>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="theme-about-us-section-body">
                      <p>GamaRooms was established in 2009 to offer a unified global hotel booking experience to all travel professionals. </p>
                      <p>Our hotel booking engine makes it easy for travel agents, tour operators, and corporatetravelers to access hotels worldwide from multiple sources.</p>
                      <p>Expertise and Experience of our team has allowed us to develop innovative technology, simplifying booking process & develop exclusive hotel product.</p>
                      <div class="theme-about-us-section-gallery">
                        <div class="row" data-gutter="10">
                          <div class="col-xs-12">
                            <div class="banner theme-about-us-section-gallery-img theme-about-us-section-gallery-img-lg banner-">
                              <div class="banner-bg" style="background-image:url({{ asset('public/img/adult-book-business-cactus-297755_555x200.jpg') }});"></div>
                            </div>
                          </div>
                          <div class="col-xs-6">
                            <div class="banner theme-about-us-section-gallery-img theme-about-us-section-gallery-img-lg banner-">
                              <div class="banner-bg" style="background-image:url({{ asset('public/img/plate-flight-sky-sunset_280x205.jpg') }});"></div>
                            </div>
                          </div>
                          <div class="col-xs-6">
                            <div class="banner theme-about-us-section-gallery-img theme-about-us-section-gallery-img-lg banner-">
                              <div class="banner-bg" style="background-image:url({{ asset('public/img/woman-wearing-bikini-jumping-to-the-beach-191741_280x205.jpg') }});"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="theme-about-us-section sticky-parent">
                <div class="row row-col-static row-col-reverse">
                  <div class="col-md-4">
                    <div class="sticky-cols">
                      <h4 class="theme-about-us-section-title">Product & Services</h4>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="theme-about-us-section-body">
                      <p>•	Over 5000+ Hotels & Resorts Worldwide </p>
                      <p>•	Directly Contracted Properties </p>
                      <p>•	VIP Transfers & Travel </p>
                      <p>•	Activities </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="theme-about-us-section sticky-parent">
                <div class="row row-col-static row-col-reverse">
                  <div class="col-md-4">
                    <div class="sticky-cols">
                      <h4 class="theme-about-us-section-title">Partner With Us</h4>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="theme-about-us-section-body">
                      <p>•	Sign up to receive your web logins</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@push('scripts')
@endpush