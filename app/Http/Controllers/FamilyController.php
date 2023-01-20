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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Alert;
use Auth;
use Carbon\Carbon;

class FamilyController extends Controller
{ 
    

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $causes = Cause::all();
        $relations = Relation::all();
        $users = User::all();
        // $userid = Auth::user()->userid;
        $search = $request->get('search');
        if ($search!=""){
        // $clients = Leads::whereHas('meetings', function ($query) use ($search) {
        // $query->whereLike('fname', $search);
        // $query->orwhereLike('sname', $search);
        // $query->orwhereLike('cellno', $search);
           
        // })
        $fams = Family::whereLike('fam_name', $search)->orwhereLike('fam_head', $search)->orwhereLike('head_no', $search)
        // ->join('loginusers','loginusers.userid', '=','tbllead.userid')
        // ->withCount(['meetings'])
        // ->with(['leadsource','projection'])
        ->orderBy('updated_at' ,'desc')
        ->get()->where('deleteflag','=' ,'0');
        return view('family.index',compact('fams'));
    }

        else{
            $fams = Family::select('*')
            // ->with(['meetings'])
            // ->withCount(['meetings'])->limit(20)
            // ->with(['leadsource','projection'])
            // ->join('loginusers','loginusers.userid', '=','tbllead.userid')
            ->orderBy('updated_at','desc')
            ->get()->where('deleteflag','=' ,'0');
            return view('family.index',compact('fams'));
        }
    }


    public function add_family(Request $request){
        $validator = Validator::make($request->all(), [
            'fam_name'=>'required',
            // 'lname'=>'required',
            // 'phone1'=>'required',
            // 'emailwork'=>'required|email|unique:tbllead',
        ]);
        
    if ($validator->fails()) {
    Alert::error('Failed', 'Ensure entries are correct');
    // return View('dashboard.clients.index', ["modal"=>"AddClientModal"]);
     return redirect()->back();
        }
        else{
            $random = mt_rand(1000, 9999);
            $hash = uniqid();
    // $first=trim(strtoupper(Auth::user()->firstname));
    // $second=trim(strtoupper(Auth::user()->lastname));
    // $name = substr($first, 0, 1).substr($second, 0, 1);

            $client = Family::create([
            'fam_name'=>$request->fam_name,
            'fam_head'=> $request->fam_head,
            'head_no1' => $request->phone1,
            'head_no2' => $request->phone2,
            'deleteflag' => 0,
            'hash' => $hash,
            ]);

            Alert::success('Success', 'Family added to the database');
            return redirect()->back();
        }
    }


    public function edit_family(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'fam_name'=>'required',
            // 'lname'=>'required',
            // 'phone1'=>'required',
            // 'emailwork'=>'required|email|unique:tbllead',
        ]);
        
    if ($validator->fails()) {
    Alert::error('Failed', 'Ensure entries are correct');
    // return View('dashboard.clients.index', ["modal"=>"AddClientModal"]);
     return redirect()->back();
        }
        else{
            $random = mt_rand(1000, 9999);
            $hash = uniqid();
    // $first=trim(strtoupper(Auth::user()->firstname));
    // $second=trim(strtoupper(Auth::user()->lastname));
    // $name = substr($first, 0, 1).substr($second, 0, 1);
            $fam = Family::find($id);
            $fam->update([
            'fam_name'=>$request->fam_name,
            'fam_head'=> $request->fam_head,
            'head_no1' => $request->phone1,
            'head_no2' => $request->phone2,
            ]);

            Alert::success('Success', 'Family details updated successfully');
            return redirect()->back();
        }
    }




    public function get_death(Request $request)
    {
        $causes = Cause::all();
        $relations = Relation::all();
        $users = User::all();
        $fams = Family::all();
        // $userid = Auth::user()->userid;
        $search = $request->get('search');
        if ($search!=""){
        // $clients = Leads::whereHas('meetings', function ($query) use ($search) {
        // $query->whereLike('fname', $search);
        // $query->orwhereLike('sname', $search);
        // $query->orwhereLike('cellno', $search);
           
        // })
        $deaths = Death::whereLike('d_name', $search)->orwhereLike('d_family', $search)->orwhereLike('d_date', $search)
       
        ->with(['cause','family','fundetail'])
        ->orderBy('updated_at' ,'desc')
        ->get()->where('deleteflag','=' ,'0');
        return view('family.dead',compact('deaths','causes','fams','relations'));
    }

        else{
            $deaths = Death::select('*') ->with(['cause','family','fundetail'])
            ->orderBy('updated_at','desc')
            ->get()->where('deleteflag','=' ,'0');
            // dd( $deaths);
            return view('family.dead',compact('deaths','causes','fams','relations'));
        }
    }


    public function add_death(Request $request){
        $validator = Validator::make($request->all(), [
            'd_name'=>'required',
        ]);
        
    if ($validator->fails()) {
    Alert::error('Failed', 'Ensure entries are correct');
     return redirect()->back();
        }
        else{
            $random = mt_rand(1000, 9999);
            $hash = uniqid();
   
            $client = Death::create([
            'd_name'=>$request->d_name,
            'd_place'=> $request->d_place,
            'd_date' => $request->d_date,
            'd_cause' => $request->d_cause,
            'd_family' => $request->d_family,
            'deleteflag' => 0,
            'hash' => $hash,
            ]);

            Alert::success('Success', 'Death details added to the database');
            return redirect()->back();
        }
    }


    public function edit_death(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'd_name'=>'required',
        ]);
        
    if ($validator->fails()) {
    Alert::error('Failed', 'Ensure entries are correct');
     return redirect()->back();
        }
        else{
            $random = mt_rand(1000, 9999);
            $hash = uniqid();
            $client = Death::find($id);
            $client->update([
            'd_name'=>$request->d_name,
            'd_place'=> $request->d_place,
            'd_date' => $request->d_date,
            'd_cause' => $request->d_cause,
            'd_family' => $request->d_family,
            ]);

            Alert::success('Success', 'Death details updated');
            return redirect()->back();
        }
    }


