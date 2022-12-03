<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- index-540:42-->
<head>
    <!-- Basic Page Needs==================================================-->
    <title>{{ config('app.name', 'Out Placement Heros') }} | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <!-- CSS==================================================-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/css/plugins.css') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" id="jssDefault" href="{{ asset('assets/css/colors/green-style.css') }}">
    <link type="text/css" rel="stylesheet" id="jssDefault" href="{{ asset('assets/css/bootstrap-notify.css') }}">
    @stack('styles')
</head>
<body>
<div class="wrapper">
    @if(Auth::user())
        @include('frontend.job_seeker.layout.header')
    @else
        @include('frontend.layout.header')
    @endif
    <div class="clearfix"></div>
    @yield('content')
    <div class="clearfix"></div>
    @include('frontend.layout.footer')
    <div class="clearfix"></div>
    <div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="tab" role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#login" role="tab" data-toggle="tab">Sign
                                In</a></li>
                        </ul>
                        <div class="tab-content" id="myModalLabel2">
                            <div role="tabpanel" class="tab-pane fade in active" id="login">
                                <img src="assets/img/logo.png" class="img-responsive" alt=""/>

                                <div class="subscribe wow fadeInUp">
                                    <form class="form-inline" method="post" action="{{ route('login') }}">
                                        @csrf
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Your Email"  autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <div class="center">
                                                    <div class="form-group row">
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" checked type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="remember">
                                                                        {{ __('Remember Me') }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" id="login-btn" class="submit-btn"> Login</button><br>
                                                    @if (Route::has('password.request'))
                                                        <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                                            {{ __('Forgot Your Password?') }}
                                                        </a> -->
                                                        <a class="btn btn-link" href="{{url('forget_password')}}">
                                                            {{ __('Forgot Your Password?') }}
                                                        </a> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts==================================================-->
    <script type="text/javascript" src="{{ asset('assets/plugins/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/js/viewportchecker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/js/bootsnav.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/js/wysihtml5-0.3.0.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/js/bootstrap-wysihtml5.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/js/datedropper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/js/dropzone.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/js/loader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/js/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/js/gmap3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/js/jquery.easy-autocomplete.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>    
        function NumbersOnly(evt,obj) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        } else {
            if(charCode != 32)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
    function isDecimal(evt,obj) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        } else {
            if(charCode != 32)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
        
    
    function skip_space(evnt,obj) {
        var charCode = (evnt.which) ? evnt.which : evnt.keyCode;
        if (charCode == 32) {
            return false;
        }
    }
    </script>
    <script src="{{ asset('assets/plugins/js/block_ui.js') }}"></script>    
    <script src="{{ asset('assets/plugins/js/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/plugins/js/additional-methods.js') }}"></script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    @stack('scripts')
     <script>
        $('#flash-overlay-modal').modal(); 
    </script>
     @include('flash::message')
</div>
</body>
</html>
