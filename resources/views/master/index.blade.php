@include('layouts.header')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Master</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo URL::to('/');?>/home">Home</a></li>
              <li class="breadcrumb-item active">Master</li>
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
                  Master Search
                </h3>
              </div>
			  
				<form method="get" action="" name="addAccount" role="form" id="addAccount" enctype="multipart/form-data" class="form-horizontal">
			  <div class="card-body">
				
					
					<div class="form-group row mb-2">
						<label for="inputName" class="col-sm-1">Name</label>
						<div class="col-sm-2">
						  <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php if(isset($name)){ echo $name;}?>">
							
						</div>
						
						
						<label for="inputName" class="col-sm-1">Type</label>
						<div class="col-sm-2">
						  <select class="form-control" name="type" >
							<option value="">Select Type</option>
								<?php foreach($type_list as $row){ ?>
									<option value="<?=$row?>"><?=$row?></option>
								<?php } ?>
						  </select>
							
						</div>
						
					</div>
					
					
					
				</div>
					
					<div class="card-footer clearfix">
						<input type="submit" name="submit" value="Search" class="btn btn-primary">
						<input type="button" name="button" value="Clear" class="btn btn-default" onclick="window.location.href='<?php echo URL::to('/');?>/master'">
						@can('master-create')
						<a href="{{ route('master.create') }}" class="btn btn-success">Add New Master</a>
						@endcan
						
					</div>
				</form>
				
			</div>
			
			<div class="card">
              <div class="card-header">
                <h3 class="card-title">Master List</h3>
				
				
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th style="width: 40px">Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  if(count($table_list) >0){
                  
                  foreach($table_list as $key){
                  ?>
                  <tr>
                    <td><?=++$i?></td>
                    <td><?php echo $key->value;?></td>
                    <td><?php echo $key->type;?></td>
                    <td>
                    @can('master-edit')
                    <a href="<?php echo URL::to('/');?>/master/<?php echo $key->id;?>/edit" title="Edit" ><i class="fa fa-edit"></i></a> 
                    @endcan

                    @can('master-delete')
                    <a href="<?php echo URL::to('/');?>/master/delete/<?php echo $key->id;?>" title="Delete" onclick="return confirm('Are you sure remove this record?')"><i class="fa fa-trash"></i></a>
                    @endcan
                    </td>
                  </tr>
                  <?php }
                  }
                    if(count($table_list) ==0){  ?>
                      <tr> <td colspan="4">No record available</td></tr>
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
  @include('layouts.footer')