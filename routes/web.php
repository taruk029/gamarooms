<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routesr
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index');
Route::get('/insert_json', 'IndexController@insert_json');
Route::get('/index_api', 'IndexController@index_api');
Route::get('/signup', 'HomeController@signup');
Route::get('/get_establishment', 'IndexController@get_establishment');
Route::post('/agent_signup', 'HomeController@agent_signup');
Route::get('/admin', 'AdminController@index');
Route::post('/adminlogin', 'AdminController@alogin');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('ccavResponseHandler', 'CCAvenueController@ccavResponseHandler');
Route::get('check_is_active', 'HomeController@check_is_active');
Route::get('aboutus', 'HomeController@aboutus');
Route::get('terms_conditions', 'HomeController@terms_conditions');
Route::get('forget_password', 'HomeController@forget_password');
Route::post('forget_password', 'HomeController@check_forget_password');
Route::get('reset_password/{id}/{token}', 'HomeController@reset_password');
Route::post('reset_password', 'HomeController@change_password');
Route::get('voucher/{id}', 'CCAvenueController@voucher');
Route::get('clear_cache', 'IndexController@clear_cache');
Auth::routes();

/*Route::get('/home', 'HomeController@index')->name('home');*/
Route::group([
    'middleware' => 'auth'
], function () {

Route::get('/', 'IndexController@index');
Route::get('index', 'HomeController@index');
Route::get('change_currency/{id}', 'IndexController@change_currency');
Route::get('search_hotel', 'IndexController@search_hotel');
Route::post('make_booking', 'IndexController@details');
Route::post('booking', 'IndexController@booking');
Route::get('cancel/{booking_id}', 'IndexController@cancel_booking');
Route::get('confirm_cancel/{booking_id}/{amount}/{currency}', 'IndexController@confirm_cancel');
Route::get('get_location', 'IndexController@get_location');


/*-----------------Bookings--------------*/
Route::get('booking_history', 'BookingController@index');
Route::get('my_profile', 'BookingController@profile');
Route::post('update_profile', 'BookingController@update_profile');


/*-----------------Payments--------------*/
Route::post('pay_details', 'CCAvenueController@pay_details');


});

Route::group(['prefix'=>'admin', 'middleware'=> ['auth' => 'checkroles']], function () {
/*------------------------- ADMIN --------------------------------*/
Route::get('/dashboard', 'DashboardController@index'); 

Route::match(array('GET', 'POST'),'/agents', 'AgentController@index');
Route::post('/approve_agent', 'AgentController@approve_agent');
Route::get('/reject_agent/{id}', 'AgentController@reject_agent');
Route::get('/agent_status/{id}/{satus}', 'AgentController@agent_status');
Route::post('/update_commission', 'AgentController@update_commission');


Route::match(array('GET', 'POST'), 'wallet', 'WalletController@index');
Route::post('/add_agent_wallet', 'WalletController@add_agent_wallet');
Route::get('/wallet/{id}', 'WalletController@wallet');

Route::match(array('GET', 'POST'), 'bookings', 'ReportController@index');
Route::get('/today', 'ReportController@today');
Route::get('/confirmed', 'ReportController@confirmed');
Route::match(array('GET', 'POST'), 'export_booking', 'ReportController@export_booking');
Route::get('admin_cancel_booking/{booking_id}', 'ReportController@admin_cancel_booking');
Route::get('admin_confirm_cancel/{booking_id}/{amount}/{currency}', 'ReportController@admin_confirm_cancel');

Route::get('/media', 'MediaController@index');
Route::post('/change_image', 'MediaController@change_image');

});