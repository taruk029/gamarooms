<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Mail;
use Log;
use App\Exports\BookingExport;
use Maatwebsite\Excel\Facades\Excel;
use GuzzleHttp\Client;
use App\Agent;
use App\Booking;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        /*$this->yallago = "https://apici.yalago.com/hotels/";
        $this->api_key = "962e72eb-a711-4516-9f90-ec6e8c9815e7";*/
        $this->yallago = "https://api.yalago.com/hotels/";
        $this->api_key = "e3d64679-1b02-4468-b986-1bc7af033d80";
    }

    public function index(Request $request)
    {  

    	$results = DB::table('bookings')
        ->leftjoin("users", "users.id", "=", "bookings.user_id")
        ->leftjoin("provinces", "bookings.province_id", "=", "provinces.provinceid")
        ->leftjoin("countries", "provinces.country_id", "=", "countries.id")
        ->select("bookings.*",
            "users.name as agent_name",
            "provinces.name as province_name",
            "countries.name as country_name")     
        ->orderBy("bookings.created_at", "desc");

        if(!empty($request->agent))
        {
            $agent_arr = array();
            foreach($request->agent as $row)
            {
                array_push($agent_arr, $row);
            }
            $results->whereIn('bookings.user_id', $agent_arr);
        }
        
        if(!empty($request->start_date) && !empty($request->end_date))
        {
            $start = date_create($request->start_date);
            $start_date = date_format($start,'Y-m-d');
            
            $end = date_create($request->end_date);
            $end_date = date_format($end,'Y-m-d');
            $results->whereBetween('bookings.created_at', [$start_date, $end_date]);
        }
        
        if(!empty($request->is_payment_done))
        {
            $is_payment_done = 1;
            if($request->is_payment_done==2)
                $is_payment_done = 0;
            $results->where('bookings.is_payment_done', $is_payment_done);
        }
        
        if(!empty($request->payment_mode))
        {
            $results->where('bookings.payment_mode', $request->payment_mode);
        }
        
        if(!empty($request->payment_success))
        {
            $results->where('bookings.payment_success', $request->payment_success);
        }

        $bookings = $results->get();

        $agents = User::leftjoin('agents', 'users.id','=','agents.user_id')->where("users.role", 2)->where("users.is_active", 1)->orderBy('users.name', 'ASC')->get();
    	return view('backend.reports.index', ['bookings'=>$bookings, 'agents'=>$agents]); 
	}
	
	public function today()
    {  
        $today = date('Y-m-d');
    	$results = DB::table('bookings')
        ->leftjoin("users", "users.id", "=", "bookings.user_id")
        ->leftjoin("provinces", "bookings.province_id", "=", "provinces.provinceid")
        ->leftjoin("countries", "provinces.country_id", "=", "countries.id")
        ->select("bookings.*",
            "users.name as agent_name",
            "provinces.name as province_name",
            "countries.name as country_name")     
        ->orderBy("bookings.id", "desc")
        ->where("bookings.status", 1)
        ->whereRaw("DATE_FORMAT(bookings.created_at, '%Y-%m-%d') = '".$today."'");
        $bookings = $results->get();

    	return view('backend.reports.today', ['bookings'=>$bookings]); 
	}
	
	public function confirmed()
    {  
        $today = date('Y-m-d');
    	$results = DB::table('bookings')
        ->leftjoin("users", "users.id", "=", "bookings.user_id")
        ->leftjoin("provinces", "bookings.province_id", "=", "provinces.provinceid")
        ->leftjoin("countries", "provinces.country_id", "=", "countries.id")
        ->select("bookings.*",
            "users.name as agent_name",
            "provinces.name as province_name",
            "countries.name as country_name")     
        ->orderBy("bookings.id", "desc")
        ->where("bookings.status", 1);
        $bookings = $results->get();

    	return view('backend.reports.confirmed', ['bookings'=>$bookings]); 
	}
	
	public function export_booking(Request $request)
    {  

    	$results = DB::table('bookings')
        ->leftjoin("users", "users.id", "=", "bookings.user_id")
        ->leftjoin("provinces", "bookings.province_id", "=", "provinces.provinceid")
        ->leftjoin("countries", "provinces.country_id", "=", "countries.id")
        ->select("bookings.*",
            "users.name as agent_name",
            "provinces.name as province_name",
            "countries.name as country_name")     
        ->orderBy("bookings.id", "desc");

        if(!empty($request->agent))
        {
            $agent_arr = array();
            foreach($request->agent as $row)
            {
                array_push($agent_arr, $row);
            }
            $results->whereIn('bookings.user_id', $agent_arr);
        }
        
        if(!empty($request->start_date) && !empty($request->end_date))
        {
            $start = date_create($request->start_date);
            $start_date = date_format($start,'Y-m-d');
            
            $end = date_create($request->end_date);
            $end_date = date_format($end,'Y-m-d');
            $results->whereBetween('bookings.created_at', [$start_date, $end_date]);
        }
        
        if(!empty($request->is_payment_done))
        {
            $is_payment_done = 1;
            if($request->is_payment_done==2)
                $is_payment_done = 0;
            $results->where('bookings.is_payment_done', $is_payment_done);
        }
        
        if(!empty($request->payment_mode))
        {
            $results->where('bookings.payment_mode', $request->payment_mode);
        }
        
        if(!empty($request->payment_success))
        {
            $results->where('bookings.payment_success', $request->payment_success);
        }

        $bookings = $results->get();
        $data = array();
        if($bookings)
        {
            foreach($bookings as $row)
            {
                $details = unserialize($row->response); 
                
                $hotel_name = "";
                if(isset($details->Establishment->Name)) 
                    $hotel_name =  $details->Establishment->Name; 
                else 
                    $hotel_name =  "--";
                $status = "";
                if($row->status==1)
                    $status ="Booked"; 
                elseif($row->status==2)
                    $status ="Cancelled";
                else
                    $status ="--"; 
                
                $payment = "";
                if($row->is_payment_done==0)
                    $payment = "Done";
                else
                    $payment = "Not Done";
                   
                $payment_mode = ""; 
                if($row->is_payment_done==1)
                {
                    if($row->payment_mode==1)
                        $payment_mode = "Payment Gateway"; 
                    elseif($row->payment_mode==2)
                        $payment_mode = "Wallet"; 
                    else
                        $payment_mode = "--"; 
                }
                else
                    $payment_mode = "Payment Not Done"; 
                    
                $payment_success = "";
                if($row->is_payment_done==1)
                {
                    if($row->payment_success==1)
                        $payment_success = "Success";
                    elseif($row->payment_success==2)
                        $payment_success = "Aborted";
                    elseif($row->payment_success==3)
                        $payment_success = "Failed";
                    else
                        $payment_success = "--";
                }
                else
                    $payment_success = "Payment Not Done";
                
                $created_at ="";
                $exd = date_create($row->created_at); 
                $created_at = date_format($exd,'d-m-Y');
                
                $check_in ="";
                $exd1 = date_create($row->check_in); 
                $check_in = date_format($exd1,'d-m-Y');
                
                $check_out ="";
                $exd2 = date_create($row->check_out); 
                $check_out =  date_format($exd2,'d-m-Y');
                 
                $cancelled_on = "";
                if(!empty($row->cancelled_on))
                {
                    $exd3 = date_create($row->cancelled_on); 
                    $cancelled_on = date_format($exd3,'d-m-Y');
                }
                else
                    $cancelled_on = "--";
                        
                $res = array('Agent'=>$row->agent_name,
                		   'Location'=>$row->province_name.", ".$row->country_name,
                		   'Reference Id'=>$row->reference_id,
                		   'API Reference'=>$row->booking_ref,
                		   'Hotel'=>$hotel_name,
                		   'Currency'=>$row->currency,
                		   'Booking Amount'=>$row->booking_amount,
                		   'Commission'=>$row->commission,
                		   'Status'=>$status,
                		   'Payment'=>$payment,
                		   'Payment Mode'=>$payment_mode,
                		   'Payment Success'=>$payment_success,
                		   'Booking Date'=>$created_at,
                		   'CheckIn & CheckOut'=>$check_in." - ".$check_out,
                		   'Cancellation Amount'=>$row->cancellation_charge?$row->cancellation_charge:"--",
                		   'Cancellation Date'=>$cancelled_on,  
                		   );
               array_push($data, $res); 
            }
        }
        return Excel::download(new BookingExport($data), 'Booking_report'.date('His').'.xlsx'); 
	}
	
	public function admin_cancel_booking($booking_id)
    {
        try
        {
            $headers = [
                        "x-api-key"=>$this->api_key,
                        "Content-Type"=> "application/json",
                        "Accept"=> "application/json"
            ];
    
            $client = new Client(['headers' => $headers]);  
    
            $body = '{
            "BookingRef": "'.base64_decode($booking_id).'",
            "GetTaxBreakdown":false
            }';
            
            $response = $client->request('POST', $this->yallago.'bookings/getcancellationcharges', ['body' => $body]);
            $statusCode = $response->getStatusCode();
            $body_res = $response->getBody()->getContents();
            $data = json_decode($body_res);
            /*echo "<pre>";
            print_r($data);die;*/
            if (property_exists($data, "IsCancellable"))
            {
                $booking = Booking::where("booking_ref", base64_decode($booking_id))->first();
                return view('backend.reports.cancel', ['data'=>$data, 'booking'=>$booking, 'booking_id'=>$booking_id]);
            }
            else
            {
                echo "Key does not exist!";
            }
            die;
               
        } 
        catch (\GuzzleHttp\Exception\RequestException $e) {
        if ($e->hasResponse()) {
            $response = $e->getResponse();
            return response()->json(['error'=>true,'response' =>$response]);     
        }
        }
    }
    
    public function admin_confirm_cancel($booking_id, $amount, $currency)
    {
        try
        {
            $headers = [
                        "x-api-key"=>$this->api_key,
                        "Content-Type"=> "application/json",
                        "Accept"=> "application/json"
            ];
    
            $client = new Client(['headers' => $headers]);  
    
            $body = '{
            "BookingRef": "'.base64_decode($booking_id).'",
            "ExpectedCharge": {
                "Charge": {
                "Amount": '.base64_decode($amount).',
                "Currency": "'.base64_decode($currency).'"
                }
            }
            }';
            
            $response = $client->request('POST', $this->yallago.'bookings/cancel', ['body' => $body]);
            $statusCode = $response->getStatusCode();
            $body_res = $response->getBody()->getContents();
            $data = json_decode($body_res);
            /*echo "<pre>";
            print_r($data);die;*/
            if (property_exists($data, "BookingRef"))
            {
                if($data->Status==1)
                {
                    DB::table('bookings')
                    ->where('booking_ref', base64_decode($booking_id)) 
                    ->limit(1) 
                    ->update(array('status' =>2, 'cancellation_charge'=>base64_decode($amount), 'cancelled_on'=>date('Y-m-d')));
                    $booking = Booking::where("booking_ref", base64_decode($booking_id))->first();
                    return view('backend.reports.cancel_success', ['data'=>$data, 'booking'=>$booking, 'booking_id'=>$booking_id]);
                }
                else
                {
                    echo "<script>alert('Booking is not cancelled, please try again.');</script>";
                    return redirect('admin/bookings');
                }
            }
            else
            {
                echo "Key does not exist!";
            }
            die;
        } 
        catch (\GuzzleHttp\Exception\RequestException $e) {
        if ($e->hasResponse()) {
            $response = $e->getResponse();
            return response()->json(['error'=>true,'response' =>$response]);     
        }
        }
    }
}
