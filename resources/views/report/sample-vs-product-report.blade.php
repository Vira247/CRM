@include('layouts.header')
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Sample VS Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo URL::to('/'); ?>/home">Home</a></li>
            <li class="breadcrumb-item active">Sample VS Product</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
            
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
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
                  <label for="exampleInputEmail1">Date</label>
                  <input type="text" class="form-control" id="date" name="date" placeholder="Date" value="{{$date}}">
                </div>
              </div>
            </div>
            <div class="card-footer clearfix">
              <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </div>
          </form>
        </div>
        <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Stacked Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              
            </div>
        <div class="card">
          <div class="card-body">
            <table id="example2" class="table table-bordered">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Vendor</th>
                  <th>No. of Samples</th>
                  <th>Total Sample Order Value ($)</th>
                  <th>No. of Product Orders</th>
                  <th>Total Product Order Value ($)</th>
                  <th>No. of Accessory Orders</th>
                  <th>Total Accessory Order Value ($)</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                @foreach($vendorList as $list)
                <tr>
                  <td>{{$i++}}</td>
                  <td>{{$list->name}}</td>
                  <td><a href="{{URL::to('report/sample-vs-product?product_type=Sample&vendor_id='.$list->id.'&date='.$date)}}" target="_blank" >{{number_format($list->sample->noorders,2)}}</a></td>
                  <td>{{number_format($list->sample->amountorders,2)}}</td>
                  <td><a href="{{URL::to('report/sample-vs-product?product_type=Product&vendor_id='.$list->id.'&date='.$date)}}" target="_blank" >{{number_format($list->product->noorders,2)}}</a></td>
                  <td>{{number_format($list->product->amountorders,2)}}</td>
                  <td><a href="{{URL::to('report/sample-vs-product?product_type=Accessory&vendor_id='.$list->id.'&date='.$date)}}" target="_blank" >{{number_format($list->accessory->noorders,2)}}</a></td>
                  <td>{{number_format($list->accessory->amountorders,2)}}</td>
                </tr>
                @endforeach

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
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
  <script src="{{ asset('dist/js/demo.js')}}"></script>
<script>
  $(function() {
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
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    
    var areaChartData = {
      //labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      labels  : [@foreach($vendorList as $list) '{{$list->name}}', @endforeach],
      datasets: [
        {
          label               : 'Samaple',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [@foreach($vendorList as $list) {{number_format($list->sample->noorders,2)}}, @endforeach]
        },
        {
          label               : 'Product',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [@foreach($vendorList as $list) {{number_format($list->product->noorders,2)}}, @endforeach]
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

   
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
   
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    
    //-------------
    //- BAR CHART -
    //-------------
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0


    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = jQuery.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    var stackedBarChart = new Chart(stackedBarChartCanvas, {
      type: 'bar', 
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>
@include('layouts.footer')