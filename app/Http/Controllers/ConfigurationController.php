<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Job_seeker;
use App\Educational_detail;
use App\Job_link;
use App\City;
use DB;
use Auth;
use Mail;
use Log;

class ConfigurationController extends Controller
{
    public function sub_admins()
    {
    	$subadmins = User::select("users.*")
    	->where("users.role",2)->orderBy("users.id", "DESC")
    	->get();
    	return view('backend.sub_admins.index', ['subadmins'=>$subadmins]); 
	}

	public function add_sub_admin(Request $request)
    {
    	if($request->js_email!="")
        {
            $check_email = User::where('email', $request->js_email)->first();
            if($check_email)
            {
                $message = array('success'=>0,'message'=>'This email is already taken.');
            }
        }
        if($request->js_mobile!="")
        {
            $check_phone = User::where('mobile', $request->js_mobile)->first();
            if($check_phone)
            {
                $message = array('success'=>0,'message'=>'This mobile is already taken.');
            }
        }
        $user = new User;
        $user->role = 2;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->is_active = 1;
        $user->save();
        if(!empty($request->email)) 
        {
            $email_data['text'] = "You are registered at OutPlacementHeros as a Sub-Admin. We are happy to see you with us.";
            $email_data['name'] =  $request->name;
            $email_data['to'] =  $request->email;
            $email_data['password'] =  $request->password;
            
            Mail::send('backend.emails.sub_admin', $email_data, function($message) use ($email_data) 
            {
                $message->to($email_data['to'], 'Welcome At OutPlacementHeros')->subject
                ("Registration at OutPlacementHeros");
                $message->from(env('MAIL_FROM_ADDRESS', 'support@outplacementheros.org'),env('MAIL_FROM_NAME', 'OutPlacementHeros'));
            });
        }
        $message = array('success'=>1,'message'=>'Sub Admin has been successfully created.');
        echo json_encode($message);
	}

    public function change_status($id, $status)
    {
        if($id)
        {
            $sub_admin = User::find($id);
            $sub_admin->is_active =$status;
            $sub_admin->save();
            flash('Status has been changed successfully.')->success();
            return redirect()->back();
        }
        else
        {
            flash('Required fields are missings to change the status.')->error();
            return redirect()->back();
        }
    }
}
