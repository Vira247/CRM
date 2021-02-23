<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Helpers\UserHelper;
use App\Helpers\RoleHelper;
use App\Helpers\InquiryHelper;
use App\Helpers\VendorHelper;
use App\Helpers\ProductHelper;
use App\Helpers\InquiryDataHelper;
use App\Helpers\InquiryProductHelper;
use App\InquiryData;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;
class InquiryController extends Controller{
	function __construct(){
         $this->middleware('permission:inquiry-list|inquiry-create|inquiry-edit|inquiry-delete', ['only' => ['index','store']]);
         $this->middleware('permission:inquiry-create', ['only' => ['create','store']]);
         $this->middleware('permission:inquiry-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:inquiry-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $data['related_to'] = $request->input('related_to');
        $data['date'] = $request->input('date');
        $data['status'] = $request->input('status');
        $data['name'] = $request->input('name');
        $data['phone'] = $request->input('phone');
        $data['email'] = $request->input('email');
        $data['table_list'] = InquiryHelper::getPaginateData($data['related_to'],$data['date'],$data['status'],$data['name'],$data['phone'],$data['email']);
        $data['i'] = ($request->input('page', 1) - 1) * 50;
        return view('inquiry.index',$data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $data['vendorList'] = VendorHelper::getList();
        $data['userList'] = User::orderBy('name','ASC')->get();
        return view('inquiry.create',$data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $products = $request->input('productid');
		$this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'follow_up_date' => 'required',
            'note' => 'required',
        ]);
		$user_data = auth()->user();
        $insert_array = $request->all();
        if($insert_array['assign_to'] == ''){
            $insert_array['assign_to'] = Auth::user()->id;
        }
		$insert = InquiryHelper::insert($insert_array);
		if($insert){
            $insertArray = array('inquiry_id'=>$insert,
            'description'=>request('note'),
            'follow_up_date'=>request('follow_up_date'));
            InquiryDataHelper::insert($insertArray);
            if( isset($products) && count($products) > 0){
                foreach($products as $product){
                    $insertArray = array("inquiry_id"=>$insert,
                    "product_id"=>$product);
                    InquiryProductHelper::insert($insertArray);
                }
            }
            
			Session::flash('success', 'Master inserted successfully.');
			return redirect('inquiry/'.$insert);
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
        $data['detail'] = InquiryHelper::getByid($id);
        if($data['detail']){
            $data['productDetail'] = array();
            if($data['detail']){
                $data['productDetail'] = ProductHelper::getByid($data['detail']->product_id);
            }
            $data['inquirList'] = InquiryDataHelper::getDataListByiInqueryd($id);
            $data['productList'] = InquiryProductHelper::getProductByInquiryId($id);
            return view('inquiry.show',$data);
        }
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)    {
        $data['master_detail'] = InquiryHelper::getByid($id);
        return view('inquiry.edit',$data);
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
        $update = InquiryHelper::update($update_array,$where);
		if($update){
			Session::flash('success', 'Master updated successfully.');
			return redirect('inquiry');
		}else{
			Session::flash('error', 'Sorry, something went wrong. Please try again.');
			return redirect()->back();
		}
    }
	public function delete($id){
        $update_array = array('delete_flag'=>'Y');
		$where = array('id'=>$id);
		$delete = InquiryHelper::softDelete($update_array,$where);
		if($delete){
			Session::flash('success', 'Master deleted successfully.');
		}else{
			Session::flash('error', 'Sorry, something went wrong. Please try again.');
		}
		return redirect()->back();
    }
    public function addFollowUp(Request $request,$id){
        $date = $request->date;
        $note = $request->note;
        $update_array = array('follow_up_date'=>$date);
		$where = array('id'=>$id);
        $update = InquiryHelper::update($update_array,$where);
        $insertArray = array("inquiry_id"=>$id,"description"=>$note,"follow_up_date"=>$date);
        InquiryDataHelper::insert($insertArray);
        Session::flash('success', 'Note addes succesfully.');
		return redirect()->back();
    }
    public function changeStatus($id,$status){
        $update_array = array('status'=>$status);
		$where = array('id'=>$id);
        $update = InquiryHelper::update($update_array,$where);
        $insertArray = array("inquiry_id"=>$id,"description"=>"Inquiry ".$status);
        InquiryDataHelper::insert($insertArray);
        Session::flash('success', 'Status change successfully.');
		return redirect()->back();
    }
    public function followUpList(Request $request){
        $data['related_to'] = $request->input('related_to');
        $data['date'] = $request->input('date');
        $data['userList'] = User::orderBy('name','ASC')->get();
        $data['table_list'] = InquiryDataHelper::getPaginateData($data['related_to'],$data['date']);
        $data['i'] = ($request->input('page', 1) - 1) * 50;
        return view('inquiry.follow_up_list',$data);
    }
    public function followCalendar(){
        return view('inquiry.follow_calendar');
    }
    public function followDateList(Request $request){
        $start = date('Y-m-d',strtotime($request->input('start')));
        $end = date('Y-m-d',strtotime($request->input('end')));
        $lists = InquiryHelper::getFollowUpByDate($start,$end);
        $data = array();
        foreach($lists as $list){
            $data[] = array("id"=>$list->id,"title"=>$list->name.'-'.$list->assignname,"start"=>$list->follow_up_date);
        }
        return $data;
    }
    public function getFollowUpNotificationCount(){
        $user = auth()->user();
        $count = InquiryHelper::getFollowUpNotificationCount();
        return $count;
    }
}