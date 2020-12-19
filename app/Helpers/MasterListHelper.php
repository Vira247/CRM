<?php



namespace App\Helpers;



use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\URL;

use App\MasterList;

use Auth;

use Mail;



class MasterListHelper {

	

	public static function insert($data){

		$user_data  = Auth::user();

		$data['created_at'] = date('Y-m-d H:i:s');

		if($user_data){

		$data['created_by'] = $user_data->id;

		}

		$inser_id = new MasterList($data);

		$inser_id->save();

		$Insert = $inser_id->id; 

		return $Insert;

	}

	public static function update($data,$where){

		$user_data  = Auth::user();

		$data['updated_at'] = date('Y-m-d H:i:s');

		if($user_data){

		$data['updated_by'] = $user_data->id;

		}

		$update = MasterList::where($where)->update($data);

		return $update;

	}

	

	public static function softDelete($data,$where){

		$user_data  = Auth::user();

		if($user_data){

		$data['deleted_by'] = $user_data->id;

		$data['deleted_at'] = date('Y-m-d H:i:s');

		}

		$update = MasterList::where($where)->update($data);

		return $update;

	}

	

	public static function getPaginateData($type,$name){

		$query = MasterList::where('delete_flag','N');
		if($type != ""){
			$query->where('type',$type);
		}
		
		if($name != ""){
			$query->where('value','Like','%'.$name.'%');
		}
		
		$query = $query->orderBy('id','desc')->paginate(10);

		return $query;

	}

	public static function GetListData(){

		$query = MasterList::where('delete_flag','N')->orderBy('id','desc')->get();

		return $query;

	}

	

	public static function getByid($id){

		$query = MasterList::where('delete_flag','N')->where('id',$id)->first();

		return $query;

	}

	public static function getByType($type){

		$getData = MasterList::select('id','value')->where('type',$type)->where('delete_flag','N')->orderBy('value','asc')->get();

		return $getData;

	}

	public static function getByTypePluck(){

		$getData = MasterList::where('delete_flag','N')->pluck('value','id')->all();

		return $getData;

	}

	

	public static function getByMultipleTypes($type){

		$getData = MasterList::select('id','type','value')->whereIn('type',$type)->where('delete_flag','N')->get();

		return $getData;

	}

	

	

}