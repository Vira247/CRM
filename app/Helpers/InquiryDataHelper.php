<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\InquiryData;
use Auth;
use Mail;
class InquiryDataHelper{
	public static function insert($data){
		$user_data  = Auth::user();
		$data['created_at'] = date('Y-m-d H:i:s');
		if ($user_data) {
			$data['created_by'] = $user_data->id;
		}
		$inser_id = new InquiryData($data);
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
		$update = InquiryData::where($where)->update($data);
		return $update;
	}
	public static function softDelete($data, $where){
		$user_data  = Auth::user();
		if ($user_data) {
			$data['deleted_by'] = $user_data->id;
			$data['deleted_at'] = date('Y-m-d H:i:s');
		}
		$update = InquiryData::where($where)->update($data);
		return $update;
	}
	public static function getPaginateData($related_to,$date){
		$query = InquiryData::select('inquiry_data.*','users.name')->where('delete_flag', 'N');
		$query->join('users', 'users.id', '=', 'inquiry_data.created_by');
		if($related_to != ""){
			$query->whereDate('inquiry_data.created_by',$related_to);
		}
		if($date != ""){
			$query->whereDate('inquiry_data.created_at',$date);
		}
		$query = $query->orderBy('id', 'desc')->paginate(50);
		return $query;
	}
	public static function getByid($id){
		$query = InquiryData::where('delete_flag', 'N')->where('id', $id)->first();
		return $query;
	}
	public static function getDataListByiInqueryd($id){
		$query = InquiryData::select('inquiry_data.*','users.name')->where('delete_flag', 'N');
		$query->join('users', 'users.id', '=', 'inquiry_data.created_by');
		$list = $query->where('inquiry_id', $id)->orderBy('id','desc')->get();
		return $list;
	}
}
