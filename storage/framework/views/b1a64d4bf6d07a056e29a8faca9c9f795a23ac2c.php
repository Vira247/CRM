<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/select2/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Order</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li  class="breadcrumb-item" ><a href="<?php echo URL::to('/')?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="breadcrumb-item" ><a href="<?php echo URL::to('/')?>/order">Order list</a></li>
				<li class="breadcrumb-item active">Edit Order</li>
                </ol>
            </div>
            </div>
      </div><!-- /.container-fluid -->
    </div>
	
	<section class="content">
    <?php echo Form::model($orderDetail, ['method' => 'PATCH','route' => ['order.update', $orderDetail->id],'enctype' => "multipart/form-data"]); ?>

        <div class="row">
        
        <div id="step1" class=" card direct-chat direct-chat-primary col-md-12">
        
            <div class="card-header bg-blue">
                <h3 class="card-title">Site Details</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Site<span style="color:red;">*</span></label>
                            <select  class="form-control " id="site"  name="site" >
                            <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($master->type == 'Site'): ?>
                                <option value="<?php echo e($master->id); ?>" <?php if($master->id == $orderDetail->site): ?> selected <?php endif; ?>><?php echo e($master->value); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span style="color:red;" id="site_error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Platform<span style="color:red;">*</span></label>
                            <select  class="form-control " id="platform"  name="platform" >
                            <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($master->type == 'Platform'): ?>
                                <option value="<?php echo e($master->id); ?>" <?php if($master->id == $orderDetail->platform): ?> selected <?php endif; ?> ><?php echo e($master->value); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span style="color:red;" id="platform_error"></span>
                        </div>
                    </div>
                </div> 
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="return step1_validation();">Next <i class="fa fa-forward" aria-hidden="true"></i></button>
            </div>
            <!-- /.card-footer-->
        </div>

        <div id="step2" class="card direct-chat direct-chat-primary col-md-12">
            <div class="card-header bg-blue">
                <h3 class="card-title">Order Details</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Order Date<span style="color:red;">*</span></label>
                            <input type="date" class="form-control" id="order_date" name="order_date" value="<?php echo e($orderDetail->order_date); ?>">
                            <span style="color:red;" id="order_date_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Order ID<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="order_id" name="order_id"  value="<?php echo e($orderDetail->order_id); ?>">
                            <span style="color:red;" id="order_id_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Order Status<span style="color:red;">*</span></label>
                            <select  class="form-control " id="order_status" name="order_status">
                            <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($master->type == 'Order Status'): ?>
                                <option value="<?php echo e($master->id); ?>" <?php if($master->id == $orderDetail->order_status): ?> selected <?php endif; ?> ><?php echo e($master->value); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span style="color:red;" id="order_status_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Order Amount<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="order_amount" name="order_amount"  value="<?php echo e($orderDetail->order_amount); ?>">
                            <span style="color:red;" id="order_amount_error"></span>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">VAT Tax Amount</label>
                            <input type="text" class="form-control" id="vat_tax_amount" name="vat_tax_amount" value="<?php echo e($orderDetail->vat_tax_amount); ?>">
                            <span style="color:red;" id="vat_tax_amount_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Comission/Other Charges</label>
                            <input type="text" class="form-control" id="comission_other_charges" name="comission_other_charges" value="<?php echo e($orderDetail->comission_other_charges); ?>">
                            <span style="color:red;" id="comission_other_charges_error"></span>
                        </div>
                    </div>
                </div> 
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="return step2_validation();">Next <i class="fa fa-forward" aria-hidden="true"></i></button>
            </div>
            <!-- /.card-footer-->
        </div>


        <div id="step3" class="card direct-chat direct-chat-primary col-md-12">
            <div class="card-header bg-blue">
                <h3 class="card-title">Customer Details</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Customer Name<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo e($orderDetail->customer_name); ?>">
                            <span style="color:red;" id="customer_name_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo e($orderDetail->phone_number); ?>">
                            <span style="color:red;" id="phone_number_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo e($orderDetail->email); ?>">
                            <span style="color:red;" id="email_error"></span>
                        </div>
                    </div>
                </div> 
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="return step3_validation();">Next <i class="fa fa-forward" aria-hidden="true"></i></button>
            </div>
            <!-- /.card-footer-->
        </div>
        

        <div id="step4" class="card direct-chat direct-chat-primary col-md-12">
            <div class="card-header bg-blue">
                <h3 class="card-title">Customer Address</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Shipping Address Line 1<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="shipping_address_line_1" name="shipping_address_line_1" value="<?php echo e($orderDetail->shipping_address_line_1); ?>">
                            <span style="color:red;" id="shipping_address_line_1_error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Shipping Address Line 2</label>
                            <input type="text" class="form-control" id="shipping_address_line_2" name="shipping_address_line_2" value="<?php echo e($orderDetail->shipping_address_line_2); ?>">
                            <span style="color:red;" id="shipping_address_line_2_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">City<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="shipping_city" name="shipping_city" value="<?php echo e($orderDetail->shipping_city); ?>">
                            <span style="color:red;" id="shipping_city_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">State<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="shipping_state" name="shipping_state" value="<?php echo e($orderDetail->shipping_state); ?>">
                            <span style="color:red;" id="shipping_state_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Zip code<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="shipping_zip_code" name="shipping_zip_code" value="<?php echo e($orderDetail->shipping_zip_code); ?>">
                            <span style="color:red;" id="shipping_zip_code_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Country<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="shipping_country" name="shipping_country" value="<?php echo e($orderDetail->shipping_country); ?>">
                            <span style="color:red;" id="shipping_country_error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Same as Shiiping Address</label>
                            <input type="checkbox" id="same_as_shipping" name="same_as_shipping" value="Yes" onclick="same_as_shipping_action();">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Billing Address Line 1<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="billing_address_line_1" name="billing_address_line_1" value="<?php echo e($orderDetail->billing_address_line_1); ?>">
                            <span style="color:red;" id="billing_address_line_1_error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Billing Address Line 2<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="billing_address_line_2" name="billing_address_line_2" value="<?php echo e($orderDetail->billing_address_line_2); ?>">
                            <span style="color:red;" id="billing_address_line_2_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">City<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="billing_city" name="billing_city" value="<?php echo e($orderDetail->billing_city); ?>">
                            <span style="color:red;" id="billing_city_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">State<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="billing_state" name="billing_state" value="<?php echo e($orderDetail->billing_state); ?>">
                            <span style="color:red;" id="billing_state_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Zip code<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="billing_zip_code" name="billing_zip_code" value="<?php echo e($orderDetail->billing_zip_code); ?>">
                            <span style="color:red;" id="billing_zip_code_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Country<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="billing_country" name="billing_country" value="<?php echo e($orderDetail->billing_country); ?>">
                            <span style="color:red;" id="billing_country_error"></span>
                        </div>
                    </div>
                </div> 
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="return step4_validation();">Next <i class="fa fa-forward" aria-hidden="true"></i></button>
            </div>
            <!-- /.card-footer-->
        </div>


        <div id="step5" class="card direct-chat direct-chat-primary col-md-12">
            <div class="card-header bg-blue">
                <h3 class="card-title">Payment Info</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Payment Method<span style="color:red;">*</span></label>
                            <select  class="form-control " id="payment_method" name="payment_method">
                            <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($master->type == 'Payment Method'): ?>
                                <option value="<?php echo e($master->id); ?>" <?php if($master->id == $orderDetail->payment_method): ?> selected <?php endif; ?> ><?php echo e($master->value); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span style="color:red;" id="payment_method_error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Transaction ID<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="transaction_id" name="transaction_id" value="<?php echo e($orderDetail->transaction_id); ?>">
                            <span style="color:red;" id="transaction_id_error"></span>
                        </div>
                    </div>
                    
                </div> 
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="return step5_validation();">Next <i class="fa fa-forward" aria-hidden="true"></i></button>
            </div>
            <!-- /.card-footer-->
        </div>


        <div id="step6" class="card direct-chat direct-chat-primary col-md-12">
            <div class="card-header bg-blue">
                <h3 class="card-title">Shipping Details</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div id="vendordivlist">
                <?php $cnt=0; foreach($orderVendorDetail as $vendors){ ?>
                    <div class="vendordiv<?php echo e($cnt); ?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Replacement<span style="color:red;">*</span></label>
                                        <select  class="form-control " name="vendor_replacement[]">
                                        <option value="No" <?php if("No"==$vendors->vendor_replacement){ echo "selected"; }?> >No</option>
                                        <option value="Yes" <?php if("Yes"==$vendors->vendor_replacement){ echo "selected"; }?> >Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Delivery Type<span style="color:red;">*</span></label>
                                        <select  class="form-control " name="vendor_replacement[]">
                                        <option value="Residential with Liftgate/Delivery Appt" <?php if("Residential with Liftgate/Delivery Appt"==$vendors->delivery_remark){ echo "selected"; }?>  >Residential with Liftgate/Delivery Appt</option>
                                        <option value="Commercial"  <?php if("Commercial"==$vendors->delivery_remark){ echo "selected"; }?> >Commercial</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Vendor<span style="color:red;">*</span></label>
                                        <select  class="form-control " name="vendor[]">
                                        <?php $__currentLoopData = $vendorList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($vendor->id); ?>" <?php if($vendor->id==$vendors->vendor_id){ echo "selected"; }?> ><?php echo e($vendor->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Invoice Number<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="invoice_number[]" value="<?php echo e($vendors->invoice_number); ?>">
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sales/Pick-up Reference<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="vendor_pick_up_reference[]" value="<?php echo e($vendors->vendor_pick_up_reference); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Vendor Invoice Amount<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="vendor_invoice_amount[]" value="<?php echo e($vendors->vendor_invoice_amount); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sales tax charged by Vendor<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="vendor_sales_tax_amount[]" value="<?php echo e($vendors->vendor_sales_tax_amount); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Invoice Paid<span style="color:red;">*</span></label>
                                        <select  class="form-control" name="vendor_invoice_paid[]" value="<?php echo e($vendors->vendor_invoice_paid); ?>">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Paid Via<span style="color:red;">*</span></label>
                                        <select  class="form-control" name="vendor_paid_via[]">
                                        <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($master->type == 'Payment Method'): ?>
                                            <option value="<?php echo e($master->id); ?>" <?php if($master->id == $vendors->vendor_paid_via){ echo "selected"; }?>><?php echo e($master->value); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shipping Agent<span style="color:red;">*</span></label>
                                        <select  class="form-control" name="broker[]">
                                        <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($master->type == 'Broker'): ?>
                                            <option value="<?php echo e($master->id); ?>" <?php if($master->id == $vendors->broker){ echo "selected"; }?>><?php echo e($master->value); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Carrier<span style="color:red;">*</span></label>
                                        <select  class="form-control" name="carrier[]">
                                        <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($master->type == 'Carrier'): ?>
                                            <option value="<?php echo e($master->id); ?>" <?php if($master->id == $vendors->carrier){ echo "selected"; }?>><?php echo e($master->value); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">BOL Number<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="bol_number[]" value="<?php echo e($vendors->bol_number); ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pick-up ZIP Code<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="pick_up_zip_code[]" value="<?php echo e($vendors->pick_up_zip_code); ?>">
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Delevery ZIP Code<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="delevery_zip_code[]" value="<?php echo e($vendors->delevery_zip_code); ?>">
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Travelling Distance (Miles):</label>
                                        <input type="text" class="form-control" name="distance[]" value="<?php echo e($vendors->distance); ?>">
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Total Weight<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="total_weight[]" value="<?php echo e($vendors->total_weight); ?>">
                                        
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shipping Cost<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="shipping_cost[]" value="<?php echo e($vendors->shipping_cost); ?>">
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shipping Paid<span style="color:red;">*</span></label>
                                        <select class="form-control" name="shipping_paid_cost[]">
                                        <option value="Yes" <?php if("Yes" == $vendors->shipping_paid_cost){ echo "selected"; }?>>Yes</option>
                                        <option value="No" <?php if("No" == $vendors->shipping_paid_cost){ echo "selected"; }?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Paid Via<span style="color:red;">*</span></label>
                                        <select class="form-control" name="shipping_paid_via[]">
                                        <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($master->type == 'Payment Method'): ?>
                                            <option value="<?php echo e($master->id); ?>"  <?php if($master->id == $vendors->shipping_paid_via){ echo "selected"; }?>><?php echo e($master->value); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tracking#/PRO#<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="tracking_number[]" value="<?php echo e($vendors->tracking_number); ?>">
                                        <span style="color:red;" id="tracking_number_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pick-up Remarks<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="shipment[]" value="<?php echo e($vendors->shipment); ?>">
                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Delivery Remarks</label>
                                        <input type="text" class="form-control" name="delivery_remark[]" value="<?php echo e($vendors->delivery_remark); ?>">
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <?php if($cnt > 0){ ?>
                        <div class="card-footer vendordiv<?php echo e($cnt); ?>">
                            <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="removemorevendor(<?php echo e($cnt); ?>);">Remove <i class="fa fa-pluse" aria-hidden="true"></i></button>
                        </div>
                    <?php } ?>
                <?php $cnt++; } ?>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="return step6_validation();">Next <i class="fa fa-forward" aria-hidden="true"></i></button>
                <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="addmorevendor();">Add more <i class="fa fa-pluse" aria-hidden="true"></i></button>
            </div>
                <!-- /.card-footer-->
        </div>

            <div id="step7" class="card direct-chat direct-chat-primary col-md-12">
                <div class="card-header bg-blue">
                    <h3 class="card-title">Order Item</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th width="10%">Vendor</th>
                                    <th width="10%">Product Type</th>
                                    <th width="45%">Product</th>
									<th width="10%">Unit</th>
                                    <th width="10%">Quantity</th>
                                    <th width="10%">Price</th>
                                    <th width="5%">Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                    <select class="form-control" id="selectvendor" onchange="getProductList()">
                                    <option value="">Select</option>
                                        <?php $__currentLoopData = $vendorList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    </td>
                                    <td>
                                    <select class="form-control" id="selectproducttype" onchange="getProductList()">
                                    <option value="">Select</option>
                                        <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($master->type == 'Product Type'): ?>
                                            <option value="<?php echo e($master->value); ?>"><?php echo e($master->value); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    </td>
                                    <td>
                                    <select class="form-control select2" id="selectproduct">
                                    <option value="">Select</option>
                                    </select>
                                    </td>
                                    <td>
                                    <select class="form-control" id="itemunit">
                                        <option value="Sqft">Sqft</option>
                                        <option value="Pallet">Pallet</option>
                                    </select>
                                    </td>
                                    <td><input type="text" id="quantity" class="form-control"></td>
                                    <td><input type="text" id="price" class="form-control"></td>
                                    <td><input type="button" class="btn-primary" value="Add" name="Add" onclick="addproduct()"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                <th>Vendor</th>
                                <th>Product Type</th>
                                <th>Product</th>
                                <th>Unit</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody id="productlist">
                               <?php $itemcount=0; ?>
                                <?php $__currentLoopData = $orderItemDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr id="itemtr<?php echo e($itemcount); ?>">
									<td><?php echo e($list->vendorname); ?><input type="hidden" name="vendorid[]" value="<?php echo e($list->vendor_id); ?>"></td>
									<td><?php echo e($list->producttype); ?><input type="hidden" name="producttypeid[]" value="<?php echo e($list->producttype); ?>"></td>
									<td><?php echo e($list->productname); ?><input type="hidden" name="productid[]" value="<?php echo e($list->product_id); ?>"></td>
                                    <td><?php echo e($list->itemunit); ?><input type="hidden" name="itemunit[]" value="<?php echo e($list->itemunit); ?>"></td>
									<td><?php echo e($list->amount); ?><input type="hidden" name="amount[]" value="<?php echo e($list->amount); ?>"></td>
									<td><?php echo e($list->price); ?><input type="hidden" name="price[]" value="<?php echo e($list->price); ?>"><input type="hidden" name="amount[]" value="<?php echo e($list->amount); ?>"> </td>
									<td  class="allamount"><?php echo e($list->amount); ?></td>
                                    <td><a href="#" title="Delete" onclick="removeItem(<?php echo e($itemcount); ?>)"><i class="fa fa-trash"></i></a></td>
									</tr>
                                    <?php $itemcount++; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-md-9">
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3">
                        <p class="lead">Amount </p>

                        <div class="table-responsive">
                            <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:<input type="hidden" id="subtotaltxt" name="subtotaltxt" value="0.00"></th>
                                <td style="text-align: right;" id="subtotalhtml">$0.00</td>
                            </tr>
                            <tr>
                                <th>Total:<input type="hidden" id="totaltxt" name="totaltxt" value="0.00"></th>
                                <td style="text-align: right;" id="totalhtml">$0.00</td>
                            </tr>
                            </table>
                        </div>
                        </div>
                        <!-- /.col -->
                    </div>


                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="return step7_validation();">Next <i class="fa fa-forward" aria-hidden="true"></i></button>
                </div>
                <!-- /.card-footer-->
            </div>

            <div id="step8" class="card direct-chat direct-chat-primary col-md-12">
                <div class="card-header bg-blue">
                    <h3 class="card-title">Customer's Claim</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Claim<span style="color:red;">*</span></label>
                                <select class="form-control" id="claim_refund" name="claim_refund">
                                    <option value="">Select</option>
                                    <option value="Replacement"  <?php if('Replacement' == $orderDetail->claim_refund): ?> selected <?php endif; ?>>Replacement</option>
                                    <option value="Refund"  <?php if('Refund' == $orderDetail->claim_refund): ?> selected <?php endif; ?>>Refund</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Refund Amount<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="refund_amount" name="refund_amount" value="<?php echo e($orderDetail->refund_amount); ?>">
                            </div>
                        </div>
                    </div> 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="return step8_validation();">Next <i class="fa fa-forward" aria-hidden="true"></i></button>
                </div>
                <!-- /.card-footer-->
            </div>
            <div id="step9" class="card direct-chat direct-chat-primary col-md-12">
                <div class="card-header bg-blue">
                    <h3 class="card-title">Villohome's Claim</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Claim against<span style="color:red;">*</span></label>
                                <select class="form-control" id="claim_against" name="claim_against"  onchange="change_claim_against()">
                                    <option value="">Select</option>
                                    <option value="Vendor"  <?php if('Vendor' == $orderDetail->claim_against): ?> selected <?php endif; ?> >Vendor</option>
                                    <option value="Shipping Company"  <?php if('Shipping Company' == $orderDetail->claim_against): ?> selected <?php endif; ?> >Shipping Company</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 claim_against" id="vendor_claim_div" style="display:<?php if('Vendor' == $orderDetail->claim_against): ?> block <?php else: ?> none <?php endif; ?>;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vendor<span style="color:red;">*</span></label>
                                <select class="form-control" id="vendor_claim" name="vendor_claim">
                                    <option value="">Select</option>
                                    <?php $__currentLoopData = $vendorList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($vendor->id); ?>" <?php if($vendor->id == $orderDetail->vendor_claim): ?> selected <?php endif; ?> ><?php echo e($vendor->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 claim_against" id="shipping_claim_div" style="display:<?php if('Shipping Company' == $orderDetail->claim_against): ?> block <?php else: ?> none <?php endif; ?>;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Shipping<span style="color:red;">*</span></label>
                                <select class="form-control" id="shipping_claim" name="shipping_claim">
                                    <option value="">Select</option>
                                    <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($master->type == 'Carrier'): ?>
                                        <option value="<?php echo e($master->id); ?>" <?php if($master->id == $orderDetail->shipping_claim): ?> selected <?php endif; ?> ><?php echo e($master->value); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 claim_against" id="shipping_claim_amount_div" style="display:<?php if('' != $orderDetail->claim_against): ?> block <?php else: ?> none <?php endif; ?>;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Refund Amount<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="shipping_claim_amount" name="shipping_claim_amount" value="<?php echo e($orderDetail->shipping_claim_amount); ?>">
                            </div>
                        </div>
                        <div class="col-md-4 claim_against" id="claim_status_div"  style="display:<?php if('' != $orderDetail->claim_against): ?> block <?php else: ?> none <?php endif; ?>;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Claim status<span style="color:red;">*</span></label>
                                <select class="form-control" id="claim_status" name="claim_status">
                                    <option value="">Select</option>
                                    <option value="Yes" <?php if("Yes" == $orderDetail->claim_status): ?> selected <?php endif; ?> >Yes</option>
                                    <option value="No"  <?php if("Yes" == $orderDetail->claim_status): ?> selected <?php endif; ?> >No</option>
                                </select>
                            </div>
                        </div>
                    </div> 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <button type="submit" id="step_btn1" class="btn btn-primary float-right" >Next <i class="fa fa-forward" aria-hidden="true"></i></button>
                </div>
                <!-- /.card-footer-->
            </div>
        
            
                <!-- /.box-header -->
                <!-- form start -->
                
                </form> 
        
    </div>
