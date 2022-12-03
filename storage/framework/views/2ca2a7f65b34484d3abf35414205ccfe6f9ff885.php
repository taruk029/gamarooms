<script src="<?php echo e(asset('public/frontend/js/jquery.js')); ?>"></script>
<script>
    $(document).ready(function(){
    setTimeout(function(){ $( "#myform" ).submit(); }, 4000);
});
</script>
<center><img src="<?php echo e(asset('public/img/loader.gif')); ?>" >
<h2>Please wait, while we are redirecting you to the payment.</h2>
</center>
<form method="post" name="customerData" id="myform" action="https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction">
<input type=hidden name="encRequest" value="<?php echo e($encrypted_data); ?>"><br>
<input type=hidden name="access_code" value="<?php echo e($access_code); ?>"><br><br>
<input type="hidden" name="language" value="EN"/><br>
<input type="hidden" name="order_id" value="<?php echo e($product_id); ?>"/><br>
<input type="hidden" name="customer_identifier" value=""/><br>
<?php date('Y-m-d h:i:s') ?>
<input type="submit" value="submit" style="display:none;">
</form><?php /**PATH /home/gamarpcx/public_html/resources/views/frontend/make_payment.blade.php ENDPATH**/ ?>