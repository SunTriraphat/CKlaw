

<div class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i>สืบทรัพย์(บังคับคดี)</span>
        <a data-link="{{ route('Exe.show', @$data->cus_id) }}?type={{ 'investigate' }}" data-bs-toggle="modal"
            data-bs-target="#modal-xl" type="button" class="btn-sm float-end btn btn-light rounded-circle">
            <i class="fa-solid fa-pen-to-square"></i>
        </a></div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">วันที่สืบทรัพย์</th>
                        <td class="text-end">{{ formatDateThai(@$data->date_investigate_first) }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">ทรัพย์ที่พบเป็น</th>
                        <td class="text-end">{{ @$data->property_found }}</td>
                    </tr>
                   
                </table>
            </div>
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">ผลสืบ</th>
                        <td class="text-end">{{ @$data->investigate_result }}</td>
                    </tr>
                    
                </table>
               
            </div>
            <div class="col-12">
                <tr>
                    <th class="text-start"><strong>หมายเหตุ : </strong></th>
                    <td class="text-end">{{ @$data->note_1 }} </td>
                </tr>
            </div>
        </div>
    </div>
   
</div>
<a data-link="{{ route('Fin.show', $data->cus_id) }}?type={{ 'InsertFinanceInvest' }}" data-bs-toggle="modal"
    data-bs-target="#modal-xl" type="button" class="btn-sm  btn btn-secondary">
    <i class="fa-solid fa-money-bill-1"></i> เพิ่มบิลใหม่
</a>

@foreach (@$dataFinance as $finance)
   
    @if ($finance->levels == 'ขั้นสืบทรัพย์' && ($finance->status == NULL || $finance->status != 'ยกเลิก'))
        <div class="card border border-white mb-2 p-2">
            <div class="card-title">
                <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ค่าใช้จ่าย
                    {{ $finance->bil_no }} </span>

                {{-- <button type="button" href="{{ route('Cus.show', $item->id) }}?type={{ 'Editcus' }}"  class="btn-sm float-end btn btn-light rounded-circle"><i class="fa-solid fa-pen-to-square"></i></button> --}}
                <a data-link="{{ route('Fin.show', $finance->id) }}?type={{ 'EditFinanceInvest' }}" data-bs-toggle="modal"
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
                                <th class="text-start">สืบทรัพย์/ตรวจกรรมสิทธิ์</th>
                                {{-- <td class="text-end">{{ date_format(date_create(@$item->date_tribunal), 'd/m/Y') }}</td> --}}
                                <td class="text-end">{{ number_format(@$finance->investigation_fee, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-sm">
                            <tr>
                                <th class="text-start">ค่านำชี้</th>
                                <td class="text-end">{{ number_format(@$finance->property_iden, 2) }}</td>


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
