<!DOCTYPE HTML>
<html lang="en">  
<head>
    <title>{{ config('app.name', 'Gama Rooms') }} | @yield('title')</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favico/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favico/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favico/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favico/site.webmanifest') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/lineicons.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/weather-icons.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/styles.css') }}"/>
    @stack('styles')
  </head>
  <body>
    @include('frontend.layout.header')
    <div class="_pos-r">
      @yield('content')
    @include('frontend.layout.footer')
    </div>
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/js/moment.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
<!--    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8aRohIKL9qqZegnjStqlOjaXiwtdnafg&amp;callback=initMap&amp;libraries=places"></script>-->
    <script src="{{ asset('frontend/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('frontend/js/blur-area.js') }}"></script>
    <script src="{{ asset('frontend/js/icheck.js') }}"></script>
   <!-- <script src="{{ asset('public/frontend/js/gmap.js') }}"></script>-->
    <script src="{{ asset('frontend/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/js/ion-range-slider.js') }}"></script>
    <script src="{{ asset('frontend/js/sticky-kit.js') }}"></script>
    <script src="{{ asset('frontend/js/smooth-scroll.js') }}"></script>
    <script src="{{ asset('frontend/js/fotorama.js') }}"></script>
    <script src="{{ asset('frontend/js/bs-datepicker.js') }}"></script>
    <script src="{{ asset('frontend/js/typeahead.js') }}"></script>
    <script src="{{ asset('frontend/js/quantity-selector.js') }}"></script>
    <script src="{{ asset('frontend/js/countdown.js') }}"></script>
    <script src="{{ asset('frontend/js/window-scroll-action.js') }}"></script>
    <script src="{{ asset('frontend/js/fitvid.js') }}"></script>
    <script src="{{ asset('frontend/js/block_ui.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap-notify.min.js') }}"></script>
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
    @stack('scripts')
    <script>
        $('#flash-overlay-modal').modal(); 
    </script>
    <script type="text/javascript">
        setTimeout(function(){ $(".alert").fadeOut(); }, 5000);
    </script>
  </body>
</html>