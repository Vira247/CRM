<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Inquiry Notes</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo URL::to('/'); ?>/home">Home</a></li>
            <li class="breadcrumb-item active">Inquiry Notes</li>
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
            <div class="card-header">
              <h3 class="card-title">
                <i class="fa fa-search"></i>
                Inquiry Notes search
              </h3>
            </div>
            <form method="get" action="" name="searchPrduct" role="form" id="searchPrduct" enctype="multipart/form-data" class="form-horizontal">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Related To</label>
                    <select class="form-control" name="related_to">
                      <option value="">All</option>
                      <?php $__currentLoopData = $userList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($user->id); ?>" <?php if($related_to==$user->id ): ?> selected <?php endif; ?> ><?php echo e($user->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Follow UP Date</label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo e($date); ?>">
                  </div>
                </div>
                
              </div>
              <div class="card-footer clearfix">
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
              </div>
            </form>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Inquiry List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Created By</th>
                    <th>Created Date</th>
                    <th>Notes</th>
                    <th>Next Follow Up</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (count($table_list) > 0) {
                    foreach ($table_list as $key) {
                  ?>
                      <tr>
                        <td><?= ++$i ?></td>
                        <td><?php echo $key->name; ?></td>
                        <td><?php echo date('m/d/Y h:i A',strtotime($key->created_at)); ?></td>
                        <td><?php echo $key->description; ?></td>
                        <td><?php if($key->follow_up_date != ""){ echo date('m/d/Y',strtotime($key->follow_up_date)); }?></td>
                      </tr>
                    <?php }
                  }
                  if (count($table_list) == 0) {  ?>
                    <tr>
                      <td colspan="9">No record available</td>
                    </tr>
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
          <!-- /.col -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- /.container-fluid -->
  </section>
</div>
<!-- /.content-wrapper -->
<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppnew\htdocs\laravel_demo\resources\views/inquiry/follow_up_list.blade.php ENDPATH**/ ?>