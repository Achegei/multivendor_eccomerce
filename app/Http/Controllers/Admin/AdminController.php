<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use App\Models\Admin;
use Session;
use Hash;
class AdminController extends Controller
{
    public function dasboard(){
        return view('admin.dasboard');
    }

    public function login(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            $incoming = [
                'email'=>'required|email|max:255',
                'password'=> 'required',
            ];
            $customMessages =[
                'email.required'=> 'Email address is Required',
                'email.email'=> 'Valid email address is required',
                'password'=> 'Valid password is required',
            ];
                $validator = Validator::make($data, $incoming, $customMessages);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                if(Auth::guard('admin')->attempt(['email'=> $data['email'], 'password'=> $data['password'], 'status'=>1]))
                {
                    return redirect('admin/dasboard');
                } else{
                return redirect()->back()->with('error_message', 'Invalid email or password');}
            } 
            return view('admin.login');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updatePassword(Request $request){
        if ($request->isMethod('post')){
            $data = $request-> all();
            if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
                if($data['new_password']== $data['confirm_passwor']){
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message', 'Your current password is updated successfully');
                } else {
                    return redirect()->back()->with('error_message', 'New password and confirm password dont match');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your current password is incorrect');
            }
        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }
    public function checkAdminPassword(Request $request){
        $data = $request->all();
       //echo "<pre>"; print_r($data); die;
       if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
        return "true";
       } else{
        return "false";
       }
    }
}
