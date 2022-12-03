<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Transaction;
use App\Booking;
use Auth;
use DB;
use Mail;
use Url;
use Session;
use GuzzleHttp\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class CCAvenueController extends Controller
{
	public function __construct()
    { 
        /*$this->merchant_id  = "45990";
        $this->yallago = "https://apici.yalago.com/hotels/";
        $this->api_key = "962e72eb-a711-4516-9f90-ec6e8c9815e7";*/
        $this->yallago = "https://api.yalago.com/hotels/";
        $this->api_key = "e3d64679-1b02-4468-b986-1bc7af033d80";
        $this->merchant_id  = "47273";
    }
    
    
    public function pay_details(Request $request)
    {
        $wallet_amount = \App\Helpers\Helper::get_wallet_amount(Auth::user()['id']);
        if($request->payment_mode==1)
        {
            $merchant_data='';
            /*$working_key='EE708612E49168770AFA7EEDA1215AFF';
    	    $access_code='AVMS03IC73BL44SMLB';*/
    	    
    	    $working_key='937DB7336E990798284840225D95B592';
    	    $access_code='AVVP03IE79CA52PVAC';
            foreach ($_POST as $key => $value)
            {
                if($key!="_token" && $key!="payment_mode")
                {
                    if($key=="amount")
                        $merchant_data.=trim($key).'='.trim(base64_decode($value)).'&';
                    else
    		            $merchant_data.=trim($key).'='.trim($value).'&';
                }
    	    }
    	    
    	    $transaction = new Transaction;
            $transaction->user_id = Auth::user()['id'];
            $transaction->booking_id = $request->booking_id;
            $transaction->current_amount = "0.00";
            $transaction->booking_amount = base64_decode($request->amount);
            $transaction->balance = "0.00";
            $transaction->payment_mode = 1;
            $transaction->created_at = date('Y-m-d h:i:s');
            $transaction->save();
            
            $booking = Booking::find($request->booking_id);
            $booking->payment_mode = 1;
            $booking->save();
            
    	    $encrypted_data = $this->encrypt($merchant_data,$working_key);
    	    $product_id = $request->order_id;
    	    return view('frontend.make_payment', ['encrypted_data'=>$encrypted_data, 'access_code'=>$access_code,'product_id'=>$product_id, 'merchant_id'=>$this->merchant_id  ]);
        }
        else
        {
            $transaction = new Transaction;
            $transaction->user_id = Auth::user()['id'];
            $transaction->booking_id = $request->booking_id;
            $transaction->current_amount = $wallet_amount;
            $transaction->booking_amount = base64_decode($request->amount);
            $transaction->balance = $wallet_amount-base64_decode($request->amount);
            $transaction->payment_mode = 2;
            $transaction->created_at = date('Y-m-d h:i:s');
            $transaction->save();
            
            $booking = Booking::find($request->booking_id);
            $booking->payment_mode = 1;
            $booking->save();
            
            DB::table('agents')
            ->where('user_id', Auth::user()['id']) 
            ->limit(1) 
            ->update(array('wallet_amount' => $wallet_amount-base64_decode($request->amount)));
            return  redirect('/');
        }
	    //echo $merchant_data;
    }
    
    public function ccavResponseHandler()
    {
        $merchant_data='';
        $working_key='937DB7336E990798284840225D95B592';
    	$encResponse=$_POST["encResp"];	
    	$rcvdString= $this->decrypt($encResponse,$working_key);	
    	$order_status="";
    	$order_id="";
    	$decryptValues=explode('&', $rcvdString);
    	$dataSize=sizeof($decryptValues);
    	/*echo "<center>";*/
    
    	for($i = 0; $i < $dataSize; $i++) 
    	{
    		$information=explode('=',$decryptValues[$i]);
    		if($i==3)	
    		    $order_status=$information[1];
    		if($i==0)	
    		    $order_id=$information[1];
    	}
    
    	if($order_status==="Success")
    	{
    	    if(Session::has('currency'))
            {
                $currency = Session::get('currency');
            }
            else
            {
                $currency = "AED";
            }
            $rooms_array = Session::get('room_book');
            $start_booking_date = Session::get('start_booking_date');
            $end_booking_date = Session::get('end_booking_date');
            $establishment_id = Session::get('establishment_id');
            $source_market_book = Session::get('source_market_book');
            $total_amount = Session::get('total_amount');
            $booking_amount = Session::get('booking_amount');
            $booking = Booking::leftjoin("users", "bookings.user_id", "=", "users.id")
            ->select('users.name')
            ->where('bookings.reference_id', $order_id)
            ->first();
            
            $headers = [
                        "x-api-key"=>$this->api_key,
                        "Content-Type"=> "application/json",
                        "Accept"=> "application/json"
            ];
    
            $client = new Client(['headers' => $headers]); 
            
            $aff_name = explode(" ", $booking['name']);
            $first_name = "";
            $last_name = "";
            if(count($aff_name))
            {
                $first_name = $aff_name[0];
                $last_name = $aff_name[1];
            }
            $body = "";
            $affiliateref = date('ymdhis');
            $body = '{
              "CheckInDate": "'.$start_booking_date.'",
              "CheckOutDate": "'.$end_booking_date.'",
              "EstablishmentId": "'.$establishment_id.'",
              "Rooms": ['.$rooms_array.'],
              "Culture": "en-gb",
              "AffiliateRef": "'.$affiliateref.'",
              "ContactDetails": {"Title": "Mr","FirstName": "'.$first_name.'", "LastName": "'.$last_name.'"},
              "GetpackagePrice": true,
              "SourceMarket": "'.$source_market_book.'",
              "GetTaxBreakDown": false,
              "GetLocalCharges": true,
              "GetErrataCategory": true,
              "GetBoardBasis": true,
              "CurrencyCode": ""
              }';
            /*echo "<pre>";
            print_r($body);die;*/
            
            $searchLog = 'logs/api.log';
            $search_Log = new Logger($searchLog);
            $search_Log->pushHandler(new StreamHandler(storage_path($searchLog)), Logger::INFO);
            $search_Log->info("request-".$this->yallago.'bookings/create'.$body);
            
            $response_body = "";
            $data = "";
            $response = $client->request('POST', $this->yallago.'bookings/create', ['body' => $body]);
            $statusCode = $response->getStatusCode();
            $response_body = $response->getBody()->getContents();
            $data = json_decode($response_body);
	        $access_code='AVVP03IE79CA52PVAC';//Shared by CCAVENUES
	        
            /*echo "<pre>";
            print_r($data);die;*/
            
            $search_Log->pushHandler(new StreamHandler(storage_path($searchLog)), Logger::INFO);
            $search_Log->info("response-".$this->yallago.'bookings/create'.serialize($data));
            if (property_exists($data, "BookingRef"))
            {
                DB::table('bookings')
                ->where('reference_id', $order_id) 
                ->limit(1) 
                ->update(array('booking_ref' =>$data->BookingRef, 
                            'booking_amount' =>$booking_amount, 
                            'commission' =>$total_amount - $booking_amount, 
                            'currency' =>$currency, 
                            'request_call' =>serialize($body), 
                            'response' =>serialize($data), 
                            'status' =>1, 
                            'payment_success' =>1, 
                            'is_payment_done' =>1));
                
                Session::forget('room_book');
                Session::forget('start_booking_date');
                Session::forget('end_booking_date');
                Session::forget('establishment_id');
                Session::forget('source_market_book');
                Session::forget('total_amount');
                Session::forget('booking_amount');
    	    }
            return view('frontend.payment_success', ['decryptValues'=>$decryptValues, 'dataSize'=>$dataSize]);
    	}
    	else if($order_status==="Aborted")
    	{
    	    if(!empty($order_id))
    	    {
                DB::table('bookings')
                ->where('reference_id', $order_id) 
                ->limit(1) 
                ->update(array('payment_success' =>2, 'is_payment_done' =>1));
    	    } 
    		echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
    		echo "<br><a href='".url('/')."'>Go to Homepage</a>";
    	
    	}
    	else if($order_status==="Failure")
    	{
    	    if(!empty($order_id))
    	    {
                DB::table('bookings')
                ->where('reference_id', $order_id) 
                ->limit(1) 
                ->update(array('payment_success' =>3, 'is_payment_done' =>1));
    	    }
    		echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
    		echo "<br><a href='".url('/')."'>Go to Homepage</a>";
    	}
    	else
    	{
    		echo "<br>Security Error. Illegal access detected";
    		echo "<br><a href='".url('/')."'>Go to Homepage</a>";
    	}
    
    	/*echo "<br><br>";
    
    	echo "<table cellspacing=4 cellpadding=4>";
    	for($i = 0; $i < $dataSize; $i++) 
    	{
    		$information=explode('=',$decryptValues[$i]);
    	    	echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
    	}
    
    	echo "</table><br>";
    	echo "</center>";*/

    }
    
    public function voucher($id)
    {
        if($id)
        {
            $book_id = base64_decode($id);
            $booking = Booking::leftjoin("provinces", "bookings.province_id", "=", "provinces.provinceid")
                ->leftjoin("countries", "provinces.country_id", "=", "countries.id")  
                ->leftjoin("users", "bookings.user_id", "=", "users.id")
                ->where('bookings.reference_id', $book_id)
                ->select("bookings.*", "provinces.name as province_name", "countries.name as country_name", "users.name as agent_name", "users.email as user_email")
                ->first();
            if($booking->is_payment_done==1 && $booking->payment_success==1)
            {
                $response = unserialize($booking->response);
                $headers = [
                    "x-api-key"=>$this->api_key,
                    "Content-Type"=> "application/json",
                    "Accept"=> "application/json"
                ];
        
                $client = new Client(['headers' => $headers]);  
        
                $body = '{
                "EstablishmentId": '.$response->Establishment->EstablishmentId.',
                "Languages": ["en"]
                }';
                $response = $client->request('POST', $this->yallago.'Inventory/GetEstablishment', ['body' => $body]);
                $statusCode = $response->getStatusCode();
                $body = $response->getBody()->getContents();
                $data = json_decode($body);
                
                $searchLog = 'logs/api.log';
                $search_Log = new Logger($searchLog);
                $search_Log->pushHandler(new StreamHandler(storage_path($searchLog)), Logger::INFO);
                $search_Log->info("request-".$this->yallago.'Inventory/GetEstablishment'.$body);
                
                $search_Log->pushHandler(new StreamHandler(storage_path($searchLog)), Logger::INFO);
                $search_Log->info("response-".$this->yallago.'Inventory/GetEstablishment'.serialize($data));
                 /*   echo "<pre>";
                    print_r($data);
                    die;  */  
                if (property_exists($data, "Establishment"))
                {
                    $response_arr = array('Address' =>$data->Establishment->Address,
                    'PhoneNumber' =>$data->Establishment->PhoneNumber,
                    'Email' =>$data->Establishment->Email);
                    
                    return view('frontend.emails.voucher', ['booking'=>$booking, 'response_arr'=>$response_arr]);
                }
                else
                {
                    echo "Key does not exist!";
                }
            }
            else
            {
                echo "<br>You can not proceed because payment is not completed for this booking.";
    		    echo "<br><a href='".url('/')."'>Go to Homepage</a>";
            }
            
        }
        
    }
    
    function encrypt($plainText,$key)
    {
        $secretKey = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = openssl_encrypt($plainText, "AES-128-CBC", $secretKey, OPENSSL_RAW_DATA, $initVector);
        $encryptedText = bin2hex($encryptedText);
        return $encryptedText;
    }
    
    function decrypt($encryptedText,$key)
    {
        $secretKey         = $this->hextobin(md5($key));
        $initVector         =  pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText      = $this->hextobin($encryptedText);
        $decryptedText         =  openssl_decrypt($encryptedText,"AES-128-CBC", $secretKey, OPENSSL_RAW_DATA, $initVector);
        return $decryptedText;
    }
	//*********** Padding Function *********************

	 function pkcs5_pad ($plainText, $blockSize)
	{
	    $pad = $blockSize - (strlen($plainText) % $blockSize);
	    return $plainText . str_repeat(chr($pad), $pad);
	}

	//********** Hexadecimal to Binary function for php 4.0 version ********

	function hextobin($hexString) 
   	 { 
    	$length = strlen($hexString); 
    	$binString="";   
    	$count=0; 
    	while($count<$length) 
    	{       
    	    $subString =substr($hexString,$count,2);           
    	    $packedString = pack("H*",$subString); 
    	    if ($count==0)
	    {
			$binString=$packedString;
	    } 
    	    
	    else 
	    {
			$binString.=$packedString;
	    } 
    	    
	    $count+=2; 
    	} 
          return $binString; 
	  }
}
