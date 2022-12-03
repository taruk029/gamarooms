<?php $__env->startSection('title', 'Medias'); ?>
<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('backend/datatables/assets/vendors/custom/datatables/datatables.bundle.css')); ?>" rel="stylesheet" type="text/css" />
<style type="text/css">
    .kt-portlet--mobile
{
    overflow-x:scroll !important;
}
.img {
  display: block;
  max-width:230px;
  max-height:95px;
  width: auto;
  height: auto;
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
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
                    Medias                 
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
                <i class="kt-font-brand fa fa-image"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Medias
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
            <thead>
                <tr>
                    <th>Page</th>
                    <th>Name</th>
                    <th>Image Name</th>
                    <th>Image</th>
                    <th>Image Size</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1; ?>
                <?php $__currentLoopData = $medias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($row->page_title); ?></td>
                    <td><?php echo e($row->name); ?></td>
                    <td><?php echo e($row->image_name); ?></td>                   
                    <td>
                            <?php if(!empty($row->image_name)): ?>
                                <?php if(file_exists(base_path().'/img/side_bannners/'.$row->image_name)): ?>   
                                    <img src="<?php echo e($row->image_url); ?>" class="img-thumb img" > 
                                <?php else: ?>
                                     <img src="<?php echo e($row->image_url); ?>" class="img-thumb img"> 
                                <?php endif; ?>
                            <?php endif; ?>
                    </td>                       
                    <td><?php echo e($row->image_size); ?></td>                  
                    <td>
                        <a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="javascript:void(0)"  onclick="javascript:open_modal(<?php echo e($row->id); ?>)" title="Change Image" >
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>
              <?php $i++; ?>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>               
            </tbody>
        </table>
        <!--end: Datatable -->
    </div>
</div>  
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="<?php echo e(url('admin/change_image')); ?>" method="post" enctype='multipart/form-data'>
        <?php echo csrf_field(); ?>
      <div class="modal-body">
        <input type="hidden" class="form-control" id="image_id" name="image_id">
        <div class="form-group">
         <label for="recipient-name" class="col-form-label">Image</label>
         <input type="file" class="form-control" id="image" name="image" required="required">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="javascript:close_set_modal()">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      
        </form>
    </div>
  </div>
</div> 
</div>
</div>
    <!-- end:: Content -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('backend/datatables/assets/vendors/custom/datatables/datatables.bundle.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('backend/datatables/assets/js/demo8/pages/crud/datatables/basic/paginations.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('backend/assets/js/demo8/pages/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
<!--end::Page Scripts -->
<script>
    function form_reset()
    {
        $('#form_book').reset();
    }
</script>
<script>
    function open_modal(id)
    {
        $("#image_id").val(id);
        $("#exampleModal").show();
        $("#exampleModal").removeClass('fade');
    } 
    function close_set_modal(id)
    {
        $("#exampleModal").hide();
        $("#exampleModal").addClass('fade');
    }
    
</script>
<?php $__env->stopPush(); ?>
<!--End::Dashboard 8--> 


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\gamarooms\resources\views/backend/media/index.blade.php ENDPATH**/ ?>