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
                    <td><img src="{{ asset('public/img/logo_new.png') }}" alt="Gama Rooms" title="Gama Rooms" style="height:80px"></td>
                    <td>@if($booking->status==1)
                            <h5 class="pull-right">Booking Status : <strong>Booked</strong></h5>  
                        @else
                            <h5 class="pull-right">Booking Status : <strong>Cancelled</strong></h5> 
                        @endif
                    </td>
                </tr>
            </table>
            <table style="width:100%; border-collapse: collapse;">
                <tr style="background-color: #354867; color: #ffffff;">
                    <td align="center" style="padding: 10px;">Checkin Date <br><br> <?php $start_booking = date_create($response->CheckInDate); echo date_format($start_booking,'d-m-Y');?></td>
                    <td align="center" style="padding: 10px;">Checkout Date <br><br> <?php $start_booking = date_create($response->CheckOutDate); echo date_format($start_booking,'d-m-Y');?></td>
                    <td align="center" style="padding: 10px;">Adult(s) <br><br> {{$adult_count}}</td>
                    <td align="center" style="padding: 10px;">Child(ren) <br><br> {{$kids_count}}</td>
                </tr>
            </table>
            <table style="width:100%; border-collapse: collapse;">
                <tr>
                    <td align="center"><h5>Hotel : {{$response->Establishment->Name}}</h5>
                    @if($response_arr)
                    <h6>Address: {{$response_arr['Address']?$response_arr['Address'].",".$booking->province_name.",".$booking->country_name : $booking->province_name.",".$booking->country_name}}</h6>
                    <h6>Email: {{$response_arr['Email']?$response_arr['Email']:"--"}}</h6>
                    <h6>Phone: {{$response_arr['PhoneNumber']?$response_arr['PhoneNumber']:"--"}}</h6>
                    @endif
                    </td>
                    <td align="center"><h5>Booking Reference : {{$booking->reference_id}}</h5></td>
                </tr>
            </table>
            <h5>Travelers Details</h5>
            <?php $i=1; ?>
            @foreach($response->Rooms as $row)
            <h5>Room {{$i}}</h5>
            <table style="width:100%; border-collapse: collapse;">
                <tr style="background-color: #354867; color: #ffffff;">
                    <td align="center" style="padding: 10px;">Title</td>
                    <td align="center" style="padding: 10px;">First Name</td>
                    <td align="center" style="padding: 10px;">Last Name</td>
                </tr>
                @foreach($row->Guests as $g_row)
                <tr>
                    <td align="center" style="padding: 10px;"> {{$g_row->Title}} </td>
                    <td align="center" style="padding: 10px; text-transform:capitalize;"> {{$g_row->FirstName}} </td>
                    <td align="center" style="padding: 10px;  text-transform:capitalize;"> {{$g_row->LastName}} @if($g_row->Age <=12) {{$g_row->Age}} yrs. @endif</td>
                </tr>
                @endforeach
            </table>
            <?php $i++; ?>
            @endforeach
            
            <h3>Booking Agent Details</h3>
            <table style="width:100%; border-collapse: collapse;">
                <tr style="background-color: #ef8354; color: #ffffff;">
                    <td align="center" style="padding: 10px;">Name</td>
                    <td align="center" style="padding: 10px;">Email</td>
                </tr>
                <tr>
                    <td align="center" style="padding: 10px;"> {{$booking->agent_name}} </td>
                    <td align="center" style="padding: 10px;"> {{$booking->user_email}}</td>
                </tr>
            </table>
            <br>
            <table style="width:100%; border-collapse: collapse;">
                <tr style="background-color: #4ecdc4; color: #ffffff;">
                    <td align="left" style="padding: 10px;">Grand Total:</td>
                    <td align="right" style="padding: 10px;">{{$booking->currency}} {{$booking->booking_amount + $booking->commission}}</td>
                </tr>
            </table>
            
            <h5>Information</h5>
            <table style="width:100%; border-collapse: collapse; font-size:11px;">
                @foreach($response->InfoItems as $info_row)
                <tr >
                    <td align="left" style="padding: 3px;"><?php echo $info_row->Title ?></td>
                    <td align="left" style="padding: 3px;"><?php echo $info_row->Description ?></td>
                </tr>
                @endforeach
            </table>
    </div>
    </div>
</body>
</html>