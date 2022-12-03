<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Wallet;
use App\Agent;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index()
    {
        $data = DB::table('wallets')
        ->leftjoin("users", "users.id", "=", "wallets.user_id")
        ->select("wallets.*", "users.name")
        ->get();
        return view('backend.wallet.index', ['data'=>$data]);
    }
    
    public function add_agent_wallet(Request $request)
    {
        $user = Agent::select('wallet_amount')->where('user_id', $request->user_wallet_id)->first();
        if($user)
        {   $final_amount = 0;
            if($request->transfer_type==1)
            {
                $final_amount = $user->wallet_amount+$request->amount;
            }
            else
            {
                $final_amount = $user->wallet_amount-$request->amount;
            }
            DB::table('agents')
            ->where('user_id', $request->user_wallet_id) 
            ->limit(1)
            ->update(array('wallet_amount' => $final_amount));
            
            $wallet = new Wallet;
            $wallet->user_id = $request->user_wallet_id;
            $wallet->transfer_type = $request->transfer_type;
            $wallet->amount = $request->amount;
            $wallet->transaction_id = date('ymdhis');
            $wallet->save();
            flash('Wallet amount has been added.')->success();
            return redirect()->back();
        }
    }
    
    public function wallet($id)
    {
        $data = DB::table('wallets')
        ->leftjoin("users", "users.id", "=", "wallets.user_id")
        ->select("wallets.*", "users.name")
        ->where('wallets.user_id', $id)
        ->get();
        return view('backend.wallet.wallet', ['data'=>$data]);
    }
}
