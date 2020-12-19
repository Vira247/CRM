<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\OrderItemDetail;
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
}