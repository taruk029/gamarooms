<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\Booking;

class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $d2 = date('Y-m-d');
        //$d2 = '2021-02-15';
        $bookings_count = Booking::where('status', 1)->count();
        $current_bookings = DB::select("SELECT COUNT(*) AS aggregate FROM `bookings` WHERE status =1 AND DATE_FORMAT(`created_at`, '%Y-%m-%d') = '".$d2."'");
        
        $booking_amount =  DB::table('bookings')->select('currency', DB::raw('SUM(booking_amount) as booking_sum'))->where('status', 1)->groupBy('currency')->get();
        $current_booking_amount = DB::select("SELECT `currency`, SUM(`booking_amount`) as booking_sum FROM `bookings` WHERE  status =1 AND  DATE_FORMAT(`created_at`, '%Y-%m-%d') = '".$d2."' GROUP BY `currency`");
        
        $commission = DB::table('bookings')->select('currency', DB::raw('SUM(commission) as commission_sum'))->where('status', 1)->groupBy('currency')->get();
        $current_commission = DB::select("SELECT `currency`, SUM(`commission`) as commission_sum FROM `bookings` WHERE  status =1 AND DATE_FORMAT(`created_at`, '%Y-%m-%d') = '".$d2."' GROUP BY `currency`");
        
        
        
    	/*$js = User::where("role", 6)->count();
    	$d2 = date('y-m-d', strtotime('-30 days'));
    	$last_month_js = User::where("role", 6)->where("last_login", ">=", $d2)->count();

        $active_jobseekers = User::select('name', 'email', 'mobile', 'last_login')->where("role", 6)->where("last_login", ">=", $d2)->orderBy("last_login", "DESC")->get();
        $new_jobseekers = User::select('name', 'email', 'mobile', 'created_at')->where("role", 6)->where("created_at", ">=", $d2)->orderBy("users.id", "DESC")->get();
    	$job_links = Job_link::count();
    	$liked_job_links = Job_link::where("is_liked", 1)->count();
    	$quality_score = $job_links/$liked_job_links;*/
    	
    	return view('backend.home', ['bookings_count'=>$bookings_count, 'current_bookings'=>$current_bookings, 'booking_amount'=>$booking_amount, 'commission'=>$commission, 'current_booking_amount'=>$current_booking_amount, 'current_commission'=>$current_commission]); 
	}
}
