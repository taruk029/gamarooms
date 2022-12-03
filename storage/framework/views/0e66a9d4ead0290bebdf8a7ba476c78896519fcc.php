<html>
    <title>Gama Rooms Booking Voucher</title>
<head>
    <link rel="stylesheet" href="http://gamarooms.com/public/frontend/css/bootstrap.css">
    <style>
        table {
    border: 1px solid #000;
}

tr {
    border-top: 1px solid #000;
}

tr + tr {
    border-top: 1px solid #fff;
}

td {
    border-left: 1px solid #000;
}

td + td {
    border-left: 1px solid #fff;
}
    </style>
</head>
<body>
    <div class="container">
        <div class="col-md-offset-2 col-md-8">
        <?php $response = unserialize($booking->response); 
        //echo "<pre>";
        //print_r($response); 
        //die;
        $adult_count = 0;
        $kids_count = 0;
        foreach($response->Rooms as $row)
        {
            foreach($row->Guests as $g_row)
            {
                if($g_row->Age <=12)
                    $kids_count++;
                else
                    $adult_count++;
            }
        }
        ?>
            <table style="width:100%;border:0px;">
                <tr>
                    <td><img src="<?php echo e(asset('public/img/logo_new.png')); ?>" alt="Gama Rooms" title="Gama Rooms" style="height:80px"></td>
                    <td><?php if($booking->status==1): ?>
                            <h5 class="pull-right">Booking Status : <strong>Booked</strong></h5>  
                        <?php else: ?>
                            <h5 class="pull-right">Booking Status : <strong>Cancelled</strong></h5> 
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            <table style="width:100%; border-collapse: collapse;">
                <tr style="background-color: #354867; color: #ffffff;">
                    <td align="center" style="padding: 10px;">Checkin Date <br><br> <?php $start_booking = date_create($response->CheckInDate); echo date_format($start_booking,'d-m-Y');?></td>
                    <td align="center" style="padding: 10px;">Checkout Date <br><br> <?php $start_booking = date_create($response->CheckOutDate); echo date_format($start_booking,'d-m-Y');?></td>
                    <td align="center" style="padding: 10px;">Adult(s) <br><br> <?php echo e($adult_count); ?></td>
                    <td align="center" style="padding: 10px;">Child(ren) <br><br> <?php echo e($kids_count); ?></td>
                </tr>
            </table>
            <table style="width:100%; border-collapse: collapse;">
                <tr>
                    <td align="center"><h5>Hotel : <?php echo e($response->Establishment->Name); ?></h5>
                    <?php if($response_arr): ?>
                    <h6>Address: <?php echo e($response_arr['Address']?$response_arr['Address'].",".$booking->province_name.",".$booking->country_name : $booking->province_name.",".$booking->country_name); ?></h6>
                    <h6>Email: <?php echo e($response_arr['Email']?$response_arr['Email']:"--"); ?></h6>
                    <h6>Phone: <?php echo e($response_arr['PhoneNumber']?$response_arr['PhoneNumber']:"--"); ?></h6>
                    <?php endif; ?>
                    </td>
                    <td align="center"><h5>Booking Reference : <?php echo e($booking->reference_id); ?></h5></td>
                </tr>
            </table>
            <h5>Travelers Details</h5>
            <?php $i=1; ?>
            <?php $__currentLoopData = $response->Rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <h5>Room <?php echo e($i); ?></h5>
            <table style="width:100%; border-collapse: collapse;">
                <tr style="background-color: #354867; color: #ffffff;">
                    <td align="center" style="padding: 10px;">Title</td>
                    <td align="center" style="padding: 10px;">First Name</td>
                    <td align="center" style="padding: 10px;">Last Name</td>
                </tr>
                <?php $__currentLoopData = $row->Guests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td align="center" style="padding: 10px;"> <?php echo e($g_row->Title); ?> </td>
                    <td align="center" style="padding: 10px; text-transform:capitalize;"> <?php echo e($g_row->FirstName); ?> </td>
                    <td align="center" style="padding: 10px;  text-transform:capitalize;"> <?php echo e($g_row->LastName); ?> <?php if($g_row->Age <=12): ?> <?php echo e($g_row->Age); ?> yrs. <?php endif; ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            <?php $i++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            <h3>Booking Agent Details</h3>
            <table style="width:100%; border-collapse: collapse;">
                <tr style="background-color: #ef8354; color: #ffffff;">
                    <td align="center" style="padding: 10px;">Name</td>
                    <td align="center" style="padding: 10px;">Email</td>
                </tr>
                <tr>
                    <td align="center" style="padding: 10px;"> <?php echo e($booking->agent_name); ?> </td>
                    <td align="center" style="padding: 10px;"> <?php echo e($booking->user_email); ?></td>
                </tr>
            </table>
            <br>
            <table style="width:100%; border-collapse: collapse;">
                <tr style="background-color: #4ecdc4; color: #ffffff;">
                    <td align="left" style="padding: 10px;">Grand Total:</td>
                    <td align="right" style="padding: 10px;"><?php echo e($booking->currency); ?> <?php echo e($booking->booking_amount + $booking->commission); ?></td>
                </tr>
            </table>
            
            <h5>Information</h5>
            <table style="width:100%; border-collapse: collapse; font-size:11px;">
                <?php $__currentLoopData = $response->InfoItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr >
                    <td align="left" style="padding: 3px;"><?php echo $info_row->Title ?></td>
                    <td align="left" style="padding: 3px;"><?php echo $info_row->Description ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
    </div>
    </div>
</body>
</html><?php /**PATH /home/gamarpcx/public_html/resources/views/frontend/emails/voucher.blade.php ENDPATH**/ ?>