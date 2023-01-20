<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Nsawa;
use App\Models\Beneficiary;
use App\Models\FuneralDetail;
use App\Models\Funeral;
use App\Models\Currency;
use App\Models\Family;
use App\Models\Cause;
use App\Models\Relation;
use App\Models\User;
use App\Models\Death;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Exports\ExportPaymentDetails;

class ReportController extends Controller
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
    
    
    public function get_paymt_detail(Request $request)
    {
        $payments = Nsawa::select('*')->with(['funeral','beneficiary','dead'])
        // ->where('capture_id','=',Auth::user()->userid)
        ->orderBy('pkid','desc')->get();
        // dd($payments);
        return view('reports.details',compact('payments'));
    }


    public function donation_bydeceased(Request $request)

    {
        
        $did = $request->d_name;

        if($did=='0')
        {
            $donation_sum = Nsawa::where('deleteflag', 0)->sum('amt');

            $payments = Nsawa::select('*')->with(['funeral','beneficiary','dead'])
           
            // ->where('capture_id','=',Auth::user()->userid)
            // ->where('did','=',$did)
            ->where('deleteflag', 0)
            ->orderBy('pkid','desc')->get();
            // dd($payments);
            return view('reports.details_bydeceased',compact('payments','donation_sum'));
        }
        else{
            $donation_sum = Nsawa::where('deleteflag', 0)->where('did','=',$did)->sum('amt');

            $payments = Nsawa::select('*')->with(['funeral','beneficiary','dead'])
           
            // ->where('capture_id','=',Auth::user()->userid)
            ->where('did','=',$did)
            ->where('deleteflag', 0)
            ->orderBy('pkid','desc')->get();
            // dd($payments);
            return view('reports.details_bydeceased',compact('payments','donation_sum'));
        }
      
    }








    public function  get_paymt_summary(Request $request)
    {
        $payments = Nsawa::select('tbldeath.d_name',  DB::raw('SUM(tblfundonation.amt) as revenue'))

        ->with(['funeral','beneficiary','dead'])
        ->leftJoin('tbldeath', 'tbldeath.did', '=', 'tblfundonation.did')
        ->where('tblfundonation.deleteflag', '=','0')
        ->groupBy('tbldeath.d_name') ->get();
        return view('reports.donation_summary_by_death',compact('payments'));
    }

    public function  get_paymt_detail_excel(Request $request)
    {
        // $sdate = $request->get('start_date');
        // $edate = $request->get('end_date');
    // return Excel::download(new ExportPaymentInsco($sdate,$edate,$deptid,$opt,$insco_id), 'paytoinsco.xlsx');
    
    return Excel::download(new ExportPaymentDetails(), 'donation_details.xlsx');
    
    }

    public function get_paymt_detail_pdf(Request $request)
    {
        // $sdate = $request->get('start_date');
        // $edate = $request->get('end_date');

        $sdate = Carbon::now();;
        $edate = Carbon::now()->subDays(7);

        $payments = Nsawa::select('*')->with(['funeral','beneficiary','dead'])
        // ->where('capture_id','=',Auth::user()->userid)
        ->orderBy('pkid','desc')->get();;

        $pdf_doc= PDF::loadview('reports.pdf_paymt_detail',compact('payments','sdate','edate'));
        $pdf_doc->setPaper('A4', 'landscape');
 return $pdf_doc->download('reports.pdf_paymt_detail.pdf');
 

    }



    public function get_paymt_summary_pdf(Request $reqest)
    {

    $payments = Nsawa::select('tbldeath.d_name',  'SUM(tblfundonation.amt) as revenue')
    ->leftJoin('tbldeath', 'tbldeath.id', '=', 'tblfundonation.did')
    ->where('tblfundonation.deleteflag', '=','0')
    ->groupBy('tbldeath.d_name') 
    ->get();

    $pdf_doc= PDF::loadview('reports.pdf_paymt_detail',compact('payments','sdate','edate'));
    $pdf_doc->setPaper('A4', 'landscape');
return $pdf_doc->download('reports.pdf_paymt_summary_bydeath.pdf');

    }



    public function get_rpt_options(Request $reqest)
    {

        $causes = Cause::all();
        $relations = Relation::all();
        $users = User::all();
        $fams = Family::all();
        $deaths = Death::all();

        $funerals = Funeral::select('*')->with(['dead','detail','funDeath'])
        ->withCount('detail')
        ->orderBy('updated_at','desc')
        ->get()->where('deleteflag','=' ,'0');


        $payments = Nsawa::select('tbldeath.d_name',  DB::raw('SUM(tblfundonation.amt) as revenue'))
        ->with(['funeral','beneficiary','dead'])
        ->leftJoin('tbldeath', 'tbldeath.did', '=', 'tblfundonation.did')
        ->where('tblfundonation.deleteflag', '=','0')
        ->groupBy('tbldeath.d_name') ->get();
        return view('reports.rpt_options_funeral',compact('payments','deaths','causes','fams','relations','funerals'));

    }
}
