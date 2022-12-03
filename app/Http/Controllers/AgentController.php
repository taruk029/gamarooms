<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\Agent;
use App\Educational_detail;
use App\Job_link;
use App\City;
use App\Agent_commission_log;
use DB;
use Auth;
use Mail;
use Log;

class AgentController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

   	public function index(Request $request)
    {
        $agents = User::leftjoin('agents', 'agents.user_id', '=', 'users.id')
        ->leftjoin('countries', 'countries.id', '=', 'agents.country')
        ->where('users.role', 2)
        ->select('users.*', 'agents.agency_name', 'agents.agency_email', 'agents.commission', DB::raw('(CASE WHEN iata_status = 0 THEN "No" ELSE agents.iata_no END) AS iata_status'), 'countries.name as country', 'agents.city')
        ->orderBy("users.id", "desc")
        ->get();
        return view('backend.agent.index', ['agents'=>$agents]);
    }

    public function approve_agent(Request $request)
    {
        try 
        {
            DB::table('agents')
            ->where('user_id', $request->userid) 
            ->limit(1)
            ->update(array('commission' => $request->commission));
            
            DB::table('users')
            ->where('id', $request->userid) 
            ->limit(1)
            ->update(array('is_active' => 1));
            
            flash('Agent has been approved successfully.')->success();
            return redirect('admin/agents');
        } 
        catch (Exception $e) 
        {
            Log::channel('customlog')->info(date("Y-m-d")."-".$e->getMessage());
            return redirect('admin/agents');
        }
    } 
    
    public function reject_agent($id)
    {
        try 
        {
            DB::table('users')
            ->where('id', $id) 
            ->limit(1)
            ->update(array('is_active' => 2));
            
            flash('Agent has been rejected.')->error();
            return redirect('admin/agents');
        } 
        catch (Exception $e) 
        {
            Log::channel('customlog')->info(date("Y-m-d")."-".$e->getMessage());
            return redirect('admin/agents');
        }
    }
    
    public function agent_status($id, $status)
    {
        $user = User::find($id);
        if($user->is_active==2 && $status==1)
            $user->is_active = $status;
        else
            $user->is_active = $status;
        $user->save();

        if($status==0)
            flash('Agent has been deactivated successfully.')->success();
        else
            flash('Agent has been activated successfully.')->success();
            
        return redirect('admin/agents'); 
    }
    
    public function update_commission(Request $request)
    {
        try 
        {
            $user = Agent::where('user_id', $request->userid_commission)->first();
            if($user)
            {
                $log = new Agent_commission_log;
                $log->agent_id = $request->userid_commission;
                $log->commission = $user['commission'];
                $log->save();
                
                DB::table('agents')
                ->where('user_id', $request->userid_commission) 
                ->limit(1)
                ->update(array('commission' => $request->new_commission));
            }
            else
            {
                $js = new Agent;
                $js->user_id = $request->userid_commission;
                $js->commission = $request->new_commission;                                                                             
                $js->save();
            }
            flash("Agent's commission has been updated.")->success();
            return redirect('admin/agents');
        } 
        catch (Exception $e) 
        {
            Log::channel('customlog')->info(date("Y-m-d")."-".$e->getMessage());
            return redirect('admin/agents');
        }
    } 
}
