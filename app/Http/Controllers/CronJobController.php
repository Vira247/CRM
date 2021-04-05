<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\OrderHelper;
use App\Helpers\GoogleAnalyticsByTimePageHelper;
use Analytics;
use Spatie\Analytics\Period;

class CronJobController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $data = Analytics::performQuery(
      Period::days(10),
      'ga:sessions',
      [
        'dimensions' => 'ga:date,ga:pagePath',
        'metrics' => 'ga:sessions',
        'sort' => '-ga:sessions',
        'filters' => 'ga:country==United States'
      ]
    );
    $lists = $data->rows;
    foreach ($lists as $list) {
      $date = date("Y-m-d", strtotime($list[0]));
      $path = $list[1];
      $viewCount = $list[2];
      $data = array('date'=>$date,'page_view'=>$viewCount,'page_path'=>$path);
      $checkEntry = GoogleAnalyticsByTimePageHelper::getByDatePath($date,$path);
      if($checkEntry)
      {if($checkEntry->page_view != $data['page_view']){
        GoogleAnalyticsByTimePageHelper::updateById($checkEntry->id,$data);}
      }
      else
      {
        GoogleAnalyticsByTimePageHelper::insert($data);
      }
    }
  }
}
