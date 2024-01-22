<div id="showAll">

    <div class="card-body">

        
        @if (@$Compro->levels == 'ชั้นบังคับคดี')
            @if (@$totalValue['DiffMonthcount'] >= 2 || @$totalValue['DiffMonthRow'] >= 2)
                <div class="alert alert-danger" style="text-align: center" role="alert">
                    ค้างเกิน 2 งวด
                </div>
            @endif
            
        @else
            @if (@$totalValue['DiffMonthcount'] >= 3 || @$totalValue['DiffMonthRow'] >= 3)
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
                        <th class="text-start">ดอกเบี้ยที่รับชำระ</th>
                        <td class="text-end">{{ number_format(@$Compro->totalInterest , 2) }}
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
                    <table id="dailytable"
                        class="table dailytable table-hover datatable  nowrap dataTable no-footer dtr-inline">
                        <thead>
                            <tr>
                                <th>บิลที่</th>
                                <th>วันที่รับชำระ</th>
                                <th>ประเภท</th>
                                <th>ยอดชำระ</th>
                                <th>ดิวถัดไป</th>
                                <th>ผู้รับชำระ</th>
                                <th>สถานะ</th>
                                <th>ดูรายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($ComFinTotal as $i => $item)
                                @if($item->status == 'cancel')
                                <tr>
                                    <td><del>{{ $i+1 }}</del></td>
                                    <td><del>{{ formatDateThai($item->pay_date) }}</del></td>
                                    <td><del>{{ $item->type }}</td>
                                    <td><del>{{ number_format($item->pay_amount) }}</td>
                                    <td class="text-danger"><del>{{ formatDateThai($item->due_date) }}</td>
                                    <td><del>{{ $item->Payee }}</td>
                                    <td><del>{{ $item->status }}</td>
                                    <td>
                                        {{-- <a data-link="{{ route('LawCom.show', $item->id) }}?type={{ 'showComFinDetail' }}"
                                            type="button" data-bs-toggle="modal" data-bs-target="#modal-lg"
                                            class="btn btn-sm btn-warning btn-rounded waves-effect waves-light mb-2 me-2" readonly>
                                            ดูรายละเอียด
                                        </a> --}}
                                    </td>

                               
                                </tr>
                                @else
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ formatDateThai($item->pay_date) }}</del></td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ number_format($item->pay_amount) }}</td>
                                    <td class="text-danger">{{ formatDateThai($item->due_date) }}</td>
                                    <td>{{ $item->Payee }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <a data-link="{{ route('LawCom.show', $item->id) }}?type={{ 'showComFinDetail' }}"
                                            type="button" data-bs-toggle="modal" data-bs-target="#modal-lg"
                                            class="btn btn-sm btn-warning btn-rounded waves-effect waves-light mb-2 me-2" readonly>
                                            ดูรายละเอียด
                                        </a>
                                    </td>

                               
                                </tr>
                                @endif
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
        $(".dailytable").DataTable({
            "responsive": false,
            "autoWidth": false,

            "lengthChange": true,

            "pageLength": 10,

        });
    })
</script>

{{-- 
<script>
    $("#dailytable").DataTable({
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
