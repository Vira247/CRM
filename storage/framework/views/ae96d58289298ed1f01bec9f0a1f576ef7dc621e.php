<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Sample VS Product By Month</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo URL::to('/'); ?>/home">Home</a></li>
            <li class="breadcrumb-item active">Vendor</li>
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
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Year Month</th>
                  <th>Sample</th>
                  <th>Product</th>
                  <th>Accessory</th>
                </tr>
              </thead>
              <?php $__currentLoopData = $finalArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year=>$monthdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $__currentLoopData = $monthdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php 
              $monthlist = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
              $date = $year.'-'.$month.'-01';
              $sdate = date("m/d/Y", strtotime($date));
              $edate = date("m/t/Y", strtotime($date));
              ?>
              <tr>
                  <td><a href="<?php echo e(URL::to('sample-vs-product?date='.$sdate.'-'.$edate)); ?>" target="_blank"><?php echo e($year.'-'.$monthlist[$month]); ?></a></th>
                  <td><?php echo e(isset($data['Sample'])?$data['Sample']:'0'); ?></td>
                  <td><?php echo e(isset($data['Product'])?$data['Product']:'0'); ?></td>
                  <td><?php echo e(isset($data['Accessory'])?$data['Accessory']:'0'); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <tbody>
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
<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppnew\htdocs\laravel_demo\resources\views/report/report-sample-product-count.blade.php ENDPATH**/ ?>