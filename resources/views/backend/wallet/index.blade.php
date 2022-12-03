@extends('backend.layouts.app')
@section('title', 'Wallet')
@push('styles')
<link href="{{ asset('public/backend/datatables/assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
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
                                            Agent Wallet               
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
                Agent Wallet
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Agent Name</th>
                    <th>Transaction Type</th>
                    <th>Amount</th>
                    <th>Transaction Id</th>
                    <th>Created At</th>
                    <!--<th>Actions</th>-->
                </tr>
            </thead>

            <tbody>
                <?php $i = 1; ?>
                @foreach($data as $row )
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $row->name  }}</td>
                    <td>@if($row->transfer_type==1)
                            Added
                        @else
                            Deducted
                        @endif
                    </td>
                    <td>{{ $row->amount  }}</td>
                    <td>{{ $row->transaction_id  }}</td>
                    <td><?php $exd = date_create($row->created_at); echo date_format($exd,'d-m-Y');?></td> 
                    <!--<td></td>-->
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
<!--end::Page Scripts -->
@endpush
<!--End::Dashboard 8--> 

