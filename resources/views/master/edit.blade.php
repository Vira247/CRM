@include('layouts.header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Master</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li  class="breadcrumb-item" ><a href="<?php echo URL::to('/')?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="breadcrumb-item" ><a href="<?php echo URL::to('/')?>/master">Master list</a></li>
				<li class="breadcrumb-item active">Edit Master</li>
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
			{!! Form::model($master_detail, ['method' => 'PATCH','route' => ['master.update', $master_detail->id],'enctype' => "multipart/form-data"]) !!}
			

              <div class="card-body">
					<div class="row">
						<div class="col-md-6">
							
							<div class="form-group">
								<label>Type <span style="color:red;">*</span></label>
								<select class="form-control" name="type" >
									<option value="">Select Type</option>
									<?php foreach($type_list as $row){ ?>
										<option value="<?=$row?>" <?php if($master_detail->type == $row){ echo "selected"; }?>><?=$row?></option>
									<?php } ?>
								</select>
								<span style="color:red" id="nerror"><?php echo $errors->first('type'); ?></span>
							
							</div>
							
							<div class="form-group">
								<label>Name <span style="color:red;">*</span></label>
								<input type="text" name="value" id="value" class="form-control" value="<?php echo $master_detail->value; ?>" placeholder="Name">
								<span style="color:red" id="nerror"><?php echo $errors->first('value'); ?></span>
							
							</div>
							
							
						</div>
						
						
					</div>
						
					
				
              </div>
              <!-- /.box-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" onclick="return submit_validation();">Submit</button>
				 <button type="button" onclick="window.location.href='<?php echo URL::to('master')?>'" class="btn btn-default">Cancel</button>
              </div>
{!! Form::close() !!}
</div>
</div>
</div>
</section>
</div>
@include('layouts.footer')