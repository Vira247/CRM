@include('layouts.header')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
    {!! Form::model($orderDetail, ['method' => 'PATCH','route' => ['order.update', $orderDetail->id],'enctype' => "multipart/form-data"]) !!}
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Site<span style="color:red;">*</span></label>
                            <select  class="form-control " id="site"  name="site" >
                            @foreach ($masterList as $master)
                                @if($master->type == 'Site')
                                <option value="{{$master->id}}" @if($master->id == $orderDetail->site) selected @endif>{{$master->value}}</option>
                                @endif
                            @endforeach
                            </select>
                            <span style="color:red;" id="site_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Platform<span style="color:red;">*</span></label>
                            <select  class="form-control " id="platform"  name="platform" >
                            @foreach ($masterList as $master)
                                @if($master->type == 'Platform')
                                <option value="{{$master->id}}" @if($master->id == $orderDetail->platform) selected @endif >{{$master->value}}</option>
                                @endif
                            @endforeach
                            </select>
                            <span style="color:red;" id="platform_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Flag</label>
                                <select  class="form-control " id="flag"  name="flag" >
                                <option value="">Select Flag</option>
                                <option value="Green" @if($orderDetail->flag == "Green") selected @endif>Green</option>
                                <option value="Red" @if($orderDetail->flag == "Red") selected @endif>Red</option>
                                <option value="Blue" @if($orderDetail->flag == "Blue") selected @endif>Blue</option>
                                <option value="Orange" @if($orderDetail->flag == "Orange") selected @endif>Orange</option>
                                <option value="Yellow" @if($orderDetail->flag == "Yellow") selected @endif>Yellow</option>
                                <option value="Pink" @if($orderDetail->flag == "Pink") selected @endif>Pink</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Primary Agent<span style="color:red;">*</span></label>
                                <select  class="form-control " id="primary_agent"  name="primary_agent" >
                                @foreach ($userList as $user)
                                    <option value="{{$user->id}}" @if($user->id == $orderDetail->primary_agent) selected @endif >{{$user->name}}</option>
                                 @endforeach
                                </select>
                                <span style="color:red;" id="site_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Secondary Agent<span style="color:red;">*</span></label>
                                <select  class="form-control " id="secondary_agent"  name="secondary_agent" >
                                @foreach ($userList as $user)
                                    <option value="{{$user->id}}" @if($user->id == $orderDetail->secondary_agent) selected @endif >{{$user->name}}</option>
                                 @endforeach
                                </select>
                                <span style="color:red;" id="site_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <label for="exampleInputEmail1">Extra Note</label>
                        <textarea class="form-control" name="extranote">{{$orderDetail->extranote}}</textarea>
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
                                <th width="10%">Amount</th>
                                <th width="5%">Price</th>
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
                            <?php $itemcount=0; ?>
                            @foreach ($orderItemDetail as $list)
                                <tr id="itemtr{{$itemcount}}">
                                <td>{{$list->vendorname}}<input type="hidden" name="vendorid[]" value="{{$list->vendor_id}}"></td>
                                <td>{{$list->producttype}}<input type="hidden" name="producttypeid[]" value="{{$list->producttype}}"></td>
                                <td>{{$list->productname}}<input type="hidden" name="productid[]" value="{{$list->product_id}}"></td>
                                <td>{{$list->itemunit}}<input type="hidden" name="itemunit[]" value="{{$list->itemunit}}"></td>
                                <td>{{$list->quantity}}<input type="hidden" name="quantity[]" value="{{$list->quantity}}"></td>
                                <td>{{$list->price}}<input type="hidden" name="price[]" value="{{$list->price}}"><input type="hidden" name="amount[]" value="{{$list->amount}}"> </td>
                                <td  class="allamount">{{$list->amount}}</td>
                                <td><a href="#" title="Delete" onclick="removeItem({{$itemcount}})"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <?php $itemcount++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row"  style="display:none">
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
                <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="return step3_validation();">Next <i class="fa fa-forward" aria-hidden="true"></i></button>
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
                            <input type="date" class="form-control" id="order_date" name="order_date" value="{{$orderDetail->order_date}}">
                            <span style="color:red;" id="order_date_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Order ID<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="order_id" name="order_id"  value="{{$orderDetail->order_id}}">
                            <span style="color:red;" id="order_id_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Order Status<span style="color:red;">*</span></label>
                            <select  class="form-control " id="order_status" name="order_status">
                            @foreach ($masterList as $master)
                                @if($master->type == 'Order Status')
                                <option value="{{$master->id}}" @if($master->id == $orderDetail->order_status) selected @endif >{{$master->value}}</option>
                                @endif
                            @endforeach
                            </select>
                            <span style="color:red;" id="order_status_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Order Amount<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="order_amount" name="order_amount"  value="{{$orderDetail->order_amount}}">
                            <span style="color:red;" id="order_amount_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Discount<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="discount" name="discount"  value="{{$orderDetail->discount}}">
                            <span style="color:red;" id="order_amount_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">VAT Tax Amount</label>
                            <input type="text" class="form-control" id="vat_tax_amount" name="vat_tax_amount" value="{{$orderDetail->vat_tax_amount}}">
                            <span style="color:red;" id="vat_tax_amount_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Comission/Other Charges</label>
                            <input type="text" class="form-control" id="comission_other_charges" name="comission_other_charges" value="{{$orderDetail->comission_other_charges}}">
                            <span style="color:red;" id="comission_other_charges_error"></span>
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
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{$orderDetail->customer_name}}">
                            <span style="color:red;" id="customer_name_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{$orderDetail->phone_number}}">
                            <span style="color:red;" id="phone_number_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{$orderDetail->email}}">
                            <span style="color:red;" id="email_error"></span>
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
                            <input type="text" class="form-control" id="shipping_address_line_1" name="shipping_address_line_1" value="{{$orderDetail->shipping_address_line_1}}">
                            <span style="color:red;" id="shipping_address_line_1_error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Shipping Address Line 2</label>
                            <input type="text" class="form-control" id="shipping_address_line_2" name="shipping_address_line_2" value="{{$orderDetail->shipping_address_line_2}}">
                            <span style="color:red;" id="shipping_address_line_2_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">City<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="shipping_city" name="shipping_city" value="{{$orderDetail->shipping_city}}">
                            <span style="color:red;" id="shipping_city_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">State<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="shipping_state" name="shipping_state" value="{{$orderDetail->shipping_state}}">
                            <span style="color:red;" id="shipping_state_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Zip code<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="shipping_zip_code" name="shipping_zip_code" value="{{$orderDetail->shipping_zip_code}}">
                            <span style="color:red;" id="shipping_zip_code_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Country<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="shipping_country" name="shipping_country" value="{{$orderDetail->shipping_country}}">
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
                            <input type="text" class="form-control" id="billing_address_line_1" name="billing_address_line_1" value="{{$orderDetail->billing_address_line_1}}">
                            <span style="color:red;" id="billing_address_line_1_error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Billing Address Line 2<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="billing_address_line_2" name="billing_address_line_2" value="{{$orderDetail->billing_address_line_2}}">
                            <span style="color:red;" id="billing_address_line_2_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">City<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="billing_city" name="billing_city" value="{{$orderDetail->billing_city}}">
                            <span style="color:red;" id="billing_city_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">State<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="billing_state" name="billing_state" value="{{$orderDetail->billing_state}}">
                            <span style="color:red;" id="billing_state_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Zip code<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="billing_zip_code" name="billing_zip_code" value="{{$orderDetail->billing_zip_code}}">
                            <span style="color:red;" id="billing_zip_code_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Country<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="billing_country" name="billing_country" value="{{$orderDetail->billing_country}}">
                            <span style="color:red;" id="billing_country_error"></span>
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
                                <option value="{{$master->id}}" @if($master->id == $orderDetail->payment_method) selected @endif >{{$master->value}}</option>
                                @endif
                            @endforeach
                            </select>
                            <span style="color:red;" id="payment_method_error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Transaction ID</label>
                            <input type="text" class="form-control" id="transaction_id" name="transaction_id" value="{{$orderDetail->transaction_id}}">
                            <span style="color:red;" id="transaction_id_error"></span>
                        </div>
                    </div>
                    
                </div> 
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="return step7_validation();">Next <i class="fa fa-forward" aria-hidden="true"></i></button>
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
                <?php $cnt=0; foreach($orderVendorDetail as $vendors){ ?>
                    <div class="card-body"id="vendordiv{{$cnt}}" >
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Replacement<span style="color:red;">*</span></label>
                                        <select  class="form-control " name="vendor_replacement[]">
                                        <option value="No" <?php if("No"==$vendors->vendor_replacement){ echo "selected"; }?> >No</option>
                                        <option value="Yes" <?php if("Yes"==$vendors->vendor_replacement){ echo "selected"; }?> >Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Vendor<span style="color:red;">*</span></label>
                                        <select  class="form-control " name="vendor[]">
                                        @foreach ($vendorList as $vendor)
                                        <option value="{{$vendor->id}}" <?php if($vendor->id==$vendors->vendor_id){ echo "selected"; }?> >{{$vendor->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Invoice #/ SO#</label>
                                        <input type="text" class="form-control" name="invoice_number[]" value="{{$vendors->invoice_number}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Vendor Invoice Amount (Inc. Sales tax)</label>
                                        <input type="text" class="form-control" name="vendor_invoice_amount[]" value="{{$vendors->vendor_invoice_amount}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sales tax charged by Vendor</label>
                                        <input type="text" class="form-control" name="vendor_sales_tax_amount[]" value="{{$vendors->vendor_sales_tax_amount}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Invoice Paid</label>
                                        <select  class="form-control" name="vendor_invoice_paid[]">
                                        <option value="Yes" <?php if("Yes"==$vendors->vendor_invoice_paid){ echo "selected"; }?> >Yes</option>
                                        <option value="No" <?php if("No"==$vendors->vendor_invoice_paid){ echo "selected"; }?> >No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Paid Via</label>
                                        <select  class="form-control" name="vendor_paid_via[]">
                                        @foreach ($masterList as $master)
                                            @if($master->type == 'Payment Method')
                                            <option value="{{$master->id}}" <?php if($master->id == $vendors->vendor_paid_via){ echo "selected"; }?>>{{$master->value}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" style="display:<?php if($vendors->vendor_replacement == "Yes"){ echo "block"; }else{ echo "none"; }?>;">
                                        <label for="exampleInputEmail1">Replacement Date</label>
                                        <input type="date" class="form-control" name="replacement_date[]" value="{{$vendors->replacement_date}}">
                                    </div>
                                </div>
                                <div class="col-md-12" style="border: 2px solid;"></div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shipping Agent</label>
                                        <select  class="form-control" name="broker[]">
                                        @foreach ($masterList as $master)
                                            @if($master->type == 'Broker')
                                            <option value="{{$master->id}}" <?php if($master->id == $vendors->broker){ echo "selected"; }?>>{{$master->value}}</option>
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
                                            <option value="{{$master->id}}" <?php if($master->id == $vendors->carrier){ echo "selected"; }?>>{{$master->value}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">BOL Number</label>
                                        <input type="text" class="form-control" name="bol_number[]" value="{{$vendors->bol_number}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Delivery Type<span style="color:red;">*</span></label>
                                        <select  class="form-control " name="delivery_type[]">
                                        <option value="Residential with Liftgate/Delivery Appt" <?php if("Residential with Liftgate/Delivery Appt"==$vendors->delivery_type){ echo "selected"; }?>  >Residential with Liftgate/Delivery Appt</option>
                                        <option value="Commercial"  <?php if("Commercial"==$vendors->delivery_type){ echo "selected"; }?> >Commercial</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pick-up ZIP Code</label>
                                        <input type="text" class="form-control" name="pick_up_zip_code[]" value="{{$vendors->pick_up_zip_code}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Delevery ZIP Code</label>
                                        <input type="text" class="form-control" name="delevery_zip_code[]" value="{{$vendors->delevery_zip_code}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Travelling Distance (Miles):</label>
                                        <input type="text" class="form-control" name="distance[]" value="{{$vendors->distance}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Total Weight</label>
                                        <input type="text" class="form-control" name="total_weight[]" value="{{$vendors->total_weight}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shipping Cost</label>
                                        <input type="text" class="form-control" name="shipping_cost[]" value="{{$vendors->shipping_cost}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shipping Paid</label>
                                        <select class="form-control" name="shipping_paid_cost[]">
                                        <option value="Yes" <?php if("Yes" == $vendors->shipping_paid_cost){ echo "selected"; }?>>Yes</option>
                                        <option value="No" <?php if("No" == $vendors->shipping_paid_cost){ echo "selected"; }?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Paid Via</label>
                                        <select class="form-control" name="shipping_paid_via[]">
                                        @foreach ($masterList as $master)
                                            @if($master->type == 'Payment Method')
                                            <option value="{{$master->id}}"  <?php if($master->id == $vendors->shipping_paid_via){ echo "selected"; }?>>{{$master->value}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tracking#/PRO#</label>
                                        <input type="text" class="form-control" name="tracking_number[]" value="{{$vendors->tracking_number}}">
                                        <span style="color:red;" id="tracking_number_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pick-up Remarks</label>
                                        <input type="text" class="form-control" name="shipment[]" value="{{$vendors->shipment}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Delivery Remarks</label>
                                        <input type="text" class="form-control" name="delivery_remark[]" value="{{$vendors->delivery_remark}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tracking link<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="vendor_pick_up_reference[]" value="{{$vendors->vendor_pick_up_reference}}">
                                    </div>
                                </div>
                            </div> 
                        </div>
                    
                    <?php if($cnt > 0){ ?>
                        <div class="card-footer vendordiv{{$cnt}}">
                            <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="removemorevendor({{$cnt}});">Remove <i class="fa fa-pluse" aria-hidden="true"></i></button>
                        </div>
                    <?php } ?>
                <?php $cnt++; } ?>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" id="step_btn1" class="btn btn-primary float-right" onclick="return step8_validation();">Next <i class="fa fa-forward" aria-hidden="true"></i></button>&nbsp;&nbsp;
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
                                    <option value="Replacement"  @if('Replacement' == $orderDetail->claim_refund) selected @endif>Replacement</option>
                                    <option value="Refund"  @if('Refund' == $orderDetail->claim_refund) selected @endif>Refund</option>
                                    <option value="Compensation"  @if('Compensation' == $orderDetail->claim_refund) selected @endif>Compensation</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Refund Amount<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="refund_amount" name="refund_amount" value="{{$orderDetail->refund_amount}}">
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
                                    <option value="Vendor"  @if('Vendor' == $orderDetail->claim_against) selected @endif >Vendor</option>
                                    <option value="Shipping Company"  @if('Shipping Company' == $orderDetail->claim_against) selected @endif >Shipping Company</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 claim_against" id="vendor_claim_div" style="display:@if('Vendor' == $orderDetail->claim_against) block @else none @endif;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vendor<span style="color:red;">*</span></label>
                                <select class="form-control" id="vendor_claim" name="vendor_claim">
                                    <option value="">Select</option>
                                    @foreach ($vendorList as $vendor)
                                        <option value="{{$vendor->id}}" @if($vendor->id == $orderDetail->vendor_claim) selected @endif >{{$vendor->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 claim_against" id="shipping_claim_div" style="display:@if('Shipping Company' == $orderDetail->claim_against) block @else none @endif;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Shipping<span style="color:red;">*</span></label>
                                <select class="form-control" id="shipping_claim" name="shipping_claim">
                                    <option value="">Select</option>
                                    @foreach ($masterList as $master)
                                        @if($master->type == 'Carrier')
                                        <option value="{{$master->id}}" @if($master->id == $orderDetail->shipping_claim) selected @endif >{{$master->value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 claim_against" id="shipping_claim_amount_div" style="display:@if('' != $orderDetail->claim_against) block @else none @endif;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Refund Amount<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="shipping_claim_amount" name="shipping_claim_amount" value="{{$orderDetail->shipping_claim_amount}}">
                            </div>
                        </div>
                        <div class="col-md-4 claim_against" id="claim_status_div"  style="display:@if('' != $orderDetail->claim_against) block @else none @endif;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Claim status<span style="color:red;">*</span></label>
                                <select class="form-control" id="claim_status" name="claim_status">
                                    <option value="">Select</option>
                                    <option value="Lodged" @if("Lodged" == $orderDetail->claim_status) selected @endif >Lodged</option>
                                    <option value="Processing"  @if("Processing" == $orderDetail->claim_status) selected @endif >Processing</option>
                                    <option value="Completed"  @if("Completed" == $orderDetail->claim_status) selected @endif >Completed</option>
                                    
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
                <label for="exampleInputEmail1">Invoice Number</label>
                <input type="text" class="form-control" name="invoice_number[]">
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
                @foreach ($masterList as $master)
                    @if($master->type == 'Payment Method')
                    <option value="{{$master->id}}">{{$master->value}}</option>
                    @endif
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3" >
            <div class="form-group" style="display:none;">
                <label for="exampleInputEmail1">Replacement Date</label>
                <input type="text" class="form-control" name="replacement_date[]">
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
@include('layouts.footer')
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
var itemcount = parseInt('{{$itemcount}}');
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
		var amount = parseFloat(price)/parseFloat(quantity);
        amount = amount.toFixed(2);
        itemcount++;
		var html = '<tr id="itemtr'+itemcount+'"><td>'+vendortext+'<input type="hidden" name="vendorid[]" value="'+vendor+'"></td><td>'+producttypetext+'<input type="hidden" name="producttypeid[]" value="'+producttype+'"></td><td>'+text+'<input type="hidden" name="productid[]" value="'+id+'"></td><td><input type="hidden" name="itemunit[]" value="'+itemunit+'">'+itemunit+'</td><td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td><td><input type="hidden" name="price[]" value="'+amount+'">'+amount+'<input type="hidden" name="amount[]" value="'+price+'"></td><td class="allamount">'+price+'</td><td><a href="#" onclick="removeItem('+itemcount+')"><i class="fa fa-trash"></i></td></tr>';
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
		$('#step3').CardWidget('expand');  
		$('#step4').CardWidget('collapse'); 
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
		$('#step4').CardWidget('expand'); 
		$('#step5').CardWidget('collapse'); 
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
		$('#step5').CardWidget('expand'); 
		$('#step6').CardWidget('collapse'); 
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
		$('#step6').CardWidget('expand'); 
		$('#step7').CardWidget('collapse');
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
    $('#step7').CardWidget('expand');
    $('#step8').CardWidget('collapse');
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
		$('#step6').CardWidget('expand'); 
		$('#step7').CardWidget('collapse'); 
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
var vendordivcount = parseInt('{{$cnt}}');
$(function () {
    $('.select2').select2()
  });
  getTotal();
</script>