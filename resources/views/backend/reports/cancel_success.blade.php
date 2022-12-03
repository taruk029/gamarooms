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
              Cancellation Details
            </h3>
        </div>
    </div>
<div class="col-md-12" style="padding:10px;">    
 <div class="col-md-8">
  <table>
    <tr>
      <td>- Status  - <strong>Cancelled</strong></td>
    </tr>
    <tr>
      <td>- Order Id  - <strong>{{$booking['reference_id']}}</strong></td>
    </tr>
    <tr>
      <td>- Booking Amount   - <strong>{{$booking['currency']}}  {{$booking['booking_amount']+$booking['commission']}}</strong></td>
    </tr>
    <tr>
      <td>- Cancellation Charge  - <strong>{{$booking['currency']}} {{$booking['cancellation_charge']}}</strong></td>
    </tr>
  </table><br>
</div>
<div class="col-md-4">
    <img src="{{ asset('public/img/cancel.png')}}" class="img-rounded pull-right" style="height:110px;">
</div>
</div>
</div>
</div>
</div>
    <!-- end:: Content -->
@endsection
@push('scripts')
@endpush
<!--End::Dashboard 8--> 

