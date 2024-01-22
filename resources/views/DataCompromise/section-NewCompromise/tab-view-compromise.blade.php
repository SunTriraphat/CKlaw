{{--  --}}
@php
    $start = new \Carbon\Carbon($Compro->date_com);
    $end = Carbon\Carbon::now()->addMonth();
    $countMonth = $start->diffInMonths($end);
@endphp


{{-- first Content --}}
@if (@$Compro->status == 'close')
    <a data-link="{{ route('LawCom.show', $Compro->cus_id) }}?type={{ 'InsertCom' }}" data-bs-toggle="modal"
        data-bs-target="#modal-xl" type="button"  class="btn-sm btn btn-secondary ">
        <i class="fa-solid fa-plus"></i> ประนอมหนี้ใหม่
    </a>
@endif

<div class="card border border-white p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ประนอมหนี้ (Details
            Compromise)

        </span>
        @if (@$Compro->status != 'close')
            <a data-link="{{ route('LawCom.show', $Compro->cus_id) }}?type={{ 'EditCom' }}" data-bs-toggle="modal"
                data-bs-target="#modal-xl" type="button" class="btn-sm float-end btn btn-light rounded-circle">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
        @else
            <span class=" fw-semibold text-danger float-end"> ประนอมหนี้เดิม
            </span>
        @endif


    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">ประเภทประนอมหนี้</th>
                        <td class="text-end">{{ @$Compro->type_com }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">วันที่ประนอม</th>

                       
                            <td class="text-end">{{ @$Compro->date_com_start != null ? formatDateThai(@$Compro->date_com_start) : '-' }}</td>
                       

                    </tr>
                    @if (@$Compro->levels == 'ชั้นบังคับคดี')
                        <tr>
                            <th class="text-start">วันที่ครบงด</th>

                           
                                <td class="text-end">{{@$Compro->blackout_date != null ? formatDateThai(@$Compro->blackout_date) : '-' }}</td>
                           

                        </tr>
                    @endif
                    <tr>
                        <th class="text-start">ค่างวด</th>
                        <td class="text-end">{{ number_format(@$Compro->period) }}</td>
                    </tr>

                </table>
            </div>
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">ยอดประนอมหนี้</th>
                        <td class="text-end">{{ number_format(@$Compro->pay_com) }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">วันที่ประนอมจ่ายงวดแรก</th>

                       
                            <td class="text-end">{{@$Compro->date_com != null ? formatDateThai(@$Compro->date_com) : '-' }}</td>
                       

                    </tr>
                    @if (@$Compro->levels == 'ชั้นบังคับคดี')
                        <tr>
                            <th class="text-start">งดการขายวันที่</th>

                           
                                <td class="text-end">{{@$Compro->stop_date != null ? formatDateThai(@$Compro->stop_date) : '-'}}</td>
                           
                        </tr>
                    @endif
                    <tr>
                        <th class="text-start">ยอดเงินก้อนแรก</th>
                        <td class="text-end">{{ number_format(@$Compro->pay_first) }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">ระยะเวลาผ่อน</th>
                        <td class="text-end">{{ @$Compro->installments }}</td>
                    </tr>

                </table>
            </div>
            <div class="col-12">
                <tr>
                    <th class="text-start"><strong>หมายเหตุ : </strong></th>
                    <td class="text-end">{{ @$Compro->note }} </td>
                </tr>
            </div>
        </div>
    </div>
</div>

{{-- second Content --}}
{{-- <div class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ข้อมูลการชำระ (Details Installment)</span>
        <button type="button" class="btn-sm float-end btn btn-light rounded-circle"><i class="fa-solid fa-pen-to-square"></i></button>
        </div>
    <div class="card-body">

        <div class="row">
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start text-danger">วันที่ชำระล่าสุด</th>
                        <td class="text-end">content 1</td>
                    </tr>
                    <tr>
                        <th class="text-start text-danger">ยอดชำระแล้ว</th>
                        <td class="text-end">content 1</td>
                    </tr>
                    <tr>
                        <th class="text-start text-danger">วันดิวงวดถัดไป</th>
                        <td class="text-end">content 1</td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start text-danger">ยอดชำระล่าสุด</th>
                        <td class="text-end">content 1</td>
                    </tr>
                    <tr>
                        <th class="text-start text-danger">ยอดคงเหลือ</th>
                        <td class="text-end">content 1</td>
                    </tr>
                    <tr>
                        <th class="text-start text-danger">งวดขาดชำระ</th>
                        <td class="text-end">content 1</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div> --}}

{{-- <div class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> หมายเหตุ (Compromise Notes)</span>
        <button type="button" class="btn-sm float-end btn btn-light rounded-circle"><i class="fa-solid fa-pen-to-square"></i></button>
      </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <p>memo.....</p>
            </div>
        </div>
    </div>
</div> --}}
