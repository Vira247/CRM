<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')); ?>">
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Inquiry # <?php echo e($detail->id); ?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo URL::to('/') ?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="breadcrumb-item"><a href="<?php echo URL::to('/') ?>/inquiry">Inquiry list</a></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</div>
	<section class="content">
		<div class="container-fluid">
			<!-- Timelime example  -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Inquiry List</h3>
							<button style="float:right;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-xl">Add Follow UP</button>
							<div style="float:right;" class="btn-group">
								<button type="button" class="btn <?php if($detail->status == 'Open'): ?> btn-info <?php elseif($detail->status == 'Close without Sale'): ?> btn-danger <?php else: ?> btn-success <?php endif; ?>"><?php echo e($detail->status); ?></button>
								<button type="button" class="btn <?php if($detail->status == 'Open'): ?> btn-info <?php elseif($detail->status == 'Close without Sale'): ?> btn-danger <?php else: ?> btn-success <?php endif; ?> dropdown-toggle dropdown-icon" data-toggle="dropdown">
									<span class="sr-only">Toggle Dropdown</span>
									<div class="dropdown-menu" role="menu">
										<a class="dropdown-item" href="#" onclick="changestatus('Open')">Open</a>
										<a class="dropdown-item" href="#" onclick="changestatus('Sale')">Sale</a>
										<a class="dropdown-item" href="#" onclick="changestatus('Close without Sale')">Close without Sale</a>
									</div>
								</button>
							</div>
						</div>
						<div class="card-body">
							<h6 class="card-title"><b>Name :- </b> <?php echo e($detail->name); ?><br>
								<b>Phone :- </b> <?php echo e($detail->phone); ?><br>
								<b>Email :- </b> <?php echo e($detail->email); ?><br>
								<?php if($detail->remark != ""): ?>
								<b>Remark :- </b> <?php echo e($detail->remark); ?><br>
								<?php endif; ?>
								<?php if($productDetail): ?>
								<b>Product :- </b> <?php echo e($productDetail->name); ?> - <?php echo e($productDetail->sku); ?><br>
								<?php endif; ?>
								<b>Created By :- </b> <?php echo e($detail->username); ?><br>
								<b>Created Date Time :- </b> <?php echo e(date('m/d/Y',strtotime($detail->created_at))); ?><br>

							</h6>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<!-- The time line -->
					<div class="timeline">
						<!-- timeline time label -->
						<?php $__currentLoopData = $inquirList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="time-label">
							<span class="bg-red"><?php echo e(date('d M. Y',strtotime($list->created_at))); ?></span>
						</div>
						<!-- /.timeline-label -->
						<!-- timeline item -->
						<div>
							<i class="fas fa-envelope bg-blue"></i>
							<div class="timeline-item">
								<span class="time"><i class="fas fa-clock"></i> <?php echo e(date('h:i A',strtotime($list->created_at))); ?></span>
								<h3 class="timeline-header"><a href="#"><?php echo e($list->name); ?></a></h3>
								<div class="timeline-body">
									<?php echo e($list->description); ?>

								</div>
								<div class="timeline-footer">
									<?php if($list->follow_up_date != ""): ?>
									<a class="btn btn-primary btn-sm"><?php echo e(date('d M. Y',strtotime($list->follow_up_date))); ?></a>
									<?php endif; ?>
									<?php if($list->attachment): ?>
									<a class="btn btn-danger btn-sm">Delete</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<!-- END timeline item -->
						<div>
							<i class="fas fa-clock bg-gray"></i>
						</div>
					</div>
				</div>
				<!-- /.col -->
			</div>
		</div>
		<!-- /.timeline -->
		<div class="modal fade" id="modal-xl">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Add Follow UP</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form role="form" method="POST" action="<?php echo URL::to('/') ?>/add/inquiry-data/<?php echo e($detail->id); ?>" enctype="multipart/form-data">
					<div class="modal-body">
						
							<?php echo csrf_field(); ?>
							<div class="row">
								<div class="col-sm-12">
									<!-- text input -->
									<div class="form-group">
										<label>Next Follow UP Date</label>
										<input type="date" class="form-control" placeholder="Date" name="date">
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label>Notes</label>
										<textarea class="form-control" name="note"></textarea>
									</div>
								</div>
							</div>
						
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save Note</button>
					</div>
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	</section>
</div>
<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="<?php echo e(asset('plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script>
$(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
	});
	<?PHP if(Session::has('success')){ ?>
    Toast.fire({
        icon: 'success',
        title: '<?php echo Session::get('success'); ?>'
	})
	<?php } ?>
});
function changestatus(status){
	window.location.href = "<?php echo URL::to('/') ?>/inquiry/chnage-status/<?php echo e($detail->id); ?>/"+status;
}
</script><?php /**PATH C:\xamppnew\htdocs\laravel_demo\resources\views/inquiry/show.blade.php ENDPATH**/ ?>