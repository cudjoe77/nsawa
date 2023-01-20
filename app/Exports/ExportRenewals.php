<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\FromView; //new
// use Illuminate\Contracts\View\View; //new

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Http\Request; //new
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\User;
use App\Models\Policy;
use Carbon\Carbon;
use Config;


class ExportRenewals implements FromQuery, WithHeadings,WithMapping,ShouldAutoSize,WithStyles,WithColumnFormatting
{

    // public $id;
    // function __construct($id)
    // {
    //   $this->id = $id;
    // }

    
    public function __construct(String  $from,String $to,String $prodt_type)
    {
        $this->from = $from;
        $this->to = $to;
        $this->prodt_type=$prodt_type;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
      public function headings(): array
      {
          return [
              'PolicyID',
              'Client Name',
              'Cell Number',
              'Department',
              'InscoName',
              'ExpiryDate',
              'Product',
              'Currency',
              'DebitAmt',
              'Payment',
              'Balance',
              'Risk_Total',
              'RiskItems'
          ];
      }

      public function map($policy): array
      {
           return[
               $policy->policyid,
               ($policy->pclient->firstnames ?? "n/a"),
               $policy->cellnumber,
               ($policy->department->subagent_name ?? "n/a"),
               ($policy->minsco->name ?? "n/a"),
               $policy->enddate,
              $policy->mproduct->description,
             
            $policy->mcurrency->curr_name,
            $policy->debits_sum_debitamt,
            ($policy->payment_sum_paymentamt ?? "0"),
           (number_format($policy->debits_sum_debitamt- $policy->payment_sum_paymentamt,2)),
            // $policy->riskitem->vehicleregno,
            // $policy->courses->Name,
            // $payment->created_at->toDatestring(),
              $policy->policydetail_count,
             
              $policy->riskitem->pluck('vehicleregno')->implode(', '),
             
           ];
      }


public function query()
{

    if($this->prodt_type=="MOTOR")
    {

  return Policy::select("*")->with(['mproduct','minsco','mcurrency','pclient','riskitem','debits','department'])
          
            ->whereBetween('tblpolicy.enddate', [$this->from, $this->to])
            ->orderBy('tblpolicy.enddate','asc')
            ->withCount('policydetail')
            ->withSum('debits','debitamt')
            ->withSum('payment','paymentamt')
            ->where('tblpolicy.deleteflag', 0)
            // ->where('departmentid',Auth::user()->deptid)
            ->where('tblproducts.product_group', '=' ,'MOTOR')
            ->join('tblproducts', 'tblproducts.productid', '=', 'tblpolicy.productid')
            ->join('tblclient', 'tblclient.clientid', '=', 'tblpolicy.clientid');
            // ->join('tblsubagents', 'tblsubagents.subagentid', '=', 'tblpolicy.departmentid');
        //    ->join('tblpolicydetail', 'tblpolicydetail.policyid', '=', 'tblpolicy.policyid');
            // ->get();

}
else{

    return Policy::select("*")->with(['mproduct','minsco','mcurrency','pclient','riskitem','debits','department'])
          
    ->whereBetween('tblpolicy.enddate', [$this->from, $this->to])
    ->orderBy('tblpolicy.enddate','asc')
    ->withCount('policydetail')
    ->withSum('debits','debitamt')
    ->withSum('payment','paymentamt')
    ->where('tblpolicy.deleteflag', 0)
    // ->where('departmentid',Auth::user()->deptid)
    ->where('tblproducts.product_group', '<>' ,'MOTOR')
    ->join('tblproducts', 'tblproducts.productid', '=', 'tblpolicy.productid')
    ->join('tblclient', 'tblclient.clientid', '=', 'tblpolicy.clientid');
    // ->join('tblsubagents', 'tblsubagents.subagentid', '=', 'tblpolicy.departmentid');
//    ->join('tblpolicydetail', 'tblpolicydetail.policyid', '=', 'tblpolicy.policyid');
    // ->get();

}
}

      public function styles(Worksheet $sheet)
      {
          return [
              // Style the first row as bold text.
              1    => ['font' => ['bold' => true]],
           
              // Styling a specific cell by coordinate.
              // 'B2' => ['font' => ['italic' => true]],
  
              // Styling an entire column.
              // 'C'  => ['font' => ['size' => 16]],
          ];
      }

      public function columnFormats(): array
      {
          return [
            //   'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'I' => "#,##0.00",
              'J' => "#,##0.00",
              'K' => "#,##0.00",
              
          ];
      }
  }



  

