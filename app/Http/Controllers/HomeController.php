<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Helpers\OrderHelper;

use App\Helpers\GoogleAnalyticsByTimePageHelper;

use Analytics;

use Spatie\Analytics\Period;



class HomeController extends Controller

{

  /**

   * Create a new controller instance.

   *

   * @return void

   */

  public function __construct()

  {

    $this->middleware('auth');
  }



  /**

   * Show the application dashboard.

   *

   * @return \Illuminate\Contracts\Support\Renderable

   */

  public function index()

  {

    $data['grphdata'] = OrderHelper::getHomepagegraphdata();

    $data['top10Product'] = OrderHelper::getTop10Product();

    return view('home', $data);
  }

  public function googleindex()

  {

    $data['grphdata'] = GoogleAnalyticsByTimePageHelper::getHomepagegraphdata();

    $data['top10Product'] = GoogleAnalyticsByTimePageHelper::getTop10Product();

    return view('google.home', $data);
  }
  public function googlePageList(Request $request)
  {
    $date = $request->input('date');
    if($date == '')
    {
      $sdate = date('Y-m-d');
      $edate = date('Y-m-d', strtotime('-30 days'));
    }else{
      $dates = explode("-", $date);
      $sdates = explode("/", $dates[0]);
      $edates = explode("/", $dates[1]);
      $sdate = $sdates[2] . '-' . $sdates[0] . '-' . $sdates[1];
      $edate = $edates[2] . '-' . $edates[0] . '-' . $edates[1];
    }
    $data['top10Product'] = GoogleAnalyticsByTimePageHelper::getProduct($sdate,$edate);
    $data['date'] = date('m/d/Y',strtotime($sdate)).'-'.date('m/d/Y',strtotime($edate));
    return view('google.google-page-view', $data);
  }
}
