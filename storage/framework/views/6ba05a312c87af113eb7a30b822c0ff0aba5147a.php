<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('public/backend/datatables/assets/vendors/custom/datatables/datatables.bundle.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="theme-hero-area theme-hero-area-half">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url(<?php echo e(asset('public/img/activity-adult-beach-beautiful-378152_1500x800.jpg')); ?>);"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
        <div class="theme-hero-area-inner-shadow"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-md-offset-2 theme-page-header-abs">
              <div class="theme-page-header theme-page-header-lg">
                <h1 class="theme-page-header-title">My Bookings</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<div class="theme-page-section theme-page-section-gray theme-page-section-lg" >
      <div class="container">
        <div class="row">
          <div class="col-md-12-5">
            <div class="theme-account-history" >
              <table class="table" id="kt_table_2">
                <thead>
                  <tr>
                    <th>Booking Ref.</th>
                    <th>Hotel Name</th>
                    <th>Location</th>
                    <th>CheckIn & CheckOut</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Payment Mode</th>
                    <th>Payment Success</th>
                    <th>Voucher</th>
                    <th>Cancel</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($bookings): ?>
                    <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td >
                          <?php echo e($row->reference_id); ?>

                        </td>
                        <td>
                          <?php $details = unserialize($row->response);  ?>
                          <p class="theme-account-history-type-title"><?php if(isset($row->hotel)) echo $row->hotel; else echo "--"; ?></p>
                        </td>
                        <td>
                          <?php echo e($row->province_name); ?>, <?php echo e($row->country_name); ?>

                        </td>
                        <td >
                          <p class="theme-account-history-date"><?php if(isset($row->check_in)){$exd = date_create($row->check_in); echo date_format($exd,'M d, Y');}?>
                           -<br> <?php if(isset($row->check_out)){$exd = date_create($row->check_out); echo date_format($exd,'M d, Y');}?>
                          </p>
                        </td>
                        <td>
                          <p class="theme-account-history-item-price"><?php echo e($row->currency); ?> <?php echo e($row->booking_amount+$row->commission); ?></p>
                        </td>
                        <td>
                            <?php if(empty($row->booking_ref)): ?>
                                Not Booked
                            <?php else: ?>
                                Booked
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($row->is_payment_done==0): ?>
                                Not Done
                            <?php else: ?>
                                Done
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($row->is_payment_done==1): ?>
                                <?php if($row->payment_mode==1): ?>
                                    Payment Gateway
                                <?php elseif($row->payment_mode==2): ?>
                                    Wallet
                                <?php else: ?>
                                    --
                                <?php endif; ?>
                            <?php else: ?>
                                Payment Not Done
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($row->is_payment_done==1): ?>
                                <?php if($row->payment_success==1): ?>
                                    Success
                                <?php elseif($row->payment_success==2): ?>
                                    Aborted
                                <?php elseif($row->payment_success==3): ?>
                                    Failed
                                <?php else: ?>
                                    --
                                <?php endif; ?>
                            <?php else: ?>
                                Payment Not Done
                            <?php endif; ?>
                        </td>
                        <td>
                          <a target="_blank" href="<?php echo e(url('voucher/'.base64_encode($row->reference_id))); ?>">
                            <i class="fa fa-print"></i>
                            <p>View
                              <br>receipt
                            </p>
                          </a>
                        </td>
                        <td>
                            <?php if($row->status==1): ?>
                            <?php 
                                $exd = date_create($row->check_in);  
                                $check_in = date_format($exd,'Y-m-d'); 
                                if($check_in >= date("Y-m-d"))
                                {
                            ?>
                            <a href="<?php echo e(url('cancel/'.base64_encode($row->booking_ref))); ?>" onclick="return confirm('Are you sure to cancel this booking?');">
                                <i class="fa fa-times"></i>
                                <p>Cancel
                                  <br>Booking
                                </p>
                             </a>
                             <?php } 
                             else
                             { ?>
                             <a href="javascript:void(0)" onclick="return confirm('You can not cancel this booking.');">
                                <i class="fa fa-times"></i>
                                <p>Cancel
                                  <br>Booking
                                </p>
                             </a>
                             <?php }?>
                             <?php elseif($row->status==2): ?>
                             <a href="<?php echo e(url('cancel/'.base64_encode($row->booking_ref))); ?>" onclick="return confirm('Are you sure to cancel this booking?');">
                                <p class="text-danger">Cancelled</p>
                             </a>
                             <?php else: ?>
                              --
                             <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('public/backend/datatables/assets/vendors/custom/datatables/datatables.bundle.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/backend/datatables/assets/js/demo8/pages/crud/datatables/basic/paginations.js')); ?>" type="text/javascript"></script>
<script>
    $(document).ready( function() {
    $('#kt_table_2').dataTable({
        order: [],
        columnDefs: [ {
            'targets': [0], /* column index [0,1,2,3]*/
            'orderable': false, /* true or false */
        }],
    });
})
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gamarpcx/public_html/resources/views/frontend/bookings/index.blade.php ENDPATH**/ ?>