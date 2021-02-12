<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Vendor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo URL::to('/');?>/home">Home</a></li>
              <li class="breadcrumb-item active">Vendor</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
	  <?php if(Session::has('success')): ?>     
        <div class="alert alert-success" role="alert">                                      
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><?php echo e(Session::get('success')); ?>

        </div> 
        <?php endif; ?>
        <?php if(Session::has('error') ): ?>                          
        <div class="alert alert-danger"> 
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><?php echo e(Session::get('error')); ?>    
        </div>                            
        <?php endif; ?>
        <div class="row">
        
          <div class="col-md-12">
            <div class="card">
			
			
			<div class="card">
              <div class="card-header">
                <h3 class="card-title">Vendor List</h3>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-create')): ?>
                <a style="float:right;" href="<?php echo e(route('vendor.create')); ?>" class="btn btn-success">Add New Vendor</a>
                <?php endif; ?> 
                <a style="float:right;" href="<?php echo e(URL::to('vendor-report-gorup-by-month-year')); ?>" class="btn btn-info" target="_blank">Vendor Report</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th style="width: 40px">Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  if(count($table_list) >0){
                  foreach($table_list as $key){
                  ?>
                  <tr>
                    <td><?=++$i?></td>
                    <td><?php echo $key->name;?></td>
                    <td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-edit')): ?>
                    <a href="<?php echo URL::to('/');?>/vendor/<?php echo $key->id;?>/edit" title="Edit" ><i class="fa fa-edit"></i></a> 
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-delete')): ?>
                    <a href="<?php echo URL::to('/');?>/vendor/delete/<?php echo $key->id;?>" title="Delete" onclick="return confirm('Are you sure remove this record?')"><i class="fa fa-trash"></i></a>
                    <?php endif; ?>
                    </td>
                  </tr>
                  <?php }
                  }
                    if(count($table_list) ==0){  ?>
                      <tr> <td colspan="3">No record available</td></tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                <?php echo $table_list->appends(Request::all())->links(); ?>
                </ul>
              </div>
            </div>
            <!-- /.card -->

        </div>
          <!-- /.col -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->
  <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppnew\htdocs\laravel_demo\resources\views/vendor/index.blade.php ENDPATH**/ ?>