<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/daterangepicker/daterangepicker.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Vendor </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo URL::to('/'); ?>/home">Home</a></li>
            <li class="breadcrumb-item active">Product</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fa fa-search"></i>
                Search
              </h3>
            </div>
            <form method="get" action="" name="searchPrduct" role="form" id="searchPrduct" enctype="multipart/form-data" class="form-horizontal">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Vendor</label>
                    <select class="form-control" name="vendor_id">
                      <option value="">Select Vendor</option>
                      <?php $__currentLoopData = $vendorList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($vendor->id); ?>" <?php if($vendor->id == $vendor_id): ?> selected <?php endif; ?>><?php echo e($vendor->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Date</label>
                    <input type="text" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo e($date); ?>">
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" value="<?php echo e($name); ?>">
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
            <h3 class="card-title">$<?php echo e(number_format($total,2)); ?></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Percentage</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
              <?php $i=1; ?>
                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $pre = 0; 
                if($total > 0){
                  $pre = ($list->amount*100)/$total;
                }
                ?>
                <tr>
                <td><?php echo e($i++); ?></td>
                <td><?php echo e($list->name); ?></td>
                <td><?php echo e(number_format($pre,2)); ?>%</td>
                <td><?php echo e(number_format($list->amount,2)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
              
            </table>
          </div>
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
<!-- DataTables -->
<script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
    var start = moment().subtract(1, 'days');
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
      $('#date').val(chosen_date.format('MM/DD/YYYY') + '-' + end_date.format('MM/DD/YYYY'));
    })

    function cb1(start, end) {
      $('#date').val(start.format('MM/DD/YYYY') + '-' + end.format('MM/DD/YYYY'));
    }
  });
</script>
<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppnew\htdocs\laravel_demo\resources\views/product/report-by-date-id.blade.php ENDPATH**/ ?>