</section>
</div>
</div>

</div>
        <div class="card-body" id="vendordiv" style="display:none;">
        <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Replacement<span style="color:red;">*</span></label>
                                        <select  class="form-control " name="vendor_replacement[]">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Delivery Type<span style="color:red;">*</span></label>
                                        <select  class="form-control " name="vendor_replacement[]">
                                        <option value="Residential with Liftgate/Delivery Appt">Residential with Liftgate/Delivery Appt</option>
                                        <option value="Commercial">Commercial</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Vendor<span style="color:red;">*</span></label>
                                        <select  class="form-control " name="vendor[]">
                                        <?php $__currentLoopData = $vendorList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Invoice Number</label>
                                        <input type="text" class="form-control" name="invoice_number[]">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sales/Pick-up Reference<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="vendor_pick_up_reference[]">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Vendor Invoice Amount</label>
                                        <input type="text" class="form-control" name="vendor_invoice_amount[]">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sales tax charged by Vendor</label>
                                        <input type="text" class="form-control" name="vendor_sales_tax_amount[]">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Invoice Paid</label>
                                        <select  class="form-control" name="vendor_invoice_paid[]">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Paid Via</label>
                                        <select  class="form-control" name="vendor_paid_via[]">
                                        <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($master->type == 'Payment Method'): ?>
                                            <option value="<?php echo e($master->id); ?>"><?php echo e($master->value); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shipping Agent</label>
                                        <select  class="form-control" name="broker[]">
                                        <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($master->type == 'Broker'): ?>
                                            <option value="<?php echo e($master->id); ?>"><?php echo e($master->value); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Carrier</label>
                                        <select  class="form-control" name="carrier[]">
                                        <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($master->type == 'Carrier'): ?>
                                            <option value="<?php echo e($master->id); ?>"><?php echo e($master->value); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">BOL Number</label>
                                        <input type="text" class="form-control" name="bol_number[]">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pick-up ZIP Code</label>
                                        <input type="text" class="form-control" name="pick_up_zip_code[]">
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Delevery ZIP Code</label>
                                        <input type="text" class="form-control" name="delevery_zip_code[]">
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Travelling Distance (Miles):</label>
                                        <input type="text" class="form-control" name="distance[]">
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Total Weight</label>
                                        <input type="text" class="form-control" name="total_weight[]">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shipping Cost</label>
                                        <input type="text" class="form-control" name="shipping_cost[]">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shipping Paid</label>
                                        <select class="form-control" name="shipping_paid_cost[]">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Paid Via</label>
                                        <select class="form-control" name="shipping_paid_via[]">
                                        <?php $__currentLoopData = $masterList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($master->type == 'Payment Method'): ?>
                                            <option value="<?php echo e($master->id); ?>"><?php echo e($master->value); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tracking#/PRO#</label>
                                        <input type="text" class="form-control" name="tracking_number[]">
                                        <span style="color:red;" id="tracking_number_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pick-up Remarks</label>
                                        <input type="text" class="form-control" name="shipment[]">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Delivery Remarks</label>
                                        <input type="text" class="form-control" name="delivery_remark[]">
                                    </div>
                                </div>
                            </div> 
        </div>
