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


class exportDataExe implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $Fdate = request('fdate');
        $Tdate = request('tdate');

        if($Fdate == null || $Tdate == null){
            $customer = DB::table('LawExe')
            ->where('status_tribunal' ,'Y')
            ->where('status_exe','Y')
            ->get();
            
        }else{
            $customer = DB::table('LawExe')
            ->whereBetween('date_investigate_first',[$Fdate,$Tdate])
            ->where('status_tribunal' ,'Y')
            ->where('status_exe','Y')
            ->get();
        }
       
      
         // $data = DB::table('Hp_ConCus')->get();
        return collect($customer) ;
    }
    public function headings(): array
    {

        $Fdate = request('fdate');
        $Tdate = request('tdate');
       
        return [
               
            ['จากวันที่ : '.date('d-m-Y', strtotime($Fdate)).'  ถึงวันที่ : '.date('d-m-Y', strtotime($Tdate)),'',''],
            [
                "เลขที่สัญญา",
                "คำนำหน้า",
                "ชื่อ",
                "นามสกุล",
                "เบอร์โทร",
                "สถานะ",
                "วันที่สืบทรัพย์",
                "ผลสืบทรัพย์",
                "ทรัพย์ที่พบเป็น",
                "วันที่คัดโฉนด",
                "ราคาประเมิณ",
                "ผู้ถือกรรมสิทธิ์",
                "ผู้รับจำนอง",
                "ตั้งเรื่องยึดทรัพย์วันที่",
                "รายงานการยึดทรัพย์วันที่",
                "สำนักงานบังคับคดีจังหวัด",
                "ทรัพย์ที่ยึด",
                "โฉนดเลขที่",
                "ที่ตามโฉนดที่ดิน",
                "ผู้ถือกรรมสิทธิ์",
                "รายจำนอง",
                "ราคาที่ดินประมาณ",
                "สภาพที่ดิน",
                "ราคาที่ดินเป็นเงิน",
                "หมายเหตุ",
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
            @$customer->date_investigate_first,  
            @$customer->investigate_result,  
            @$customer->property_found,  
            @$customer->date_deed_certificate,  
            @$customer->estimated_price,  
            @$customer->owner,  
            @$customer->mortgagee,  
            @$customer->date_confiscation,  
            @$customer->date_report,  
            @$customer->exe_office,  
            @$customer->property,  
            @$customer->deed_no,  
            @$customer->land_deed,  
            @$customer->owner_deed,  
            @$customer->mortgage_income,  
            @$customer->some_land_price,  
            @$customer->land_con,  
            @$customer->land_price,  
            @$customer->note_3,  
        ];
    }

    
}
