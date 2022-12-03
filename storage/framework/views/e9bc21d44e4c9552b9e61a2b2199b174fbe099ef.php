<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('assets/css/bootstrap-select.min.css')); ?>" rel="stylesheet">
<style type="text/css">
.sal{
    line-height: 50px;
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="theme-hero-area theme-hero-area-full">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url(<?php echo e(asset('public/frontend/img/buoy-dawn-daylight-forest-442555_1500x800.jpg')); ?> );"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-dark"></div>
        <div class="theme-hero-area-inner-shadow"></div>
      </div>
      <div class="theme-hero-area-body theme-hero-area-body-vert-center">
        <div class="container">
          <div class="theme-page-404 _ta-c">
                <?php if(isset($response)): ?>
                <h1 class="theme-page-404-title"><?php echo $response->getStatusCode() ?></h1>
                <p class="theme-page-404-subtitle"><?php echo $response->getReasonPhrase() ?></p>
                <p class="theme-page-404-subtitle"><?php echo $response->getBody() ?></p>
                <?php else: ?>
                <h2 class="theme-page-404-title">Sorry</h2>
                <p class="theme-page-404-subtitle"><?php echo $message ?></p>
                <?php endif; ?>
            <a class="btn btn-ghost btn-xxl btn-white btn-uc" href="<?php if(isset($_SERVER['HTTP_REFERER'])) echo $_SERVER['HTTP_REFERER']; ?>">Go Back</a>
          </div>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('assets/js/bootstrap-select.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\gamarooms\resources\views/frontend/error/error.blade.php ENDPATH**/ ?>