// Setup funerals


public function get_funeral(Request $request)
{
    $causes = Cause::all();
    $relations = Relation::all();
    $users = User::all();
    $fams = Family::all();
    $deaths = Death::all();
    // $userid = Auth::user()->userid;
    $search = $request->get('search');
    if ($search!=""){
    $funs = Funeral::whereLike('d_name', $search)->orwhereLike('d_family', $search)->orwhereLike('d_date', $search)
    ->with(['dead','detail','funDeath'])
    ->withCount('detail')
    ->orderBy('updated_at' ,'desc')
    ->get()->where('deleteflag','=' ,'0');
    return view('family.funeral',compact('deaths','causes','fams','relations','funs'));
}
    else{
        $funs = Funeral::select('*')->with(['dead','detail','funDeath'])
        ->withCount('detail')
        ->orderBy('updated_at','desc')
        ->get()->where('deleteflag','=' ,'0');
        return view('family.funeral',compact('deaths','causes','fams','relations','funs'));
    }
}


public function add_funeral(Request $request){

    $validator = Validator::make($request->all(), [
    'd_name'=>'required',
    ]);
    
if ($validator->fails()) {
Alert::error('Failed', 'Ensure deceased name selected...');
 return redirect()->back();
    }
    else{
        $random = mt_rand(1000, 9999);
        $hash = uniqid();

$deceased = $request->d_name;
// test if dead funeral set already
if($deceased!= Null)
{
foreach($deceased as $deceased_id)
{
$find_d = Death::find($deceased_id);
$count = FuneralDetail::select("did")->where('did','=',$deceased_id)->count();

if($count>0)
{
    Alert::error('Failed', $find_d->d_name.' : funeral already set');
    return redirect()->back();
}
    
}
}
// end of test dead funeral set already




        $client = Funeral::create([
        // 'did'=>$request->d_name,
        'funeral_name'=> $request->funeral_name,
        'funeral_date' => $request->funeral_date,
        'town' => $request->town,
        'venue' => $request->venue,
        'contact_name' => $request->contact_name,
        'contact_phone' => $request->contact_phone,
        'deleteflag' => 0,
        'hash' => $hash,
        'funeral_code' => $random,
        'remarks' => $request->remarks,
        ]);
        
        $lastid = $client->fid;
       
        foreach($deceased as $dec)
        {
            $client = FuneralDetail::create([
                'fid'=>  $lastid,
                'did' => $dec,
                'funeral_date' => $request->funeral_date,
                ]);

        }

        Alert::success('Success', 'Funeral added to the database');
        return redirect()->back();
    }
}




public function edit_funeral(Request $request,$id){
    $validator = Validator::make($request->all(), [
        'funeral_date'=>'required',
    ]);
    
if ($validator->fails()) {
Alert::error('Failed', 'Ensure funeral date is selected');
 return redirect()->back();
    }
    else{

 // test if dead funeral set already
        $deceased = $request->d_name;
        if($deceased!= Null)
        {
        foreach($deceased as $deceased_id)
        {
        $find_d = Death::find($deceased_id);
        $count = FuneralDetail::select("did")->where('did','=',$deceased_id)->count();
        
        if($count>0)
        {
            Alert::error('Failed', $find_d->d_name.' : funeral already set');
            return redirect()->back();
        }
            
        }
    }
        // end of test dead funeral set already

    
        $client = Funeral::find($id);
        $client->update([
        // 'did'=>$request->d_name,
        'funeral_name'=> '',
        'funeral_date' => $request->funeral_date,
        'town' => $request->town,
        'venue' => $request->venue,
        'contact_name' => $request->contact_name,
        'contact_phone' => $request->contact_phone,
        // 'deleteflag' => 0,
        // 'hash' => $hash,
        // 'funeral_code' => $random,
        'remarks' => $request->remarks,
        ]);

        // $deceased = $request->d_name;
       
        if($deceased!= Null)
        {
        $funeral_name = implode(',', $deceased );
        foreach($deceased as $dec)
        {
        $client = FuneralDetail::create([
        'fid'=>  $id,
        'did' => $dec,
        'funeral_date' => $request->funeral_date,
        ]);
        }
    }
        Alert::success('Success', 'Funeral details updated successfully');
        return redirect()->back();
    }
}

public function del_deceased(Request $request,$id){
        $client = FuneralDetail::find($id);
        $client->update([
        'deleteflag' => 1,
        ]);

        Alert::success('Success', 'Deceased dropped successfully');
        return redirect()->back();
}


}
