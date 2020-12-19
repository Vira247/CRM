<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\OrderLog;
use Auth;
use Mail;
class OrderLogHelper{
	public static function insert($data){
		$user_data  = Auth::user();
		$data['created_at'] = date('Y-m-d H:i:s');
		if($user_data){
			$data['user_id'] = $user_data->id;
		}
		$inser_id = new OrderLog($data);
		$inser_id->save();
		$Insert = $inser_id->id; 
		return $Insert;
	}
	public static function insertOrderUpdate($data,$id){
		if(count($data)>1){
			$insertArray = array("order_id"=>$id,"message"=>"Order update","old_data"=>serialize($data['oldData']),"new_data"=>serialize($data['newData']));
			OrderLogHelper::insert($insertArray);
		}
	}
	public static function getLogsByOrderId($id){
		$logList = OrderLog::select('order_log.message','order_log.old_data','order_log.new_data','order_log.created_at','users.name')
		->leftjoin('users','users.id','order_log.user_id')
		->where('order_log.order_id',$id)->OrderBy('order_log.id','desc')->get();
		return $logList;
	}
}