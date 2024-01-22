<?php

namespace App\Exports;

use App\Models\tbl_customer;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Controllers\customercontroller;
use App\Models\Customer;


//หัวข้อ
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

//ปรับขนาด
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

//สี
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;

use App\TB_PactContracts\Pact_Contracts;
use App\TB_DataCus\Data_Customer;
use App\TB_Constant\TB_Branchs;
use DB;


use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


class exportDataLaw implements WithColumnFormatting,FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $Fdate = request('fdate');
        $Tdate = request('tdate');

        if ($Fdate == null || $Tdate == null) {
            $customer = DB::table('LawCus')
                ->where('status_tribunal', 'Y')
                ->where('status_exe', 'N')
                ->get();
        } else {
            $customer = DB::table('LawCus')
                ->whereBetween('date_tribunal', [$Fdate, $Tdate])
                ->where('status_tribunal', 'Y')
                ->where('status_exe', 'N')
                ->get();
        }


        // $data = DB::table('Hp_ConCus')->get();
        return collect($customer);
    }
    public function headings(): array
    {

        $Fdate = request('fdate');
        $Tdate = request('tdate');

        return [

            ['จากวันที่ : ' . date('d-m-Y', strtotime($Fdate)) . '  ถึงวันที่ : ' . date('d-m-Y', strtotime($Tdate)), '', ''],
            [
                "เลขที่สัญญา",
                "คำนำหน้า",
                "ชื่อ",
                "นามสกุล",
                "เบอร์โทร",
                "สถานะ",
                "วันที่ศาลรับฟ้อง",
                "ทุนทรัพย์ฟ้อง",
                "ศาลที่รับฟ้อง",
                "ประเภทคดี",
                "วันที่สืบพยาน",
                "สถานะ",
                "วันเลื่อนนัด",
                "ยอดหนี้",
                "วันส่งคำบังคับ",
                "วันที่ออกหมายตั้งเจ้าพนง.บังคับคดี",
            ],
        ];
    }
    public function map($customer): array
    {


        return [

            @$customer->CON_NO,
            @$customer->prefix,
            @$customer->name,
            @$customer->surname,
            @$customer->PhoneNum,
            @$customer->status,
            \Carbon\Carbon::parse(@$customer->date_tribunal)->format('Y-m-d'),
            @$customer->capital_sue,
            @$customer->tribunal,
            @$customer->case_type,
            // Date::dateTimeToExcel(\Carbon\Carbon::parse(@$customer->date_witness)->format('Y-m-d')),  
            \Carbon\Carbon::parse(@$customer->date_witness)->format('Y-m-d'),
            @$customer->witness_status,
            @$customer->date_postponed,
            @$customer->debt_balance,
            @$customer->sub_date,
            @$customer->date_app,


            

        ];
    }

    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'K' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
