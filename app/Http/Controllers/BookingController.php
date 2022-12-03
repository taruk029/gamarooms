<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Validator;
use Mail;
use App\Booking;
use App\Agent;
use App\Country;
use App\Transaction;


class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $bookings = Booking::leftjoin("provinces", "bookings.province_id", "=", "provinces.provinceid")
        ->leftjoin("countries", "provinces.country_id", "=", "countries.id")
        ->select('bookings.*', 'countries.name as country_name', 'provinces.name as province_name')
        ->where("bookings.user_id", Auth::user()['id'])
        ->where("bookings.status", 1)
        ->orderBy('bookings.id', 'desc')
        ->get();
        return view('frontend.bookings.index', ['bookings'=>$bookings]);
    }
    
    public function profile() 
    {
        $agent = User::leftjoin('agents', 'agents.user_id', '=', 'users.id')
        ->select('users.*', 'agents.first_name', 'agents.last_name', 'agents.city','agents.iata_status','agents.country','agents.iata_no', 'agents.agency_name','agents.agency_email', 'agents.iata_no', 'agents.city')
        ->where("users.id", Auth::user()['id'])
        ->first();
        $countries = Country::select('id', 'name')->where('is_active', 1)->orderBy('name', 'ASC')->get();
        return view('frontend.bookings.profile', ['agent'=>$agent, 'countries'=>$countries]);
    }
    
    public function update_profile(Request $request) 
    {
        DB::table('agents')
        ->where('user_id', Auth::user()['id']) 
        ->limit(1)
        ->update(array(
            'agency_name' => $request->agency_name,
            'agency_email' => $request->agency_email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'country' => $request->country,
            'city' => $request->city,
            'iata_status' => $request->iata_status,
            'iata_no' => $request->iata_no
        ));
        
        DB::table('users')
        ->where('id', Auth::user()['id']) 
        ->limit(1)
        ->update(array(
            'name' => $request->first_name." ".$request->last_name
        ));
        flash('Profile has been updated')->success();
        return redirect()->back();
    }
}
