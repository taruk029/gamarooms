<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Country;
use App\Province;
use App\Location;
use DB;
use Cache;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $data = DB::table('locations')
        ->leftjoin('provinces', 'locations.province_id',  '=',  'provinces.id')
        ->leftjoin('countries', 'provinces.country_id',  '=',  'countries.id')
        ->select('locations.id as location_id', 'locations.name as name', 'provinces.name as province', 'provinces.provinceid as province_id', 'countries.name as country')
        ->get();
        Cache::put('locations', $data, 1440);
        $this->middleware('guest')->except('logout');
    }
}
