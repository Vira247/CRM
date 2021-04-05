@include('layouts.header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create New User </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
              @csrf
                <div class="card-body">
					<div class="row">
						<div class="col-md-12">
							
							<div class="form-group">
								<label>Name <span style="color:red;">*</span></label>
								{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
								<span style="color:red" id="nerror"><?php echo $errors->first('name'); ?></span>
							
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">	
								<label>Email <span  style="color:red;" >*</span></label>
								{!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
								<span style="color:red" id="eerror"><?php echo $errors->first('email'); ?></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Mobile <span style="color:red;">*</span></label>
								<div class="input-group">
									<div class="input-group-prepend">
									  <span class="input-group-text"><i class="fas fa-phone"></i></span>
									</div>
									<input type="text" id="mobile" name="mobile" class="form-control" value="<?php echo old('mobile'); ?>" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" im-insert="true">
								  </div>
								<span  style="color:red;" id="perror"><?php echo $errors->first('mobile'); ?></span>
								
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Password <span style="color:red;">*</span></label>
								{!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
								<span style="color:red" id="passerror"><?php echo $errors->first('password'); ?></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Confirm Password <span style="color:red;">*</span></label>
								{!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
								<span style="color:red" id="cpasserror"><?php echo $errors->first('confirm-password'); ?></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">					
							<label>Role <span style="color:red;">*</span></label>
								<div class="row">
                                {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
								</div>
							<span style="color:red" id="roleserror" ><?php echo $errors->first('roles'); ?></span>
							</div>
							
							
						</div>
						
					</div>
						
					
				
              </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" onclick="window.location.href='<?php echo URL::to('/');?>/users'" class="btn btn-default">Cancel</button>
                </div>
                {!! Form::close() !!}
            </div>
          </div>
          <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  @include('layouts.footer')