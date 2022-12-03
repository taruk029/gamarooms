<?php $__env->startSection('title', 'Payment Details'); ?>
<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('public/assets/css/bootstrap-select.min.css')); ?>" rel="stylesheet">
<style type="text/css">
.sal{
    line-height: 50px;
}
.info_booking{
    font-size:12px;
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<?php $criteria = Session::get('criteria'); ?>
    <div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg-pattern theme-hero-area-bg-pattern-ultra-light" style="background-image:url(<?php echo e(asset('public/frontend/img/patterns/travel/4.png')); ?> ) ;"></div>
        <div class="theme-hero-area-grad-mask"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="row _pv-60">
          </div>
        </div>
      </div>
    </div>
     <div class="theme-page-section theme-page-section-lg">
      <div class="container">
        <div class="row row-col-static row-col-mob-gap" id="sticky-parent" data-gutter="60">
          <div class="col-md-8 ">
            <h2>Booking Confirmation</h2>
            <div class="theme-payment-page-sections">
              <div class="theme-payment-page-sections-item">
                <h3 class="theme-payment-page-sections-item-title">Cutomer Information</h3>
                <div class="theme-payment-page-form">
                  <div class="row row-col-gap" data-gutter="20">
                    <div class="col-md-6 ">
                      <table>
                          <?php $i =1; ?>
                            <?php if($guests): ?>
                                <?php $__currentLoopData = $guests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                      <td style="text-transform:capitalize;"><?php echo e($i); ?> - <?php echo e($row); ?></td>
                                    </tr>
                                <?php $i++; ?>   
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php if(count($kids_count)): ?>
                                <tr>
                                    <td>+ <?php echo e(count($kids_count)); ?> Child(ren)</td>
                                </tr>
                            <?php endif; ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="theme-payment-page-sections-item">
                <h3 class="theme-payment-page-sections-item-title">Booking Information</h3>
                <div class="theme-payment-page-form">
                    <div class="theme-payment-page-form _mb-20">
                  <!--<h3 class="theme-payment-page-form-title">Cutomer's Details</h3>-->
                  <form action="<?php echo e(url('pay_details')); ?>" method="post">
                      <?php echo csrf_field(); ?>
                      <input type="hidden" name="currency" value="<?php if(Session::has('currency')) { if(Session::get('currency')=="AED") echo "AED"; else echo '$';} else echo "AED"; ?>"/>
                    
                  <div class="row row-col-gap" data-gutter="20">
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Name" name="billing_name" maxlength="50" required value="<?php echo e(Auth::user()['name']); ?>">
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="email" placeholder="Email" name="billing_email" maxlength="50" required value="<?php echo e(Auth::user()['email']); ?>">
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Phone" name="billing_tel" maxlength="10" required >
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Billing Address" name="billing_address" maxlength="100" required value="">
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="City" name="billing_city"   maxlength="50" required value="<?php echo e($agent_details['city']); ?>">
                      </div>
                    </div>
                    
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Country" name="billing_country" maxlength="50" required value="<?php echo e($agent_details['name']); ?>">
                      </div>
                    </div>
                    <div class="col-md-6 ">
                        <h3 class="theme-payment-page-sections-item-title">Payment</h3>
                      <div class="theme-payment-page-form-item form-group">
                            <label class="radio-inline">
                              <input type="radio" name="payment_mode" checked value="1">Credit/Debit Card
                            </label>
                            <label class="radio-inline">
                                <?php $wallet_amount = App\Helpers\Helper::get_wallet_amount(Auth::user()['id']); ?>
                              <input type="radio" name="payment_mode" value="2" <?php if($wallet_amount < $total_amount) echo "disabled";echo " title='Your wallet has insufficient balance to make this booking';" ?> >Wallet
                            </label>
                      </div>
                    </div>
                    <input type=hidden name="merchant_id" value="<?php echo e($merchant_id); ?>">
                    <input type="hidden" name="redirect_url" value="<?php echo e(url('ccavResponseHandler')); ?>"/><br>
                    <input type="hidden" name="cancel_url" value="<?php echo e(url('ccavResponseHandler')); ?>"/><br>
                    <input type=hidden name="amount" value="<?php echo e(base64_encode($total_amount)); ?>"><br>
                    <input type="hidden" name="order_id" value="<?php echo e($product_id); ?>"/><br>  
                    <input type="hidden" name="booking_id" value="<?php echo e($booking_id); ?>"/>
                  </div>
                </div>
                  <div class="row row-col-gap" data-gutter="20">
                    
                    <div class="col-md-6 ">
                   
                    </div>
                  </div>
                </div>
                <h3 class="theme-payment-page-sections-item-title">Booking Information</h3>
                <div class="theme-payment-page-form">
                 <?php if($data->InfoItems): ?>
                 <ol class="info_booking">
                    <?php $__currentLoopData = $data->InfoItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><strong><?php echo $rows->Title; ?></strong><br><?php echo $rows->Description; ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                 <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="sticky-col">
              <div class="theme-sidebar-section _mb-10">
                <h5 class="theme-sidebar-section-title">Booking Summary</h5>
                <ul class="theme-sidebar-section-summary-list">
                  <li><?php echo e($count_rooms); ?> room, <?php echo e(count($guests)); ?> adult(s)</li>
                  <li><?php if(isset($data->Establishment->Rooms[0]->Boards[0]->Description)) echo $data->Establishment->Rooms[0]->Boards[0]->Description; else echo ""; ?> </li>
                  <li>Check-in: <?php $start_booking = date_create($start_booking_date); echo date_format($start_booking,'d-m-Y');?></li>
                  <li>Check-out: <?php $end_booking = date_create($end_booking_date); echo date_format($end_booking,'d-m-Y');?></li>
                </ul>
              </div>
              <div class="theme-sidebar-section _mb-10">
                <h5 class="theme-sidebar-section-title">Charges</h5>
                <div class="theme-sidebar-section-charges">
                  <ul class="theme-sidebar-section-charges-list">
                    <li class="theme-sidebar-section-charges-item">
                      <h5 class="theme-sidebar-section-charges-item-title"><?php $diff=date_diff($end_booking,$start_booking); echo $diff->format("%a") ?> nights</h5>
                      <p class="theme-sidebar-section-charges-item-subtitle"><?php echo e(count($guests)); ?> Guest(s)</p>
                      <p class="theme-sidebar-section-charges-item-price"><?php if(Session::has('currency')) { if(Session::get('currency')=="AED") echo "AED"; else echo '$';} else echo "AED"; ?> <?php echo e($total_amount); ?></p>
                    </li>
                  </ul>
                  <p class="theme-sidebar-section-charges-total">Total
                    <span><?php if(Session::has('currency')) { if(Session::get('currency')=="AED") echo "AED"; else echo '$';} else echo "AED"; ?> <?php echo e($total_amount); ?></span>
                  </p>
                </div>
              </div>
              <div class="theme-payment-page-sections-item">
                <div class="theme-payment-page-booking">
                  <button type="submit" class="btn _tt-uc btn-primary-inverse btn-lg btn-block">Confirm & Book</a>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
   /* window.onbeforeunload = function() {
        return "Dude, are you sure you want to leave? Think of the kittens!";
    }*/
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gamarpcx/public_html/resources/views/frontend/confirm_booking.blade.php ENDPATH**/ ?>