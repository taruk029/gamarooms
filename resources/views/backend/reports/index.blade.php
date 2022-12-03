@extends('backend.layouts.app')
@section('title', 'Bookings')
@push('styles')
<link href="{{ asset('public/backend/datatables/assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
    .kt-portlet--mobile
{
    overflow-x:scroll !important;
}
ul.multiselect-container
{
    transform: translate3d(0px, 0px, 0px) !important;
    max-height: 200px;
    overflow-y: scroll;
    top: 35px  !important;
}
.multiselect-container label {
    margin: 0;
    white-space: nowrap;
}
.multiselect-container div.checkbox {
     padding: 5px 15px 5px 35px;
}

.checkbox{ float: left !important; margin-top:0px !important ;  margin-bottom:0px !important ; }
button.multiselect {
  background-color: initial;
  border: 1px solid #ced4da;
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
<div class="row">
     <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="fa fa-search"></i>
            </span>
            <h3 class="kt-portlet__head-title">
              Search
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
    <div class="kt-portlet__head-actions">       
    </div>  
</div>      
</div>
    </div>
    <form class="kt-form kt-form--label-right" method="post" action="{{url('admin/bookings')}}" id="form_book">
    {{ csrf_field() }}
    <div class="kt-portlet__body">
    <div class="col-md-12">    
        <div class="col-md-3">           
            <div class="form-group">
                <label>Agents</label>
                <div class='input-group'>
                    <select name="agent[]" id="agent" class="form-control" multiple>
                        @if($agents)
                            @foreach($agents as $row)
                                <option value="{{$row->id}}" <?php if(isset($_POST['agent'])) { if(in_array($row->id,$_POST['agent'])) echo "selected";} ?> >{{$row->agency_name}} - {{$row->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>        
        </div>
        <div class="col-md-3">           
            <div class="form-group">
                <label>Start Date</label>
                <div class='input-group'>
                    <input type="text" class="form-control datepicker" id="kt_datepicker_1" name="start_date" value="<?php if(isset($_POST['start_date'])) echo $_POST['start_date']; ?>"  readonly="" placeholder="Select Start date">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                    </div>
                </div>
            </div>        
        </div>
        <div class="col-md-3">           
            <div class="form-group">
                <label>End Date</label>
                <div class='input-group'>
                    <input type="text" class="form-control datepicker" id="kt_datepicker_1" name="end_date" value="<?php if(isset($_POST['end_date'])) echo $_POST['end_date']; ?>"  readonly="" placeholder="Select End date">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                    </div>
                </div>
            </div>        
        </div>
        <div class="col-md-3">           
            <div class="form-group">
                <label>Payment</label>
                <div class='input-group'>
                    <select name="is_payment_done" class="form-control">
                        <option value="">Select</option>
                        <option value="1"  <?php if(isset($_POST['is_payment_done'])) { if($_POST['is_payment_done']==1) echo "selected";} ?>>Done</option>
                        <option value="2"  <?php if(isset($_POST['is_payment_done'])) { if($_POST['is_payment_done']==2) echo "selected";} ?>>Return</option>
                    </select>
                </div>
            </div>        
        </div>
        <div class="col-md-3">           
            <div class="form-group">
                <label>Payment Mode</label>
                <div class='input-group'>
                    <select name="payment_mode" class="form-control">
                        <option value="">Select</option>
                        <option value="1"  <?php if(isset($_POST['payment_mode'])) { if($_POST['payment_mode']==1) echo "selected";} ?>>Payment Gateway</option>
                        <option value="2"  <?php if(isset($_POST['payment_mode'])) { if($_POST['payment_mode']==2) echo "selected";} ?>>Wallet</option>
                    </select>
                </div>
            </div>        
        </div>
        <div class="col-md-3">           
            <div class="form-group">
                <label>Payment Success</label>
                <div class='input-group'> 
                    <select name="payment_success" class="form-control">
                        <option value="">Select</option>
                        <option value="1"  <?php if(isset($_POST['payment_success'])) { if($_POST['payment_success']==1) echo "selected";} ?>>Success</option>
                        <option value="2" <?php if(isset($_POST['payment_success'])) { if($_POST['payment_success']==2) echo "selected";} ?>>Aborted</option>
                        <option value="3" <?php if(isset($_POST['payment_success'])) { if($_POST['payment_success']==3) echo "selected";} ?>>Failed</option>
                    </select>
                </div>
            </div>        
        </div>
    </div>     
    </div>      
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <div class="row">
                <div class="col-10">
                    <button type="submit" class="btn btn-success">Search</button>
                    <!--<input type="reset" class="btn btn-warning" value="Reset" onclick="javascript:form_reset()">-->
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
</div>

<!--Begin::Section-->
<div class="row">
     <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-building"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Bookings
                </h3>
            </div>
        </div>
        
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
            <div class="kt-portlet__head-actions">
               &nbsp;
               <form class="kt-form kt-form--label-right px-5" method="post" action="{{url('admin/export_booking')}}" id="" >
                {{ csrf_field() }}
                <select name="agent[]" id="agent1" class="form-control" multiple style="display:none;">
                    @if($agents)
                        @foreach($agents as $row)
                            <option value="{{$row->id}}" <?php if(isset($_POST['agent'])) { if(in_array($row->id,$_POST['agent'])) echo "selected";} ?> >{{$row->name}}</option>
                        @endforeach
                    @endif
                </select>
                <input type="hidden" class="form-control datepicker" id="kt_datepicker_1" name="start_date" value="<?php if(isset($_POST['start_date'])) echo $_POST['start_date']; ?>"  readonly="" placeholder="Select Start date">
                <input type="hidden" class="form-control datepicker" id="kt_datepicker_1" name="end_date" value="<?php if(isset($_POST['end_date'])) echo $_POST['end_date']; ?>"  readonly="" placeholder="Select End date">
                <select name="is_payment_done" class="form-control" style="display:none;">
                    <option value="">Select</option>
                    <option value="1"  <?php if(isset($_POST['is_payment_done'])) { if($_POST['is_payment_done']==1) echo "selected";} ?>>Done</option>
                    <option value="2"  <?php if(isset($_POST['is_payment_done'])) { if($_POST['is_payment_done']==2) echo "selected";} ?>>Not Done</option>
                </select>
                <select name="payment_mode" class="form-control" style="display:none;">
                    <option value="">Select</option>
                    <option value="1"  <?php if(isset($_POST['payment_mode'])) { if($_POST['payment_mode']==1) echo "selected";} ?>>Payment Gateway</option>
                    <option value="2"  <?php if(isset($_POST['payment_mode'])) { if($_POST['payment_mode']==2) echo "selected";} ?>>Wallet</option>
                </select>
                <select name="payment_success" class="form-control" style="display:none;">
                    <option value="">Select</option>
                    <option value="1"  <?php if(isset($_POST['payment_success'])) { if($_POST['payment_success']==1) echo "selected";} ?>>Success</option>
                    <option value="2" <?php if(isset($_POST['payment_success'])) { if($_POST['payment_success']==2) echo "selected";} ?>>Aborted</option>
                    <option value="3" <?php if(isset($_POST['payment_success'])) { if($_POST['payment_success']==3) echo "selected";} ?>>Failed</option>
                </select>
                <button type="submit" class=" pull-right btn btn-brand btn-elevate btn-icon-sm"><i class="la la-download"></i> Export Excel</button>
                </form>
            </div>  
        </div>      
        </div>
    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_2">
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
                    <th>Cancel</th>
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
                    <td><?php $exd = date_create($row->check_in); echo date_format($exd,'d-m-Y');?> / <?php $exd1 = date_create($row->check_out); echo date_format($exd1,'d-m-Y');?></td>
                    <td>
                        @if($row->status==1)
                        <?php 
                            $exd = date_create($row->check_in);  
                            $check_in = date_format($exd,'Y-m-d'); 
                            if($check_in >= date("Y-m-d"))
                            {
                        ?>
                        <a href="{{ url('admin/admin_cancel_booking/'.base64_encode($row->booking_ref))}}" onclick="return confirm('Are you sure to cancel this booking?');">
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
                         @elseif($row->status==2)
                         <a href="{{ url('admin/admin_cancel_booking/'.base64_encode($row->booking_ref))}}" onclick="return confirm('Are you sure to cancel this booking?');">
                            <p class="text-danger">Cancelled</p>
                         </a>
                         @else
                          --
                         @endif
                    </td>
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
 <script src="{{ asset('public/backend/js/bootstrap-multiselect.min.js') }}"></script>
<!--end::Page Scripts -->
<script type="text/javascript">
  /*  $(document).ready( function () 
    {
    $('#kt_table_1').dataTable({ "bSort" : false,"bInfo": false});
} );*/
</script>
<script>
        $(document).ready(function() {
            
    $('#kt_table_2').DataTable({ "bSort" : false});
    
    $('#agent').multiselect({
        templates: { // Use the Awesome Bootstrap Checkbox structure
            li: '<li><div class="checkbox"><label></label></div></li>'
        }
    });
});
</script>
<script>
    function form_reset()
    {
        $('#form_book').reset();
    }
</script>
@endpush
<!--End::Dashboard 8--> 

