<!DOCTYPE HTML>
<html lang="en"> 
  
<!-- Mirrored from remtsoy.com/tf_templates/tf-bookify-demo/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Dec 2020 07:51:10 GMT -->
<head>
    <title>{{ config('app.name', 'Gama Rooms') }} | Agent Login</title> 
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/favico/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/favico/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/favico/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('public/favico/site.webmanifest') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('public/frontend/css/font-awesome.css') }}"/>
    <link rel="stylesheet" href="{{ asset('public/frontend/css/lineicons.css') }}"/>
    <link rel="stylesheet" href="{{ asset('public/frontend/css/weather-icons.css') }}"/>
    <link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('public/frontend/css/styles.css') }}"/>
  </head>
  <style type="text/css">
    #remember-error{
      white-space: pre !important;
    }
  </style>
  <body>
    <nav class="navbar navbar-default navbar-inverse navbar-theme navbar-theme-abs navbar-theme-transparent navbar-theme-border" id="main-nav">
      <div class="container">
        <div class="navbar-inner nav">
          <div class="navbar-header">
            <button class="navbar-toggle collapsed" data-target="#navbar-main" data-toggle="collapse" type="button" area-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
              <img src="{{ asset('public/frontend/img/logo.png') }}" alt="Image Alternative text" title="Image Title"/> 
            </a>
          </div>
          <div class="collapse navbar-collapse" id="navbar-main">
            <ul class="nav navbar-nav">
              <li>
                <a class="dropdown-toggle" href="{{ url('/') }}" title="Home" >Home</a>
              </li>
              <li>
                <a class="dropdown-toggle" href="{{ url('aboutus') }}" title="About Us" >About Us</a>
              </li>
              
              <li>
                <a class="dropdown-toggle" href="{{ url('terms_conditions') }}" title="Terms & Conditions" >Terms & Conditions</a>
              </li>
              <!-- <li>
                <a class="dropdown-toggle" href="javascript:void(0)" title="About" >About</a>
              </li> -->
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url({{ asset('public/frontend/img/adult-book-business-cactus-297755_1500x800.jpg' ) }});"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-strong"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="theme-page-section _pt-100 theme-page-section-xl">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="theme-login theme-login-white">
                  <div class="theme-login-header">
                    <h1 class="theme-login-title">Sign Up</h1>
                    <p class="theme-login-subtitle">Register yourself with Gama Rooms</p>
                  </div>
                  <div class="theme-login-box">
                    <div class="theme-login-box-inner">
                      <form class="theme-login-form" method="POST" action="{{ url('agent_signup') }}" id="gama_form" >
                        @csrf
                        <div class="col-md-6">
                          <div class="form-group theme-login-form-group">
                            <input id="agency_name" type="text" class="form-control" name="agency_name" value="{{ old('agency_name') }}" required placeholder="Agency Name" maxlength="50" tabindex="1" />
                            <span class="form-text" style="color:red">
                                @if ($errors->has('agency_name'))
                                    <strong>{{ $errors->first('agency_name') }}</strong>
                                @endif
                            </span>
                          </div>
                          <div class="form-group theme-login-form-group">
                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required placeholder="First Name" maxlength="50" tabindex="3" />
                            <span class="form-text" style="color:red">
                                @if ($errors->has('first_name'))
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                @endif
                            </span>
                          </div>
                          <div class="form-group theme-login-form-group">
                            <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}"  maxlength="50" required placeholder="City" tabindex="7" />
                            <span class="form-text" style="color:red">
                                @if ($errors->has('city'))
                                    <strong>{{ $errors->first('city') }}</strong>
                                @endif
                            </span>
                          </div>
                          <div class="form-group">
                            <textarea name="address" id="address" class="form-control" placeholder="Address" cols="10" rows="5" required tabindex="9" ></textarea>
                            <span class="form-text" style="color:red">
                                @if ($errors->has('address'))
                                    <strong>{{ $errors->first('address') }}</strong>
                                @endif
                            </span>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group theme-login-form-group">
                              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  maxlength="99" required placeholder="Agency Email" tabindex="2" />
                              <span class="form-text" style="color:red">
                                @if ($errors->has('email'))
                                    <strong>{{ $errors->first('email') }}</strong>
                                @endif
                            </span>
                            </div>
                            <div class="form-group theme-login-form-group">
                              <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"  maxlength="50" required placeholder="Last Name" tabindex="4" />
                              <span class="form-text" style="color:red">
                                @if ($errors->has('last_name'))
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                @endif
                            </span>
                            </div>
                            <div class="form-group theme-login-form-group">
                              <input id="password" type="password" class="form-control" name="password" required placeholder="Password" tabindex="6" />
                            </div>
                            <div class="form-group theme-login-form-group">
                              <select name="country" id="country" class="form-control" tabindex="8">
                                <option value="">Select Country</option>
                                @if($countries)
                                  @foreach($countries as $rows)
                                    <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                  @endforeach
                                @endif
                              </select>
                              <span class="form-text" style="color:red">
                                @if ($errors->has('country'))
                                    <strong>{{ $errors->first('country') }}</strong>
                                @endif
                            </span>
                            </div>
                            <div class="form-group theme-login-form-group">
                              <div class="form-group">
                                    <label>IATA status:</label>
                                    <div class="radio-wrapper">
                                      <label class="radio-inline">
                                        <input type="radio" name="iata_status" value="1" tabindex="9" onclick="open_iata_no(1)">Approved
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="iata_status" value="0" tabindex="10" checked onclick="open_iata_no(0)">Not Approved
                                      </label>
                                    </div>
                                    <br>
                                    <input id="iata_no" type="text" class="form-control" name="iata_no" value="{{ old('iata_no') }}" required placeholder="IATA Registration Number" tabindex="" style="display: none;"  />
                                </div>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group"> 
                          <div class="theme-login-checkbox">
                            <input type="checkbox" name="remember" id="remember" tabindex="11" {{ old('remember') ? 'checked' : '' }}>
                              I accept the <a href="{{ url('terms_conditions') }}" target="_blank">Terms & Conditions.</a>
                          </div>
                        </div>
                        <button class="btn btn-uc btn-dark btn-block btn-lg" tabindex="12" type="submit">Sign Up</button>
                      </form>
                    </div>
                    <div class="theme-login-box-alt">
                      <p>Have an account? &nbsp;
                        <a href="{{ url('login')}}">Sign in.</a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-copyright">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <p class="theme-copyright-text">Copyright &copy; 2018
              <a href="#">Gama Rooms</a>. All rights reserved.
            </p>
          </div>
          <div class="col-md-6">
            <ul class="theme-copyright-social">
               <li>
                <a class="fa fa-facebook" href="https://www.facebook.com/GamaRooms-102806101980667"></a>
              </li>
              <li>
                <a class="fa fa-twitter" href="https://twitter.com/GamaRooms?s=20"></a>
              </li>
              <li>
                <a class="fa fa-youtube-play" href="https://www.youtube.com/channel/UCybVcKQKhAPcGC8fr3IT5HQ"></a>
              </li>
              <li>
                <a class="fa fa-instagram" href="https://www.instagram.com/gamarooms_/"></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ asset('public/frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('public/frontend/js/moment.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.js') }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYeBBmgAkyAN_QKjAVOiP_kWZ_eQdadeI&amp;callback=initMap&amp;libraries=places"></script>
    <script src="{{ asset('public/frontend/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('public/frontend/js/blur-area.js') }}"></script>
    <script src="{{ asset('public/frontend/js/icheck.js') }}"></script>
    <script src="{{ asset('public/frontend/js/gmap.js') }}"></script>
    <script src="{{ asset('public/frontend/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('public/frontend/js/ion-range-slider.js') }}"></script>
    <script src="{{ asset('public/frontend/js/sticky-kit.js') }}"></script>
    <script src="{{ asset('public/frontend/js/smooth-scroll.js') }}"></script>
    <script src="{{ asset('public/frontend/js/fotorama.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bs-datepicker.js') }}"></script>
    <script src="{{ asset('public/frontend/js/typeahead.js') }}"></script>
    <script src="{{ asset('public/frontend/js/quantity-selector.js') }}"></script>
    <script src="{{ asset('public/frontend/js/countdown.js') }}"></script>
    <script src="{{ asset('public/frontend/js/window-scroll-action.js') }}"></script>
    <script src="{{ asset('public/frontend/js/fitvid.js') }}"></script>
    <script src="{{ asset('public/frontend/js/youtube-bg.js') }}"></script>
    <script src="{{ asset('public/frontend/js/custom.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('public/frontend/js/additional-methods.js') }}"></script>

    <script type="text/javascript">
      function open_iata_no(id)
      {
        if(id==1)
        {
          $("#iata_no").css('display', 'block');
          $("#iata_no").attr('required', 'required');
        }
        else
        {
          $("#iata_no").css('display', 'none');
          $("#iata_no").removeAttr('required');
          $("#iata_no-error").html('');

        }
      }
    </script>
    <script type="text/javascript">           
    $("#gama_form").validate({
    rules: {
        agency_name: "required",
        first_name: "required",
        last_name: "required",
        username: {
            required: true,
            minlength: 8
        },
        password: {
            required: true,
            minlength: 8
        },        
        city: "required",
        country: "required",
        address: "required",
        remember: "required"
    },
    messages: {
        agency_name: "Please enter agency name",
        first_name: "Please enter your first name",
        last_name: "Please enter your last name",
        username: {
            required: "Please enter your username",
            minlength: "Username must be at least 8 characters long"
        },
        password: {
            required: "Please provide a password",
            minlength: "Password must be at least 8 characters long"
        },
        city: "Please enter your city",
        country: "Please select your country",
        address: "Please enter your address",
        remember: "Please accept our Terms & Conditions"
    }
});
</script>
</body>
</html>