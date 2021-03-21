<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\OrderHelper;
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
		return view('home',$data);
    }
}
