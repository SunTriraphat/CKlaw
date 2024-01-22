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


class exportDataCustomers implements FromCollection, WithHeadings, WithMapping, WithEvents, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $Fdate = request('fdate');
        $Tdate = request('tdate');

        if($Fdate == null || $Tdate == null){
            $customer = DB::table('test')->get();
        }else{
            $customer = DB::table('test')->whereBetween('date_tribunal',[$Fdate,$Tdate])->get();
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
                "ที่อยู่",
                "สถานะ"
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
            @$customer->address,    
            @$customer->status,    
           
        ];
    }

    public function registerEvents(): array
    {
        
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $getRow = $event->sheet->getHighestRow()+1;
                $customer = DB::table('test')->get();
                $TriCus = DB::table('test')->where('status','ชั้นศาล')->get();
                $ExeCus = DB::table('test')->where('status','ชั้นบังคับคดี')->get();
                $getCol = $event->sheet->getHighestColumn();
                $event->sheet->setCellValue('A'.$getRow+1, 'จำนวนลูกค้าทั้งหมด');
                $event->sheet->setCellValue('A'.$getRow+2, 'ลูกค้าชั้นศาล');
                $event->sheet->setCellValue('A'.$getRow+3, 'ลูกค้าชั้นบังคับคดี');
                $event->sheet->setCellValue('B'.$getRow+1, count($customer));
                $event->sheet->setCellValue('B'.$getRow+2, count($TriCus));
                $event->sheet->setCellValue('B'.$getRow+3, count($ExeCus));

                $event->sheet->getStyle('A'.$getRow.':'.$getCol.$getRow)->applyFromArray([
                    'font' => [
                        'size' =>  12,
                        'bold' => true
                    ]
                ])
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFEDCFE5');

                $event->sheet->getStyle('A1:'.$getCol.'1')->applyFromArray([
                    'font' => [
                        'size' =>  12,
                        'bold' => true
                    ]
                ])
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFf9be79');

                $event->sheet->getStyle('A3:A'.($getRow-1))->applyFromArray([
                    'font' => [
                        'size' =>  12,
                        'bold' => true
                    ]
                    ])
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFebf517');

                $event->sheet->getStyle('A2:'.$getCol.'2')->applyFromArray([
                    'font' => [
                        'size' =>  12,
                        'bold' => true
                    ]
                ])
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FF81bd4f');

                $event->sheet->getDelegate()->getStyle('A:'.$getCol)
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            },
        
        ];
    }
}
