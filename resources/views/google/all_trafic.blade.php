@include('layouts.header')
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">All Trafic</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo URL::to('/'); ?>/home">Home</a></li>
						<li class="breadcrumb-item active">All Trafic</li>
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
									<th></th>
									<th></th>
									<?php foreach ($dates as $date) { ?>
										<th colspan="3">{{date("m/d/Y", strtotime($date))}}</th>
									<?php } ?>
								</tr>
								<tr>
									<th>#</th>
									<th>#</th>
									<?php foreach ($dates as $date) { ?>
										<th>Session</th>
										<th>Pageviews</th>
										<th>Duration</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($finalArray as $sourcekey => $source) {
									foreach ($source as $mediumkey => $medium) { ?>
										<tr>
											<td><?= $sourcekey ?></td>
											<td><?= $mediumkey ?></td>
											<?php foreach ($dates as $date) { ?>
												<td><?= (isset($finalArray[$sourcekey][$mediumkey][$date]['session'])) ? $finalArray[$sourcekey][$mediumkey][$date]['session'] : 0; ?></td>
												<td><?= (isset($finalArray[$sourcekey][$mediumkey][$date]['pageviews'])) ? $finalArray[$sourcekey][$mediumkey][$date]['pageviews'] : 0; ?></td>
												<td><?= (isset($finalArray[$sourcekey][$mediumkey][$date]['duration'])) ? $finalArray[$sourcekey][$mediumkey][$date]['duration'] : 0; ?></td>
											<?php } ?>
										</tr>
								<?php }
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
@include('layouts.footer')