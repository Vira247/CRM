@include('layouts.header')

<style>
	.error{
		color:red
	}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo URL::to('/home'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php 
	$session = Auth()->user();
?>
    <!-- Main content -->
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
          <?php /*<div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
				<?php if($session['profile_pic'] !=''){ ?>
				<img class="profile-user-img img-fluid img-circle"
                       src="<?php echo URL::to('/'); ?>/uploads/user/<?php echo $session['profile_pic'];?>"
                       alt="User profile picture">
				
				<?php } else{ ?>
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo URL::asset('/'); ?>/uploads/avatar.png"
                       alt="User profile picture">
				<?php } ?>
                </div>

                <h3 class="profile-username text-center">{{$session->name}}</h3>

                <p class="text-muted text-center">Admin</p>

                

                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            
            <!-- /.card -->
          </div> */ ?>
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                 <!-- <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>-->
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#change_pass" data-toggle="tab">Change Password</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  
                  <!-- /.tab-pane -->
                 
                  <!-- /.tab-pane -->

					<div class="active tab-pane" id="settings">
						  <div class="form-group row">
							<label for="inputName" class="col-sm-2">Name</label>
							<div class="col-sm-10">
							  <?php echo $session['name'];?>
							</div>
						  </div>
						  <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Email</label>
							<div class="col-sm-10">
								<?php echo $session['email'];?>
							 
							</div>
						  </div>
						  <?php  if($session['mobile'] !=''){?> 
						  <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Mobile</label>
							<div class="col-sm-10">
							<?php echo $session['mobile'];?>
							 
							</div>
						  </div>
						  <?php } ?>
						  
						  
						  
						  <?php if(count($userRole) >0){?>
						  <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Role</label>
							<div class="col-sm-10">
							<?php if(count($userRole) >0){
								foreach($userRole as $role){?>
								<span class="badge badge-pill badge-light p-10 text-muted" style="font-size:14px !important"><?php echo  $role;?></span>
							<?php  } } ?>
							</div>
						  </div>
						  <?php } ?>
						
					</div>
					<div class=" tab-pane" id="change_pass">
						<form class="form-horizontal" method="post" action="<?php echo URL::to('/');?>/profile/change-password" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="id" value="<?php echo $session['id'];?>">
							<div class="form-group row">
								<label for="inputName" class="col-sm-2">Old Password <span class="error">*</span></label>
								<div class="col-sm-10">
								  <input type="password" name="old_password" class="form-control" id="inputName" placeholder="Enter old password" value="">
									<span class="error"><?php echo $errors->profile->first('old_password');?></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputName" class="col-sm-2">New Password <span class="error">*</span></label>
								<div class="col-sm-10">
								  <input type="password" name="new_password" class="form-control" id="inputName" placeholder="Enter new password" value="">
									<span class="error"><?php echo $errors->profile->first('new_password');?></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputName" class="col-sm-2">Confirm Password <span class="error">*</span></label>
								<div class="col-sm-10">
								  <input type="password" name="confirm_password" class="form-control" id="inputName" placeholder="Enter confirm password" value="">
									<span class="error"><?php echo $errors->profile->first('confirm_password');?></span>
								</div>
							</div>
						  
						  <div class="form-group row">
							<div class="offset-sm-2 col-sm-10">
							  <button type="submit" class="btn btn-danger">Update</button>
							</div>
						  </div>
						</form>
					</div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- /.content-wrapper -->
  @include('layouts.footer')