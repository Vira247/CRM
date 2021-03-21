<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ChartJS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ChartJS</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Last 30 Days Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
			<div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Top 10 Product</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>SKU</th>
                      <th>Product</th>
                      <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php $__currentLoopData = $top10Product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($product->sku); ?></td>
                      <td><?php echo e($product->name); ?></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo e(number_format($product->amount,2)); ?></div>
                      </td>
                    </tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
            </div>
            <!-- /.card -->

            <!-- DONUT CHART -->
            <!-- /.card -->

            <!-- PIE CHART -->
            <!-- /.card -->

          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            <!-- /.card -->

            <!-- BAR CHART -->
            <!-- /.card -->

            <!-- STACKED BAR CHART -->
            
            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script src="<?php echo e(asset('plugins/chart.js/Chart.min.js')); ?>"></script>
  <script src="<?php echo e(asset('dist/js/demo.js')); ?>"></script>
  <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : [<?php $__currentLoopData = $grphdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> '<?php echo e($key); ?>', <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php $__currentLoopData = $grphdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($value); ?>, <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas, { 
      type: 'line',
      data: areaChartData, 
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    
  })
</script><?php /**PATH C:\xamppnew\htdocs\laravel_demo\resources\views/home.blade.php ENDPATH**/ ?>