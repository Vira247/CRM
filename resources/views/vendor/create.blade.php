@include('layouts.header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Vendor</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li  class="breadcrumb-item" ><a href="<?php echo URL::to('/')?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="breadcrumb-item" ><a href="<?php echo URL::to('/')?>/vendor">Vendor list</a></li>
				<li class="breadcrumb-item active">Add Vendor</li>
                </ol>
            </div>
            </div>
      </div><!-- /.container-fluid -->
    </div>
	
	<section class="content">
	<div class="row">
	<div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
           
			<!-- /.box-header -->
            <!-- form start -->
			<form role="form" method="post" action="<?php echo URL::to('/') ?>/vendor" enctype="multipart/form-data">
				@method('POST')
				@csrf

              <div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Name <span style="color:red;">*</span></label>
								<input type="text" name="name" id="name" class="form-control" value="<?php echo old('name'); ?>" placeholder="Name">
								<span style="color:red" id="nerror"><?php echo $errors->first('name'); ?></span>
							</div>
						</div>
                        <div class="col-md-6">
							<div class="form-group">
								<label>Contact Person Name <span style="color:red;">*</span></label>
								<input type="text" name="contact_person_name" id="contact_person_name" class="form-control" value="<?php echo old('contact_person_name'); ?>" placeholder="Contact Person Name">
								<span style="color:red" id="nerror"><?php echo $errors->first('contact_person_name'); ?></span>
							</div>
						</div>
                        <div class="col-md-6">
							<div class="form-group">
								<label>Contact e-mail address <span style="color:red;">*</span></label>
								<input type="text" name="contact_email_address" id="contact_email_address" class="form-control" value="<?php echo old('contact_email_address'); ?>" placeholder="Contact e-mail address">
								<span style="color:red" id="nerror"><?php echo $errors->first('contact_email_address'); ?></span>
							</div>
						</div>
                        <div class="col-md-6">
							<div class="form-group">
								<label>Head Office Address <span style="color:red;">*</span></label>
								<input type="text" name="head_office_address" id="head_office_address" class="form-control" value="<?php echo old('head_office_address'); ?>" placeholder="Head Office Address">
								<span style="color:red" id="nerror"><?php echo $errors->first('head_office_address'); ?></span>
							</div>
						</div>
                        <div class="col-md-6">
							<div class="form-group">
								<label>Warehouse Address <span style="color:red;">*</span></label>
								<input type="text" name="warehouse_address" id="warehouse_address" class="form-control" value="<?php echo old('warehouse_address'); ?>" placeholder="Warehouse Address">
								<span style="color:red" id="nerror"><?php echo $errors->first('warehouse_address'); ?></span>
							</div>
						</div>
					</div>
              </div>
              <!-- /.box-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" onclick="return submit_validation();">Submit</button>
				 <button type="button" onclick="window.location.href='<?php echo URL::to('vendor')?>'" class="btn btn-default">Cancel</button>
              </div>
            </form>
        </div>
    </div>
</div>
</section>
</div>
@include('layouts.footer')