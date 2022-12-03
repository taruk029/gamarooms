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
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Artisan;
use Cache;
use App\Media;

class IndexController extends Controller
{
    public function __construct()
    { 
        $this->middleware('auth');
        $this->data = array();
        $this->yallago = "https://apici.yalago.com/hotels/";
        $this->api_key = "962e72eb-a711-4516-9f90-ec6e8c9815e7";
        $this->merchant_id  = "45990";
       /* $this->yallago = "https://api.yalago.com/hotels/";
        $this->api_key = "e3d64679-1b02-4468-b986-1bc7af033d80";*/
        $this->merchant_id  = "47273";
        if(!Cache::has('locations'))
        {
            $this->data = DB::table('locations')
            ->leftjoin('provinces', 'locations.province_id',  '=',  'provinces.id')
            ->leftjoin('countries', 'provinces.country_id',  '=',  'countries.id')
            ->select('locations.id as location_id', 'locations.name as name', 'provinces.name as province', 'provinces.provinceid as province_id', 'countries.name as country')
            ->get();
        }
        else
        {
            $this->data = Cache::get( 'locations' );
        }
    }
    
    public function index()
    {
        if(Auth::user()['is_active']==1)
        {
            $country = Country::get();
            return view('frontend.index', ['data'=>$this->data, 'country'=>$country]);
        }
        else
        {
            if(Auth::user()['is_active']==0)
            {
                flash('Admin has not yet approved you.')->success();
            }
            else
            {
                flash('Admin has rejected your request.')->success();
            }
        }
        return redirect('logout');  
    }

    public function check_email(Request $request)
    {
        $check = User::where("email", $request->email)->first();
        $res = 1;
        if($check)
        {
            $res = 0;
        }
        echo $res;
    }

    public function check_mobile(Request $request)
    {
        $check = User::where("mobile", $request->mobile)->first();
        $res = 1;
        if($check)
        {
            $res = 0;
        }
        echo $res;
    }

    public function terms_and_conditions()
    {
        return view('tandc');
    }
    
    public function forget_password()
    {
        return view('forget_password');
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
                    $message->to($email_data['to'], 'Password Reset Request')
                    ->subject("Password Reset Request");
                    $message->from('support@outplacementheros.org','Outplacement Heroes'); 
                });
            }
            return view('check_forget_password');
        }
        else
        {
            flash('The email you have entered does not exists.')->error();
            return redirect()->back();
        }
    }

