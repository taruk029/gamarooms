<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Country;
use App\Province;
use App\Location;
use App\Agent;
use App\Booking;
use GuzzleHttp\Client;
use DB;
use Auth;
use Mail;
use Url;
use Session;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->to = "ops@gamarooms.com";
    } 
    
    public function signup() 
    {        
        $countries = Country::select('id', 'name')->where('is_active', 1)->orderBy('name', 'ASC')->get();
        return view('frontend.signup', ['countries'=>$countries]);
    }
    
    

    public function agent_signup(Request $request)
    {
        $request->validate([
            'agency_name' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|string',
            'city' => 'required|string',
            'country' => 'required',
            'address' => 'required|string',
            'email' => 'required|email'
        ]);
        if($request->email!="")
        {
            $check_email = User::where('email', $request->email)->first();
            if($check_email)
            {
                flash('This email is already taken.')->error();
                return redirect()->back();
            }
        }

        $user = new User;
        $user->role = 2;
        $user->name = $request->first_name." ".$request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_active = 0;
        
        if($user->save())
        {           
            $js = new Agent;
            $js->user_id = $user->id;
            $js->agency_name = $request->agency_name;
            $js->agency_email = $request->email;
            $js->first_name = $request->first_name; 
            $js->last_name = $request->last_name;
            $js->country = $request->country;
            $js->city = $request->city;
            $js->iata_status = $request->iata_status;
            $js->iata_no = $request->iata_no;                                                                              
            $js->save();

            $email_data['to'] =  $this->to; 
            //$email_data['to'] =  "taru.kanthra029@hotmail.com"; 
            
            Mail::send('frontend.emails.signup', $email_data, function($message) use ($email_data) 
            {
                $message->to($email_data['to'], 'Agent Registration')
                ->subject("Agent Registration");
                $message->from('tec@gamarooms.com','Gama Rooms'); 
            });
            /*$credentials = array("email"=>$request->js_email, "password"=>$request->js_password);
            Auth::attempt($credentials);*/
            //flash('Thanks for registering with us.We will let you know after Admin approval.')->success();
            echo "<script>alert('You are registered successfully.');</script>";
            return redirect('/'); 
        }
    }
    
    public function check_is_active(Request $request)
    {
        $is_active = User::select('is_active')->where("email", $request->email)->first();
        if($is_active)
        {
            if($is_active['is_active']==1)
            {
                echo 1;
            }
            else
            {
                if($is_active['is_active']==0)
                {
                    echo 0;
                }
                else
                {
                    echo 2;
                }
            } 
        }
        else
            echo 3;
    }
    
    public function aboutus() 
    {        
        return view('frontend.aboutus');
    }
    
    public function terms_conditions() 
    {        
        return view('frontend.terms_conditions');
    }

    public function forget_password()
    {
        return view('frontend.forget_password');
    }
    
    public function check_forget_password(Request $request)
    {
        $js_email = User::select('id', 'name')->where("email", $request->email)->first();
        if($js_email)
        {
            $digit = date('Ymdhis').rand(0,9999999);

            $js = User::find($js_email->id);
            $js->forgot_password_token = $digit;
            $js->save();

            $url = url('/').'/reset_password/'.base64_encode($js_email->id).'/'.$digit;
            if($js_email)
            {                    
                $email_data['name'] =  $js_email->name;
                $email_data['to'] = $request->email;
                $email_data['url'] =  $url;
                
                Mail::send('frontend.emails.forget_password', $email_data, function($message) use ($email_data) 
                {
                    $message->to($email_data['to'], 'Reset Password:Gama Rooms')
                ->subject("Reset Password:Gama Rooms");
                $message->from('tec@gamarooms.com','Gama Rooms'); 
                });
            }
            return view('frontend.check_forget_password');
        }
        else
        {
            flash('The email you have entered does not exists.')->error();
            return redirect()->back();
        }
    }
    
    public function reset_password($id, $token)
    {
        if($id && $token)
        {
            $user_id = base64_decode($id);
            $user = User::find($user_id);
            if($user)
            {
                return view('frontend.reset_password', ['id'=>$id, 'token'=>$token]);
            }
        }
    }

    public function change_password(Request $request)
    {
        if($request->id && $request->token)
        {
            $user_id = base64_decode($request->id);
            $user = User::find($user_id);
            if($user)
            {
                if($user->forgot_password_token == $request->token)
                {
                    $user->password = bcrypt($request->password);
                    $user->forgot_password_token ="";
                    $user->save();                  
                    
                    $email_data['name'] =  $user->name;
                    $email_data['to'] = $user->email;
                    
                    Mail::send('frontend.emails.forget_password_success', $email_data, function($message) use ($email_data) 
                    {
                        $message->to($email_data['to'], 'Reset Password Success:Gama Rooms')
                        ->subject("Reset Password Success:Gama Rooms");
                        $message->from('tec@gamarooms.com','Gama Rooms');
                    });
                    return view('frontend.success_forget_password');
                }
                else
                {
                    flash('The reset password link has expired, please try again.')->error();
                    return redirect()->back();
                }
            }
        }
    }



}
