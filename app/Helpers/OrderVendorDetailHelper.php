<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\OrderVendorDetail;
use Auth;
use Mail;
class OrderVendorDetailHelper{
	public static function insert($data){
		$user_data  = Auth::user();
		$data['created_at'] = date('Y-m-d H:i:s');
		if($user_data){
			$data['created_by'] = $user_data->id;
		}
		$inser_id = new OrderVendorDetail($data);
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
		$update = OrderVendorDetail::where('id',$id)->update($data);
		return $update;
	}
	public static function softDelete($data,$where){
		$user_data  = Auth::user();
		if($user_data){
			$data['deleted_by'] = $user_data->id;
		}
		$data['deleted_at'] = date('Y-m-d H:i:s');
		$update = OrderVendorDetail::where($where)->update($data);
		return $update;
	}
	public static function getByid($id){
		$query = OrderVendorDetail::where('delete_flag','N')->where('id',$id)->first();
		return $query;
	}
	public static function getByOrderid($id){
		$query = OrderVendorDetail::where('delete_flag','N')->where('order_id',$id)->get();
		return $query;
	}
	public static function deleteByOrderId($id){
		$data = array('delete_flag'=>'Y');
		$user_data  = Auth::user();
		if($user_data){
			$data['deleted_by'] = $user_data->id;
		}
		$data['deleted_at'] = date('Y-m-d H:i:s');
		$update = OrderVendorDetail::where('order_id',$id)->update($data);
		return $update;
	}
}