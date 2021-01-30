<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/select2/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Add Inquiry</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo URL::to('/') ?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="breadcrumb-item"><a href="<?php echo URL::to('/') ?>/inquiry">Inquiry list</a></li>
						<li class="breadcrumb-item active">Add Inquiry</li>
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
					<form role="form" method="post" action="<?php echo URL::to('/') ?>/inquiry" enctype="multipart/form-data">
						<?php echo method_field('POST'); ?>
						<?php echo csrf_field(); ?>
						<div class="card-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Customer Name <span style="color:red;">*</span></label>
										<input type="text" name="name" id="name" class="form-control" value="<?php echo old('name'); ?>" placeholder="Name" required >
										<span style="color:red" id="nerror"><?php echo $errors->first('name'); ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Phone <span style="color:red;">*</span></label>
										<input type="text" name="phone" id="phone" class="form-control" value="<?php echo old('phone'); ?>" placeholder="Phone" required >
										<span style="color:red" id="nerror"><?php echo $errors->first('phone'); ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Email <span style="color:red;">*</span></label>
										<input type="text" name="email" id="email" class="form-control" value="<?php echo old('email'); ?>" placeholder="Email" required >
										<span style="color:red" id="nerror"><?php echo $errors->first('email'); ?></span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>Inquiry Type<span style="color:red;">*</span></label>
										<select name="inquiry_type" id="inquiry_type" class="form-control" required >
										<option value="Call">Call</option>
										<option value="Contact Us">Contact Us</option>
										<option value="General Inquiry">General Inquiry</option>
										<option value="LVQ">LVQ</option>
										<option value="Product Discount">Product Discount</option>
										<option value="Special Order">Special Order</option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>Assign To</label>
										<select name="assign_to" id="assign_to" class="form-control" >
										<option value="">Select User</option>
										<?php $__currentLoopData = $userList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>Next Follow Up Date <span style="color:red;">*</span></label>
										<input type="date" name="follow_up_date" id="follow_up_date" class="form-control" value="<?php echo old('follow_up_date'); ?>" placeholder="Email" required >
										<span style="color:red" id="nerror"><?php echo $errors->first('follow_up_date'); ?></span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>Vendor </label>
										<select class="form-control" id="selectvendor"  onchange="getProductList()">
											<option value="">Select</option>
											<?php $__currentLoopData = $vendorList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Product</label>
										<select class="form-control select2" id="selectproduct" name="product_id">
											<option value="">Select</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Inquiry Subject </label>
										<textarea name="remark" id="remark" class="form-control" placeholder="Inquiry Subject"><?php echo old('remark'); ?></textarea>
										<span style="color:red" id="nerror"><?php echo $errors->first('remark'); ?></span>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label>Note <span style="color:red;">*</span></label>
										<textarea name="note" id="note" class="form-control" placeholder="Note" required ><?php echo old('note'); ?></textarea>
										<span style="color:red" id="nerror"><?php echo $errors->first('note'); ?></span>
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="card-footer">
							<button type="submit" class="btn btn-primary" onclick="return submit_validation();">Submit</button>
							<button type="button" onclick="window.location.href='<?php echo URL::to('vendor') ?>'" class="btn btn-default">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="<?php echo e(asset('plugins/select2/js/select2.full.min.js')); ?>"></script>
<script>
$(function () {
    $('.select2').select2()
  });
function getProductList(){
	var vendor = $("#selectvendor").val();
	$("#selectproduct").html('<option value="">Select</option>');
	$("#selectproduct").trigger("change");
	if(vendor != ""){
		$.ajax({
			'url':"<?php echo URL::to('/');?>/product/list-by-vendor/"+vendor,
			'type':'GET',
			success:function(response){
				$(response).each(function( key,index ) {
					console.log(index);
					$("#selectproduct").append('<option value="'+index.id+'">'+index.name+'-'+index.sku+'</option>');
				});
				$("#selectproduct").trigger("change");
			}
		})
	}else{

	}
}
</script><?php /**PATH C:\xamppnew\htdocs\laravel_demo\resources\views/inquiry/create.blade.php ENDPATH**/ ?>