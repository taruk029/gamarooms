<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favico/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favico/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favico/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favico/site.webmanifest') }}">
    <!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CAsap+Condensed:500" media="all">
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Asap+Condensed:500"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="{{ asset('backend/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/vendors/global/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/demo8/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @stack('styles')
<style>
    .close{ display: none; }

</style>
</head>
<!-- end::Head -->
<!-- begin::Body -->
<body style="background-image: url({{ asset('backend/assets/media/demos/demo8/bg-1.jpg)') }}" class="kt-page--fluid kt-page--loading">

    <!-- begin:: Page -->
    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="{{url('/')}}">
                <img alt="Logo" src="{{ asset('img/logo-8.png') }}" />
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">

            <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
        </div>
    </div>
    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                @include('backend.layouts.header')

                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
                    <div class="kt-container kt-body kt-grid kt-grid--ver" id="kt_body">
                        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
                          @include('flash::message')  
                            @yield('content')
                        </div>
                    </div>
                </div>

                @include('backend.layouts.footer') </div>
        </div>
    </div>

    <!-- end:: Page -->
    <
    <!-- begin::Scrolltop -->
    <div id="kt_scrolltop" class="kt-scrolltop">
        <i class="fa fa-arrow-up"></i>
    </div>
    <!-- end::Scrolltop -->
    <!-- begin::Global Config(global config for global JS sciprts) -->

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
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#716aca",
                    "light": "#ffffff",
                    "dark": "#282a3c",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
    </script>
    <!-- end::Global Config -->

    <!--begin::Global Theme Bundle(used by all pages) -->
    <script src="{{ asset('backend/assets/vendors/global/vendors.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/js/demo8/scripts.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/block_ui.js') }}"></script>    
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{ asset('backend/js/bootstrap-notify.min.js') }}"></script>
    <!--end::Global Theme Bundle -->
     @stack('scripts')
     <script>
        $('#flash-overlay-modal').modal(); 
    </script>
    <script type="text/javascript">
        setTimeout(function(){ $(".alert").fadeOut(); }, 5000);
    </script>
</body>
<!-- end::Body -->
</html>