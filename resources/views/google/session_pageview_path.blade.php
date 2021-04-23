 @include('layouts.header')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<div class="content-header">
 		<div class="container-fluid">
 			<div class="row mb-2">
 				<div class="col-sm-6">
 					<h1 class="m-0 text-dark">Product Order </h1>
 				</div><!-- /.col -->
 				<div class="col-sm-6">
 					<ol class="breadcrumb float-sm-right">
 						<li class="breadcrumb-item"><a href="<?php echo URL::to('/'); ?>/home">Home</a></li>
 						<li class="breadcrumb-item active">Page Views</li>
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
 					<div class="card-header">
 						<h3 class="card-title">
 							<i class="fa fa-search"></i>
 							Search
 						</h3>
 					</div>
 					<form method="get" action="" name="searchPrduct" role="form" id="searchPrduct" enctype="multipart/form-data" class="form-horizontal">
 						<div class="card-body">
 							<div class="row">
 								<div class="col-md-2">
 									<label for="exampleInputEmail1">Date</label>
 									<input type="date" class="form-control" name="date" id="date" value="<?= $date ?>">
 								</div>
 							</div>
 						</div>
 						<div class="card-footer clearfix">
 							<input type="submit" name="submit" value="Search" class="btn btn-primary">
 						</div>
 					</form>
 				</div>
 				<div class="card">
 					<div class="card-body">
 						<table id="personnelTable" class="table table-striped table-bordered table-hover">
 							<thead>
 								<tr>
 									<th>Path</th>
 									<th>Page Views</th>
 								</tr>
 							</thead>
 							<tbody>
 								<?php foreach ($list as $lists) { ?>
 									<tr>
 										<td><?= $lists->path ?></td>
 										<td><?= $lists->pageviwe ?></td>
 									</tr>
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
 <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
 <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
 <!-- DataTables -->

 @include('layouts.footer')