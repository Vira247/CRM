@include('layouts.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Vendor ${{number_format($finalTotal,2)}}</h1>
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            
            <!-- /.card -->

            <!-- DONUT CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Donut Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- PIE CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Pie Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

         
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
  <section class="content">
    <div class="row">
      <div class="col-md-12">
      <?php $monthlist = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December'); ?>
        @foreach($lists as $key=>$list)
        @if(count($list) > 0)
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{$key}} $@if(isset($finalVendorTotal[$key])){{number_format($finalVendorTotal[$key],2)}}@else 0.00 @endif</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Year Month</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $cnt = 0;
                $total = 0;
                $totals = 0;
                if(isset($finalVendorTotal[$key])){
                  $totals = $finalVendorTotal[$key];
                }
                foreach ($list as $year => $listyear) {

                  foreach ($listyear as $month => $listmonth) {
                    $pre = 0;
                    $pre = number_format(((100 * $listmonth['amount']) / $totals), 2);
                ?>
                    <tr>
                      <td><?php echo ++$cnt; ?></th>
                      <td style="background:linear-gradient(90deg, rgba(45, 246, 8) 0%, rgba(255, 214, 214) <?= $pre ?>%, rgba(255,255,255,1) <?= $pre ?>%)">
                        <?php if ($key != "") { ?>
                          <a href="<?php echo URL::to('vender-order-by-month/' . $listmonth['id'] . '/' . $year . '/' . $month) ?>" target="_blank">
                          <?php } ?>
                          <?php echo $year . ' ' . $monthlist[$month]; ?> (<?= $pre ?>)
                          <?php if ($key != "") { ?>
                          </a>
                        <?php } ?>
                        </th>
                      <td><?php echo number_format($listmonth['amount'], 2); ?></th>
                    </tr>
                <?php //$total = $total + $listmonth->subtotal;
                  }
                }                      ?>

              </tbody>
              
            </table>
          </div>
        </div>
        @endif
        @endforeach
        <!-- /.col -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- /.container-fluid -->
  </section>
</div>
<!-- /.content-wrapper -->
@include('layouts.footer')
<script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{ asset('dist/js/demo.js')}}"></script>
<script>
  $(function () {
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [@foreach($lists as $key=>$list)
        @if(count($list) > 0)'{{$key}}',@endif
        @endforeach],
      datasets: [
        {
          data: [@foreach($lists as $key=>$list)
        @if(count($list) > 0){{$finalVendorTotal[$key]}},@endif
        @endforeach],
          backgroundColor : [@foreach($lists as $key=>$list)
        @if(count($list) > 0)'#{{str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT)}}',@endif
        @endforeach],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })


  })
</script>