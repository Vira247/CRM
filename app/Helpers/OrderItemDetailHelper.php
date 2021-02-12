<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\OrderItemDetail;
use App\Helpers\VendorHelper;
use Auth;
use Mail;
class OrderItemDetailHelper{
	public static function insert($data){
		$user_data  = Auth::user();
		$data['created_at'] = date('Y-m-d H:i:s');
		if($user_data){
			$data['created_by'] = $user_data->id;
		}
		$inser_id = new OrderItemDetail($data);
		$inser_id->save();
		$Insert = $inser_id->id; 
		return $Insert;
	}
	public static function updateById($data,$id){
		$oldData = Self::getByid($id)->toArray();
		$user_data  = Auth::user();
		$data['updated_at'] = date('Y-m-d H:i:s');
		if($user_data){
			$data['updated_by'] = $user_data->id;
		}
		$update = OrderItemDetail::where('id',$id)->update($data);
		return $update;
	}
	public static function softDelete($data,$where){
		$user_data  = Auth::user();
		if($user_data){
			$data['deleted_by'] = $user_data->id;
		}
		$data['deleted_at'] = date('Y-m-d H:i:s');
		$update = OrderItemDetail::where($where)->update($data);
		return $update;
	}
	public static function getByid($id){
		$query = OrderItemDetail::where('delete_flag','N')->where('id',$id)->first();
		return $query;
	}
	public static function getByOrderid($id){
		$query = OrderItemDetail::selectRaw('order_item_detail.itemunit,order_item_detail.id,order_item_detail.product_id,order_item_detail.vendor_id,vendor.name AS vendorname,order_item_detail.producttype,product.name AS productname,order_item_detail.quantity,order_item_detail.price,order_item_detail.amount')
		->leftjoin('vendor','vendor.id','order_item_detail.vendor_id')
		->leftjoin('product','product.id','order_item_detail.product_id')
		->where('order_item_detail.delete_flag','N')->where('order_item_detail.order_id',$id)->get();
		return $query;
	}
	public static function deleteByOrderId($id){
		$data = array('delete_flag'=>'Y');
		$user_data  = Auth::user();
		if($user_data){
			$data['deleted_by'] = $user_data->id;
		}
		$data['deleted_at'] = date('Y-m-d H:i:s');
		$update = OrderItemDetail::where('order_id',$id)->update($data);
		return $update;
	}
	
	public static function getVendorReportByMonthGroup(){
		$query = OrderItemDetail::selectRaw("vendor.id,vendor.name,DATE_FORMAT(order_master.order_date,'%m') AS MONTH,DATE_FORMAT(order_master.order_date,'%Y') AS YEAR,SUM(order_item_detail.amount) AS amount")
		->leftjoin('order_master','order_master.id','order_item_detail.order_id')
		->leftjoin('product','product.id','order_item_detail.product_id')
		->leftjoin('vendor','vendor.id','order_item_detail.vendor_id')
		->where('order_item_detail.delete_flag','N')
		->where('order_master.delete_flag','N')
		->where('product.delete_flag','N')
		->groupByRaw("vendor.id,DATE_FORMAT(order_master.order_date,'%m'),DATE_FORMAT(order_master.order_date,'%Y')")
		->orderByRaw("DATE_FORMAT(order_master.order_date,'%Y'), DATE_FORMAT(order_master.order_date,'%m'),vendor.name")
		->get();
		$vendors = VendorHelper::getByTypePluckName();
		$finalarray = array();
		$finalTotal = 0;
		$finalVendorTotal = array();
		foreach($vendors as $key=>$value){
			$finalarray[$key] = array();
			foreach($query as $queryvalue){
				if($queryvalue->id == $value){
					$finalarray[$key][$queryvalue->YEAR][$queryvalue->MONTH]['amount'] = $queryvalue->amount;
					$finalarray[$key][$queryvalue->YEAR][$queryvalue->MONTH]['id'] = $queryvalue->id;
					if(isset($finalVendorTotal[$key])){
						$finalVendorTotal[$key] = $finalVendorTotal[$key] + $queryvalue->amount;
					}else{
						$finalVendorTotal[$key] = $queryvalue->amount;
					}
					$finalTotal = $finalTotal + $queryvalue->amount;
				}
			}
		}
		return array("finalTotal"=>$finalTotal,"finalVendorTotal"=>$finalVendorTotal,"finalarray"=>$finalarray);
	} 
	public static function productOrderByVendorDate($vendorId,$sdate,$edate,$name){
		$query = OrderItemDetail::selectRaw("product.id,product.name,product.product_type,SUM(order_item_detail.amount) AS amount")
		->leftjoin('order_master','order_master.id','order_item_detail.order_id')
		->leftjoin('product','product.id','order_item_detail.product_id')
		->where('order_item_detail.delete_flag','N')
		->where('order_master.delete_flag','N')
		->where('product.delete_flag','N')
		->where('order_master.order_date','>=',$sdate)
		->where('order_master.order_date','<=',$edate);
		if($vendorId != ''){
			$query->where('product.vendor_id',$vendorId);
		}
		if($name != ''){
			$query->where('product.name','LIKE','%'.$name.'%');
		}
		return $query->groupBy('product.id')->get();
	}
}