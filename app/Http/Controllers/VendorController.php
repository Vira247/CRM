<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Helpers\UserHelper;
use App\Helpers\RoleHelper;
use App\Helpers\VendorHelper;
use App\Helpers\ProductHelper;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
class VendorController extends Controller{
	function __construct(){
         $this->middleware('permission:vendor-list|vendor-create|vendor-edit|vendor-delete', ['only' => ['index','store']]);
         $this->middleware('permission:vendor-create', ['only' => ['create','store']]);
         $this->middleware('permission:vendor-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:vendor-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $data['table_list'] = VendorHelper::getPaginateData();
        $data['i'] = ($request->input('page', 1) - 1) * 50;
        return view('vendor.index',$data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('vendor.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
		
		$this->validate($request, [
            'name' => 'required'
        ]);



		$user_data = auth()->user();

        $insert_array = $request->all();
		

			
			
		$insert = VendorHelper::insert($insert_array);



		if($insert){

			Session::flash('success', 'Master inserted successfully.');

			return redirect('vendor');

		}else{

			Session::flash('error', 'Sorry, something went wrong. Please try again.');

			return redirect()->back();

		}


    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)    {
        $data['master_detail'] = VendorHelper::getByid($id);
        return view('vendor.edit',$data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $this->validate($request, [
           'name' => 'required'
        ]);
		$update_array = array('name'=>request('name'));
		$where = array('id'=>$id);
        $update = VendorHelper::update($update_array,$where);
		if($update){
			Session::flash('success', 'Master updated successfully.');
			return redirect('vendor');
		}else{
			Session::flash('error', 'Sorry, something went wrong. Please try again.');
			return redirect()->back();
		}
    }
	public function delete($id){
        $update_array = array('delete_flag'=>'Y');
		$where = array('id'=>$id);
		$delete = VendorHelper::softDelete($update_array,$where);
		if($delete){
			Session::flash('success', 'Master deleted successfully.');
		}else{
			Session::flash('error', 'Sorry, something went wrong. Please try again.');
		}
		return redirect()->back();
    }
	public function importProductList(){
        $users = DB::table('productlist4')->get();
        $vendorList = VendorHelper::getByTypePluck();
        echo "<pre>"; \print_r($vendorList);
        
        foreach($users as $user){
            $insertArray = array("name"=>$user->title,"product_type"=>"Product","sku"=>$user->sku,"vendor_id"=>$vendorList[$user->vender]);
            ProductHelper::insert($insertArray);
        }
    }
}