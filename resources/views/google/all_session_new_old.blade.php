@include('layouts.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">New Visitor Returning Visitor</h1>
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
                                    <th>Date</th>
                                    <th>New Visitor</th>
                                    <th>Returning Visitor</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php foreach ($finalArray as $sourcekey => $source) { ?>
                                    <tr>
                                        <td>{{date("m/d/Y", strtotime($sourcekey))}}</td>
                                        <td><?= $source['newuser'] ?></td>
                                        <td><?= $source['olduser'] ?></td>
                                    </tr>
                                <?php
                                } ?>
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