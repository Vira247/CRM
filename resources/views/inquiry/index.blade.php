@include('layouts.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Inquiry</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo URL::to('/'); ?>/home">Home</a></li>
            <li class="breadcrumb-item active">Inquiry</li>
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
                Inquiry search
              </h3>
            </div>
            <form method="get" action="" name="searchPrduct" role="form" id="searchPrduct" enctype="multipart/form-data" class="form-horizontal">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Related To</label>
                    <select class="form-control" name="related_to">
                      <option value="">All</option>
                      <option value="Me" @if($related_to=="Me" ) selected @endif>Me</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Follow UP Date</label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="Date" value="{{$date}}">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Status</label>
                    <select class="form-control" name="status">
                      <option value="">Select Status</option>
                      <option value="Open" @if($status=="Open" ) selected @endif>Open</option>
                      <option value="Sale" @if($status=="Sale" ) selected @endif>Sale</option>
                      <option value="Close without Sale" @if($status=="Close without Sale" ) selected @endif>Close without Sale</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$name}}">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{$phone}}">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">EMail</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{$email}}">
                  </div>
                </div>
              </div>
              <div class="card-footer clearfix">
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
                <input type="button" name="button" value="Clear" class="btn btn-default" onclick="window.location.href='<?php echo URL::to('/'); ?>/inquiry'">
                @can('inquiry-create')
                <a href="{{ route('inquiry.create') }}" class="btn btn-success">Add New Inquiry</a>
                @endcan
                <a href="{{ URL::TO('follow-up-list') }}" target="_blank" class="btn btn-info">View FolloW UP Notes</a>
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
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created BY</th>
                    <th>Assigan TO</th>
                    <th>Next Follow UP Date</th>
                    <th style="width: 40px">Action</th>
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
                        <td><?php echo $key->phone; ?></td>
                        <td><?php echo $key->email; ?></td>
                        <td>
                          @if($key->status == 'Open')
                          <span class="badge bg-info">{{$key->status}}</span>
                          @elseif($key->status == 'Sale')
                          <span class="badge bg-success">{{$key->status}}</span>
                          @else
                          <span class="badge bg-danger">{{$key->status}}</span>
                          @endif
                        </td>
                        <td><?php echo $key->username; ?></td>
                        <td><?php echo $key->assignname; ?></td>
                        <td><?php echo date('m/d/Y', strtotime($key->follow_up_date)); ?></td>
                        <td>
                          @can('vendor-edit')
                          <a href="<?php echo URL::to('/'); ?>/inquiry/<?php echo $key->id; ?>" title="Show" target="_blank"><i class="fa fa-eye"></i></a>
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