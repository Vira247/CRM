@include('layouts.header')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li  class="breadcrumb-item" ><a href="<?php echo URL::to('/')?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
				    <li class="breadcrumb-item" ><a href="<?php echo URL::to('/')?>/order">Order list</a></li>
				    <li class="breadcrumb-item active">Add Order</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<section class="content">
<form role="form" method="post" action="<?php echo URL::to('/') ?>/order" enctype="multipart/form-data" onsubmit="return step9_validation();">
    @method('POST')
    @csrf
	<section class="content">
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
                                @foreach ($masterList as $master)
                                    @if($master->type == 'Site')
                                    <option value="{{$master->id}}">{{$master->value}}</option>
                                    @endif
                                @endforeach
                                </select>
                                <span style="color:red;" id="site_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Platform<span style="color:red;">*</span></label>
                                <select  class="form-control " id="platform"  name="platform" >
                                @foreach ($masterList as $master)
                                    @if($master->type == 'Platform')
                                    <option value="{{$master->id}}">{{$master->value}}</option>
                                    @endif
                                @endforeach
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
                                            @foreach ($vendorList as $vendor)
                                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                            @endforeach
                                        </select>
                                        </td>
                                        <td>
                                        <select class="form-control" id="selectproducttype" onchange="getProductList()">
                                        <option value="">Select</option>
                                            @foreach ($masterList as $master)
                                                @if($master->type == 'Product Type')
                                                <option value="{{$master->value}}">{{$master->value}}</option>
                                                @endif
                                            @endforeach
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
                                            <option value="Pieces">Pieces</option>
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
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row" style="display:none">
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
                    <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="return step2_validation();">Next <i class="fa fa-forward" aria-hidden="true"></i></button>
                </div>
                <!-- /.card-footer-->
            </div>
            <div id="step3" class="card direct-chat direct-chat-primary col-md-12">
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
                                <input type="date" class="form-control" id="order_date" name="order_date">
                                <span style="color:red;" id="order_date_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order ID<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="order_id" name="order_id">
                                <span style="color:red;" id="order_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order Status<span style="color:red;">*</span></label>
                                <select  class="form-control " id="order_status" name="order_status">
                                @foreach ($masterList as $master)
                                    @if($master->type == 'Order Status')
                                    <option value="{{$master->id}}">{{$master->value}}</option>
                                    @endif
                                @endforeach
                                </select>
                                <span style="color:red;" id="order_status_error"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order Amount<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="order_amount" name="order_amount">
                                <span style="color:red;" id="order_amount_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Discount</label>
                                <input type="text" class="form-control" id="discount" name="discount">
                                <span style="color:red;" id="discount_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sales tax charged to Customer</label>
                                <input type="text" class="form-control" id="vat_tax_amount" name="vat_tax_amount">
                                <span style="color:red;" id="vat_tax_amount_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Comission/Other Charges</label>
                                <input type="text" class="form-control" id="comission_other_charges" name="comission_other_charges">
                                <span style="color:red;" id="comission_other_charges_error"></span>
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
                                <input type="text" class="form-control" id="customer_name" name="customer_name">
                                <span style="color:red;" id="customer_name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number">
                                <span style="color:red;" id="phone_number_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                                <span style="color:red;" id="email_error"></span>
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
                                <input type="text" class="form-control" id="shipping_address_line_1" name="shipping_address_line_1">
                                <span style="color:red;" id="shipping_address_line_1_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Shipping Address Line 2</label>
                                <input type="text" class="form-control" id="shipping_address_line_2" name="shipping_address_line_2">
                                <span style="color:red;" id="shipping_address_line_2_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">City<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="shipping_city" name="shipping_city">
                                <span style="color:red;" id="shipping_city_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">State<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="shipping_state" name="shipping_state">
                                <span style="color:red;" id="shipping_state_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Zip code<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="shipping_zip_code" name="shipping_zip_code">
                                <span style="color:red;" id="shipping_zip_code_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Country<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="shipping_country" name="shipping_country">
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
                                <input type="text" class="form-control" id="billing_address_line_1" name="billing_address_line_1">
                                <span style="color:red;" id="billing_address_line_1_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Billing Address Line 2</label>
                                <input type="text" class="form-control" id="billing_address_line_2" name="billing_address_line_2">
                                <span style="color:red;" id="billing_address_line_2_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">City<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="billing_city" name="billing_city">
                                <span style="color:red;" id="billing_city_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">State<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="billing_state" name="billing_state">
                                <span style="color:red;" id="billing_state_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Zip code<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="billing_zip_code" name="billing_zip_code">
                                <span style="color:red;" id="billing_zip_code_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Country<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="billing_country" name="billing_country">
                                <span style="color:red;" id="billing_country_error"></span>
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
                                @foreach ($masterList as $master)
                                    @if($master->type == 'Payment Method')
                                    <option value="{{$master->id}}">{{$master->value}}</option>
                                    @endif
                                @endforeach
                                </select>
                                <span style="color:red;" id="payment_method_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Transaction ID</label>
                                <input type="text" class="form-control" id="transaction_id" name="transaction_id">
                                <span style="color:red;" id="transaction_id_error"></span>
                            </div>
                        </div>
                        
                    </div> 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="return step6_validation();">Next <i class="fa fa-forward" aria-hidden="true"></i></button>
                </div>
                <!-- /.card-footer-->
            </div>
            <div id="step7" class="card direct-chat direct-chat-primary col-md-12">
                <div class="card-header bg-blue">
                    <h3 class="card-title">Vendor Details & Shipping Details</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div id="vendordivlist">
                    <div class="vendordiv0">
                        <div class="card-body" id="vendordiv">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Replacement<span style="color:red;">*</span></label>
                                        <select  class="form-control " name="vendor_replacement[]">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Vendor<span style="color:red;">*</span></label>
                                        <select  class="form-control " name="vendor[]">
                                        @foreach ($vendorList as $vendor)
                                            <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Invoice #/ SO#</label>
                                        <input type="text" class="form-control" name="invoice_number[]">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Vendor Invoice Amount (Inc. Sales tax)</label>
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
                                        @foreach ($masterList as $master)
                                            @if($master->type == 'Payment Method')
                                            <option value="{{$master->id}}">{{$master->value}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Replacement Date</label>
                                        <input type="date" class="form-control" name="replacement_date[]">
                                    </div>
                                </div>
                                <div class="col-md-12" style="border: 2px solid;"></div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shipping Agent</label>
                                        <select  class="form-control" name="broker[]">
                                        @foreach ($masterList as $master)
                                            @if($master->type == 'Broker')
                                            <option value="{{$master->id}}">{{$master->value}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Carrier</label>
                                        <select  class="form-control" name="carrier[]">
                                        @foreach ($masterList as $master)
                                            @if($master->type == 'Carrier')
                                            <option value="{{$master->id}}">{{$master->value}}</option>
                                            @endif
                                        @endforeach
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
                                        <label for="exampleInputEmail1">Delivery Type<span style="color:red;">*</span></label>
                                        <select  class="form-control " name="delivery_type[]">
                                        <option value="Residential with Liftgate/Delivery Appt">Residential with Liftgate/Delivery Appt</option>
                                        <option value="Commercial">Commercial</option>
                                        </select>
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
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shipping Cost</label>
                                        <input type="text" class="form-control" name="shipping_cost[]">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shipping Paid</label>
                                        <select class="form-control" name="shipping_paid_cost[]">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Paid Via</label>
                                        <select class="form-control" name="shipping_paid_via[]">
                                        @foreach ($masterList as $master)
                                            @if($master->type == 'Payment Method')
                                            <option value="{{$master->id}}">{{$master->value}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tracking link<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="vendor_pick_up_reference[]">
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="return step7_validation();">Next <i class="fa fa-forward" aria-hidden="true"></i></button>&nbsp;&nbsp;
                    <button type="button" id="step_btn1" class="btn btn-warning float-left" onclick="addmorevendor();">Add more <i class="fa fa-pluse" aria-hidden="true"></i></button>
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
                                    <option value="Replacement">Replacement</option>
                                    <option value="Refund">Refund</option>
                                    <option value="Compensation">Compensation</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Refund Amount<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="refund_amount" name="refund_amount">
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
                                <label for="exampleInputEmail1">Claim against</label>
                                <select class="form-control" id="claim_against" name="claim_against"  onchange="change_claim_against()">
                                    <option value="">Select</option>
                                    <option value="Vendor">Vendor</option>
                                    <option value="Shipping Company">Shipping Company</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 claim_against" id="vendor_claim_div" style="display:none;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vendor</label>
                                <select class="form-control" id="vendor_claim" name="vendor_claim">
                                    <option value="">Select</option>
                                    @foreach ($vendorList as $vendor)
                                        <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 claim_against" id="shipping_claim_div" style="display:none;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Shipping</label>
                                <select class="form-control" id="shipping_claim" name="shipping_claim">
                                    <option value="">Select</option>
                                    @foreach ($masterList as $master)
                                        @if($master->type == 'Carrier')
                                        <option value="{{$master->id}}">{{$master->value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 claim_against" id="shipping_claim_amount_div" style="display:none;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Refund Amount</label>
                                <input type="text" class="form-control" id="shipping_claim_amount" name="shipping_claim_amount">
                            </div>
                        </div>
                        <div class="col-md-4 claim_against" id="claim_status_div"  style="display:none;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Claim status</label>
                                <select class="form-control" id="claim_status" name="claim_status">
                                    <option value="">Select</option>
                                    <option value="Lodged">Lodged</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div> 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <button type="submit" id="step_btn1" class="btn btn-primary float-right" >Save </button>
                </div>
                <!-- /.card-footer-->
            </div>
        </div>
    
</form> 
</section>
</div>
</div>
</div>
@include('layouts.footer')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
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
var itemcount = 0;
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
    $('#step9').CardWidget('collapse');
		 return 0;
    }
}
function step3_validation(){
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
		$('#step3').CardWidget('collapse');  
		$('#step4').CardWidget('expand'); 
		$('#step5').CardWidget('collapse'); 
		$('#step6').CardWidget('collapse'); 
		$('#step7').CardWidget('collapse');
        $('#step8').CardWidget('collapse');
    $('#step9').CardWidget('collapse');
		 return 0;
    }
}
function step4_validation(){
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
		$('#step4').CardWidget('collapse'); 
		$('#step5').CardWidget('expand'); 
		$('#step6').CardWidget('collapse'); 
		$('#step7').CardWidget('collapse');
        $('#step8').CardWidget('collapse');
    $('#step9').CardWidget('collapse');
		 return 0;
    }
}
function step5_validation(){
    var validation_array = ["shipping_address_line_1", "shipping_city","shipping_city","shipping_state","shipping_zip_code","shipping_country",
    "billing_address_line_1","billing_city","billing_city","billing_state","billing_zip_code","billing_country"];
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
    $('#step9').CardWidget('collapse');

		 return 0;
    }
}
function step6_validation(){
    var validation_array = ["payment_method"];
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
    $('#step9').CardWidget('collapse');

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
    $('#step9').CardWidget('collapse');

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
function step2_validation(){
    $('#step1').CardWidget('collapse');  
    $('#step2').CardWidget('collapse');
    $('#step3').CardWidget('expand');  
    $('#step4').CardWidget('collapse'); 
    $('#step5').CardWidget('collapse'); 
    $('#step6').CardWidget('collapse'); 
    $('#step7').CardWidget('collapse'); 
    $('#step8').CardWidget('collapse');
    $('#step9').CardWidget('collapse');
    return 0;
}
function step8_validation(){
    $('#step1').CardWidget('collapse');  
    $('#step2').CardWidget('collapse');
    $('#step3').CardWidget('collapse');  
    $('#step4').CardWidget('collapse'); 
    $('#step5').CardWidget('collapse'); 
    $('#step6').CardWidget('collapse'); 
    $('#step7').CardWidget('collapse'); 
    $('#step8').CardWidget('collapse');
    $('#step9').CardWidget('expand');
    return 0;
}
function step9_validation(){
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
var vendordivcount = 0;
$(function () {
    $('.select2').select2()
  });
</script>