/*    public function success_forget_password()
    {
        return view('check_forget_password');
    }*/

    public function reset_password($id, $token)
    {
        if($id && $token)
        {
            $user_id = base64_decode($id);
            $user = User::find($user_id);
            if($user)
            {
                return view('reset_password', ['id'=>$id, 'token'=>$token]);
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
                        $message->to($email_data['to'], 'Password Reset Success')
                        ->subject("Password Reset Success");
                        $message->from('support@outplacementheros.org','Outplacement Heroes'); 
                    });
                    return view('success_forget_password');
                }
                else
                {
                    flash('The reset password link has expired, please try again.')->error();
                    return redirect()->back();
                }
            }
        }
    }

    public function search_hotel(Request $request)
    {
        try
        {
            $room = filter_var($request->rooms, FILTER_SANITIZE_NUMBER_INT);
            $guest = filter_var($request->guest, FILTER_SANITIZE_NUMBER_INT);
            $kids = filter_var($request->kids, FILTER_SANITIZE_NUMBER_INT);
            $ids = explode(",",$request->search_by_name);
            $txt_search = $request->txt_search;
            $location_id = $ids[0];
            $province_id = $ids[1];
            $romms_array = '';
            $guests_per_room = round($guest/$room);
            if($guests_per_room == 0)
            {
                $guests_per_room = 1;
            }
            $kids_per_array = array();
            $kids_array = "";
            if(!empty($kids))
            {
                for($j=1; $j<=$kids; $j++)
                {
                    array_push($kids_per_array, 5);
                }
                $kids_array = implode(",",$kids_per_array);
                for($i=1; $i <= $room; $i++ )
                {
                    $romms_array .= '{ "Adults": "'.$guests_per_room.'", "ChildAges": ['.$kids_array.']  },';
                }
            }
            else
            {
                $romms_array .= '{ "Adults": "'.$guests_per_room.'"}';
            }
            
            
            $sess = array("province_id"=>$province_id, "location_id"=>$location_id, "room"=>$room, "guest"=>$guest, "kids"=>$kids, "start_date"=>$request->start_date,"end_date"=>$request->end_date);
            Session::put('criteria', $sess);
            $headers = [
                        "x-api-key"=>$this->api_key,
                        "Content-Type"=> "application/json",
                        "Accept"=> "application/json"
            ];
            
            $currency = "AED";
            if(Session::has('currency'))
            {
                $currency = Session::get('currency');
            }
            $client = new Client(['headers' => $headers]);  
            $source = DB::table('view_location')->select('countrycode')->where('province_id',$province_id)->first();
            $loc = Location::find($location_id);
            $body = '{
              "CheckInDate": "'.$request->start_date.'T00:00:00Z",
              "CheckOutDate": "'.$request->end_date.'T00:00:00Z",
              "ProvinceId": "'.$province_id.'",
              "LocationId": "'.$loc['locationid'].'",
              "Rooms": ['.$romms_array.'],
              "Culture": "en-gb",
              "GetpackagePrice": true,
              "SourceMarket": "'.$request->source_market.'",
              "GetTaxBreakDown": true,
              "GetLocalCharges": true,
              "GetBoardBasis": true,
              "CurrencyCode": "'.$currency.'"
              }';
            /*echo "<pre>";
            print_r($body);die;*/
            $searchLog = 'logs/api.log';
            $search_Log = new Logger($searchLog);
            $search_Log->pushHandler(new StreamHandler(storage_path($searchLog)), Logger::INFO);
            $search_Log->info("request-".$this->yallago.'availability/get'.$body);
            
            $response = $client->request('POST', $this->yallago.'availability/get', ['body' => $body]);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            $data = json_decode($body);
            /*echo "<pre>";
            print_r($data);die;*/
            $search_Log->pushHandler(new StreamHandler(storage_path('logs/api.log')), Logger::INFO);
            $search_Log->info("response-".$this->yallago.'availability/get'.serialize($data));
            if (property_exists($data, "Establishments"))
            {
                if(!empty($data->Establishments))
                {
                    $commission = Agent::select('commission')->where('user_id', Auth::user()['id'])->first();
                    $province = Province::select('provinceid', 'name', 'country_id')->where('provinceid', $province_id)->first();
                    $country = Country::select('name')->where('id', $province['country_id'])->first();
                    /*echo "<pre>";
                    print_r($data);
                    die;*/
                    $count_hotels = count($data->Establishments);
                   /* $locations = DB::table('locations')
                    ->leftjoin('provinces', 'locations.province_id',  '=',  'provinces.id')
                    ->leftjoin('countries', 'provinces.country_id',  '=',  'countries.id')
                    ->select('locations.id as location_id', 'locations.name as name', 'provinces.name as province', 'provinces.provinceid as province_id', 'countries.name as country')
                    ->get();*/
                    $country_all = Country::get();
                    $medias = DB::table('medias')->get();

                    return view('frontend.search_hotels', ['locations'=>$this->data, 'data'=>$data->Establishments, 'province'=>$province, 'country'=>$country, 'count_hotels'=>$count_hotels, 'location_id'=>$location_id, 'guest'=>$guest, 'start_date'=>$request->start_date, 'end_date'=>$request->end_date, 'room'=>$room, 'kids'=>$kids, 'commission'=>$commission, 'source_market'=>$request->source_market, 'country_all'=>$country_all, 'txt_search'=>$txt_search, 'search_by_name'=>$request->search_by_name, 'medias'=>$medias]);
                }
                else
                {
                    if(isset($data->Messages[0]))
                        $message = $data->Messages[0];
                    else
                        $message = "No hotel found with the searched criteria.";
                    return view('frontend.error.error', ['message'=>$message]);
                }
            }
            else
            {
                echo "Key does not exist!";
            }
        } 
        catch (\GuzzleHttp\Exception\RequestException $e) {
        if ($e->hasResponse()) {
            $response = $e->getResponse();
            $searchLog = 'logs/api.log';
            $search_Log = new Logger($searchLog);
            $search_Log->pushHandler(new StreamHandler(storage_path($searchLog)), Logger::INFO);
            $search_Log->info("error-".$this->yallago.'availability/get'.serialize($response));
            
            return view('frontend.error.error', ['response'=>$response]);
            //print_r($response->getStatusCode()); // HTTP status code;
            //print_r($response->getReasonPhrase()); // Response message;
            //print_r((string) $response->getBody()); // Body, normally it is JSON;
            //print_r(json_decode((string) $response->getBody())); // Body as the decoded JSON;
        }
        }
    }
    
    public function get_establishment(Request $request)
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
            "EstablishmentId": '.$request->establishmentid.',
            "Languages": ["en"]
            }';
            $response = $client->request('POST', $this->yallago.'Inventory/GetEstablishment', ['body' => $body]);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            $data = json_decode($body);
            /*echo "<pre>";
                  print_r($data);
                  die;*/
            $searchLog = 'logs/api.log';
            $search_Log = new Logger($searchLog);
            $search_Log->pushHandler(new StreamHandler(storage_path($searchLog)), Logger::INFO);
            $search_Log->info("request-".$this->yallago.'Inventory/GetEstablishment'.$body);
            
            $search_Log->pushHandler(new StreamHandler(storage_path($searchLog)), Logger::INFO);
                $search_Log->info("response-".$this->yallago.'Inventory/GetEstablishment'.serialize($data));
            if (property_exists($data, "Establishment"))
            {
                return response()->json(['error'=>false,
                'Address' =>$data->Establishment->Address,
                'PhoneNumber' =>$data->Establishment->PhoneNumber,
                'FaxNumber' =>$data->Establishment->FaxNumber,
                'Email' =>$data->Establishment->Email,
                'Longitude' =>$data->Establishment->Longitude,
                'Latitude' =>$data->Establishment->Latitude,
                'Summary' =>$data->Establishment->Summary->en,
                'Images' =>$data->Establishment->Images
                ]);
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
    
    public function change_currency($val)
    {
        if($val)
        {
            if($val==1)
                $value = "AED";
            else
                $value = "USD";
            Session::put('currency', $value);
            return redirect()->back();
        }
    }
    
    public function details(Request $request)
    {
        try
        {
            if(!empty($request->establishment_id) && !empty($request->num_rooms))
            {
                if(Session::has('currency'))
                {
                    $currency = Session::get('currency');
                }
                else
                {
                    $currency = "AED";
                }
                $rooms_array ="";
                $j=1;
                $guests = array();
                $kids_count = array();
                $total_amount = 0;
                $booking_amount = 0;
                
                for($i = 0; $i <= $request->num_rooms-1; $i++)
                {
                    $count = 0;
                    $rooms_array .= '{ "Guests": [';
                    $guests_first_name = "guests_first_name".$j;
                    $guests_last_name = "guests_last_name".$j;
                    $guests_age = "guests_age".$j;
                    $guests_salutation = "guests_salutation".$j;
                    $kids_per_array = array();
                    $kids_array = '';
                    $rooms = "";
                    for($k=0; $k <= count($request->$guests_first_name); $k++)
                    {
                        if(isset($request->$guests_salutation[$k]) && isset($request->$guests_first_name[$k]) && isset($request->$guests_last_name[$k]) && isset($request->$guests_age[$k]))
                        {   
                            if($request->$guests_age[$k] <=12)
                            {
                                array_push($kids_per_array, $request->$guests_age[$k]);
                                array_push($kids_count, $request->$guests_age[$k]);
                            }
                            else
                            {
                                array_push($guests, $request->$guests_salutation[$k].". ".$request->$guests_first_name[$k]." ".$request->$guests_last_name[$k] );
                                $rooms .= '{ "Title": "'.$request->$guests_salutation[$k].'", "FirstName": "'.$request->$guests_first_name[$k].'", "LastName": "'.$request->$guests_last_name[$k].'", "Age": "'.$request->$guests_age[$k].'"},'; 
                                $count++;
                            }
                        } 
                    }
                    
                    $rooms_array .= rtrim($rooms, ',');
                    $rooms_array .= "],";
                    $kids_array = implode(",",$kids_per_array);
                    if(count($request->room_code) >= $request->num_rooms)
                    {
                        $rooms_array .= '"RoomCode": "'.$request->room_code[$i]. '",';
                        $rooms_array .= '"BoardCode": "'.$request->board_code[$i]. '",';
                        $rooms_array .= '"ExpectedNetCost": { "Amount": '.base64_decode($request->amount[$i]).', "Currency": "'.$currency.'" },';
                        $total_amount = $total_amount+base64_decode($request->commission_amount[$i]);
                        $booking_amount = $booking_amount+base64_decode($request->amount[$i]);
                    }
                    else
                    {
                       for($l=0; $l <= count($request->room_code)-1; $l++)
                        {
                            $rooms_array .= '"RoomCode": "'.$request->room_code[$l]. '",';
                            $rooms_array .= '"BoardCode": "'.$request->board_code[$l]. '",';
                            $rooms_array .= '"ExpectedNetCost": { "Amount": '.base64_decode($request->amount[$l]).', "Currency": "'.$currency.'" },';
                            $total_amount = $total_amount+base64_decode($request->commission_amount[$l]);
                            $booking_amount = $booking_amount+base64_decode($request->amount[$l]);
                            break;
                        } 
                    }
                    $rooms_array .= '"AffiliateRoomRef": "Room'.$i. '",';
                    $rooms_array .= '"Adults": '.$count.', "ChildAges": ['.$kids_array.'] },';
                    $j++;
                }
            }
            Session::put('room_book', $rooms_array);
            Session::put('start_booking_date', $request->start_booking_date);
            Session::put('end_booking_date', $request->end_booking_date);
            Session::put('establishment_id', $request->establishment_id);
            Session::put('source_market_book', $request->source_market_book);
            Session::put('total_amount', $total_amount);
            Session::put('booking_amount', $booking_amount);
            
            if(!empty($request->establishment_id) && !empty($request->num_rooms))
            {
                if(Session::has('currency'))
                {
                    $currency = Session::get('currency');
                }
                else
                {
                    $currency = "AED";
                }
                $rooms_array_details ="";
                $j=1;
                
                for($i = 0; $i <= $request->num_rooms-1; $i++)
                {   
                    $count = 0;
                    $rooms_array_details .= '{';
                    $guests_first_name = "guests_first_name".$j;
                    $guests_last_name = "guests_last_name".$j;
                    $guests_age = "guests_age".$j;
                    $guests_salutation = "guests_salutation".$j;
                    $kids_per_array_details = array();
                    $kids_array_details = '';
                    $rooms_details = "";
                    for($k=0; $k <= count($request->$guests_first_name); $k++)
                    {
                        if(isset($request->$guests_salutation[$k]) && isset($request->$guests_first_name[$k]) && isset($request->$guests_last_name[$k]) && isset($request->$guests_age[$k]))
                        {   
                            if($request->$guests_age[$k] <=12)
                            {
                                array_push($kids_per_array_details, $request->$guests_age[$k]);
                            }
                            else
                            {
                                $count++;
                            }
                        } 
                    }
                    
                    $kids_array_details = implode(",",$kids_per_array_details);
                    $rooms_array_details .= '"Adults": '.$count.', "ChildAges": ['.$kids_array_details.'],';
                    $rooms_array_details .= rtrim($rooms_details, ',');
                   
                    if(count($request->room_code) >= $request->num_rooms)
                    {
                        $rooms_array_details .= '"RoomCode": "'.$request->room_code[$i]. '",';
                        $rooms_array_details .= '"BoardCode": "'.$request->board_code[$i]. '",';
                    }
                    else
                    {
                       for($l=0; $l <= count($request->room_code)-1; $l++)
                        {
                            $rooms_array_details .= '"RoomCode": "'.$request->room_code[$l]. '",';
                            $rooms_array_details .= '"BoardCode": "'.$request->board_code[$l]. '"';
                            break;
                        } 
                    }
                    $rooms_array_details .= "},";
                    $j++;
                }
            }
            /*echo "<pre>";
            print_r($rooms_array_details);
            die;*/
            $headers = [
                        "x-api-key"=>$this->api_key,
                        "Content-Type"=> "application/json",
                        "Accept"=> "application/json"
            ];
            $client = new Client(['headers' => $headers]); 
            
            $aff_name = explode(" ", Auth::user()['name']);
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
              "CheckInDate": "'.$request->start_booking_date.'",
              "CheckOutDate": "'.$request->end_booking_date.'",
              "EstablishmentId": "'.$request->establishment_id.'",
              "Rooms": ['.$rooms_array_details.'],
              "Culture": "en-gb",
              "GetpackagePrice": true,
              "SourceMarket": "'.$request->source_market_book.'",
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
            $search_Log->info("request-".$this->yallago.'details/get'.$body);
            
            $response_body = "";
            $data = "";
            $response = $client->request('POST', $this->yallago.'details/get', ['body' => $body]);
            $statusCode = $response->getStatusCode();
            $response_body = $response->getBody()->getContents();
            $data = json_decode($response_body);
	        $access_code='AVMS03IC73BL44SMLB';//Shared by CCAVENUES
	        
           /* echo "<pre>";
            print_r($data);die;
            */
            $search_Log->pushHandler(new StreamHandler(storage_path($searchLog)), Logger::INFO);
            $search_Log->info("response-".$this->yallago.'details/get'.serialize($data));

            if (property_exists($data, "Establishment"))
            {
                $agent_details = Agent::leftjoin('countries', 'countries.id', '=', 'agents.country')
                    ->select('agents.city','countries.name')
                    ->where('user_id', Auth::user()['id'])
                    ->first();
                    
                $start_booking = date_create($request->start_booking_date);
                $end_booking = date_create($request->end_booking_date);
                  
                $reference_id = "GR".date('ymdhis');
                $booking = new Booking;
                $booking->user_id = Auth::user()['id'];
                $booking->province_id = $request->province_id;
                $booking->reference_id = $reference_id;
                $booking->hotel = $request->establishment_name;
                $booking->booking_amount = $booking_amount;
                $booking->commission = $total_amount - $booking_amount;
                $booking->currency = $currency;
                $booking->check_in = date_format($start_booking,'Y-m-d');
                $booking->check_out = date_format($end_booking,'Y-m-d');
                $booking->save();
                $booking_id = $booking->id;
                
               return view('frontend.confirm_booking', ['data'=>$data, 'guests'=>$guests,
               'kids_count'=>$kids_count, 
               'start_booking_date'=>$request->start_booking_date, 
               'end_booking_date'=>$request->end_booking_date, 
               'count_rooms'=>$request->num_rooms, 
               'total_amount'=>$total_amount,
               'booking_amount'=>$booking_amount,
               'source_market'=>$request->source_market_book,
               'establishment_id'=>$request->establishment_id,
               'guests'=>$guests,
               'agent_details'=>$agent_details,
               'merchant_id'=>$this->merchant_id,
               'product_id'=>$reference_id,
               'booking_id'=>$booking_id,
               'reference_id'=>$reference_id,
               'province_id'=>$request->province_id]);     
            }
            else
            {
                echo "Key does not exist!";
            }
        } 
        catch (\GuzzleHttp\Exception\RequestException $e) {
        if ($e->hasResponse()) {
            $response = $e->getResponse();
            return view('frontend.error.error', ['response'=>$response]);
        }
        }
    }
    
    public function booking(Request $request)
    {
        /*try
        {*/
            if(!empty($request->establishment_id))
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
                
                $guests = json_decode( $request->guests);
                $kids_count = $request->kids_count;
                $total_amount = $request->total_amount;
                $booking_amount = $request->booking_amount;
            }
            
            $headers = [
                        "x-api-key"=>$this->api_key,
                        "Content-Type"=> "application/json",
                        "Accept"=> "application/json"
            ];
    
            $client = new Client(['headers' => $headers]); 
            
            $aff_name = explode(" ", Auth::user()['name']);
            $first_name = "";
            $last_name = "";
            if(count($aff_name))
            {
                $first_name = $aff_name[0];
                $last_name = $aff_name[1];
            }
            $body = "";
            $affiliateref = date('ymdhis');
            $source = DB::table('view_location')->select('countrycode')->where('province_id',$request->province_id)->first();
            $body = '{
              "CheckInDate": "'.$request->start_booking_date.'",
              "CheckOutDate": "'.$request->end_booking_date.'",
              "EstablishmentId": "'.$request->establishment_id.'",
              "Rooms": ['.$rooms_array.'],
              "Culture": "en-gb",
              "AffiliateRef": "'.$affiliateref.'",
              "ContactDetails": {"Title": "Mr","FirstName": "'.$first_name.'", "LastName": "'.$last_name.'"},
              "GetpackagePrice": true,
              "SourceMarket": "'.$request->source_market.'",
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
	        $access_code='AVMS03IC73BL44SMLB';//Shared by CCAVENUES
	        
            /*echo "<pre>";
            print_r($data);die;*/
            
            $search_Log->pushHandler(new StreamHandler(storage_path($searchLog)), Logger::INFO);
            $search_Log->info("response-".$this->yallago.'bookings/create'.serialize($data));
            if (property_exists($data, "BookingRef"))
            {
                if(!empty($data->BookingRef))
                {
                    $reference_id = "GR".date('ymdhis');
                    $booking = new Booking;
                    $booking->user_id = Auth::user()['id'];
                    $booking->province_id = $request->province_id;
                    $booking->reference_id = $reference_id;
                    $booking->booking_ref = $data->BookingRef;
                    $booking->booking_amount = $booking_amount;
                    $booking->commission = $total_amount - $booking_amount;
                    $booking->currency = $currency;
                    $booking->request_call = serialize($body);
                    $booking->response = serialize($data);
                    $booking->save();
                    $booking_id = $booking->id;
                    
                    $agent_details = Agent::leftjoin('countries', 'countries.id', '=', 'agents.country')
                    ->select('agents.city','countries.name')
                    ->where('user_id', Auth::user()['id'])
                    ->first();
                    return view('frontend.pay_details', ['data'=>$data, 'booking_id'=>$booking_id, 'reference_id'=>$reference_id, 'guests'=>$guests, 'agent_details'=>$agent_details, 'kids_count'=>$kids_count, 'start_booking_date'=>$request->start_booking_date, 'end_booking_date'=>$request->end_booking_date, 'count_rooms'=>$request->num_rooms, 'total_amount'=>$total_amount,'access_code'=>$access_code,'product_id'=>$reference_id, 'merchant_id'=>$this->merchant_id]);
                }
                else
                {
                    $message = $data->ErrorMessage;
                    return view('frontend.error.error', ['message'=>$message]);
                }
            }
            else
            {
                echo "Key does not exist!";
            }
        /*} 
        catch (\GuzzleHttp\Exception\RequestException $e) {
        if ($e->hasResponse()) {
            $response = $e->getResponse();
            return view('frontend.error.error', ['response'=>$response]);
        }
        }*/
    }
    
    public function cancel_booking($booking_id)
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
                return view('frontend.cancel_booking', ['data'=>$data, 'booking'=>$booking, 'booking_id'=>$booking_id]);
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
    
    public function confirm_cancel($booking_id, $amount, $currency)
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
                    return view('frontend.cancel_success', ['data'=>$data, 'booking'=>$booking, 'booking_id'=>$booking_id]);
                }
                else
                {
                    echo "<script>alert('Booking is not cancelled, please try again.');</script>";
                    return redirect('booking_history');
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
    
    public function clear_cache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('optimize:clear');
        return redirect()->back();
    }

    public function get_location(Request $request)
    {
        set_time_limit(300);
        $data = DB::table('locations')
        ->leftjoin('provinces', 'locations.province_id',  '=',  'provinces.id')
        ->leftjoin('countries', 'provinces.country_id',  '=',  'countries.id')
        ->select('locations.id as location_id', 'locations.name as name', 'provinces.name as province', 'provinces.provinceid as province_id', 'countries.name as country')
        ->where('locations.name', 'LIKE', '%'.$request->search.'%')
        ->orWhere('provinces.name', 'LIKE', '%'.$request->search.'%')
        ->orWhere('countries.name', 'LIKE', '%'.$request->search.'%')
        ->get();
        
        $datas = array();
        for($i=0;$i<count($data);$i++){
           $datas[] = array('location_id'=>$data[$i]->location_id,
            'province_id'=>$data[$i]->province_id,
            'name'=>$data[$i]->name,
            'province'=>$data[$i]->province,
            'country'=>$data[$i]->country
        );
        }
        $output  = $datas;
        echo json_encode($output);
    }
    
}