<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="<?php echo e(asset('plugins/select2/js/select2.full.min.js')); ?>"></script>
<script>
function same_as_shipping_action(){
    $("#billing_address_line_1").val('');
    $("#billing_address_line_2").val('');
    $("#billing_city").val('');
    $("#billing_state").val('');
    $("#billing_zip_code").val('');
    $("#billing_country").val('');
    if($("#same_as_shipping").prop('checked') == true){
        $("#billing_address_line_1").val($("#shipping_address_line_1").val());
        $("#billing_address_line_2").val($("#shipping_address_line_2").val());
        $("#billing_city").val($("#shipping_city").val());
        $("#billing_state").val($("#shipping_state").val());
        $("#billing_zip_code").val($("#shipping_zip_code").val());
        $("#billing_country").val($("#shipping_country").val());
    }
}
var itemcount = parseInt('<?php echo e($itemcount); ?>');
function change_claim_against(){
    var claimtype = $("#claim_against").val();
    $("#vendor_claim").val('');
    $("#shipping_claim").val('');
    $("#shipping_claim_amount").val('');
    $("#claim_status").val('');
    $(".claim_against").hide();
    if(claimtype == 'Vendor'){
        $("#vendor_claim_div").show();
        $("#shipping_claim_amount_div").show();
        $("#claim_status_div").show();
    }
    if(claimtype == 'Shipping Company'){
        $("#shipping_claim_div").show();
        $("#shipping_claim_amount_div").show();
        $("#claim_status_div").show();
    }
    alert('hiii');
}
function removeItem(countid){
    $('#itemtr'+countid).remove();
    getTotal(); 
}
function addproduct(){
	var id = $("#selectproduct").val();
	var quantity = $("#quantity").val();
	var vendor = $("#selectvendor").val();
	var producttype = $("#selectproducttype").val();
	var price = $("#price").val();
	if(id != "" && quantity != "" && price != "" && vendor != "" && producttype != ""){
		var text = $("#selectproduct option:selected").text();
		var vendortext = $("#selectvendor option:selected").text();
		var producttypetext = $("#selectproducttype option:selected").text();
		var itemunit = $("#itemunit option:selected").text();
		var amount = parseFloat(quantity)*parseFloat(price);
        amount = amount.toFixed(2);
        itemcount++;
		var html = '<tr id="itemtr'+itemcount+'"><td>'+vendortext+'<input type="hidden" name="vendorid[]" value="'+vendor+'"></td><td>'+producttypetext+'<input type="hidden" name="producttypeid[]" value="'+producttype+'"></td><td>'+text+'<input type="hidden" name="productid[]" value="'+id+'"></td><td><input type="hidden" name="itemunit[]" value="'+itemunit+'">'+itemunit+'</td><td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td><td><input type="hidden" name="price[]" value="'+price+'">'+price+'<input type="hidden" name="amount[]" value="'+amount+'"></td><td class="allamount">'+amount+'</td><td><a href="#" onclick="removeItem('+itemcount+')"><i class="fa fa-trash"></i></td></tr>';
		$("#productlist").append(html);
		$("#selectproduct").val('');
		$("#quantity").val('');
		$("#price").val('');
        $("#selectvendor").val('');
        $("#selectproducttype").val('');
	}
	getTotal();
}
function getTotal(){
	var subtotal = 0;
	$( ".allamount" ).each(function() {
		var amount = $(this).html();
		subtotal = subtotal + parseFloat(amount);
	});
	subtotal = subtotal.toFixed(2);
	$("#subtotaltxt").val(subtotal);
	$("#subtotalhtml").html("$"+subtotal);
	var total = ((parseFloat(subtotal)));
	total = total.toFixed(2);
	$("#totaltxt").val(total);
	$("#totalhtml").html("$"+total);
}
function getProductList(){
    var vendor = $("#selectvendor").val();
    var producttype = $("#selectproducttype").val();
    $("#selectproduct").html('<option value="">Select</option>');
    $("#selectproduct").trigger("change");
    if(vendor != "" && producttype != "" ){
        $.ajax({
            'url':"<?php echo URL::to('/');?>/product/list/"+vendor+"/"+producttype,
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

function removemorevendor(id){
    $(".vendordiv"+id).remove();
}
function addmorevendor(){
    vendordivcount++;
    $("#vendordivlist").append('<div class="vendordiv'+vendordivcount+'">');
    $("#vendordivlist").append(vendordivhtml);
    $("#vendordivlist").append('</div>');
    $("#vendordivlist").append('<div class="card-footer vendordiv'+vendordivcount+'"><button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="removemorevendor('+vendordivcount+');">Remove <i class="fa fa-pluse" aria-hidden="true"></i></button></div>');
}
$('#step2').CardWidget('collapse');
$('#step3').CardWidget('collapse');
$('#step4').CardWidget('collapse');
$('#step5').CardWidget('collapse');
$('#step6').CardWidget('collapse');
$('#step7').CardWidget('collapse');
$('#step8').CardWidget('collapse');
$('#step9').CardWidget('collapse');

function step1_validation(){
    var validation_array = ["site", "platform"];
	var i = 0;
	validation_array.forEach(function(validation_name) {
		var validation_field= $('#'+validation_name).val();
		$('#'+validation_name+'_error').html("");
		if(validation_field.trim() == ""){
			$('#'+validation_name+'_error').html("Required");
			i++;
		}
	});
    if(i != 0){
        return false;
    }else{
        $('#step1').CardWidget('collapse');  
		$('#step2').CardWidget('expand');
		$('#step3').CardWidget('collapse');  
		$('#step4').CardWidget('collapse'); 
		$('#step5').CardWidget('collapse'); 
		$('#step6').CardWidget('collapse'); 
		$('#step7').CardWidget('collapse'); 
        $('#step8').CardWidget('collapse');
		 return 0;
    }
}
function step2_validation(){
    var validation_array = ["order_date", "order_id","order_status","order_amount"];
	var i = 0;
	validation_array.forEach(function(validation_name) {
		var validation_field= $('#'+validation_name).val();
		$('#'+validation_name+'_error').html("");
		if(validation_field.trim() == ""){
			$('#'+validation_name+'_error').html("Required");
			i++;
		}
	});
    if(i != 0){
        return false;
    }else{
        $('#step1').CardWidget('collapse');  
		$('#step2').CardWidget('collapse');
		$('#step3').CardWidget('expand');  
		$('#step4').CardWidget('collapse'); 
		$('#step5').CardWidget('collapse'); 
		$('#step6').CardWidget('collapse'); 
		$('#step7').CardWidget('collapse');
        $('#step8').CardWidget('collapse');
		 return 0;
    }
}
function step3_validation(){
    var validation_array = ["customer_name"];
	var i = 0;
	validation_array.forEach(function(validation_name) {
		var validation_field= $('#'+validation_name).val();
		$('#'+validation_name+'_error').html("");
		if(validation_field.trim() == ""){
			$('#'+validation_name+'_error').html("Required");
			i++;
		}
	});
    if(i != 0){
        return false;
    }else{
        $('#step1').CardWidget('collapse');  
		$('#step2').CardWidget('collapse');
		$('#step3').CardWidget('collapse');  
		$('#step4').CardWidget('expand'); 
		$('#step5').CardWidget('collapse'); 
		$('#step6').CardWidget('collapse'); 
		$('#step7').CardWidget('collapse');
        $('#step8').CardWidget('collapse');
		 return 0;
    }
}
function step4_validation(){
    var validation_array = ["shipping_address_line_1", "shipping_address_line_2","shipping_city","shipping_city","shipping_state","shipping_zip_code","shipping_country",
    "billing_address_line_1", "billing_address_line_2","billing_city","billing_city","billing_state","billing_zip_code","billing_country"];
	var i = 0;
	validation_array.forEach(function(validation_name) {
		var validation_field= $('#'+validation_name).val();
		$('#'+validation_name+'_error').html("");
		if(validation_field.trim() == ""){
			$('#'+validation_name+'_error').html("Required");
			i++;
		}
	});
    if(i != 0){
        return false;
    }else{
        $('#step1').CardWidget('collapse');  
		$('#step2').CardWidget('collapse');
		$('#step3').CardWidget('collapse');  
		$('#step4').CardWidget('collapse'); 
		$('#step5').CardWidget('expand'); 
		$('#step6').CardWidget('collapse'); 
		$('#step7').CardWidget('collapse');
        $('#step8').CardWidget('collapse');
		 return 0;
    }
}
function step5_validation(){
    var validation_array = ["payment_method","transaction_id"];
	var i = 0;
	validation_array.forEach(function(validation_name) {
		var validation_field= $('#'+validation_name).val();
		$('#'+validation_name+'_error').html("");
		if(validation_field.trim() == ""){
			$('#'+validation_name+'_error').html("Required");
			i++;
		}
	});
    if(i != 0){
        return false;
    }else{
        $('#step1').CardWidget('collapse');  
		$('#step2').CardWidget('collapse');
		$('#step3').CardWidget('collapse');  
		$('#step4').CardWidget('collapse'); 
		$('#step5').CardWidget('collapse'); 
		$('#step6').CardWidget('expand'); 
		$('#step7').CardWidget('collapse');
        $('#step8').CardWidget('collapse');
		 return 0;
    }
}
function step6_validation(){
    $('#step1').CardWidget('collapse');  
    $('#step2').CardWidget('collapse');
    $('#step3').CardWidget('collapse');  
    $('#step4').CardWidget('collapse'); 
    $('#step5').CardWidget('collapse'); 
    $('#step6').CardWidget('collapse'); 
    $('#step7').CardWidget('expand');
    $('#step8').CardWidget('collapse');
        return 0;
    var validation_array = ["broker","carrier","bol_number","pick_up_zip_code","delevery_zip_code","total_weight","shipment","shipping_cost","shipping_paid_cost","shipping_paid_via","tracking_number"];
	var i = 0;
	validation_array.forEach(function(validation_name) {
		var validation_field= $('#'+validation_name).val();
		$('#'+validation_name+'_error').html("");
		if(validation_field.trim() == ""){
			$('#'+validation_name+'_error').html("Required");
			i++;
		}
	});
    if(i != 0){
        return false;
    }else{
        $('#step1').CardWidget('collapse');  
		$('#step2').CardWidget('collapse');
		$('#step3').CardWidget('collapse');  
		$('#step4').CardWidget('collapse'); 
		$('#step5').CardWidget('collapse'); 
		$('#step6').CardWidget('collapse'); 
		$('#step7').CardWidget('expand'); 
        $('#step8').CardWidget('collapse');
		 return 0;
    }
}
function step7_validation(){
    $('#step1').CardWidget('collapse');  
    $('#step2').CardWidget('collapse');
    $('#step3').CardWidget('collapse');  
    $('#step4').CardWidget('collapse'); 
    $('#step5').CardWidget('collapse'); 
    $('#step6').CardWidget('collapse'); 
    $('#step7').CardWidget('collapse'); 
    $('#step8').CardWidget('expand');
    return 0;
}
function step8_validation(){
    step1_validation();
    step2_validation();
    step3_validation();
    step4_validation();
    step5_validation();
    step6_validation();
    step7_validation();
    var i = 0;
	if(i != 0){
        return false;
    }else{
        $('#step1').CardWidget('collapse');  
		$('#step2').CardWidget('collapse');
		$('#step3').CardWidget('collapse');  
		$('#step4').CardWidget('collapse'); 
		$('#step5').CardWidget('collapse'); 
		$('#step6').CardWidget('collapse'); 
		$('#step7').CardWidget('collapse'); 
        $('#step8').CardWidget('collapse');
		 return true;
    }
}

var vendordivhtml = $("#vendordiv").html();
var vendordivcount = parseInt('<?php echo e($cnt); ?>');
$(function () {
    $('.select2').select2()
  });
  getTotal();
</script><?php /**PATH C:\xamppnew\htdocs\laravel_demo\resources\views/order/edit.blade.php ENDPATH**/ ?>