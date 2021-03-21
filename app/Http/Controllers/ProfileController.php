<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;
class ProfileController extends Controller
{
    public function __construct(){}
	
	public function profile(){
		$auth = auth()->user();
		$user = User::find($auth->id);
		$user->getRoleNames();
        $userRole = $user->roles->pluck('name','name')->all();
		$data['userRole'] =  $userRole;
		return view('profile',$data);
	}
	/*
	public function updateProfile(Request $request){
		
		$validator = Validator::make($request->all(), [
				'first_name' => 'required',
				'last_name' => 'required',
				'email' => 'required|email',
				'dob' => 'required',
				'address' => 'required',
				'mobile' => 'required|numeric',
				'state' => 'required',
				'city' => 'required',
				'zipcode' => 'required',
				'gender' => 'required',
				'agency' => 'required',
            ]);
			if ($validator->fails()) {
                return redirect("profile")
                                ->withErrors($validator, 'profile')
                                ->withInput();
            } else {
				
				$img ='';
				if($request->file('images') !=''){
					$files =$request->file('images');
					$name = time() . '.' . $files->getClientOriginalExtension();	
					 $destination= public_path('uploads/user');
					$files->move($destination, $name);
					$img = $name;
				}
				
				$data_new =array(
					'first_name' => $request->input('first_name'),
					'last_name' => $request->input('last_name'),
					'email' => $request->input('email'),
					'date_of_birth' => Utility::convertYMD($request->input('dob')),
					'address1' =>$request->input('address'),
					'address2' =>$request->input('address2'),
					'mobile' =>$request->input('mobile'),
					'state' =>$request->input('state'),
					'city' =>$request->input('city'),
					'zip' =>$request->input('zipcode'),
					'gender' =>$request->input('gender'),
					'agency' =>implode(',',$request->input('agency')),
				
				);
				
				if($img !=''){
					$data_new['profile_pic'] = $img;
				}
				$update = $this->user->update($data_new,array('id'=>$request->input('id')));
				Session::flash('success', 'Profile successfully updated.');
                    return redirect('profile');
			}
		
	}
*/
	public function changePassword(Request $request){
		$users = auth()->user();
		$validator = Validator::make($request->all(), [
				'old_password' => 'required',
				'new_password' => 'required',
				'confirm_password' => 'required|same:new_password|min:6',
				
            ]);
			if ($validator->fails()) {
				return redirect("/profile")
					->withErrors($validator, 'profile')
					->withInput();
			} else {
		
			$id = $request->input('id');
			$usern = $this->user->getUserDetailById($id);
		
			$user = User::findOrFail($id);
			if (Hash::check($request->input('old_password'), $user->password)) { 
				$this->user->update(array('password' => Hash::make($request->input('new_password'))),array('id'=>$id));
			   $request->session()->flash('success', 'Password changed successfully');
				return redirect()->back();
			} else {
				$request->session()->flash('error', 'Password does not match');
				return redirect()->back();
			}
		}
		
	}
	public function uploadProfile(Request $request){
		if ($request->hasfile('file')) {
			$update_array = array();
			$file = $request->file('file');
			$name = $file->getClientOriginalName();
			$name = str_replace(" ", "", time() . $name);
			$file->move(public_path() . '/upload/', $name);
			$users = auth()->user();
			$update_array['profilepic'] = '/upload/'.$name;
			$user = User::findOrFail($users->id);
			User::where('id',$users->id)->update($update_array);
			$request->session()->flash('success', 'Profile changed successfully');
			return redirect()->back();
		}
	}
}
