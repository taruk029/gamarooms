@extends('backend.layouts.app')
@section('title', 'Cancel Bookings')
@push('styles')
@endpush
@section('content')
<!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Dashboard
            </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="#" class="kt-subheader__breadcrumbs-link">
                    Cancel Bookings                 
                </a>
        </div>
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
<div class="row">
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="fa fa-search"></i>
            </span>
            <h3 class="kt-portlet__head-title">
              Cancel Booking
            </h3>
        </div>
    </div>
<div class="col-md-12" style="padding:10px;">    
 <div class="col-md-8">
  <table>
      <?php $i =1; ?>
        @if($data)
            @if($data->IsCancellable==1)
                <tr>
                  <td>- Booking Reference  - <strong>{{$booking['reference_id']}}</strong></td>
                </tr>
                <tr>
                  <td>- Booking Amount  - <strong>{{$booking['currency']}} {{$booking['booking_amount']+$booking['commission']}}</strong></td>
                </tr>
                @if(isset($data->CancellationPolicyStatic[0]->CancellationCharges))
                <?php $is_true = 0;
                    $amount = 0;
                    $currency = "";?>
                @foreach($data->CancellationPolicyStatic[0]->CancellationCharges as $rows)
                    <tr><td><br></td></tr>
                    <tr>
                      <td>- Expiry Date - <strong><?php $exd = date_create($rows->ExpiryDate); echo date_format($exd,'M d, Y'); ?></strong></td>
                    </tr>
                    <tr><td><br></td></tr>
                    <tr>
                      <td>- Cancellation Charge - <strong>{{$rows->Charge->Currency}} {{$rows->Charge->Amount}}</strong></td>
                    </tr>
                    <tr>
                      <td><h5>You will be charged {{$rows->Charge->Currency}} {{$rows->Charge->Amount}} for cancelling this booking till <?php $exd = date_create($rows->ExpiryDate); echo date_format($exd,'M d, Y'); ?>.</h5></td>
                    </tr>
                    <?php
                    $cur_date =  date("Y-m-d H:i:s");
                    $exd = date_create($rows->ExpiryDate); $check_date = date_format($exd,'Y-m-d H:i:s');
                    if($cur_date<=$check_date)
                    {
                        if($is_true==0)
                        {
                            $amount = $rows->Charge->Amount;
                            $currency = $rows->Charge->Currency;
                        }
                        $is_true=1;
                    } 
                    ?>
                @endforeach
                @endif
            @else
            <tr>
              <td><h3>Sorry, you can not cancel this booking.</h3></td>
            </tr>
            @endif
        @endif
  </table><br>
</div>
<div class="col-md-4">
    <img src="{{ asset('public/img/cancel.png')}}" class="img-rounded pull-right" style="height:110px;">
</div>
</div>
<hr>
<div class="col-md-offset-4 col-md-4">
    <a href="{{url('admin/admin_confirm_cancel/'.$booking_id."/".base64_encode($amount)."/".base64_encode($currency))}}" class="btn btn-sm btn-outline-danger active" onclick="return confirm('Are you sure to cancel this booking?');">Confirm to Cancel !</a>
</div>
</div>
</div>
</div>
    <!-- end:: Content -->
@endsection
@push('scripts')
@endpush
<!--End::Dashboard 8--> 

