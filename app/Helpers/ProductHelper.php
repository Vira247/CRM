<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Product;
use Auth;
use Mail;
class ProductHelper{
	public static function insert($data){
		$user_data  = Auth::user();
		$data['created_at'] = date('Y-m-d H:i:s');
		if($user_data){
			$data['created_by'] = $user_data->id;
		}
		$inser_id = new Product($data);
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
		$update = Product::where($where)->update($data);
		return $update;
	}
	public static function softDelete($data,$where){
		$user_data  = Auth::user();
		if($user_data){
			$data['deleted_by'] = $user_data->id;
		}
		$data['deleted_at'] = date('Y-m-d H:i:s');
		$update = Product::where($where)->update($data);
		return $update;
	}
	public static function getPaginateData(){
		$query = Product::select('product.id','product.name','product.sku','vendor.name as vendorname')
		->leftjoin('vendor','vendor.id','product.vendor_id')
		->where('vendor.delete_flag','N')
		->where('product.delete_flag','N');
		$query = $query->orderBy('id','desc')->paginate(10);
		return $query;
	}
	public static function getByid($id){
		$query = Product::where('delete_flag','N')->where('id',$id)->first();
		return $query;
	}
	
	public static function getAllList(){
		$query = Product::where('delete_flag','N')->get();
		return $query;
	}
	public static function getProductByVendorType($vendor,$productType){
		$query = Product::where('delete_flag','N')->where('vendor_id',$vendor)->where('product_type',$productType)->get();
		return $query;
	}
}