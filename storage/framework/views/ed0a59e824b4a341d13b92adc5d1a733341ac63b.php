<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo URL::to('/');?>/home">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
      <div class="container-fluid">
	      <?php if(Session::has('success')): ?>     
        <div class="alert alert-success" role="alert">                                      
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><?php echo e(Session::get('success')); ?>

        </div> 
        <?php endif; ?>
        <?php if(Session::has('error') ): ?>                          
        <div class="alert alert-danger"> 
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><?php echo e(Session::get('error')); ?>    
        </div>                            
        <?php endif; ?>
          <div class="row">
          <div class="col-md-12">
          <div class="card">
          <div class="card-header">
          <h3 class="card-title">
          <i class="fa fa-search"></i>
          Product Search
          </h3>
          </div>
          <form method="get" action="" name="searchPrduct" role="form" id="searchPrduct" enctype="multipart/form-data" class="form-horizontal">
          <div class="card-body">
            <div class="form-group row mb-2">
              <label for="inputName" class="col-sm-1">SKU</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="sku" name="sku" placeholder="SKU" value="<?php if(isset($sku)){ echo $sku; }?>">
              </div>
              <label for="inputName" class="col-sm-1">Type</label>
              <div class="col-sm-2">
                <select class="form-control" name="type" >
                <option value="">Select Type</option>
                <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($master->type == 'Product Type'): ?>
                      <option value="<?php echo e($master->value); ?>" <?php if($type == $master->value): ?> selected <?php endif; ?>><?php echo e($master->value); ?></option>
                      <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <label for="inputName" class="col-sm-1">Vendor</label>
              <div class="col-sm-2">
                <select class="form-control" name="vendors" >
                <option value="">Select Type</option>
                <?php foreach($vendorList as $vendor){ ?>
                <option value="<?php echo e($vendor->id); ?>" <?php if($vendor->id == $vendors){ echo "selected"; } ?>><?php echo e($vendor->name); ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
          </div>
					<div class="card-footer clearfix">
						<input type="submit" name="submit" value="Search" class="btn btn-primary">
						<input type="button" name="button" value="Clear" class="btn btn-default" onclick="window.location.href='<?php echo URL::to('/');?>/product'">
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-create')): ?>
            <a href="<?php echo e(route('product.create')); ?>" class="btn btn-success">Add New Product</a>
            <?php endif; ?> 
					</div>
				</form>
			</div>
        <div class="row">
        
          <div class="col-md-12">
            <div class="card">
			
			
			<div class="card">
              <div class="card-header">
                <h3 class="card-title">Product List (<?php echo e($table_list->toArray()['total']); ?>)</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Product Type</th>
                        <th>Vendor</th>
                        <th style="width: 40px">Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  if(count($table_list) >0){
                  if(isset($page) && $page !=1){
                  $cnt =($page *50) -49;
                  }else{
                  $cnt =1;
                  }
                  foreach($table_list as $key){
                  ?>
                  <tr>
                    <td><?=++$i?></td>
                    <td><?php echo $key->name;?></td>
                    <td><?php echo $key->sku;?></td>
                    <td><?php echo $key->product_type;?></td>
                    <td><?php echo $key->vendorname;?></td>
                    <td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-edit')): ?>
                    <a href="<?php echo URL::to('/');?>/product/<?php echo $key->id;?>/edit" title="Edit" ><i class="fa fa-edit"></i></a> 
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-delete')): ?>
                    <a href="<?php echo URL::to('/');?>/product/delete/<?php echo $key->id;?>" title="Delete" onclick="return confirm('Are you sure remove this record?')"><i class="fa fa-trash"></i></a>
                    <?php endif; ?>
                    </td>
                  </tr>
                  <?php }
                  }
                    if(count($table_list) ==0){  ?>
                      <tr> <td colspan="5">No record available</td></tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                <?php echo $table_list->appends(Request::all())->links(); ?>
                </ul>
              </div>
            </div>
            <!-- /.card -->

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
  <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppnew\htdocs\laravel_demo\resources\views/product/index.blade.php ENDPATH**/ ?>