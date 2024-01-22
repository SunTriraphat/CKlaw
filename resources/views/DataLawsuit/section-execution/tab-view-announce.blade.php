<div class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ขั้นตอนประกาศขายทอดตลาด</span>
        <a data-link="{{ route('Exe.show', @$data->cus_id) }}?type={{ 'announce' }}" data-bs-toggle="modal"
            data-bs-target="#modal-xl" type="button" class="btn-sm float-end btn btn-light rounded-circle">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    </div>
    <div class="card-body">
        <div class="row">

            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">นัดที่1</th>
                        <td class="text-end">{{ @$data->date_1 != null ? formatDateThai(@$data->date_1) : '-' }} </td>
                    </tr>
                    <tr>
                        <th class="text-start">นัดที่3</th>
                        <td class="text-end">{{ @$data->date_3 != null ? formatDateThai(@$data->date_3) : '-' }} </td>
                    </tr>
                    <tr>
                        <th class="text-start">นัดที่5</th>
                        <td class="text-end">{{ @$data->date_5 != null ? formatDateThai(@$data->date_5) : '-' }} </td>
                    </tr>

                    <tr>
                        <th class="text-start">กำหนดประกาศขายครั้งเเรก</th>
                        <td class="text-end">
                            {{ @$data->date_announce_first != null ? formatDateThai(@$data->date_announce_first) : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-start">สถานะบังคับคดี</th>
                        <td class="text-end">{{ @$data->exe_status }}</td>
                    </tr>

                </table>
            </div>
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">นัดที่2</th>
                        <td class="text-end">{{ @$data->date_2 != null ? formatDateThai(@$data->date_2) : '-' }} </td>
                    </tr>
                    <tr>
                        <th class="text-start">นัดที่4</th>
                        <td class="text-end">{{ @$data->date_4 != null ? formatDateThai(@$data->date_4) : '-' }} </td>
                    </tr>
                    <tr>
                        <th class="text-start">นัดที่6</th>
                        <td class="text-end">{{ @$data->date_6 != null ? formatDateThai(@$data->date_6) : '-' }} </td>
                    </tr>
                    <tr>
                        <th class="text-start">ผลประกาศขาย</th>
                        <td class="text-end">{{ @$data->announce_result }}</td>
                    </tr>

                </table>
            </div>

           

            <div class="col-12">
                <tr>
                    <th class="text-start"><strong>หมายเหตุ : </strong></th>
                    <td class="text-end">{{ @$data->note_4 }} </td>
                </tr>
            </div>

        </div>

        
       
    </div>

    <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ผลประกาศขาย</span>
    <div class="card-body">
        
        
        <div class="row">
           
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start"><strong> ครบหนี้/ไม่ครบหนี้ : </strong></th>
                        <td class="text-end">{{ @$data->announce_bill_result }} </td>
                    </tr>
                    <tr>
                        <th class="text-start"><strong>รับเช็คจากบังคับคดีจำนวน : </strong></th>
                        <td class="text-end">{{ @$data->check_balance }} </td>
                    </tr>
                    <tr>
                        <th class="text-start"><strong>เงินได้จากการขายทอดตลาด : </strong></th>
                        <td class="text-end">{{ @$data->auction_sale }} </td>
                    </tr>

                </table>
            </div>
            
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start"><strong> ขายได้เมื่อวันที่ : </strong></th>
                        <td class="text-end">{{ @$data->sale_date != null ? formatDateThai(@$data->sale_date) : '-' }} </td>
                      
                    </tr>
                    <tr>
                        <th class="text-start"><strong>ค่าใช้จ่ายเหลือคืน : </strong></th>
                        <td class="text-end">{{ @$data->total_refund_balance }} </td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
</div>

{{-- <div class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> หมายเหตุ (์Note)</span>
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
