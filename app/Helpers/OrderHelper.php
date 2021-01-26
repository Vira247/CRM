<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Order;
use App\Helpers\OrderLogHelper;
use Auth;
use Mail;
class OrderHelper{
	public static function insert($data){
		$user_data  = Auth::user();
		$data['created_at'] = date('Y-m-d H:i:s');
		if($user_data){
			$data['created_by'] = $user_data->id;
		}
		$inser_id = new Order($data);
		$inser_id->save();
		$Insert = $inser_id->id; 
		$insertArray = array("order_id"=>$Insert,"message"=>"Order added","new_data"=>serialize($data));
		OrderLogHelper::insert($insertArray);
		return $Insert;
	}
	public static function updateById($data,$id){
		$oldData = Self::getByid($id)->toArray();
		$user_data  = Auth::user();
		$data['updated_at'] = date('Y-m-d H:i:s');
		if($user_data){
			$data['updated_by'] = $user_data->id;
		}
		$update = Order::where('id',$id)->update($data);
		$newData = Self::getByid($id)->toArray();
		$finalArray = array();
		foreach($newData as $key=>$value){
			if($value != $oldData[$key] && $key != 'updated_at'){
				$finalArray['newData'][$key] = $value;
				$finalArray['oldData'][$key] = $oldData[$key];
			}
		}
		OrderLogHelper::insertOrderUpdate($finalArray,$id);
		return $update;
	}
	public static function softDelete($data,$where){
		$user_data  = Auth::user();
		if($user_data){
			$data['deleted_by'] = $user_data->id;
		}
		$data['deleted_at'] = date('Y-m-d H:i:s');
		$update = Order::where($where)->update($data);
		return $update;
	}
	public static function getPaginateData($sdate,$edate,$site,$platform,$status){
		$query = Order::select('order_master.*','vendor.name as vendor_name')
		->leftjoin('vendor','vendor.id','order_master.vendor')
		->where('order_master.delete_flag','N');
		if($sdate != ""){
			$query->where('order_date','>=',$sdate);
		}
		if($edate != ""){
			$query->where('order_date','<=',$edate);
		}
		if($site != ""){
			$query->where('site',$site);
		}
		if($platform != ""){
			$query->where('platform',$platform);
		}
		if($status != ""){
			$query->where('order_status',$status);
		}
		$query = $query->orderBy('order_master.id','desc')->paginate(100);
		return $query;
	}
	public static function getByid($id){
		$query = Order::where('delete_flag','N')->where('id',$id)->first();
		return $query;
	}
}