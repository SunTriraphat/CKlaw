

<div class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i>ตั้งเรื่องยึดทรัพย์ (15 วัน)</span>
        <a data-link="{{ route('Exe.show', @$data->cus_id) }}?type={{ 'confiscation' }}" data-bs-toggle="modal"
            data-bs-target="#modal-xl" type="button" class="btn-sm float-end btn btn-light rounded-circle">
            <i class="fa-solid fa-pen-to-square"></i>
        </a></div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">ตั้งเรื่องยึดทรัพย์วันที่</th>
                        <td class="text-end">{{ @$data->date_confiscation != NULL ? formatDateThai(@$data->date_confiscation) : '-' }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">สำนักงานบังคับคดีจังหวัด</th>
                        <td class="text-end">{{@$data->exe_office }}</td>
                    </tr>
                    
                </table>
            </div>
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">รายงานการยึดทรัพย์วันที่</th>
                        <td class="text-end">{{ @$data->date_report != NULL ? formatDateThai(@$data->date_report) : '-'}}</td>
                    </tr>
                   
                </table>
            </div>
            
        </div>
        
    </div>
    <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> รายละเอียด</span>
            <div class="col-12 mt-3">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">ทรัพย์ที่ยึด</th>
                        <td class="text-end">{{ @$data->property }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">โฉนดที่ดินเลขที่</th>
                        <td class="text-end">{{@$data->deed_no }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">เนื้อที่ตามโฉนดที่ดิน</th>
                        <td class="text-end">{{ @$data->land_deed }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">ผู้ถือกรรมสิทธิ์</th>
                        <td class="text-end">{{ @$data->owner_deed }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">รายจำนอง</th>
                        <td class="text-end">{{ @$data->mortgage_income }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">ราคาที่ดินทั้งแปลงประมาณเป็นเงิน</th>
                        <td class="text-end">{{@$data->some_land_price }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">สภาพที่ดิน</th>
                        <td class="text-end">{{ @$data->land_con }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">ราคาประมาณเป็นเงิน</th>
                        <td class="text-end">{{ @$data->land_price }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">ราคาประเมิณรวม</th>
                        <td class="text-end">{{ @$data->estimate }}</td>
                    </tr>
                   
                </table>
                <tr>
                    <th class="text-start"><strong>หมายเหตุ : </strong></th>
                    <td class="text-end">{{ @$data->note_3 }} </td>
                </tr>
            </div>

</div>


<a data-link="{{ route('Fin.show', $data->cus_id) }}?type={{ 'InsertFinanceCon' }}" data-bs-toggle="modal"
    data-bs-target="#modal-xl" type="button" class="btn-sm  btn btn-secondary">
    <i class="fa-solid fa-money-bill-1"></i> เพิ่มบิลใหม่
</a>

@foreach (@$dataFinance as $finance)
    @if ($finance->levels == 'ขั้นตั้งเรื่องยึดทรัพย์' && ($finance->status == NULL || $finance->status != 'ยกเลิก'))
        <div class="card border border-white mb-2 p-2">
            <div class="card-title">
                <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ค่าใช้จ่าย
                    {{ $finance->bil_no }}  </span>

                {{-- <button type="button" href="{{ route('Cus.show', $item->id) }}?type={{ 'Editcus' }}"  class="btn-sm float-end btn btn-light rounded-circle"><i class="fa-solid fa-pen-to-square"></i></button> --}}
                <a data-link="{{ route('Fin.show', $finance->id) }}?type={{ 'EditFinanceCon' }}" data-bs-toggle="modal"
                    data-bs-target="#modal-xl" type="button" class="btn-sm float-end btn btn-light rounded-circle">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                {{-- <a href="{{ route('Law.show' ,$item->id) }}?type={{ 'showCus' }}"
                       
                    class="btn btn-primary btn-rounded float-end waves-effect waves-light mb-2 me-2">
                    <i class="mdi mdi-plus me-1"></i> ส่งสืบพยาน
                </a> --}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <table class="table table-sm">
                            <tr>
                                <th class="text-start">ตั้งเรื่องยึดทรัพย์</th>
                                {{-- <td class="text-end">{{ date_format(date_create(@$item->date_tribunal), 'd/m/Y') }}</td> --}}
                                <td class="text-end">{{ number_format(@$finance->setup_con, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-sm">
                            <tr>
                                <th class="text-start">วางเงินค่าประกาศขายทอดตลาด</th>
                                {{-- <td class="text-end">{{ date_format(date_create(@$item->date_tribunal), 'd/m/Y') }}</td> --}}
                                <td class="text-end">{{ number_format(@$finance->auction_announce, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-sm">
                            <tr>
                                <th class="text-start">ถอนบังคับคดี</th>
                                {{-- <td class="text-end">{{ date_format(date_create(@$item->date_tribunal), 'd/m/Y') }}</td> --}}
                                <td class="text-end">{{ number_format(@$finance->withdraw_execution, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                   
                    @foreach ($finance->FinanceToFinOther as $other)
                        <div class="col-6">
                            <table class="table table-sm">
                                <tr>
                                    <th class="text-start">{{ $other->name }}</th>
                                    <td class="text-end">{{ number_format($other->value, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    @endforeach

                    {{-- วนลูปแสดงค่าอื่นๆ --}}
                    {{-- <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">ค่าธรรมเนียมศาลฟ้องคดี</th>
                       
                        <td class="text-end">{{ formatDateThai(@$item->date_tribunal) }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">ค่าสงหมายเรียกจำเลย</th>
                        <td class="text-end">{{ @$item->tribunal }}</td>
                    </tr>
                    
                </table>
            </div> --}}
                </div>




            </div>
        </div>
    @endif
@endforeach