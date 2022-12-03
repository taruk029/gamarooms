@extends('backend.layouts.app')
@section('title', 'Bookings')
@push('styles')
<link href="{{ asset('public/backend/datatables/assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
    .kt-portlet--mobile
{
    overflow-x:scroll !important;
}
</style>
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
                    Bookings                 
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
<!--Begin::Section-->
<div class="row">
     <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand fa fa-building"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Confirmed Bookings
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
            <thead>
                <tr>
                    <th>Booking Date</th>
                    <th>Agent</th>
                    <th>Location</th>
                    <th>Reference Id</th>
                    <th>API Reference</th>
                    <th>Hotel</th>
                    <th>Currency</th>
                    <th>Booking Amount</th>
                    <th>Commission</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Payment Mode</th>
                    <th>Payment Success</th>
                    <th>CheckIn & CheckOut</th>
                    <th>Cancellation Amount</th>
                    <th>Cancellation Date</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1; ?>
                @foreach($bookings as $row )
                <tr>
                    <td><?php $exd = date_create($row->created_at); echo date_format($exd,'d-m-Y');?></td>
                    <td>{{ $row->agent_name  }}</td>
                    <td>{{ $row->province_name  }}, {{$row->country_name}}</td>
                    <td>{{ $row->reference_id  }}</td>
                    <td>{{ $row->booking_ref  }}</td>
                    <td><?php $details = unserialize($row->response);  ?>
                    <?php if(isset($row->hotel)) echo $row->hotel; else echo "--"; ?>
                    </td>
                    <td>{{ $row->currency  }}</td>
                    <td>{{ $row->booking_amount  }}</td>
                    <td>{{ $row->commission  }}</td>
                    <td>@if(empty($row->booking_ref))
                                Not Booked
                            @else
                                @if($row->status==1)
                                   <span class="text-success"> Booked </span>
                                @elseif($row->status==2)
                                    <span class="text-danger"> Cancelled </span>
                                @else
                                    --
                                @endif
                            @endif
                            </td>
                    <td>
                        @if($row->is_payment_done==0)
                            <button type="button" class="btn btn-sm btn-outline-danger active">Not Done</button>
                        @else
                            <button type="button" class="btn btn-sm btn-outline-success active">Done</button>
                        @endif
                    </td>
                    <td>
                        @if($row->is_payment_done==1)
                            @if($row->payment_mode==1)
                                Payment Gateway
                            @elseif($row->payment_mode==2)
                                Wallet
                            @else
                                --
                            @endif
                        @else
                            Payment Not Done
                        @endif
                    </td>
                    <td>
                        @if($row->is_payment_done==1)
                            @if($row->payment_success==1)
                                <button type="button" class="btn btn-sm btn-outline-success active">Success</button>
                            @elseif($row->payment_success==2)
                                <button type="button" class="btn btn-sm btn-outline-warning active">Aborted</button>
                            @elseif($row->payment_success==3)
                                <button type="button" class="btn btn-sm btn-outline-danger active">Failed</button>
                            @else
                                --
                            @endif
                        @else
                            <button type="button" class="btn btn-sm btn-outline-danger active">Payment Not Done</button>
                        @endif
                    </td> 
                    <td><?php $exd = date_create($row->check_in); echo date_format($exd,'d-m-Y');?> - <?php $exd1 = date_create($row->check_out); echo date_format($exd1,'d-m-Y');?></td>
                    <td>{{$row->cancellation_charge}}</td> 
                    <td><?php 
                    if(!empty($row->cancelled_on))
                    {
                        $exd = date_create($row->cancelled_on); echo date_format($exd,'d-m-Y');
                    }
                    else
                        echo "--";
                        ?>
                    </td>
                </tr>
              <?php $i++; ?>  
            @endforeach               
            </tbody>
        </table>
        <!--end: Datatable -->
    </div>
</div>   
</div>
</div>
    <!-- end:: Content -->
@endsection
@push('scripts')
<script src="{{ asset('public/backend/datatables/assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/backend/datatables/assets/js/demo8/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/backend/assets/js/demo8/pages/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<!--end::Page Scripts -->
<script>
    function form_reset()
    {
        $('#form_book').reset();
    }
</script>
@endpush
<!--End::Dashboard 8--> 

