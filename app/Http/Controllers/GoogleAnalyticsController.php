<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Analytics\Period;
use App\Comment;
use App\GoogleAnalyticsByTime;
use App\GooglePagePageviwe;
use Analytics;
use Artisan;
class GoogleAnalyticsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
    public function toDay(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            [
                'dimensions'=>'ga:source,ga:medium,ga:date',
                'metrics'=>'ga:sessions,ga:pageviews,ga:sessionDuration,ga:exits',
                'sort'=>'ga:date,-ga:sessions'
            ]);
		$dates = array();
		$finalArray = array();
        foreach($analyticsData['rows'] as $rows){
			$finalArray[$rows[0]][$rows[1]][$rows[2]]['session'] = $rows[3]; 
			$finalArray[$rows[0]][$rows[1]][$rows[2]]['pageviews'] = $rows[4]; 
			$finalArray[$rows[0]][$rows[1]][$rows[2]]['duration'] = $rows[5]; 
			$finalArray[$rows[0]][$rows[1]][$rows[2]]['exit'] = $rows[6];
			if(!in_array($rows[2],$dates)){
				$dates[] = $rows[2];
			}
		}
		$data['dates'] = $dates;
		$data['finalArray'] = $finalArray;
		rsort($data['dates']);
		return view('google.all_trafic', $data);
    }
	public function toDaySessionsPageviewsData(){
		$time = array("00","10","20","30","40","50","60");
		if('10' == date("i")){
			
		}
		if(in_array(date("i"),$time)){
		Artisan::call('cache:clear');
        $analyticsData = Analytics::performQuery(
            Period::days(0),
            'ga:sessions',
			['dimensions'=>'ga:date','metrics'=>'ga:sessions,ga:pageviews']);
		if(isset($analyticsData['rows'][0])){
			$totalSession = ($analyticsData['rows'][0]['1'])?$analyticsData['rows'][0]['1']:0;
			$totalPageviews = ($analyticsData['rows'][0]['2'])?$analyticsData['rows'][0]['2']:0;
			$data = array("date"=>date('Y-m-d'),"date_time"=>date('Y-m-d H:i:s'),
			"total_session"=>$totalSession,"total_pageviews"=>$totalPageviews);
		}else{
			$data = array("date"=>date('Y-m-d'),"date_time"=>date('Y-m-d H:i:s'),
			"total_session"=>0,"total_pageviews"=>0);
		}
		$getLastData = GoogleAnalyticsByTime::where('date',date('Y-m-d'))->orderBy('id','desc')->first();
		$session = 0;
		$pageview = 0;
		if($getLastData){
			$session = $data['total_session'] - $getLastData->total_session;
			$pageview = $data['total_pageviews'] - $getLastData->total_pageviews;
		}
		$data['session'] = $session;
		$data['pageviews'] = $pageview;
		$inser_id = new GoogleAnalyticsByTime($data);
		$inser_id->save();
		$Insert = $inser_id->id; 
		Self::toDaySessionsPageviewsPath();
		}
    }
    public function toDaySessionsPageviews(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
			['dimensions'=>'ga:date','metrics'=>'ga:sessions,ga:pageviews']);
        $dates = array();
		$finalArray = array();
        foreach($analyticsData['rows'] as $rows){ 
			$finalArray[$rows[0]]['session'] = $rows[1]; 
			$finalArray[$rows[0]]['pageviews'] = $rows[2]; 
			if(!in_array($rows[0],$dates)){
				$dates[] = $rows[0];
			}
		}
		$data['dates'] = $dates;
		$data['finalArray'] = $finalArray;
		rsort($data['dates']);
		return view('google.all_session_page_view', $data);
    }
	public function toDaySessionsPageviewsPath(){
        $analyticsData = Analytics::performQuery(
            Period::days(1),
            'ga:sessions',
			['dimensions'=>'ga:pagePath,ga:date',
			'metrics'=>'ga:sessions,ga:pageviews']);
        $dates = array();
		$finalArray = array();
		foreach($analyticsData['rows'] as $rows){
			$path = str_replace(array('"','″',"'"),"",$rows[0]);
			$originpath = $rows[0];
			$pageviews = $rows[3];
			$date = date('Y-m-d',strtotime($rows[1]));
			$check = GooglePagePageviwe::where('path',$path)->where('date',$date)->first();
			if($check){
				GooglePagePageviwe::where('id',$check->id)->update(array("pageviwe"=>$pageviews));
			}else{
				$data = array("path"=>$path,"originpath"=>$originpath,"date"=>$date,"pageviwe"=>$pageviews);
				$inser_id = new GooglePagePageviwe($data);
				$inser_id->save();
				$Insert = $inser_id->id;
			}
		}
    }
	public function sessionsPageviewsPath(request $request){
		$data['date'] = $date = request('date');
		if($date == ""){
			$data['date'] = $date = date('Y-m-d');
		}
		$data['list'] = GooglePagePageviwe::where('date',$date)->orderBy('pageviwe','desc')->get();
		return view('google.session_pageview_path', $data);
	}
	public function toDayTimeSessionsPageviews(){
		$list = GoogleAnalyticsByTime::whereDate('date','<=',date('Y-m-d'))->whereDate('date','>=',date( 'Y-m-d' , strtotime (date('Y-m-d')  . ' - 10 days' )))->get();
		$data['list'] = array();
		$data['time'] = array();
		$data['date'] = array();
		foreach($list as $lists){
			$data['list'][date('Ymd',strtotime($lists->date))][date('Hi',strtotime($lists->date_time))]['time'] = date('H:i',strtotime($lists->date_time));
			$data['list'][date('Ymd',strtotime($lists->date))][date('Hi',strtotime($lists->date_time))]['session'] = $lists->session;
			$data['list'][date('Ymd',strtotime($lists->date))][date('Hi',strtotime($lists->date_time))]['pageview'] = $lists->pageviews;
			if(!in_array(date('Hi',strtotime($lists->date_time)),$data['time'])){
			$data['time'][] = date('Hi',strtotime($lists->date_time));
			}
			if(!in_array(date('Ymd',strtotime($lists->date)),$data['date'])){
			$data['date'][] = date('Ymd',strtotime($lists->date));
			}
		}
		rsort($data['time']);
		rsort($data['date']);
		return view('google.all_time_session_page_view', $data);
    }
    public function toDayMobileTrafic(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['dimensions'=>'ga:mobileDeviceInfo,ga:source,ga:date',
            'metrics'=>'ga:sessions,ga:pageviews,ga:sessionDuration',
            'segment'=>'gaid::-14','sort'=>'ga:date,-ga:sessions']);
        $dates = array();
		$finalArray = array();
        foreach($analyticsData['rows'] as $rows){
			$finalArray[$rows[0]][$rows[1]][$rows[2]]['mobileDeviceInfo'] = $rows[0]; 
			$finalArray[$rows[0]][$rows[1]][$rows[2]]['source'] = $rows[1]; 
			$finalArray[$rows[0]][$rows[1]][$rows[2]]['sessions'] = $rows[3]; 
			$finalArray[$rows[0]][$rows[1]][$rows[2]]['pageviews'] = $rows[4];
			$finalArray[$rows[0]][$rows[1]][$rows[2]]['sessionDuration'] = $rows[5];
			if(!in_array($rows[2],$dates)){
				$dates[] = $rows[2];
			}
		}
		$data['date'] = $dates;
		$data['finalArray'] = $finalArray;
		rsort($data['date']);
		return view('google.all_session_by_mobile', $data);
    }
    public function toDayRevenueGeneratingCampaigns(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['dimensions'=>'ga:source,ga:medium,ga:date',
            'metrics'=>'ga:sessions,ga:pageviews,ga:sessionDuration,ga:bounces',
            'segment'=>'dynamic::ga:transactions>1']);
        echo "<pre>"; 
        print_r($analyticsData);
    }
    public function toDayUsers(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['dimensions'=>'ga:userType,ga:date',
            'metrics'=>'ga:sessions']);
        $dates = array();
		$finalArray = array();
		foreach($analyticsData['rows'] as $rows){
			if($rows[0] == "New Visitor"){
				$finalArray[$rows[1]]['newuser'] = $rows[2];
			}else{
				$finalArray[$rows[1]]['olduser'] = $rows[2];
			}
			if(!in_array($rows[1],$dates)){
				$dates[] = $rows[1];
			}
		}
		$data['date'] = $dates;
		$data['finalArray'] = $finalArray;
		rsort($data['date']);
		return view('google.all_session_new_old', $data);
    }
    
    public function sessionsByCountry(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['dimensions'=>'ga:country,ga:region,ga:city,ga:date',
            'metrics'=>'ga:sessions',
            'sort'=>'-ga:sessions',
			'filters'=>'ga:country==United States']);
			$dates = array();
		$finalArray = array();
        foreach($analyticsData['rows'] as $rows){
			$finalArray[$rows[0]][$rows[1]][$rows[2]][$rows[3]] = $rows[4]; 
			if(!in_array($rows[3],$dates)){
				$dates[] = $rows[3];
			}
		}
		$data['date'] = $dates;
		$data['finalArray'] = $finalArray;
		rsort($data['date']);
		//echo "<pre>"; print_r($data['finalArray']); die;
		return view('google.all_session_by_region', $data);
    }
    public function browserAndOperatingSystem(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['dimensions'=>'ga:operatingSystem,ga:operatingSystemVersion,ga:browser,ga:browserVersion,ga:date',
            'metrics'=>'ga:sessions']);
        echo "<pre>"; 
        print_r($analyticsData);
    }
    public function timeOnSite(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['metrics'=>'ga:sessions,ga:sessionDuration,ga:date']);
        echo "<pre>"; 
        print_r($analyticsData);
    }
    public function trafficSources(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['metrics'=>'ga:sessions,ga:sessionDuration']);
        echo "<pre>"; 
        print_r($analyticsData);
    }
    public function allTrafficSourcesGoals(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['metrics'=>'ga:sessions,ga:sessionDuration']);
        echo "<pre>"; 
        print_r($analyticsData);
    }
    public function allTrafficSourcesECommerce(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['metrics'=>'ga:sessions,ga:sessionDuration']);
        echo "<pre>"; 
        print_r($analyticsData);
    }
    public function referringSites(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['metrics'=>'ga:sessions,ga:sessionDuration']);
        echo "<pre>"; 
        print_r($analyticsData);
    }
    
    public function searchEngines(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['dimensions'=>'ga:source,ga:date',
            'metrics'=>'ga:pageviews,ga:sessionDuration,ga:exits',
            'filters'=>'ga:medium==cpa,ga:medium==cpc,ga:medium==cpm,ga:medium==cpp,ga:medium==cpv,ga:medium==organic,ga:medium==ppc',
            'sort'=>'-ga:pageviews']);
        echo "<pre>"; 
        print_r($analyticsData);
    }
    public function SearchEnginesOrganicSearch(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['dimensions'=>'ga:source,ga:date',
            'metrics'=>'ga:pageviews,ga:sessionDuration,ga:exits',
            'filters'=>'ga:medium==organic',
            'sort'=>'-ga:pageviews']);
        echo "<pre>"; 
        print_r($analyticsData);
    }
    public function SearchEnginesPaidSearch(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['dimensions'=>'ga:source,ga:date',
            'metrics'=>'ga:pageviews,ga:sessionDuration,ga:exits',
            'filters'=>'ga:medium==cpa,ga:medium==cpc,ga:medium==cpm,ga:medium==cpp,ga:medium==cpv,ga:medium==ppc',
            'sort'=>'-ga:pageviews']);
        echo "<pre>"; 
        print_r($analyticsData);
    }
    public function keyWords(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['dimensions'=>'ga:keyword,ga:date',
            'metrics'=>'ga:sessions',
            'sort'=>'-ga:sessions,ga:date']);
			$dates = array();
		$finalArray = array();
        foreach($analyticsData['rows'] as $rows){
			$finalArray[$rows[0]][$rows[1]]['keyWord'] = $rows[0]; 
			$finalArray[$rows[0]][$rows[1]]['session'] = $rows[2]; 
			$finalArray[$rows[0]][$rows[1]]['date'] = $rows[1];
			if(!in_array($rows[1],$dates)){
				$dates[] = $rows[1];
			}
		}
		$data['dates'] = $dates;
		$data['finalArray'] = $finalArray;
        return view('google.all_keyword', $data);
    }
    
    public function topContent(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['dimensions'=>'ga:pagePath,ga:date',
            'metrics'=>'ga:pageviews,ga:uniquePageviews,ga:timeOnPage,ga:bounces,ga:entrances,ga:exits',
            'sort'=>'-ga:pageviews']);
        echo "<pre>"; 
        print_r($analyticsData);
    }
    public function topLandingPages(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['dimensions'=>'ga:landingPagePath,ga:date',
            'metrics'=>'ga:entrances',
            'sort'=>'-ga:entrances']);
        $dates = array();
		$finalArray = array();
        foreach($analyticsData['rows'] as $rows){
			$finalArray[$rows[0]][$rows[1]]['page'] = $rows[0]; 
			$finalArray[$rows[0]][$rows[1]]['session'] = $rows[2]; 
			$finalArray[$rows[0]][$rows[1]]['date'] = $rows[1];
			if(!in_array($rows[1],$dates)){
				$dates[] = $rows[1];
			}
		}
		$data['dates'] = $dates;
		$data['finalArray'] = $finalArray;
		rsort($data['dates']);
		return view('google.top_landing', $data);
    }
    public function topExitPages(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['dimensions'=>'ga:exitPagePath,ga:date',
            'metrics'=>'ga:exits',
            'sort'=>'-ga:exits']);
        $dates = array();
		$finalArray = array();
        foreach($analyticsData['rows'] as $rows){
			$finalArray[$rows[0]][$rows[1]]['page'] = $rows[0]; 
			$finalArray[$rows[0]][$rows[1]]['session'] = $rows[2]; 
			$finalArray[$rows[0]][$rows[1]]['date'] = $rows[1];
			if(!in_array($rows[1],$dates)){
				$dates[] = $rows[1];
			}
		}
		rsort($dates);
		$data['dates'] = $dates;
		$data['finalArray'] = $finalArray;
		rsort($data['dates']);
		return view('google.top_exit', $data);
    }
    public function siteSearchSearchTerms(){
        $analyticsData = Analytics::performQuery(
            Period::days(10),
            'ga:sessions',
            ['dimensions'=>'ga:searchKeyword,ga:date',
            'metrics'=>'ga:searchUniques',
            'sort'=>'-ga:searchUniques']);
        echo "<pre>"; 
        print_r($analyticsData);
    }
}
