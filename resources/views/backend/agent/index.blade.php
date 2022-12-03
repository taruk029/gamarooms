@extends('backend.layouts.app')
@section('title', 'Agents')
@push('styles')
<link href="{{ asset('public/backend/datatables/assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<style>
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
                    Agent List                    
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
                Agent List
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Agency Name/Email</th>
                    <th>City, Country</th>
                    <th>IATA Status</th>
                    <th>Commission</th>
                    <th>Wallet Amount</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1; ?>
                @foreach($agents as $row )
                <tr>
                    <td>{{ $row->name  }}</td>
                    <td>{{ $row->agency_name?$row->agency_name:'NA'  }}/{{ $row->agency_email?$row->agency_email:'NA'  }}</td>
                    <td>{{ $row->city?$row->city:'NA'  }}, {{ $row->country?$row->country:'NA'  }}</td>
                    <td>{{ $row->iata_status  }}</td>
                    <td>{{ $row->commission  }}</td>
                    <td>{{App\Helpers\Helper::get_wallet_amount($row->id)?App\Helpers\Helper::get_wallet_amount($row->id):"0.00"}}</td>
                    <td><?php $exd = date_create($row->created_at); echo date_format($exd,'d-m-Y');?></td> 
                    <td>
                        @if($row->is_active==0)
                        <a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="javascript:void(0)"  onclick="javascript:open_modal({{$row->id}})" title="Approve Agent" >
                            <i class="fa fa-check"></i>
                        </a>
                        <a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="{{url('admin/reject_agent/'.$row->id)}}" title="Reject Agent" >
                            <i class="fa fa-times"></i>
                        </a>
                        @else
                        
                            @if($row->is_active==1)
                                <span class="kt-badge kt-badge--success kt-badge--inline">Approved</span>
                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="{{url('admin/wallet/'.$row->id)}}" title="View Agent Wallet" >
                                <i class="fa fa-wallet"></i>
                                </a>
                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md"  onclick="javascript:open_wallet_modal({{$row->id}})" title="Wallet Transaction" >
                                    <i class="fa fa-plus-square"></i>
                                </a>
                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="{{url('admin/agent_status/'.$row->id.'/3')}}" title="Deactivate Agent" >
                                    <i class="fa fa-window-close"></i>
                                </a>
                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md" onclick="javascript:commissionModal({{$row->id}}, '{{$row->commission}}')" title="Change Commission Percentage" >
                                    <i class="fa fa-percent"></i>
                                </a>
                            @elseif($row->is_active==3)
                                <span class="kt-badge kt-badge--danger kt-badge--inline">Deactivated</span>
                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="{{url('admin/agent_status/'.$row->id.'/1')}}" title="Activate Agent" >
                                    <i class="fa fa-check"></i>
                                </a>
                            @else
                                <span class="kt-badge kt-badge--danger kt-badge--inline">Rejected</span>
                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="{{url('admin/agent_status/'.$row->id.'/1')}}" title="Activate Agent" >
                                    <i class="fa fa-check"></i>
                                </a>
                            @endif
                            
                        @endif
                    </td>
                </tr>
              <?php $i++; ?>  
            @endforeach                
            </tbody>
        </table>
        <!--end: Datatable -->
    </div>
</div>    
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Set Commission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="{{url('admin/approve_agent')}}" method="post">
        @csrf
      <div class="modal-body">
        <input type="hidden" class="form-control" id="userid" name="userid">
        <div class="form-group">
         <label for="recipient-name" class="col-form-label">Commission Percentage:</label>
         <input type="text" class="form-control" id="recipient-name" name="commission">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="javascript:close_set_modal()">Close</button>
        <button type="submit" class="btn btn-primary">Approve</button>
      </div>
      
        </form>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleWalletModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Wallet Transaction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
        <form action="{{url('admin/add_agent_wallet')}}" method="post">
        @csrf
      <div class="modal-body">
        <input type="hidden" class="form-control" id="user_wallet_id" name="user_wallet_id">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Amount:</label>
            <input type="text" class="form-control" id="recipient-name" name="amount" required onkeypress="return NumbersOnly(event,this)" maxlength="10">
          
            <label for="recipient-name" class="col-form-label">Transfer Type</label>
            <div class="kt-radio-inline">
                <label class="kt-radio">
                    <input type="radio" name="transfer_type" checked="checked" value="1"> Add
                    <span></span>
                </label>
                <label class="kt-radio">
                    <input type="radio" name="transfer_type" value="2"> Deduct
                    <span></span>
                </label>
            </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="javascript:close_wallet_modal()">Close</button>
        <button type="submit" class="btn btn-primary">Transfer</button>
      </div>
      
        </form>
    </div>
  </div>
</div>
<div class="modal fade" id="commissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Commission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="{{url('admin/update_commission')}}" method="post">
        @csrf
      <div class="modal-body">
        <input type="hidden" class="form-control" id="userid_commission" name="userid_commission">
        <div class="form-group">
         <label for="recipient-name" class="col-form-label">Commission Percentage:</label>
         <input type="text" class="form-control" name="new_commission" id="new_commission">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="javascript:close_modal()">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      
        </form>
    </div>
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
<script>
    function open_modal(id)
    {
        $("#userid").val(id);
        $("#exampleModal").show();
        $("#exampleModal").removeClass('fade');
    } 
    function close_set_modal(id)
    {
        $("#exampleModal").hide();
        $("#exampleModal").addClass('fade');
    }
    
</script>
<script>
    function commissionModal(id, commission)
    {
        $("#userid_commission").val(id);
        $("#new_commission").val(commission);
        $("#commissionModal").show();
        $("#commissionModal").removeClass('fade');
    } 
    function close_modal(id)
    {
        $("#commissionModal").hide();
        $("#commissionModal").addClass('fade');
    }
    
</script>
<script>
    function open_wallet_modal(id)
    {
        $("#user_wallet_id").val(id);
        $("#exampleWalletModal").show();
        $("#exampleWalletModal").removeClass('fade');
    } 
    function close_wallet_modal(id)
    {
        $("#exampleWalletModal").hide();
        $("#exampleWalletModal").addClass('fade');
    }
    
</script>
@endpush
<!--End::Dashboard 8--> 

