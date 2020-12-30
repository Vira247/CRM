<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Helpers\UserHelper;
use App\Helpers\RoleHelper;
use App\Helpers\MasterListHelper;
use App\Helpers\VendorHelper;
use App\Helpers\ProductHelper;
use App\Helpers\OrderHelper;
use App\Helpers\OrderLogHelper;
use App\Helpers\OrderVendorDetailHelper;
use App\Helpers\OrderItemDetailHelper;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class OrderController extends Controller{
	function __construct(){
         $this->middleware('permission:order-list|order-create|order-edit|order-delete', ['only' => ['index','store']]);
         $this->middleware('permission:order-create', ['only' => ['create','store']]);
         $this->middleware('permission:order-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:order-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $data['master_list'] = MasterListHelper::getByTypePluck();
        $data['table_list'] = OrderHelper::getPaginateData();
        return view('order.index',$data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $data['vendorList'] = VendorHelper::getList();
        $data['masterList'] = MasterListHelper::getByMultipleTypes(array('Site','Platform','Order Status','Payment Method','Broker','Carrier','Product Type'));
        return view('order.create',$data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //echo "<pre>"; \print_r($request->all());die;
        $vendorList = $request->input('vendor');
        $invoiceNumberList = $request->input('invoice_number');
        $vendorPickUpReferenceList = $request->input('vendor_pick_up_reference');
        $vendorInvoiceAmountList = $request->input('vendor_invoice_amount');
        $vendorSalesTaxAmountList = $request->input('vendor_sales_tax_amount');
        $vendorInvoicePaidList = $request->input('vendor_invoice_paid');
        $vendorPaidViaList = $request->input('vendor_paid_via');
        $brokerList = $request->input('broker');
        $carrierList = $request->input('carrier');
        $bolNumberList = $request->input('bol_number');
        $pickUpZipCodeList = $request->input('pick_up_zip_code');
        $deleveryZipCodeList = $request->input('delevery_zip_code');
        $totalWeightList = $request->input('total_weight');
        $shipmentList = $request->input('shipment');
        $shippingCostList = $request->input('shipping_cost');
        $shippingPaidCostList = $request->input('shipping_paid_cost');
        $shippingPaidViaList = $request->input('shipping_paid_via');
        $trackingNumberList = $request->input('tracking_number');
        $vendor_replacement = $request->input('vendor_replacement');
        $itemunit = $request->input('itemunit');
        $distance = $request->input('distance');
        $delivery_remark = $request->input('delivery_remark');
		$user_data = auth()->user();
        //$insert_array = $request->all();
        $insert_array = array("site"=>$request->input('site'),
            "platform"=>$request->input('platform'),
            "order_date"=>$request->input('order_date'),
            "order_id"=>$request->input('order_id'),
            "order_status"=>$request->input('order_status'),
            "order_amount"=>$request->input('order_amount'),
            "vat_tax_amount"=>$request->input('vat_tax_amount'),
            "comission_other_charges"=>$request->input('comission_other_charges'),
            "customer_name"=>$request->input('customer_name'),
            "phone_number"=>$request->input('phone_number'),
            "email"=>$request->input('email'),
            "shipping_address_line_1"=>$request->input('shipping_address_line_1'),
            "shipping_address_line_2"=>$request->input('shipping_address_line_2'),
            "shipping_city"=>$request->input('shipping_city'),
            "shipping_state"=>$request->input('shipping_state'),
            "shipping_country"=>$request->input('shipping_country'),
            "shipping_zip_code"=>$request->input('shipping_zip_code'),
            "billing_address_line_1"=>$request->input('billing_address_line_1'),
            "billing_address_line_2"=>$request->input('billing_address_line_2'),
            "billing_city"=>$request->input('billing_city'),
            "billing_state"=>$request->input('billing_state'),
            "billing_zip_code"=>$request->input('billing_zip_code'),
            "billing_country"=>$request->input('billing_country'),
            "payment_method"=>$request->input('payment_method'),
            "claim_refund"=>$request->input('claim_refund'),
            "refund_amount"=>$request->input('refund_amount'),
            "transaction_id"=>$request->input('transaction_id'),
            "claim_against"=>$request->input('claim_against'),
            "vendor_claim"=>$request->input('vendor_claim'),
            "shipping_claim"=>$request->input('shipping_claim'),
            "shipping_claim_amount"=>$request->input('shipping_claim_amount'),
            "claim_status"=>$request->input('claim_status'),
        );
//        echo "<pre>"; \print_r($insert_array); die;
		$insert = OrderHelper::insert($insert_array);
		if($insert){
            $cnt = 0;
            foreach($vendorList as $list){
                $inserArray = array("vendor_id"=>$list,
                    "order_id"=>$insert,
                    "invoice_number"=>$invoiceNumberList[$cnt],
                    "vendor_replacement"=>$vendor_replacement[$cnt],
                    "vendor_pick_up_reference"=>$vendorPickUpReferenceList[$cnt],
                    "vendor_invoice_amount"=>$vendorInvoiceAmountList[$cnt],
                    "vendor_sales_tax_amount"=>$vendorSalesTaxAmountList[$cnt],
                    "vendor_invoice_paid"=>$vendorInvoicePaidList[$cnt],
                    "vendor_paid_via"=>$vendorPaidViaList[$cnt],
                    "broker"=>$brokerList[$cnt],
                    "carrier"=>$carrierList[$cnt],
                    "bol_number"=>$bolNumberList[$cnt],
                    "pick_up_zip_code"=>$pickUpZipCodeList[$cnt],
                    "delevery_zip_code"=>$deleveryZipCodeList[$cnt],
                    "total_weight"=>$totalWeightList[$cnt],
                    "shipment"=>$shipmentList[$cnt],
                    "delivery_remark"=>$delivery_remark[$cnt],
                    "shipping_cost"=>$shippingCostList[$cnt],
                    "shipping_paid_cost"=>$shippingPaidCostList[$cnt],
                    "shipping_paid_via"=>$shippingPaidViaList[$cnt],
                    "tracking_number"=>$trackingNumberList[$cnt],
                    "distance"=>$distance[$cnt],
                );
                $cnt++;
                OrderVendorDetailHelper::insert($inserArray);
            }
            $cnt=0;
            $vendorId = $request->input('vendorid');
            $productType = $request->input('producttypeid');
            $productId = $request->input('productid');
            $quantity = $request->input('quantity');
            $price = $request->input('price');
            $amount = $request->input('amount');
            if(isset($vendorId) && count($vendorId) > 0){
                foreach($vendorId as $vendor){
                    $inserArray = array(
                        "order_id"=>$insert,
                        "vendor_id"=> $vendor,
                        "itemunit"=> $itemunit[$cnt],
                        "producttype"=>$productType[$cnt],
                        "product_id"=>$productId[$cnt],
                        "quantity"=>$quantity[$cnt],
                        "price"=>$price[$cnt],
                        "amount"=>$amount[$cnt]
                    );
                    $cnt++;
                    OrderItemDetailHelper::insert($inserArray);
                }
            }
            
			Session::flash('success', 'Order inserted successfully.');
			return redirect('order');
		}else{
			Session::flash('error', 'Sorry, something went wrong. Please try again.');
			return redirect()->back();
		}
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $data['vendorList'] = VendorHelper::getByTypePluck();
        $data['orderDetail'] = OrderHelper::getByid($id);
        $data['orderVendorDetail'] = OrderVendorDetailHelper::getByOrderid($id);
        $data['orderItemDetail'] = OrderItemDetailHelper::getByOrderid($id);
        //echo "<pre>"; print_r($data['orderItemDetail']); die;
        $data['master_list'] = MasterListHelper::getByTypePluck();
        $data['vendor'] = array();
        if($data['orderDetail']->vendor != ""){
            $data['vendor'] = VendorHelper::getByid($data['orderDetail']->vendor);
        }
        $data['logList'] = OrderLogHelper::getLogsByOrderId($id);
        return view('order.show',$data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $data['vendorList'] = VendorHelper::getList();
        $data['masterList'] = MasterListHelper::getByMultipleTypes(array('Site','Platform','Order Status','Payment Method','Broker','Carrier','Product Type'));
        $data['orderDetail'] = OrderHelper::getByid($id);
        $data['orderVendorDetail'] = OrderVendorDetailHelper::getByOrderid($id);
        $data['orderItemDetail'] = OrderItemDetailHelper::getByOrderid($id);
        return view('order.edit',$data);
	}
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        /*$this->validate($request, [
            'site' => 'required',
            'platform' => 'required',
            'order_date' => 'required',
            'order_id' => 'required',
            'order_status' => 'required',
            'sample_order' => 'required',
            'order_amount' => 'required',
            'vat_tax_amount' => 'required',
            'comission_other_charges' => 'required',
            'customer_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'shipping_address_line_1' => 'required',
            'shipping_address_line_2' => 'required',
        ]);*/
		$vendorList = $request->input('vendor');
        $invoiceNumberList = $request->input('invoice_number');
        $vendorPickUpReferenceList = $request->input('vendor_pick_up_reference');
        $vendorInvoiceAmountList = $request->input('vendor_invoice_amount');
        $vendorSalesTaxAmountList = $request->input('vendor_sales_tax_amount');
        $vendorInvoicePaidList = $request->input('vendor_invoice_paid');
        $vendorPaidViaList = $request->input('vendor_paid_via');
        $brokerList = $request->input('broker');
        $carrierList = $request->input('carrier');
        $bolNumberList = $request->input('bol_number');
        $pickUpZipCodeList = $request->input('pick_up_zip_code');
        $deleveryZipCodeList = $request->input('delevery_zip_code');
        $totalWeightList = $request->input('total_weight');
        $shipmentList = $request->input('shipment');
        $shippingCostList = $request->input('shipping_cost');
        $shippingPaidCostList = $request->input('shipping_paid_cost');
        $shippingPaidViaList = $request->input('shipping_paid_via');
        $trackingNumberList = $request->input('tracking_number');
        $distance = $request->input('distance');
        //echo "<pre>"; print_r($distance); die;
        $vendor_replacement = $request->input('vendor_replacement');
        $itemunit = $request->input('itemunit');
        $delivery_remark = $request->input('delivery_remark');
		$user_data = auth()->user();
        //$insert_array = $request->all();
        $update_array = array("site"=>$request->input('site'),
            "platform"=>$request->input('platform'),
            "order_date"=>$request->input('order_date'),
            "order_id"=>$request->input('order_id'),
            "order_status"=>$request->input('order_status'),
            "order_amount"=>$request->input('order_amount'),
            "vat_tax_amount"=>$request->input('vat_tax_amount'),
            "comission_other_charges"=>$request->input('comission_other_charges'),
            "customer_name"=>$request->input('customer_name'),
            "phone_number"=>$request->input('phone_number'),
            "email"=>$request->input('email'),
            "shipping_address_line_1"=>$request->input('shipping_address_line_1'),
            "shipping_address_line_2"=>$request->input('shipping_address_line_2'),
            "shipping_city"=>$request->input('shipping_city'),
            "shipping_state"=>$request->input('shipping_state'),
            "shipping_zip_code"=>$request->input('shipping_zip_code'),
            "shipping_country"=>$request->input('shipping_country'),
            "billing_address_line_1"=>$request->input('billing_address_line_1'),
            "billing_address_line_2"=>$request->input('billing_address_line_2'),
            "billing_city"=>$request->input('billing_city'),
            "billing_state"=>$request->input('billing_state'),
            "billing_zip_code"=>$request->input('billing_zip_code'),
            "billing_country"=>$request->input('billing_country'),
            "payment_method"=>$request->input('payment_method'),
            "claim_refund"=>$request->input('claim_refund'),
            "refund_amount"=>$request->input('refund_amount'),
            "transaction_id"=>$request->input('transaction_id'),
            "claim_against"=>$request->input('claim_against'),
            "vendor_claim"=>$request->input('vendor_claim'),
            "shipping_claim"=>$request->input('shipping_claim'),
            "shipping_claim_amount"=>$request->input('shipping_claim_amount'),
            "claim_status"=>$request->input('claim_status'),
        );
        $where = array('id'=>$id);
        $update = OrderHelper::updateById($update_array,$id);
		if($update){
            OrderVendorDetailHelper::deleteByOrderId($id);
            OrderItemDetailHelper::deleteByOrderId($id);
            $cnt = 0;
            foreach($vendorList as $list){
                $inserArray = array("vendor_id"=>$list,
                    "order_id"=>$id,
                    "invoice_number"=>$invoiceNumberList[$cnt],
                    "vendor_replacement"=>$vendor_replacement[$cnt],
                    "vendor_pick_up_reference"=>$vendorPickUpReferenceList[$cnt],
                    "vendor_invoice_amount"=>$vendorInvoiceAmountList[$cnt],
                    "vendor_sales_tax_amount"=>$vendorSalesTaxAmountList[$cnt],
                    "vendor_invoice_paid"=>$vendorInvoicePaidList[$cnt],
                    "vendor_paid_via"=>$vendorPaidViaList[$cnt],
                    "broker"=>$brokerList[$cnt],
                    "carrier"=>$carrierList[$cnt],
                    "bol_number"=>$bolNumberList[$cnt],
                    "pick_up_zip_code"=>$pickUpZipCodeList[$cnt],
                    "delevery_zip_code"=>$deleveryZipCodeList[$cnt],
                    "total_weight"=>$totalWeightList[$cnt],
                    "shipment"=>$shipmentList[$cnt],
                    "delivery_remark"=>$delivery_remark[$cnt],
                    "shipping_cost"=>$shippingCostList[$cnt],
                    "shipping_paid_cost"=>$shippingPaidCostList[$cnt],
                    "shipping_paid_via"=>$shippingPaidViaList[$cnt],
                    "tracking_number"=>$trackingNumberList[$cnt],
                    "distance"=>$distance[$cnt],
                );
                $cnt++;
                OrderVendorDetailHelper::insert($inserArray);
            }
            $cnt=0;
            $vendorId = $request->input('vendorid');
            $productType = $request->input('producttypeid');
            $productId = $request->input('productid');
            $quantity = $request->input('quantity');
            $price = $request->input('price');
            $amount = $request->input('amount');
            if(isset($vendorId) && count($vendorId) > 0){
                foreach($vendorId as $vendor){
                    $inserArray = array(
                        "order_id"=>$id,
                        "vendor_id"=> $vendor,
                        "itemunit"=> $itemunit[$cnt],
                        "producttype"=>$productType[$cnt],
                        "product_id"=>$productId[$cnt],
                        "quantity"=>$quantity[$cnt],
                        "price"=>$price[$cnt],
                        "amount"=>$amount[$cnt]
                    );
                    $cnt++;
                    OrderItemDetailHelper::insert($inserArray);
                }
            }
			Session::flash('success', 'Order updated successfully.');
			return redirect('order');
		}else{
			Session::flash('error', 'Sorry, something went wrong. Please try again.');
			return redirect()->back();
		}
    }
	public function delete($id){
        $update_array = array('delete_flag'=>'Y');
		$where = array('id'=>$id);
		$delete = ProductHelper::softDelete($update_array,$where);
		if($delete){
			Session::flash('success', 'Product deleted successfully.');
		}else{
			Session::flash('error', 'Sorry, something went wrong. Please try again.');
		}
		return redirect()->back();
    }
}