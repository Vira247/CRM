<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/daterangepicker/daterangepicker.css')); ?>">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Order</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo URL::to('/'); ?>/home">Home</a></li>
            <li class="breadcrumb-item active">Order</li>
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
                Order Search
              </h3>
            </div>
            <form method="get" action="" name="searchPrduct" role="form" id="searchPrduct" enctype="multipart/form-data" class="form-horizontal">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Date</label>
                    <input type="text" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo e($sdate); ?>-<?php echo e($edate); ?>">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Site</label>
                    <select class="form-control" name="site">
                      <option value="">Select Site</option>
                      <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($master->type == 'Site'): ?>
                      <option value="<?php echo e($master->id); ?>" <?php if($master->id == $site): ?> selected <?php endif; ?>><?php echo e($master->value); ?></option>
                      <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Platform</label>
                    <select class="form-control" name="platform">
                      <option value="">Select Platform</option>
                      <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($master->type == 'Platform'): ?>
                      <option value="<?php echo e($master->id); ?>" <?php if($master->id == $platform): ?> selected <?php endif; ?>><?php echo e($master->value); ?></option>
                      <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Status</label>
                    <select class="form-control" name="status">
                      <option value="">Select Platform</option>
                      <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($master->type == 'Order Status'): ?>
                      <option value="<?php echo e($master->id); ?>" <?php if($master->id == $status): ?> selected <?php endif; ?>><?php echo e($master->value); ?></option>
                      <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Order Id</label>
                    <input type="text" class="form-control" id="order_id" name="order_id" placeholder="Order ID" value="<?php echo e($order_id); ?>">
                  </div>
                </div>
              </div>
              <div class="card-footer clearfix">
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
                <input type="button" name="button" value="Clear" class="btn btn-default" onclick="window.location.href='<?php echo URL::to('/'); ?>/order'">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-create')): ?>
                <a href="<?php echo e(route('order.create')); ?>" class="btn btn-success">Add New Order</a>
                <?php endif; ?>
              </div>
            </form>
          </div>
          <div class="card">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order List (<?php echo e($table_list->toArray()['total']); ?>)</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Order ID</th>
                      <th>Order Status</th>
                      <th>Order Amount</th>
                      <th>Order Date</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (count($table_list) > 0) {
                      if (isset($page) && $page != 1) {
                        $cnt = ($page * 50) - 49;
                      } else {
                        $cnt = 1;
                      }
                      foreach ($table_list as $key) {
                    ?>
                        <tr <?php if($key->flag != ""): ?> style="background-color:<?php echo e($key->flag); ?>" <?php endif; ?>>
                          <td><?= $cnt++ ?></td>
                          <td><?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-show')): ?><a href="order/<?php echo e($key->id); ?>" target="_blank"><?php endif; ?><?php echo e($key->order_id); ?><?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-show')): ?></a><?php endif; ?></td>
                          <td><?php echo e($master_list[$key->order_status]); ?></td>
                          <td><?php echo e($key->order_amount); ?></td>
                          <td><?php if($key->order_date != ""): ?><?php echo e(date('m/d/Y',strtotime($key->order_date))); ?><?php endif; ?></td>
                          <td>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-edit')): ?>
                            <a href="<?php echo URL::to('/'); ?>/order/<?php echo $key->id; ?>/edit" target="_blank" title="Edit"><i class="fa fa-edit"></i></a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-delete')): ?>
                            <a href="<?php echo URL::to('/'); ?>/order/delete/<?php echo $key->id; ?>" title="Delete" onclick="return confirm('Are you sure remove this record?')"><i class="fa fa-trash"></i></a>
                            <?php endif; ?>
                          </td>
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
<script src="<?php echo e(asset('plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<script>
  $(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();
    $('#date').daterangepicker({
      startDate: start,
      endDate: end,
      autoUpdateInput: false,
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    }, function(chosen_date, end_date) {
      $('#date').val(chosen_date.format('MM/DD/YYYY') + ' - ' + end_date.format('MM/DD/YYYY'));
    })

    function cb1(start, end) {
      $('#date').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
    }
  });
</script>
<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppnew\htdocs\laravel_demo\resources\views/order/index.blade.php ENDPATH**/ ?>