
    <div class="card border border-white mb-2 p-2">
        <div class="card-title">
            <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ขั้นตอนฟ้อง</span>
            <a data-link="{{ route('Law.show', $data->cus_id) }}?type={{ 'Editcus3' }}" data-bs-toggle="modal"
                data-bs-target="#modal-xl" type="button" class="btn-sm float-end btn btn-light rounded-circle">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-sm">
                        <tr>
                            <th class="text-start">วันส่งคำบังคับ</th>
                            @if (@$data->sub_date != null)
                                <td class="text-end">{{ formatDateThai(@$data->sub_date) }}</td>
                            @else
                                <td class="text-end">-</td>
                            @endif
                        </tr>

                    </table>
                </div>

                <div class="col-12">
                    <tr>
                        <th class="text-start"><strong>หมายเหตุ : </strong></th>
                        <td class="text-end">{{ @$data->command_note }} </td>
                    </tr>
                </div>

            </div>

        </div>

    </div>

    <a data-link="{{ route('Fin.show', $data->cus_id) }}?type={{ 'InsertFinanceCommand' }}" data-bs-toggle="modal"
        data-bs-target="#modal-xl" type="button" class="btn-sm  btn btn-secondary">
        <i class="fa-solid fa-money-bill-1"></i> เพิ่มบิลใหม่
    </a>


@foreach ($dataFinance as $finance)
    @if ($finance->levels == 'ขั้นส่งคำบังคับ' && ($finance->status == NULL || $finance->status != 'ยกเลิก'))
        <div class="card border border-white mb-2 p-2">
            <div class="card-title">
                <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ค่าใช้จ่ายบิล
                    {{ $finance->bil_no }} </span>

                {{-- <button type="button" href="{{ route('Cus.show', $dataProperty->id) }}?type={{ 'Editcus' }}"  class="btn-sm float-end btn btn-light rounded-circle"><i class="fa-solid fa-pen-to-square"></i></button> --}}
                <a data-link="{{ route('Fin.show', $finance->id) }}?type={{ 'EditFinanceCommand' }}"
                    data-bs-toggle="modal" data-bs-target="#modal-xl" type="button"
                    class="btn-sm float-end btn btn-light rounded-circle">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                {{-- <a href="{{ route('Law.show' ,$dataProperty->id) }}?type={{ 'showCus' }}"
                       
                    class="btn btn-primary btn-rounded float-end waves-effect waves-light mb-2 me-2">
                    <i class="mdi mdi-plus me-1"></i> ส่งสืบพยาน
                </a> --}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <table class="table table-sm">
                            <tr>
                                <th class="text-start">ค่าส่งคำบังคับ</th>
                                {{-- <td class="text-end">{{ date_format(date_create(@$data->date_tribunal), 'd/m/Y') }}</td> --}}
                                <td class="text-end">{{ number_format(@$finance->mandatory_fee, 2) }}</td>
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


                </div>

            </div>
        </div>
    @endif
@endforeach
