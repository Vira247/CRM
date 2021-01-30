<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Inquiry;
use Auth;
use Mail;
class InquiryHelper{
	public static function insert($data){
		$user_data  = Auth::user();
		$data['created_at'] = date('Y-m-d H:i:s');
		if ($user_data) {
			$data['created_by'] = $user_data->id;
		}
		$inser_id = new Inquiry($data);
		$inser_id->save();
		$Insert = $inser_id->id;
		return $Insert;
	}
	public static function update($data, $where){
		$user_data  = Auth::user();
		$data['updated_at'] = date('Y-m-d H:i:s');
		if ($user_data) {
			$data['updated_by'] = $user_data->id;
		}
		$update = Inquiry::where($where)->update($data);
		return $update;
	}
	public static function softDelete($data, $where){
		$user_data  = Auth::user();
		if ($user_data) {
			$data['deleted_by'] = $user_data->id;
		}
		$data['deleted_at'] = date('Y-m-d H:i:s');
		$update = Inquiry::where($where)->update($data);
		return $update;
	}
	public static function getPaginateData($related_to,$date,$status,$name,$phone,$email){
		$query = Inquiry::select('inquiry.*','users.name as username','u.name as assignname')->where('delete_flag', 'N');
		$query->join('users', 'users.id', '=', 'inquiry.created_by');
		$query->join('users as u', 'u.id', '=', 'inquiry.assign_to');
		if($status != ""){
			$query->where('inquiry.status',$status);
		}
		if($name != ""){
			$query->where('inquiry.name','like','%'.$name.'%');
		}
		if($phone != ""){
			$query->where('inquiry.phone','like','%'.$phone.'%');
		}
		if($date != ""){
			$query->where('inquiry.follow_up_date',$date);
		}
		if($related_to != ""){
			$user_data  = Auth::user();
			$query->where('inquiry.assign_to',$user_data->id);
			/*$query->Where(function($query) {
				$user_data  = Auth::user();
				$query->where('inquiry.created_by',$user_data->id)
					->orWhere('inquiry.assign_to',$user_data->id);
			});*/
		}
		$query = $query->orderBy('id', 'desc')->paginate(50);
		return $query;
	}
	public static function getByid($id){
		$query = Inquiry::select('inquiry.*','users.name as username','u.name as assignname')->where('inquiry.delete_flag', 'N')->where('inquiry.id', $id);
		$query->join('users', 'users.id', '=', 'inquiry.created_by');
		$query->join('users as u', 'u.id', '=', 'inquiry.assign_to');
		$detail = $query->first();
		return $detail;
	}
	public static function getFollowUpByDate($start,$end){
		$query = Inquiry::select('inquiry.*','u.name as assignname')
		->where('inquiry.delete_flag', 'N')
		->where('inquiry.follow_up_date','>=',$start)
		->where('inquiry.follow_up_date','<=',$end);
		$query->join('users as u', 'u.id', '=', 'inquiry.assign_to');
		$detail = $query->get();
		return $detail;
	}
	public static function getFollowUpNotificationCount(){
		$user = auth()->user();
		return $query = Inquiry::whereDate('follow_up_date',date('Y-m-d'))->where('assign_to',$user->id)->count();
	}
}
