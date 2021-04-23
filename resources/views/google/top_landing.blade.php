@include('layouts.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Top Landing Page</h1>
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
													<?php foreach($dates as $date){ ?>
														<th>{{date("m/d/Y", strtotime($date))}}</th>
													<?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php foreach($finalArray as $sourcekey=>$source){ ?>
													<tr>
													<td><?=$sourcekey?></td>
													<?php foreach($dates as $date){ ?>
														<td><?=(isset($finalArray[$sourcekey][$date]['session']))?$finalArray[$sourcekey][$date]['session']:0;?></td>
														
													<?php } ?>
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
@include('layouts.footer')