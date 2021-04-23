@include('layouts.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">All Session Pageviews</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo URL::to('/'); ?>/home">Home</a></li>
                        <li class="breadcrumb-item active">Google Analytics</li>
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
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Session</th>
                                    <th>Pageviews</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($finalArray as $sourcekey => $source) { ?>
                                    <tr>
                                        <td><?= $source['session'] ?></td>
                                        <td><?= $source['pageviews'] ?></td>
                                    </tr>
                                <?php } ?>
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