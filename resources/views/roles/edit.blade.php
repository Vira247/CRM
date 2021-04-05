@include('layouts.header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create New Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Home</a></li>
              <li class="breadcrumb-item active">Role</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
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
                    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
              @csrf
                <div class="card-body">
                    <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Role Name <span style="color:red;">*</span></label>
                                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                            <span style="color:red;">{{ $errors->first('RoleName') }}</span>
                                        </div>
                                    </div>
                                    
                                </div> 
                                
								<div class="col-md-12">
									<label>Permission <span style="color:red;">*</span></label>
									<div class="form-group">
										<div class="row">
                                        @foreach($permission as $value)
												<div class="col-md-4">
												<label>
                                                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
												<?php 
													echo $value->name;
												?>
												</label>
												</div>
											@endforeach
										<span style="color:red;">{{ $errors->first('permission') }}</span>
											<span style="color:red;" id="perror"></span>
										</div>
									</div>
								</div>
                              
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" onclick="window.location.href='<?php echo URL::to('/');?>/roles'" class="btn btn-default">Cancel</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.card -->

            <!-- Form Element sizes -->
            

            <!-- Input addon -->
            
            <!-- Horizontal Form -->
            
          </div>
          <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  @include('layouts.footer')