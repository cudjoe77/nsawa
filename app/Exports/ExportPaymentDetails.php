<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
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

use App\Models\Nsawa;
use App\Models\Beneficiary;
use App\Models\FuneralDetail;
use Carbon\Carbon;
use Config;

class ExportPaymentDetails implements FromQuery, WithHeadings,WithMapping,ShouldAutoSize,WithStyles,WithColumnFormatting
{

// public function __construct(String  $from,String $to,String $prodt_type)
// {
// $this->from = $from;
// $this->to = $to;
// $this->prodt_type=$prodt_type;
// }


    /**
    * @return \Illuminate\Support\Collection
    */
      public function headings(): array
      {
          return [
            'ID',
              'Date',
              'Deceased Name',
              'Family',
              'Donor Name',
              'Phone',
              'Beneficiary',
              'Amount',
          ];
      }

      public function map($paymt): array
      {
           return[
               $paymt->pkid,
               (date('d-M-y', strtotime($paymt->created_at))),
           
            $paymt->dead->d_name?? "n/a",
               ($paymt->dead->family->fam_name),
               $paymt->donor_name,
               $paymt->donor_phone,
               ($paymt->beneficiary->ben_type?? "n/a"),
               (number_format($paymt->amt,2)),
            //    $paymt->dead->pluck('d_name')->implode(', '),
            //   $paymt->policydetail_count,
             
           
             
           ];
      }


public function query()
{

   
return Nsawa::select('*')->with(['funeral','beneficiary','dead'])
// ->whereBetween('created_at', [$this->from, $this->to])
// ->withSum('payment','paymentamt')
->where('deleteflag', 0)
->orderBy('pkid','desc');

// ->get();
   
          
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



  

