<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Session By Region</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo URL::to('/'); ?>/home">Home</a></li>
						<li class="breadcrumb-item active">Analytics</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	<section class="content">
		<div class="row">

			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<table id="personnelTable" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>#</th>
									<?php foreach ($date as $dates) { ?>
										<th colspan="3"><?= $dates ?></th>
									<?php } ?>
								</tr>
								<tr>
									<th>#</th>
									<th>#</th>
									<?php foreach ($date as $dates) { ?>
										<th>Session</th>
										<th>Page View</th>
										<th>Duration</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($finalArray as $keycountry => $contrydata) { ?>
									<tr>
										<?php foreach ($contrydata as $keystate => $statedata) { ?>
											<td><?= $keycountry ?></td>
											<td><?= $keystate ?></td>
											<?php foreach ($date as $dates) { ?>
												<td><?= (isset($finalArray[$keycountry][$keystate][$dates]['sessions'])) ? $finalArray[$keycountry][$keystate][$dates]['sessions'] : 0; ?></td>
												<td><?= (isset($finalArray[$keycountry][$keystate][$dates]['pageviews'])) ? $finalArray[$keycountry][$keystate][$dates]['pageviews'] : 0; ?></td>
												<td><?= (isset($finalArray[$keycountry][$keystate][$dates]['sessionDuration'])) ? $finalArray[$keycountry][$keystate][$dates]['sessionDuration'] : 0; ?></td>
											<?php } ?>
									</tr>
								<?php } ?>
							<?php
								}
							?>
							</tbody>
						</table>
					</div>
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
<script src="<?php echo e(asset('plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- DataTables -->

<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppnew\htdocs\CRM\resources\views/google/all_session_by_mobile.blade.php ENDPATH**/ ?>