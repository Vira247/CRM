@include('layouts.header')

<style>
	.error{
		color:red
	}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo URL::to('/home'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Order</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php 
	$session = Auth()->user();
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
	  @if(Session::has('success'))     
        <div class="alert alert-success" role="alert">                                      
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>{{ Session::get('success') }}
        </div> 
        @endif
        @if(Session::has('error') )                          
        <div class="alert alert-danger"> 
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>{{ Session::get('error') }}    
        </div>                            
        @endif
        <div class="row">
         
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                 <!-- <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>-->
                  <li class="nav-item"><a class="nav-link active" href="#sitedetails" data-toggle="tab">Site Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#orderdetails" data-toggle="tab">Order Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#customerdetails" data-toggle="tab">Customer Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#addresses" data-toggle="tab">Addresses</a></li>
                  <li class="nav-item"><a class="nav-link" href="#paymentinfo" data-toggle="tab">Payment Info</a></li>
                  <li class="nav-item"><a class="nav-link" href="#vendordetails" data-toggle="tab">Vendor Shipping Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#items" data-toggle="tab">Items</a></li>
                  <li class="nav-item"><a class="nav-link" href="#claim" data-toggle="tab">Customer's Claim</a></li>
                  <li class="nav-item"><a class="nav-link" href="#villohomeclaim" data-toggle="tab">Villohome's Claim</a></li>
                  <li class="nav-item"><a class="nav-link" href="#logs" data-toggle="tab">Logs</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  
                  <!-- /.tab-pane -->
                 
                  <!-- /.tab-pane -->

					<div class="active tab-pane" id="sitedetails">
						  <div class="form-group row">
							<label for="inputName" class="col-sm-2">Site</label>
							<div class="col-sm-10">
							  {{$master_list[$orderDetail->site]}}
							</div>
						  </div>
						  <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Platform</label>
							<div class="col-sm-10">
                            {{$master_list[$orderDetail->platform]}}
							</div>
						  </div>
					</div>
					<div class=" tab-pane" id="orderdetails">
                        <div class="form-group row">
							<label for="inputName" class="col-sm-2">Order Date</label>
							<div class="col-sm-10">
							  @if($orderDetail->order_date != "") {{date('m/d/Y',strtotime($orderDetail->order_date))}} @endif
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Order ID</label>
							<div class="col-sm-10">
                                {{$orderDetail->order_id}}
							</div>
						</div>
                        <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Order Status</label>
							<div class="col-sm-10">
                                {{$master_list[$orderDetail->order_status]}}
							</div>
						</div>
                        <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Sample Order</label>
							<div class="col-sm-10">
                                {{$orderDetail->sample_order}}
							</div>
						</div>
                        <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Order Amount</label>
							<div class="col-sm-10">
                            {{$orderDetail->order_amount}}
							</div>
						</div>
                        <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">VAT Tax Amount</label>
							<div class="col-sm-10">
                                {{$orderDetail->vat_tax_amount}}
							</div>
						</div>
                        <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Comission/Other Charges</label>
							<div class="col-sm-10">
                            {{$orderDetail->comission_other_charges}}
							</div>
						  </div>
					    </div>
                    <!-- /.tab-pane -->
                    <div class=" tab-pane" id="customerdetails">
                        <div class="form-group row">
							<label for="inputName" class="col-sm-2">Customer Name</label>
							<div class="col-sm-10">
							  {{$orderDetail->customer_name}}
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Phone Number</label>
							<div class="col-sm-10">
                                {{$orderDetail->phone_number}}
							</div>
						</div>
                        <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Email</label>
							<div class="col-sm-10">
                                {{$orderDetail->email}}
							</div>
						</div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class=" tab-pane" id="addresses">
                        <div class="form-group row">
							<label for="inputName" class="col-sm-2">Shipping Address Line 1</label>
							<div class="col-sm-10">
							  {{$orderDetail->shipping_address_line_1}}
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Shipping Address Line 2</label>
							<div class="col-sm-10">
                                {{$orderDetail->shipping_address_line_2}}
							</div>
						</div>
                        <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">City</label>
							<div class="col-sm-10">
                                {{$orderDetail->shipping_city}}
							</div>
						</div>
                        <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">State</label>
							<div class="col-sm-10">
                                {{$orderDetail->shipping_state}}
							</div>
						</div>
                        <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Zip code</label>
							<div class="col-sm-10">
                                {{$orderDetail->shipping_zip_code}}
							</div>
						</div>
                        <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Country</label>
							<div class="col-sm-10">
                                {{$orderDetail->shipping_country}}
							</div>
						</div>

                        <div class="form-group row">
							<label for="inputName" class="col-sm-2">Billing  Address Line 1</label>
							<div class="col-sm-10">
							  {{$orderDetail->billing_address_line_1}}
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Billing  Address Line 2</label>
							<div class="col-sm-10">
                                {{$orderDetail->billing_address_line_2}}
							</div>
						</div>
                        <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">City</label>
							<div class="col-sm-10">
                                {{$orderDetail->billing_city}}
							</div>
						</div>
                        <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">State</label>
							<div class="col-sm-10">
                                {{$orderDetail->billing_state}}
							</div>
						</div>
                        <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Zip code</label>
							<div class="col-sm-10">
                                {{$orderDetail->billing_zip_code}}
							</div>
						</div>
                        <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Country</label>
							<div class="col-sm-10">
                                {{$orderDetail->billing_country}}
							</div>
						</div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class=" tab-pane" id="paymentinfo">
                        <div class="form-group row">
							<label for="inputName" class="col-sm-2">Payment Method</label>
							<div class="col-sm-10">
							  {{$master_list[$orderDetail->payment_method]}}
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Transaction ID</label>
							<div class="col-sm-10">
                                {{$orderDetail->transaction_id}}
							</div>
						</div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class=" tab-pane" id="vendordetails">
						<?php foreach($orderVendorDetail as $vendor){ ?>
						<div class="form-group row">
							<label for="inputName" class="col-sm-2">Vendor</label>
							<div class="col-sm-4">
							{{$vendorList[$vendor->vendor_id]}}
							</div>
							<label for="inputName" class="col-sm-2">Invoice Number</label>
							<div class="col-sm-4">
							{{$vendor->invoice_number}}
							</div>
						</div>
						<div class="form-group row">
							<label for="inputName" class="col-sm-2">Sales/Pick-up Reference</label>
							<div class="col-sm-4">
							{{$vendor->vendor_pick_up_reference}}
							</div>
							<label for="inputName" class="col-sm-2">Vendor Invoice Amount</label>
							<div class="col-sm-4">
							{{$vendor->vendor_invoice_amount}}
							</div>
						</div>
						<div class="form-group row">
							<label for="inputName" class="col-sm-2">Sales Tax Amount</label>
							<div class="col-sm-4">
							{{$vendor->vendor_sales_tax_amount}}
							</div>
							<label for="inputName" class="col-sm-2">Invoice Paid</label>
							<div class="col-sm-4">
							{{$vendor->vendor_invoice_paid}}
							</div>
						</div>
						<div class="form-group row">
							<label for="inputName" class="col-sm-2">Paid Via</label>
							<div class="col-sm-4">
							{{$master_list[$vendor->vendor_paid_via]}}
							</div>
							<label for="inputName" class="col-sm-2">Broker</label>
							<div class="col-sm-4">
							{{$master_list[$vendor->broker]}}
							</div>
						</div>
						<div class="form-group row">
							<label for="inputName" class="col-sm-2">Carrier</label>
							<div class="col-sm-4">
							{{$master_list[$vendor->carrier]}}
							</div>
							<label for="inputName" class="col-sm-2">BOL Number</label>
							<div class="col-sm-4">
							{{$vendor->bol_number}}
							</div>
						</div>
						<div class="form-group row">
							<label for="inputName" class="col-sm-2">Pick-up ZIP Code</label>
							<div class="col-sm-4">
							{{$vendor->pick_up_zip_code}}
							</div>
							<label for="inputName" class="col-sm-2">Delevery ZIP Code</label>
							<div class="col-sm-4">
							{{$vendor->delevery_zip_code}}
							</div>
						</div>
						<div class="form-group row">
							<label for="inputName" class="col-sm-2">Total Weight</label>
							<div class="col-sm-4">
							{{$vendor->total_weight}}
							</div>
							<label for="inputName" class="col-sm-2">Shipment</label>
							<div class="col-sm-4">
							{{$vendor->shipment}}
							</div>
						</div>
						<div class="form-group row">
							<label for="inputName" class="col-sm-2">Shipping Cost</label>
							<div class="col-sm-4">
							{{$vendor->shipping_cost}}
							</div>
							<label for="inputName" class="col-sm-2">Shipping Paid</label>
							<div class="col-sm-4">
							{{$vendor->shipping_paid_cost}}
							</div>
						</div>
						<div class="form-group row">
							<label for="inputName" class="col-sm-2">Paid Via</label>
							<div class="col-sm-4">
							{{$master_list[$vendor->shipping_paid_via]}}
							</div>
							<label for="inputName" class="col-sm-2">Tracking#/PRO#</label>
							<div class="col-sm-4">
							{{$vendor->tracking_number}}
							</div>
						</div>
						<hr>
						<?php } ?>
                       
                    </div>
					<div class=" tab-pane" id="items">
                        <div class="form-group row">
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap">
								<thead>
									<tr>
									<th>Vendor</th>
									<th>Product</th>
									<th>Unit</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Amount</th>
									</tr>
								</thead>
								<tbody>
								@foreach ($orderItemDetail as $list)
									<tr>
									<td>{{$list->vendorname}}</td>
									<td>{{$list->productname}}</td>
									<td>{{$list->itemunit}}</td>
									<td>{{$list->quantity}}</td>
									<td>{{$list->price}}</td>
									<td>{{$list->amount}}</td>
									</tr>
								@endforeach
								</tbody>
								</table>
							</div>
						</div>
                    </div>
					<div class="tab-pane" id="claim">
						  <div class="form-group row">
							<label for="inputName" class="col-sm-2">Claim</label>
							<div class="col-sm-10">
							  {{$orderDetail->claim_refund}}
							</div>
						  </div>
						  <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Refund Amount</label>
							<div class="col-sm-10">
                            {{$orderDetail->refund_amount}}
							</div>
						  </div>
					</div>
					<div class="tab-pane" id="villohomeclaim">
						  <div class="form-group row">
							<label for="inputName" class="col-sm-2">Claim</label>
							<div class="col-sm-10">
							  {{$orderDetail->claim_against}}
							</div>
						  </div>
						  @if($orderDetail->claim_against == "Vendor")
						  <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Vendor</label>
							<div class="col-sm-10">
                            @if(isset($vendorList[$orderDetail->vendor_claim])) {{$vendorList[$orderDetail->vendor_claim]}} @endif
							</div>
						  </div>
						  @endif
						  @if($orderDetail->claim_against == "Shipping Company")
						  <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Shipping Company</label>
							<div class="col-sm-10">
                            {{$master_list[$orderDetail->shipping_claim]}}
							</div>
						  </div>
						  @endif
						  <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Amount</label>
							<div class="col-sm-10">
                            {{$orderDetail->shipping_claim_amount}}
							</div>
						  </div>
						  
						  <div class="form-group row">
							<label for="inputEmail" class="col-sm-2">Claim status</label>
							<div class="col-sm-10">
                            {{$orderDetail->claim_status}}
							</div>
						  </div>
					</div>
					<div class=" tab-pane" id="logs">
                        <div class="form-group row">
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap">
								<thead>
									<tr>
									<th>User</th>
									<th>Date</th>
									<th>Note</th>
									<th>Old Data</th>
									<th>New Data</th>
									</tr>
								</thead>
								<tbody>
								@foreach ($logList as $list)
									<tr>
									<td>{{$list->name}}</td>
									<td>{{date('m/d/Y h:i A',strtotime($list->created_at))}}</td>
									<td>{{$list->message}}</td>
									<td><?php if(isset($list->old_data)){
										$array = unserialize($list->old_data);
										foreach($array as $key=>$value){
											echo $key."=".$value."<br>";
										}
									} ?></td>
									<td><?php if(isset($list->new_data)){
										$array = unserialize($list->new_data);
										foreach($array as $key=>$value){
											echo $key."=".$value."<br>";
										}
									} ?></td>
									</tr>
								@endforeach
								</tbody>
								</table>
							</div>
						</div>
						
                    </div>

                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- /.content-wrapper -->
  @include('layouts.footer')