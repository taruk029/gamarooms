<!doctype html>
<html lang="en">

<!-- login35:56-->
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <title>{{ config('app.name', 'Out Placement Heroes') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/css/plugins.css') }}">
    
    <!-- Custom style -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" id="jssDefault" href="{{ asset('assets/css/colors/green-style.css') }}">
    
    </head>
    <body class="simple-bg-screen" style="background-image:url({{ asset('assets/img/banner-10.jpg') }});">
        <div class="Loader"></div>
        <div class="wrapper">  
            
            <!-- Title Header Start -->
            <section class="login-screen-sec">
                <div class="container">
                    <div class="login-screen">
                        <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo.png') }}" class="img-responsive" alt=""></a>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Username">
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
                            <span><input class="form-check-input" checked="checked" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                             <a href="signup.html"> {{ __('Remember Me') }}</a></span><br><br>
                            <button class="btn btn-login" type="submit">Login</button>
                            <span style="color: white;">You Have No Account? <a href="{{ url('signup') }}"> Create An Account</a></span>
                            <span><a href="{{ url('forget_password') }}"> Forget Password</a></span>
                        </form>
                    </div>
                </div>
            </section>            
            <!-- Scripts
            ================================================== -->
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
            
            <!-- Custom Js -->
            <script src="{{ asset('assets/js/custom.js') }}"></script>
            <script src="{{ asset('assets/js/jQuery.style.switcher.js') }}"></script>
        </div>
    </body>

<!-- login35:58-->
</html>
