<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Auth;

class AdminController extends Controller
{
	public function index()
    {
    	return view('backend.login');
	}

	public function alogin(Request $request)
    {
    	$request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    	$check = User::select("role","is_active")->where("email",$request->email)->first();
        if($check)
        {
            if($check->role==1 && $check->is_active==1)
            {
                $credentials = array("email"=>$request->email, "password"=>$request->password);
                if(Auth::attempt($credentials))
                {
                    return redirect('admin/dashboard'); 
                }
                else
                {
                    flash('Username or password is wrong.')->error();
                    return redirect('admin'); 
                }
            }
            else
            {
                flash('You do not have permissions to login.')->error();
                return redirect()->back();
            } 
        }
        else
        {
            flash('Username or password is wrong.')->error();
            return redirect('admin'); 
        }
	}

    public function adminLogout() 
    {        
        Auth::logout();
        return redirect('admin');     
    }
}
