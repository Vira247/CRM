@include('layouts.header')
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
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
      @if(Session::has('success'))
      <div class="alert alert-success" role="alert">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>{{ Session::get('success') }}
      </div>
      @endif
      @if(Session::has('error') )
      <div class="alert alert-danger">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>{{ Session::get('error') }}
      </div>
      @endif
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
                    <input type="text" class="form-control" id="date" name="date" placeholder="Date" value="{{$sdate}}-{{$edate}}">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Site</label>
                    <select class="form-control" name="site">
                      <option value="">Select Site</option>
                      @foreach ($masterList as $master)
                      @if($master->type == 'Site')
                      <option value="{{$master->id}}" @if($master->id == $site) selected @endif>{{$master->value}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Platform</label>
                    <select class="form-control" name="platform">
                      <option value="">Select Platform</option>
                      @foreach ($masterList as $master)
                      @if($master->type == 'Platform')
                      <option value="{{$master->id}}" @if($master->id == $platform) selected @endif>{{$master->value}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Status</label>
                    <select class="form-control" name="status">
                      <option value="">Select Platform</option>
                      @foreach ($masterList as $master)
                      @if($master->type == 'Order Status')
                      <option value="{{$master->id}}" @if($master->id == $status) selected @endif>{{$master->value}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Order Id</label>
                    <input type="text" class="form-control" id="order_id" name="order_id" placeholder="Order ID" value="{{$order_id}}">
                  </div>
                </div>
              </div>
              <div class="card-footer clearfix">
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
                <input type="button" name="button" value="Clear" class="btn btn-default" onclick="window.location.href='<?php echo URL::to('/'); ?>/order'">
                @can('order-create')
                <a href="{{ route('order.create') }}" class="btn btn-success">Add New Order</a>
                @endcan
              </div>
            </form>
          </div>
          <div class="card">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order List ({{$table_list->toArray()['total']}})</h3>

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
                        <tr @if($key->flag != "") style="background-color:{{$key->flag}}" @endif>
                          <td><?= $cnt++ ?></td>
                          <td>@can('order-show')<a href="order/{{$key->id}}" target="_blank">@endcan{{$key->order_id}}@can('order-show')</a>@endcan</td>
                          <td>{{$master_list[$key->order_status]}}</td>
                          <td>{{$key->order_amount}}</td>
                          <td>@if($key->order_date != ""){{date('m/d/Y',strtotime($key->order_date))}}@endif</td>
                          <td>
                            @can('vendor-edit')
                            <a href="<?php echo URL::to('/'); ?>/order/<?php echo $key->id; ?>/edit" target="_blank" title="Edit"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can('vendor-delete')
                            <a href="<?php echo URL::to('/'); ?>/order/delete/<?php echo $key->id; ?>" title="Delete" onclick="return confirm('Are you sure remove this record?')"><i class="fa fa-trash"></i></a>
                            @endcan
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
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
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
@include('layouts.footer')