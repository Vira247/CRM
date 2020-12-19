<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Helpers\UserHelper;
use App\Helpers\RoleHelper;
use App\Helpers\MasterListHelper;
use App\MasterType;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use DB;
use Hash;





class MasterController extends Controller

{
	function __construct()
	{

         $this->middleware('permission:master-list|master-create|master-edit|master-delete', ['only' => ['index','store']]);

         $this->middleware('permission:master-create', ['only' => ['create','store']]);

         $this->middleware('permission:master-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:master-delete', ['only' => ['destroy']]);

    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {
		
		$data['type'] = $type = request('type');
		$data['name'] = $name = request('name');
        $data['table_list'] = MasterListHelper::getPaginateData($type,$name);
        $data['type_list'] = MasterType::getPluckData();
        return view('master.index',$data);

    }





    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
	{
        $data['type_list'] = MasterType::getPluckData();
        return view('master.create',$data);

    }





    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {
		
		$this->validate($request, [

            'type' => 'required',
			
            'value' => 'required'


        ]);



		$user_data = auth()->user();

        $insert_array = $request->all();
		

			
			
		$insert = MasterListHelper::insert($insert_array);



		if($insert){

			Session::flash('success', 'Master inserted successfully.');

			return redirect('master');

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

    public function show($id)

    {


    }





    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {
        $data['master_detail'] = MasterListHelper::getByid($id);
        $data['type_list'] = MasterType::getPluckData();
        return view('master.edit',$data);

    }





    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

        $this->validate($request, [

            'type' => 'required',
			
            'value' => 'required'
			

        ]);





		$update_array = array('type'=>request('type'),
						'value'=>request('value'));

					

		$where = array('id'=>$id);

        $update = MasterListHelper::update($update_array,$where);
		
		

		if($update){

			Session::flash('success', 'Master updated successfully.');

			return redirect('master');

		}else{

			Session::flash('error', 'Sorry, something went wrong. Please try again.');

			return redirect()->back();

		}
    }


	public function delete($id)
	{
        $update_array = array('delete_flag'=>'Y');
		$where = array('id'=>$id);
		$delete = MasterListHelper::softDelete($update_array,$where);
		if($delete){
			Session::flash('success', 'Master deleted successfully.');
		}else{
			Session::flash('error', 'Sorry, something went wrong. Please try again.');
		}
		return redirect()->back();
    }
	

}