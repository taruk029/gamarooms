<!DOCTYPE HTML>
<html lang="en"> 
  
<!-- Mirrored from remtsoy.com/tf_templates/tf-bookify-demo/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Dec 2020 07:51:10 GMT -->
<head>
    <title><?php echo e(config('app.name', 'Gama Rooms')); ?> | Agent Login</title> 
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('public/favico/apple-touch-icon.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('public/favico/favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('public/favico/favicon-16x16.png')); ?>">
    <link rel="manifest" href="<?php echo e(asset('public/favico/site.webmanifest')); ?>">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/font-awesome.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/lineicons.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/weather-icons.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/bootstrap.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/styles.css')); ?>"/>
  </head>
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
            <a class="navbar-brand" href="<?php echo e(asset('/')); ?>">
              <img src="<?php echo e(asset('public/frontend/img/logo.png')); ?>" alt="Image Alternative text" title="Image Title"/> 
            </a>
          </div>
          <div class="collapse navbar-collapse" id="navbar-main">
            <ul class="nav navbar-nav">
              <li>
                <a class="dropdown-toggle" href="<?php echo e(url('/')); ?>" title="Home" >Home</a>
              </li>
              <li>
                <a class="dropdown-toggle" href="<?php echo e(url('aboutus')); ?>" title="About Us" >About Us</a>
              </li>
              
              <li>
                <a class="dropdown-toggle" href="<?php echo e(url('terms_conditions')); ?>" title="Terms & Conditions" >Terms & Conditions</a>
              </li>
            <!--   <li>
                <a class="dropdown-toggle" href="index-2.html" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About</a>
              </li> -->
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url(<?php echo e(asset('public/frontend/img/adult-book-business-cactus-297755_1500x800.jpg' )); ?>);"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-strong"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="theme-page-section _pt-100 theme-page-section-xl">
          <div class="container">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <div class="theme-login theme-login-white">
                  <div class="theme-login-header">
                    <h1 class="theme-login-title">Sign In</h1>
                    <p class="theme-login-subtitle">Login into your Gama Rooms account</p>
                  </div>
                  <div class="theme-login-box">
                      <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                    <div class="theme-login-box-inner">
                      <form class="theme-login-form" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group theme-login-form-group">
                          <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" id="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" onblur="javascript:check_status()" placeholder="Username"/>
                          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group theme-login-form-group">
                          <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password" placeholder="Password"/>
                          <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                          <p class="help-block">
                            <a href="<?php echo e(url('forget_password')); ?>">Forgot password?</a>
                          </p>
                        </div>
                        <div class="form-group"> 
                          <div class="theme-login-checkbox">
                            <label class="icheck-label">
                              <input class="icheck" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                              <span class="icheck-title">Keep me logged in</span>
                            </label>
                          </div>
                        </div>
                        <button class="btn btn-uc btn-dark btn-block btn-lg" type="submit">Login</button>
                      </form>
                    </div>
                    <div class="theme-login-box-alt">
                      <p>Don't have an account? &nbsp;
                        <a href="<?php echo e(url('signup')); ?>">Sign up.</a>
                      </p>
                    </div>
                  </div>
                  <p class="theme-login-terms">By logging in you accept our
                    <a href="#">terms of use</a>
                    <br/>and
                    <a href="#">privacy policy</a>.
                  </p>
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
    <script src="<?php echo e(asset('public/frontend/js/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/bootstrap.js')); ?>"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYeBBmgAkyAN_QKjAVOiP_kWZ_eQdadeI&amp;callback=initMap&amp;libraries=places"></script>
    <script src="<?php echo e(asset('public/frontend/js/owl-carousel.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/blur-area.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/icheck.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/gmap.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/magnific-popup.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/ion-range-slider.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/sticky-kit.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/smooth-scroll.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/fotorama.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/bs-datepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/typeahead.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/quantity-selector.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/countdown.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/window-scroll-action.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/fitvid.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/youtube-bg.js')); ?>"></script>
    <script src="<?php echo e(asset('public/frontend/js/custom.js')); ?>"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="<?php echo e(asset('public/backend/js/block_ui.js')); ?>"></script>    
    <script>
        function check_status()
        {
            var email = $("#email").val();
            $.blockUI({ message: "<i class='fa fa-2x fa-spinner fa-spin' aria-hidden='true' ></i> &nbsp; <h6>Loading... a moment please.</h6>" });
            $.ajax({
                url: "<?php echo e(url('check_is_active')); ?>",
                type: 'GET',
                data: {email:email},            
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data){
                    if(data==0)
                        alert('Admin has not approved your request yet.');
                    else if(data==2)
                        alert('Admin has rejected your request');
                    else if(data==3)
                        alert('The email you entered is not available.');
                    else
                        return;
                }
            });
            $.unblockUI();
        }
    </script>
  </body>

<!-- Mirrored from remtsoy.com/tf_templates/tf-bookify-demo/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Dec 2020 07:51:11 GMT -->
</html><?php /**PATH /home/gamarpcx/public_html/resources/views/auth/login.blade.php ENDPATH**/ ?>