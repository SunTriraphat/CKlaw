<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <div>
        
    <table >
        
        <tr>
            <th style="text-align: left;"><h2>เลขที่สัญญา {{$customer->CON_NO}}</h2></th>
            <th></th>
            <th style="text-align: right;"><h2>ใบขอนุมัติเลขที่ {{$data->bil_no}}</h2></th>
        </tr>
        <tr>
            <br>
            <br>
            <th colspan="3" style="text-align: center;"><h1>ใบขออนุมัติเงินค่าใช้จ่าย</h1> </th>
        </tr>
       
        <tr>
            <br>
            <th colspan="3" style="text-align: right;"><h2>วันที่ {{formatDateThaiLong(date('Y-m-d'))}}</h2></th>
        </tr>
        <tr>
          
            <th colspan="3" style="text-align: left;"><p style="font-size: 15px;"><b>เรื่อง</b> ขออนุมัติเงินวางค่าใช้จ่ายในการดำเนินคดี</p></th>
            
        </tr>
        
        <tr>
            <th colspan="3" style="text-align: left;"><p style="font-size: 15px;"><b>เรียน</b> กรรมการผู้จัดการ {{$customer->plaintiff}} </p></th>
        </tr>
        <tr>
            <th><h3>ชื่อลูกหนี้</h3></th>
            <th style="text-align: left;"><p style="font-size: 15px;">1.{{$customer->prefix}}{{$customer->name}} {{$customer->surname}}</p></th>
            
            <th><p style="font-size: 15px;">จำเลยที่ 1</p></th>
        </tr>
        @foreach(@$customer->CustoGua as $i => $Gua )
        <tr> 
            <th></th>
            <th style="text-align: left;"><p style="font-size: 15px;">{{$i +2}}.{{$Gua->prefix}}{{$Gua->name}} {{$Gua->surname}}</p></th>
            <th><p style="font-size: 15px;">จำเลยที่ {{$i + 2}}</p></th>
        </tr>
        @endforeach

        <tr>
            <th style="text-align: left;"><p style="font-size: 15px;"><b>ศาล</b> {{$customer->CusToTri->tribunal != NULL ? $customer->CusToTri->tribunal : '-'}}</p></th>
            <th></th>
            <th style="text-align: left;"><p style="font-size: 15px;"><b>หมายเลขดำที่</b> {{@$customer->CusToTri->black_no != NULL ? @$customer->CusToTri->black_no : '-'}}</p></th>
        </tr>
        <tr>
            
            <th style="text-align: left;"><p style="font-size: 15px;"><b>สำนักงานบังคับคดีจังหวัด</b>  {{@$customer->CusToExe->exe_office != NULL ? $customer->CusToExe->exe_office : '-' }}</p></th>
            <th></th>
            <th style="text-align: left;"><p style="font-size: 15px;"><b>หมายเลขแดงที่</b> {{@$customer->CusToTri->red != NULL ? $customer->CusToTri->red : '-'}}</p></th>
        </tr>
        <tr>
            <th style="text-align: left;"><p style="font-size: 15px;"><b>ทุนทรัพย์</b>  {{@$customer->CusToTri->capital_sue != NULL ? number_format($customer->CusToTri->capital_sue).'บาท' :'-'}}   </p></th>
            <th style="text-align: left;"><p style="font-size: 15px;"><b>ประเภทคดี</b> ฟ้อง{{@$customer->CusToTri->case_type != NULL ? $customer->CusToTri->case_type : '-' }}</p></th>
            <th style="text-align: left;"><p style="font-size: 15px;"><b>ฟ้องวันที่</b> {{@$customer->CusToTri->date_tribunal != NULL ? formatDateThaiLong($customer->CusToTri->date_tribunal) :'-' }}</p></th>
        </tr>
        
        <tr>
            <th colspan="3" style="text-align: left;"><br><h2>ขออนุมัติเงินวางค่าใช้จ่ายในการดำเนินคดี โดยมีรายละเอียดดังต่อไปนี้ </h2></th>
           
        </tr>
        <table class="table table-sm">
            {{-- ขั้นฟ้อง --}}
            @if ($data->court_fee != 0)
                <tr>
                   
                    <th colspan="2" ><p style="font-size: 15px; text-indent: 100px;">- ค่าธรรมเนียมศาลฟ้องคดี</p></th>
                    <th><p style="font-size: 15px; ">{{ number_format($data->court_fee, 2) }} บาท</p></th>
                </tr>
            @endif
            @if ($data->send_defendant != 0)
                <tr>
                
                    <th colspan="2" ><p style="font-size: 15px; text-indent: 100px;">- ค่าส่งหมายเรียกจำเลย</p></th>
                    <td ><p style="font-size: 15px; ">{{ number_format($data->send_defendant, 2) }} บาท</p></td>
                </tr>
            @endif
            {{-- ขั้นสืบพยาน --}}
            @if ($data->mandatory_fee != 0)
                <tr>
                   
                    <th colspan="2" ><p style="font-size: 15px; text-indent: 100px;">- ค่าคัดถ่ายและรับรองเอกสาร</p></th>
                    <td ><p style="font-size: 15px; ">{{ number_format($data->mandatory_fee, 2) }} บาท</p></td>
                </tr>
            @endif
            {{-- ขั้นส่งคำบังคับ --}}
            @if ($data->copy_documents1 != 0)
                <tr>
                   
                    <th colspan="2" ><p style="font-size: 15px; text-indent: 100px;">- ค่าส่งคำบังคับ</p></th>
                    <td ><p style="font-size: 15px; ">{{ number_format($data->copy_documents1, 2) }} บาท</p></td>
                </tr>
            @endif
            {{-- ขั้นตั้งเจ้าพนักงาน --}}
            @if ($data->check_ownership != 0)
                <tr>
                    
                    <th colspan="2" ><p style="font-size: 15px; text-indent: 100px;">- ค่าตรวจกรรมสิทธิ์ทรัพย์</p></th>
                    <td ><p style="font-size: 15px; ">{{ number_format($data->check_ownership, 2) }} บาท</p></td>
                </tr>
            @endif
            @if ($data->copy_documents2 != 0)
                <tr>
                    
                    <th colspan="2" ><p style="font-size: 15px; text-indent: 100px;">- ค่าคัดถ่ายและรับรองเอกสาร</p></th>
                    <td ><p style="font-size: 15px; ">{{ number_format($data->copy_documents2, 2) }} บาท</p></td>
                </tr>
            @endif
            @if ($data->point_property != 0)
                <tr>
                    
                    <th colspan="2" ><p style="font-size: 15px; text-indent: 100px;">- ค่านำชี้ทรัพย์</p></th>
                    <td ><p style="font-size: 15px; ">{{ number_format($data->point_property, 2) }} บาท</p></td>
                </tr>
            @endif
            {{-- ขั้นสืบทรัพย์ --}}
            @if ($data->investigation_fee != 0)
                <tr>
                    
                    <th colspan="2" ><p style="font-size: 15px; text-indent: 100px;">- สืบทรัพย์/ตรวจกรรมสิทธิ์</p></th>
                    <td ><p style="font-size: 15px; ">{{ number_format($data->investigation_fee, 2) }} บาท</p></td>
                </tr>
            @endif
            @if ($data->property_iden != 0)
                <tr>
                    
                    <th colspan="2" ><p style="font-size: 15px; text-indent: 100px;">- สืบทรัพย์/ตรวจกรรมสิทธิ์</p></th>
                    <td ><p style="font-size: 15px; ">{{ number_format($data->property_iden, 2) }} บาท</p></td>
                </tr>
            @endif
            {{-- ขั้นคัดโฉนด --}}
            @if ($data->copy_documents3 != 0)
                <tr>
                   
                    <th colspan="2" ><p style="font-size: 15px; text-indent: 100px;">- คัดถ่ายและรับรองเอกสาร</p></th>
                    <td ><p style="font-size: 15px; ">{{ number_format($data->copy_documents3, 2) }} บาท</p></td>
                </tr>
            @endif
            {{-- ขั้นตั้งยึดทรัพย์ --}}
            @if ($data->setup_con != 0)
                <tr>
                    
                    <th colspan="2" ><p style="font-size: 15px; text-indent: 100px;">- ตั้งเรื่องยึดทรัพย์</p></th>
                    <td ><p style="font-size: 15px; ">{{ number_format($data->setup_con, 2) }} บาท</p></td>
                </tr>
            @endif
            @if ($data->auction_announce != 0)
                <tr>
                    
                    <th colspan="2" ><p style="font-size: 15px; text-indent: 100px;">- วางเงินค่าประกาศขายทอดตลาด</p></th>
                    <td ><p style="font-size: 15px; ">{{ number_format($data->auction_announce, 2) }} บาท</p></td>
                </tr>
            @endif
            @if ($data->withdraw_execution != 0)
                <tr>
                    
                    <th colspan="2" ><p style="font-size: 15px;  text-indent: 100px;">- ถอนบังคับคดี</p></th>
                    <td ><p style="font-size: 15px; ">{{ number_format($data->withdraw_execution, 2) }} บาท</p></td>
                </tr>
            @endif
        </table>
       
    
    
        {{-- {{$data->FinanceToFinOther}} --}}
        @foreach ($data->FinanceToFinOther as $other)
            <table class="table table-sm">
                <tr>
                    <th colspan="2" ><p style="font-size: 15px; text-indent: 100px;">- {{ $other->name }}</p></th>
                    <td ><p style="font-size: 15px; ">{{ number_format($other->value, 2) }} บาท</p></td>
                </tr>
            </table>
        @endforeach

        <tr>
            <th ></th>
            <th style="text-align: center;"><p style="font-size: 15px;"><b>รวม</b> </p></th>
            <th style="text-align: left;"><p style="font-size: 15px;">{{ number_format($data->totalsum, 2) }} บาท</p></th>
            
        </tr>
        <tr>
            <th ></th>
            <th colspan="2" style="text-align: center;"><p style="font-size: 15px;">( {{ $textFin }} )</p></th>
        </tr>
        <tr>
            
            <th colspan="3"><p style="font-size: 15px;"><b>หมายเหตุ : {{ $data->note }} </b></p></th>
        </tr>
        <tr> 
            <br>
            <th style="text-align: left;"><p style="font-size: 15px;"><b>จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ</b> </p></th>
        </tr>
        
        <tr> 
            <br>
            <br>
            <br>
            <th colspan="3" style="text-align: center;"><p style="font-size: 15px;">ขอแสดงความนับถือ </p></th>
        </tr>
        <tr> 
            <br>
            <br>
            <br>
            <th colspan="3" style="text-align: center;"><p style="font-size: 15px;">(__________________) </p></th>
        </tr>
        <tr> 
           
            <th colspan="3" style="text-align: center;"><p style="font-size: 15px;">{{$data->Applicant}}</p></th>
        </tr>
        <tr> 
           
            <th colspan="3" style="text-align: center;"><p style="font-size: 15px;">ทนายความ / ผู้ขอเบิก </p></th>
        </tr>
        <tr> 
            <br>
            <br>
            <br>
            <th></th>
            <th></th>
            <th colspan="3" style="text-align: center;"><p style="font-size: 15px;">ตรวจแล้ว__________________ธุรการฯ </p></th>
        </tr>
        <tr> 
            <th></th>
            <th></th>
            <th style="text-align: center;"><p style="font-size: 15px;">(  นางสาวกัลยา  สุขพรหม  )</p></th>
        </tr>



    </table>
</div>
</body>

</html>
