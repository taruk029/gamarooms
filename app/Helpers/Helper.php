<?php

namespace App\Helpers;

use App\Agent;

class Helper {

    public static function get_wallet_amount($id) 
    {
      $amount = Agent::select('wallet_amount')->where('user_id', $id)->first();
      if($amount)
        return $amount->wallet_amount;
      else
        return "0.00";
    }

    public static function get_seen_count($id) 
    {
      $count = Job_link::where('send_to', $id)->where('is_opened', 1)->count();
      return $count;
    }
}
