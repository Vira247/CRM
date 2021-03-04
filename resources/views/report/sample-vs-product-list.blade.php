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
          <h1 class="m-0 text-dark">Product Order </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo URL::to('/'); ?>/home">Home</a></li>
            <li class="breadcrumb-item active">Sample VS Product List</li>
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
                  <label for="exampleInputEmail1">Date</label>
                  <input type="text" class="form-control" id="date" name="date" placeholder="Date" value="{{$date}}">
                </div>
                  <input type="hidden" class="form-control" id="name" name="vendor_id" placeholder="Product Name" value="{{$vendor_id}}">
                  <input type="hidden" class="form-control" id="name" name="product_type" placeholder="Product Name" value="{{$product_type}}">
                
              </div>
            </div>
            <div class="card-footer clearfix">
              <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </div>
          </form>
        </div>
        <div class="card">
          <div class="card-body">
            <table id="example2" class="table table-bordered">
              <thead>
                <tr>
                  <th>Order Id</th>
                  <th>Product Type</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
              <?php $i = 1; ?>
                @foreach($list as $deatail)
                <tr>
                  <td><a href="{{URL::to('order/'.$deatail->order_id)}}" target="_blank">{{$deatail->orders}}</a></td>
                  <td>{{$deatail->producttype}}</td>
                  <td>{{$deatail->quantity}}</td>
                  <td>{{$deatail->price}}</td>
                  <td>{{$deatail->amount}}</td>
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
<script>
  $(function() {
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
@include('layouts.footer')