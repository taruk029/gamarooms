<?php $__env->startSection('title', 'Gama Rooms Admin Login'); ?>
<?php $__env->startSection('content'); ?>

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
<!--begin::Aside-->
<div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url(<?php echo e(asset('backend/assets/media/demos/demo8/bg-1.jpg')); ?>);">
    <div class="kt-grid__item">
        
    </div>
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
        <div class="kt-grid__item kt-grid__item--middle">
           <a href="#" class="kt-login__logo">
            <img src="<?php echo e(asset('img/login-logo.png')); ?>" class="kt-header__brand-logo-default  login_logo">
        </a></div>
    </div>
    <div class="kt-grid__item">
        <div class="kt-login__info row">
            <div class="kt-login__copyright col-md-6 col-sm-12">
                &copy <?php echo date('Y'); ?> Gama Rooms
            </div>
            <div class="kt-login__menu  col-md-6 col-sm-12">
                <a href="javascript:void(0)" class="kt-link">About</a>
                <a href="javascript:void(0)" class="kt-link">Team</a>
                <a href="javascript:void(0)" class="kt-link">Contact</a>
            </div>
        </div>
    </div>

</div>
<!--begin::Aside-->

<!--begin::Content-->
<div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
    <!--begin::Head-->
   <!--  <div class="kt-login__head">
        <span class="kt-login__signup-label">Don't have an account yet?</span>&nbsp;&nbsp;
        <a href="#" class="kt-link kt-login__signup-link">Sign Up!</a>
    </div> -->
    <!--end::Head-->

    <!--begin::Body-->
    <div class="kt-login__body">

        <!--begin::Signin-->
        <div class="kt-login__form">
            <div class="kt-login__title">
                <h3>Sign In</h3>
            </div>          

            <!--begin::Form-->
            <form class="kt-form"  method="POST" action="<?php echo e(url('adminlogin')); ?>">
                            <?php echo csrf_field(); ?>
                <div class="form-group">
                    <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus placeholder="Please Enter User Id">
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
                <div class="form-group">
                    <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password" placeholder="Please Enter Password">

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
                </div>
                <!--begin::Action-->
                <div class="kt-login__actions">
                    <!-- <a href="#" class="kt-link kt-login__link-forgot">
                        Forgot Password ?
                    </a> -->
                    <button type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Sign In</button>
                </div>
                <!--end::Action-->
            </form>
            <!--end::Form-->

            <!--begin::Divider-->
            <!-- <div class="kt-login__divider">
                <div class="kt-divider">
                    <span></span>
                    <span>OR</span>
                    <span></span>
                </div>
            </div> -->
            <!--end::Divider-->

            <!--begin::Options-->
           <!--  <div class="kt-login__options">
                <a href="#" class="btn btn-primary kt-btn">
                    <i class="fab fa-facebook-f"></i>
                    Facebook
                </a>

                <a href="#" class="btn btn-info kt-btn">
                    <i class="fab fa-twitter"></i>
                    Twitter
                </a>

                <a href="#" class="btn btn-danger kt-btn">
                    <i class="fab fa-google"></i>
                    Google
                </a>
            </div> -->
            <!--end::Options-->
        </div>
        <!--end::Signin-->
    </div>
    <!--end::Body-->
</div>
<!--end::Content-->
</div>
</div>



        </div>

<!-- end:: Page -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.login_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\gamarooms\resources\views/backend/login.blade.php ENDPATH**/ ?>