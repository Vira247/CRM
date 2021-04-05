<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\GoogleAnalyticsByTimePage;
use Auth;
use Mail;
class GoogleAnalyticsByTimePageHelper{
	public static function insert($data){
		$inser_id = new GoogleAnalyticsByTimePage($data);
		$inser_id->save();
		$Insert = $inser_id->id;
		return $Insert;
	}
	public static function updateById($id,$data){
		$update = GoogleAnalyticsByTimePage::where('id',$id)->update($data);
		return $update;
	}
	public static function getByDatePath($date, $path){
		$update = GoogleAnalyticsByTimePage::where('date',$date)->where('page_path',$path)->first();
		return $update;
	}
	public static function getHomepagegraphdata(){
		$date = date('Y-m-d', strtotime('-10 days'));
		$querys = GoogleAnalyticsByTimePage::selectRaw('SUM(page_view) as amount,date as order_date')
		->where('date','>=',$date)
		->groupBy('date')
		->orderBy('date','asc')
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
		$query = GoogleAnalyticsByTimePage::selectRaw('SUM(page_view) as amount,page_path as name')
		->where('page_path','!=','/')
		->groupBy('page_path')
		->orderByRaw('SUM(page_view) desc')
		->take(10)
		->get();
		return $query;
	}
}
