<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\Cause;
use App\Models\Relation;
use App\Models\User;
use App\Models\Death;
use App\Models\Funeral;
use App\Models\FuneralDetail;
use App\Models\Nsawa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function get_dashboard(Request $request)
    {
        $uid = Auth::user()->userid;
        $sdate = Carbon::now();
        // $date7 = Carbon::now()->subDays(30);
        $edate = Carbon::now()->addDays(30);

        $causes = Cause::all();
        $relations = Relation::all();
        $users = User::all();
        $family_count = Family::where('deleteflag', 0)->count('fid');
        $death_count = Death::where('deleteflag', 0)->count('did');
        $funeral_count = Funeral::where('deleteflag', 0)->count('fid');
        $donation_sum = Nsawa::where('deleteflag', 0)->sum('amt');

        $fun_renewals = Funeral::select('*')->with(['dead','detail'])
        ->whereBetween('funeral_date', [$sdate,$edate])
        ->withCount('detail')
        ->orderBy('updated_at','desc')
        ->get()->where('deleteflag','=' ,'0');


        // $sum_nsawa = Nsawa::select('users.id', 'users.name', 'users.password', 'analytics.date', 'analytics.clicks', 'SUM(analytics.revenue) as revenue')
        // ->leftJoin('analytics', 'users.id', '=', 'analytics.user_id')
        // ->where('analytics.date', Carbon::today()->toDateString())
        // ->groupBy('users.id', 'users.name', 'users.password', 'analytics.date', 'analytics.clicks') 
        // ->get();



        // $clients = Leads::where('deleteflag', 0)->where('userid', $uid)->count('leadid');
        // $policy = Projection::where('deleteflag', 0)->where('userid', $uid)->count('policyid');
       
        return view('dashboard.index',compact('family_count','death_count','funeral_count','fun_renewals','donation_sum'));
    }
}
