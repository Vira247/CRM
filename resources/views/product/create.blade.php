@include('layouts.header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Product</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li  class="breadcrumb-item" ><a href="<?php echo URL::to('/')?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="breadcrumb-item" ><a href="<?php echo URL::to('/')?>/product">Product list</a></li>
				<li class="breadcrumb-item active">Add Product</li>
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
			<form role="form" method="post" action="<?php echo URL::to('/') ?>/product" enctype="multipart/form-data">
				@method('POST')
				@csrf

              <div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Name <span style="color:red;">*</span></label>
								<input type="text" name="name" id="name" class="form-control" value="<?php echo old('name'); ?>" placeholder="Name">
								<span style="color:red" id="nerror"><?php echo $errors->first('name'); ?></span>
							</div>
						</div>
                        <div class="col-md-6">
							<div class="form-group">
								<label>Product Type <span style="color:red;">*</span></label>
								<select name="product_type" id="product_type" class="form-control">
                                @foreach ($masterList as $master)
                                    @if($master->type == 'Product Type')
                                    <option value="{{$master->value}}">{{$master->value}}</option>
                                    @endif
                                @endforeach
                                </select>
								<span style="color:red" id="nerror"><?php echo $errors->first('name'); ?></span>
							</div>
						</div>
                        <div class="col-md-6">
							<div class="form-group">
								<label>SKU <span style="color:red;">*</span></label>
								<input type="text" name="sku" id="sku" class="form-control" value="<?php echo old('sku'); ?>" placeholder="SKU">
								<span style="color:red" id="serror"><?php echo $errors->first('sku'); ?></span>
							</div>
						</div>
                        <div class="col-md-6">
							<div class="form-group">
								<label>Vendor <span style="color:red;">*</span></label>
								<select name="vendor_id" id="vendor_id" class="form-control">
                                <?php foreach($vendorList as $vendor){ ?>
                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                <?php } ?>
                                </select>
								<span style="color:red" id="verror"><?php echo $errors->first('vendor_id'); ?></span>
							</div>
						</div>
					</div>
              </div>
              <!-- /.box-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" onclick="return submit_validation();">Submit</button>
				 <button type="button" onclick="window.location.href='<?php echo URL::to('vendor')?>'" class="btn btn-default">Cancel</button>
              </div>
            </form> 
        </div>
    </div>
</div>
</section>
</div>
@include('layouts.footer')