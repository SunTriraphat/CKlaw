<div >

    <div class="card-body">

        
        @if (@$Compro->levels == 'ชั้นบังคับคดี')
            {{-- @if (@$totalValue['DiffMonthcount'] >= 2 || @$totalValue['DiffMonthRow'] >= 2)
                <div class="alert alert-danger" style="text-align: center" role="alert">
                    ค้างเกิน 2 งวด
                </div>
            @endif --}}
            
           
            @if (count(@$ComInstall->where('totalSum','!=','0')->where('due_date','<', date("Y-m-d"))) >= 2) 
            <div class="alert alert-danger" style="text-align: center" role="alert">
                ค้างเกิน 2 งวด
            </div>
        @endif

        @else
        @if (count(@$ComInstall->where('totalSum','!=','0')->where('due_date','<', date("Y-m-d"))) >= 3) 
                <div class="alert alert-danger" style="text-align: center" role="alert">
                    ค้างเกิน 3 งวด
                </div>
            @endif
        @endif
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">ยอดประนอมหนี้</th>
                        <td class="text-end">{{ number_format(@$Compro->pay_com, 2) }}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-start">ยอดเงินก้อนแรก</th>
                        <td class="text-end">{{ number_format(@$Compro->pay_first, 2) }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-3">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">ดอกเบี้ยค้างชำระ</th>
                        <td class="text-end">{{ number_format(@$ComInstall->sum('interest') , 2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">ดอกเบี้ยทั้งหมด</th>
                        <td class="text-end">{{ number_format(@$Compro->totalInterest, 2) }}
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col-3">
                <table class="table table-sm">
                    {{-- <tr>
                        <th class="text-start">ยอดชำระปัจจุบัน</th>
                        <td class="text-end">{{ number_format(@$ComFin->sum('pay_amount'), 2) }}</td>
                    </tr> --}}
                    <tr>
                        <th class="text-start">ยอดชำระทั้งหมด</th>
                        <td class="text-end">{{ number_format(@$ComFinTotal->where('status',"!=",'cancel')->where('status',"!=",'ประนอมหนี้เดิม')->sum('pay_amount'), 2) }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-3">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">คงเหลือ</th>

                        <td class="text-end">
                            {{ number_format(@$ComInstall->sum('totalSum') , 2) }}
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
    <div class="table-responsive mt-2 " style="overflow-x:hidden">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

            <div class="row">
                <div class="col-12">
                    <table id="installtable"
                        class="table installtable table-hover datatable  nowrap dataTable no-footer dtr-inline">
                        <thead>
                            <tr>
                                <th>งวดที่</th>
                                <th>ดิวถัดไป</th>
                                <th>ยอดชำระ</th>
                                <th>ดอกเบี้ย</th>
                                <th>ยอดค้างชำระ</th>
                                <th>สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($ComInstall as $i => $item)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td class="text-danger">{{ formatDateThai($item->due_date) }}</td>
                                    <td>{{ number_format($item->pay_amount) }}</td>
                                    <td>{{ $item->interestShow }}</td>
                                    <td>{{ $item->totalSum }}</td>
                                    <td>{{ $item->status }}</td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $(function() {
        $(".installtable").DataTable({
            "responsive": false,
            "autoWidth": false,

            "lengthChange": true,

            "pageLength": 10,

        });
    })
</script>

{{-- 
<script>
    $("#installtable").DataTable({
        "responsive": false,
        "autoWidth": false,
        "ordering": true,
        "lengthChange": true,
        "order": [
            [0, "asc"]
        ],
        "pageLength": 5,
        "scrollX": true,
    });
</script> --}}
