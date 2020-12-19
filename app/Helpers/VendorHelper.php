<?php



namespace App\Helpers;



use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\URL;

use App\Vendor;

use Auth;

use Mail;



class VendorHelper {

	

	public static function insert($data){

		$user_data  = Auth::user();

		$data['created_at'] = date('Y-m-d H:i:s');

		if($user_data){

		$data['created_by'] = $user_data->id;

		}

		$inser_id = new Vendor($data);

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

		$update = Vendor::where($where)->update($data);

		return $update;

	}

	

	public static function softDelete($data,$where){

		$user_data  = Auth::user();

		if($user_data){

		$data['deleted_by'] = $user_data->id;

		$data['deleted_at'] = date('Y-m-d H:i:s');

		}

		$update = Vendor::where($where)->update($data);

		return $update;

	}

	

	public static function getPaginateData(){

		$query = Vendor::where('delete_flag','N');
		$query = $query->orderBy('id','desc')->paginate(10);

		return $query;

	}

	public static function GetListData(){

		$query = Vendor::where('delete_flag','N')->orderBy('id','desc')->get();

		return $query;

	}

	

	public static function getByid($id){

		$query = Vendor::where('delete_flag','N')->where('id',$id)->first();

		return $query;

	}
	public static function getList(){
		$query = Vendor::where('delete_flag','N')->orderBy('name','asc')->get();
		return $query;
	}
	public static function getByTypePluck(){
		$getData = Vendor::where('delete_flag','N')->pluck('name','id')->all();
		return $getData;
	}
}