<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\InquiryProduct;
use Auth;
use Mail;
class InquiryProductHelper{
	public static function insert($data){
		$user_data  = Auth::user();
		$data['created_at'] = date('Y-m-d H:i:s');
		if ($user_data) {
			$data['created_by'] = $user_data->id;
		}
		$inser_id = new InquiryProduct($data);
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
		$update = InquiryProduct::where($where)->update($data);
		return $update;
	}
	public static function softDelete($data, $where){
		$user_data  = Auth::user();
		if ($user_data) {
			$data['deleted_by'] = $user_data->id;
		}
		$data['deleted_at'] = date('Y-m-d H:i:s');
		$update = InquiryProduct::where($where)->update($data);
		return $update;
	}
	public static function getProductByInquiryId($id){
		$query = InquiryProduct::select('product.*')
		->where('product.delete_flag', 'N')
		->where('inquiry_product.delete_flag', 'N')
		->where('inquiry_product.inquiry_id', $id);
		$query->join('product', 'product.id', '=', 'inquiry_product.product_id');
		$detail = $query->get();
		return $detail;
	}
}
