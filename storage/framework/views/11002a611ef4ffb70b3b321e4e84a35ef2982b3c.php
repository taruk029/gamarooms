<?php $__env->startSection('title', 'Admin Dashboard'); ?>
<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('public/backend/assets/css/demo8/pricing-1.css')); ?>" rel="stylesheet" type="text/css" />
<style>
    .kt-widget14__stat{
        padding-left: 32px;
    }
    .fa
    {
        font-size: 55px !important;
    }
    .kt-widget14__legends
    {
        margin-left: 100px !important;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            Dashboard
        </h3>
        </div>
    <div class="kt-subheader__toolbar">
        <div class="kt-subheader__wrapper">
            <a href="#" class="btn kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker" data-toggle="kt-tooltip" title="Today is <?php echo date("d-m-Y"); ?>" data-placement="left">
                <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                <span class="kt-subheader__btn-daterange-date" id="kt_dashboard_daterangepicker_date"><?php echo date("M d"); ?></span>
            </a>
        </div>
    </div>
</div>
<!-- end:: Subheader -->
                            
    <!-- begin:: Content -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
        <!--Begin::Dashboard 8-->

<!--Begin::Section-->
<div class="row">
    <div class="kt-portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Total
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body  kt-portlet__body--fit">
    <a href="<?php echo e(url('admin/confirmed')); ?>" >
    <div class="row">
      <div class="col-md-4">
         <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14">
               <div class="kt-widget14__header">
                  <h3 class="kt-widget14__title">
                     Bookings           
                  </h3>
               </div>
               <div class="kt-widget14__content">
                  <div class="kt-widget14__chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                     <div class="kt-widget14__stat"><i class="fa fa-bed" aria-hidden="true"></i></div>
                     
                  </div>
                  <div class="kt-widget14__legends">
                     <div class="kt-widget14__legend">
                        <span class="kt-widget14__stats"><h3><?php echo e($bookings_count); ?></h3></span>
                     </div>
                  </div>
               </div>
            </div>
         </div>   
      </div>
      <div class="col-md-4">
         <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14">
               <div class="kt-widget14__header">
                  <h3 class="kt-widget14__title">
                     Booking Amount            
                  </h3>
               </div>
               <div class="kt-widget14__content">
                  <div class="kt-widget14__chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                     <div class="kt-widget14__stat"><i class="fa fa-money-bill-alt" aria-hidden="true"></i></div>
                     
                  </div>
                  <div class="kt-widget14__legends">
                    <?php if($booking_amount): ?>
                        <?php $__currentLoopData = $booking_amount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <div class="kt-widget14__legend">
                                <span class="kt-widget14__stats"><h3><?php echo e($row->currency); ?> <?php echo e($row->booking_sum); ?></h3></span>
                             </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14">
               <div class="kt-widget14__header">
                  <h3 class="kt-widget14__title">
                     Commission Amount            
                  </h3>
               </div>
               <div class="kt-widget14__content">
                  <div class="kt-widget14__chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                     <div class="kt-widget14__stat"><i class="fa fa-money-bill-wave" aria-hidden="true"></i></div>
                     
                  </div>
                  <div class="kt-widget14__legends">
                    <?php if($commission): ?>
                        <?php $__currentLoopData = $commission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <div class="kt-widget14__legend">
                                <span class="kt-widget14__stats"><h3><?php echo e($row->currency); ?> <?php echo e($row->commission_sum); ?></h3></span>
                             </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </a>
   <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Today's
            </h3>
        </div>
    </div>
    <a href="<?php echo e(url('admin/today')); ?>" >
    <div class="row">
      <div class="col-md-4">
         <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14">
               <div class="kt-widget14__header">
                  <h3 class="kt-widget14__title">
                     Bookings           
                  </h3>
               </div>
               <div class="kt-widget14__content">
                  <div class="kt-widget14__chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                     <div class="kt-widget14__stat"><i class="fa fa-bed" aria-hidden="true"></i></div>
                     
                  </div>
                  <div class="kt-widget14__legends">
                     <div class="kt-widget14__legend">
                        <span class="kt-widget14__stats"><h3><?php echo e($current_bookings[0]->aggregate); ?></h3></span>
                     </div>
                  </div>
               </div>
            </div>
         </div>   
      </div>
      <div class="col-md-4">
         <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14">
               <div class="kt-widget14__header">
                  <h3 class="kt-widget14__title">
                     Booking Amount            
                  </h3>
               </div>
               <div class="kt-widget14__content">
                  <div class="kt-widget14__chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                     <div class="kt-widget14__stat"><i class="fa fa-money-bill-alt" aria-hidden="true"></i></div>
                     
                  </div>
                  <div class="kt-widget14__legends">
                    <?php if($current_booking_amount): ?>
                        <?php $__currentLoopData = $current_booking_amount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <div class="kt-widget14__legend">
                                <span class="kt-widget14__stats"><h3><?php echo e($row->currency); ?> <?php echo e($row->booking_sum); ?></h3></span>
                             </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php else: ?>
                        <div class="kt-widget14__legend">
                            <span class="kt-widget14__stats"><h3>0</h3></span>
                        </div>
                    <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14">
               <div class="kt-widget14__header">
                  <h3 class="kt-widget14__title">
                     Commission Amount            
                  </h3>
               </div>
               <div class="kt-widget14__content">
                  <div class="kt-widget14__chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                     <div class="kt-widget14__stat"><i class="fa fa-money-bill-wave" aria-hidden="true"></i></div>
                     
                  </div>
                  <div class="kt-widget14__legends">
                    <?php if($current_commission): ?>
                        <?php $__currentLoopData = $current_commission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <div class="kt-widget14__legend">
                                <span class="kt-widget14__stats"><h3><?php echo e($row->currency); ?> <?php echo e($row->commission_sum); ?></h3></span>
                             </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="kt-widget14__legend">
                            <span class="kt-widget14__stats"><h3>0</h3></span>
                        </div>
                    <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </a>
    </div>
</div>
</div>
<!--End::Section-->


<!--End::Dashboard 8--> </div>
    <!-- end:: Content -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<!--begin::Page Vendors(used by this page) -->
<script src="<?php echo e(asset('public/backend/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')); ?>" type="text/javascript"></script>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
<script src="<?php echo e(asset('public/backend/assets/vendors/custom/gmaps/gmaps.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/backend/assets/js/demo8/pages/dashboard.js')); ?>" type="text/javascript"></script>
<!--end::Page Scripts -->
<?php $__env->stopPush(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gamarpcx/public_html/resources/views/backend/home.blade.php ENDPATH**/ ?>