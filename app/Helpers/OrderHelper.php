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
	public static function getPaginateData($sdate,$edate,$site,$platform,$status,$order_id,$snetmargin,$enetmargin,$samount,$eamount,$vendor,$product_type){
		$query = Order::select('order_master.*')
		->leftjoin('order_item_detail','order_item_detail.order_id','order_master.id')
		->where('order_master.delete_flag','N');
		if($vendor != ""){
			$query->where('order_item_detail.vendor_id',$vendor);
		}
		if($product_type != ""){
			$query->where('order_item_detail.producttype',$product_type);
		}
		if($order_id != ""){
			$query->where('order_master.order_id',$order_id);
		}
		if($sdate != ""){
			$query->where('order_master.order_date','>=',$sdate);
		}
		if($edate != ""){
			$query->where('order_master.order_date','<=',$edate);
		}
		if($site != ""){
			$query->where('order_master.site',$site);
		}
		if($platform != ""){
			$query->where('order_master.platform',$platform);
		}
		if($status != ""){
			$query->where('order_master.order_status',$status);
		}
		if($snetmargin != ""){
			$query->where('order_master.profit','>=',$snetmargin);
		}
		if($enetmargin != ""){
			$query->where('order_master.profit','<=',$enetmargin);
		}
		if($samount != ""){
			$query->where('order_master.order_amount','>=',$samount);
		}
		if($eamount != ""){
			$query->where('order_master.order_amount','<=',$eamount);
		}
		$query = $query->orderBy('order_master.id','desc')->groupBy('order_master.id')->paginate(100);
		return $query;
	}

	
	public static function getPaginateDataCount($sdate,$edate,$site,$platform,$status,$order_id,$snetmargin,$enetmargin,$samount,$eamount,$vendor,$product_type){
		$query = Order::selectRaw('SUM(order_master.order_amount) as order_amount,SUM(order_master.profit) as profit')
		->leftjoin('order_item_detail','order_item_detail.order_id','order_master.id')
		->where('order_master.delete_flag','N')
		->where('order_item_detail.delete_flag','N')
		->where('order_master.order_status','!=','16');
		if($order_id != ""){
			$query->where('order_master.order_id',$order_id);
		}
		if($sdate != ""){
			$query->where('order_master.order_date','>=',$sdate);
		}
		if($edate != ""){
			$query->where('order_master.order_date','<=',$edate);
		}
		if($site != ""){
			$query->where('order_master.site',$site);
		}
		if($platform != ""){
			$query->where('order_master.platform',$platform);
		}
		if($status != ""){
			$query->where('order_master.order_status',$status);
		}
		if($snetmargin != ""){
			$query->where('order_master.profit','>=',$snetmargin);
		}
		if($vendor != ""){
			$query->where('order_item_detail.vendor_id',$vendor);
		}
		if($enetmargin != ""){
			$query->where('order_master.profit','<=',$enetmargin);
		}
		
		if($samount != ""){
			$query->where('order_master.order_amount','>=',$samount);
		}
		if($eamount != ""){
			$query->where('order_master.order_amount','<=',$eamount);
		}
		$query = $query->groupBy('order_master.id')->first();
		return $query;
	}
	


	public static function getByid($id){
		$query = Order::where('delete_flag','N')->where('id',$id)->first();
		return $query;
	}
	public static function getAllOrder(){
		$query = Order::where('delete_flag','N')->get();
		return $query;
	}
	public static function getHomepagegraphdata(){
		$date = date('Y-m-d', strtotime('-30 days'));
		$querys = Order::selectRaw('SUM(order_amount) as amount,order_date')
		->where('order_date','>=',$date)
		->where('delete_flag','N')
		->groupBy('order_date')
		->orderBy('order_date','asc')
		->get();
		$data = array();
		foreach($querys as $query){
			$data[$query->order_date] = $query->amount;
		}
		$current = strtotime($date);
		$date2 = strtotime(date('Y-m-d'));
		$stepVal = '+1 day';
		$finalArray = array();
		while( $current <= $date2 ) {
			$dates = date('Y-m-d', $current);
			$current = strtotime($stepVal, $current);
			if(isset($data[$dates])){ $amount = $data[$dates]; }else{ $amount = 0; }
			$finalArray[date('m/d',strtotime($dates))] = $amount;
		}
		return $finalArray;
	}
	public static function getTop10Product(){
		$query = Order::selectRaw('SUM(order_item_detail.amount) as amount,product.name,product.sku')
		->leftjoin('order_item_detail','order_item_detail.order_id','order_master.id')
		->leftjoin('product','product.id','order_item_detail.product_id')
		->where('order_item_detail.delete_flag','N')
		->where('order_master.delete_flag','N')
		->groupBy('product.id')
		->orderByRaw('SUM(order_item_detail.amount) desc')
		->take(10)
		->get();
		return $query;
	}
}