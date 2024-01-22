{{-- @foreach ($data as $key => $data)
    <div class="card border border-white mb-2 p-2">
        <div class="card-title">
            <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ขั้นตอนฟ้อง (45-60
                วัน)</span>
            <a data-link="{{ route('Law.show', $data->id) }}?type={{ 'Editcus2' }}" data-bs-toggle="modal"
                data-bs-target="#modal-xl" type="button" class="btn-sm float-end btn btn-light rounded-circle">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <table class="table table-sm">
                        <tr>
                            <th class="text-start">วันที่สืบพยาน</th>
                            @if (@$data->date_witness != null)
                                <td class="text-end">{{ formatDateThai(@$data->date_witness) }}</td>
                            @else
                                <td class="text-end">-</td>
                            @endif
                        </tr>
                        <tr>
                            <th class="text-start">วันเลือน</th>

                            @if (@$data->date_postponed != null)
                                <td class="text-end">{{ formatDateThai(@$data->date_postponed) }}</td>
                            @else
                                <td class="text-end">-</td>
                            @endif
                        </tr>

                    </table>
                </div>
                <div class="col-6">
                    <table class="table table-sm">
                        <tr>
                            <th class="text-start">สถานะ</th>
                            <td class="text-end">{{ @$data->witness_status }}</td>
                        </tr>

                    </table>
                </div>
                <div class="col-12">
                    <tr>
                        <th class="text-start"><strong>หมายเหตุ : </strong></th>
                        <td class="text-end">{{ @$data->witness_note }} </td>
                    </tr>
                </div>

            </div>

        </div>

    </div>
@endforeach


<div class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ค่าใช้จ่าย </span>



             <a data-link="{{ route('Fin.show', $data->cus_id) }}?type={{ 'EditFinanceWitness' }}" data-bs-toggle="modal"
            data-bs-target="#modal-xl" type="button" class="btn-sm float-end btn btn-light rounded-circle">
            <i class="fa-solid fa-pen-to-square"></i>
      
    </div>
    <div class="card-body">
        @foreach ($dataFinance as $finance)
            <div class="row">
                <div class="col-6">
                    <table class="table table-sm">
                        <tr>
                            <th class="text-start">ค่าส่งคำบังคับ</th>
                            <td class="text-end">{{ number_format(@$finance->mandatory_fee, 2) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-6">
                    <table class="table table-sm">
                        <tr>
                            <th class="text-start">ค่าคัดถ่ายและรับรองเอกสาร</th>
                            <td class="text-end">{{ number_format(@$finance->copy_documents1, 2) }}</td>


                        </tr>

                    </table>
                </div>
                @foreach ($FinanceOther as $other)
                    @if ($other->status == 'ขั้นสืบพยาน')
                        <div class="col-6">
                            <table class="table table-sm">
                                <tr>
                                    <th class="text-start">{{ $other->name }}</th>
                                    <td class="text-end">{{ number_format($other->value, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    @endif
                @endforeach
        @endforeach
       
    </div>
</div>
 --}}


{{-- @php
            dump($data);
        @endphp --}}

    <div class="card border border-white mb-2 p-2">
        <div class="card-title">
            <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ขั้นตอนฟ้อง </span>
            <a data-link="{{ route('Law.show', $data->cus_id) }}?type={{ 'Editcus2' }}" data-bs-toggle="modal"
                data-bs-target="#modal-xl" type="button" class="btn-sm float-end btn btn-light rounded-circle">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <table class="table table-sm">
                        <tr>
                            <th class="text-start">วันที่สืบพยาน</th>
                            @if (@$data->date_witness != null)
                                <td class="text-end">{{ formatDateThai(@$data->date_witness) }}</td>
                            @else
                                <td class="text-end">-</td>
                            @endif
                        </tr>
                        <tr>
                            <th class="text-start">วันเลือน</th>

                            @if (@$data->date_postponed != null)
                                <td class="text-end">{{ formatDateThai(@$data->date_postponed) }}</td>
                            @else
                                <td class="text-end">-</td>
                            @endif
                        </tr>

                    </table>
                </div>
                <div class="col-6">
                    <table class="table table-sm">
                        <tr>
                            <th class="text-start">สถานะ</th>
                            <td class="text-end">{{ @$data->witness_status }}</td>
                        </tr>

                    </table>
                </div>
                <div class="col-12">
                    <tr>
                        <th class="text-start"><strong>หมายเหตุ : </strong></th>
                        <td class="text-end">{{ @$data->witness_note }} </td>
                    </tr>
                </div>

            </div>

        </div>

    </div>

    <a data-link="{{ route('Fin.show',$data->cus_id) }}?type={{ 'InsertFinanceWitness' }}" data-bs-toggle="modal"
        data-bs-target="#modal-xl" type="button" class="btn-sm  btn btn-secondary">
        <i class="fa-solid fa-money-bill-1"></i> เพิ่มบิลใหม่
    </a>


<div>

</div>
@foreach ($dataFinance as $finance)
   
    @if ($finance->levels == 'ขั้นสืบพยาน'&& ($finance->status == NULL || $finance->status != 'ยกเลิก'))
        <div class="card border border-white mb-2 p-2">
            <div class="card-title">
                <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ค่าใช้จ่ายบิล
                    {{ $finance->bil_no }}  </span>

                {{-- <button type="button" href="{{ route('Cus.show', $data->id) }}?type={{ 'Editcus' }}"  class="btn-sm float-end btn btn-light rounded-circle"><i class="fa-solid fa-pen-to-square"></i></button> --}}
                <a data-link="{{ route('Fin.show', $finance->id) }}?type={{ 'EditFinanceWitness' }}" data-bs-toggle="modal"
                    data-bs-target="#modal-xl" type="button" class="btn-sm float-end btn btn-light rounded-circle">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                {{-- <a href="{{ route('Law.show' ,$data->id) }}?type={{ 'showCus' }}"
                   
                class="btn btn-primary btn-rounded float-end waves-effect waves-light mb-2 me-2">
                <i class="mdi mdi-plus me-1"></i> ส่งสืบพยาน
            </a> --}}
            </div>
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-6">
                        <table class="table table-sm">
                            <tr>
                                <th class="text-start">ค่าคัดถ่ายและรับรองเอกสาร</th>
                                <td class="text-end">{{ number_format(@$finance->copy_documents1, 2) }}</td>

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

{{--  --}}




<script type="text/javascript">
    $(function() {

        $('#UploadBtn').hide()

        $('#upload_file').on('change input', () => {
            $('#UploadBtn').show()
        })


        $('form').submit(function(e) {

                console.log('upload');
                $.ajax({
                    url: "{{ route('Upload.store') }}?type={{ 'updateFilePath' }}",
                    method: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: data,
                    },


                    success: function(result) {

                        Swal.fire({
                            icon: 'success',
                            title: `SUCCESS `,
                            showConfirmButton: false,
                            text: result.message,
                            timer: 1500
                        });
                        $('#modal-xl').modal('hide');
                        location.reload();
                    },
                    error: function(err) {
                        console.log(err);
                        Swal.fire({
                            icon: 'error',
                            title: `ERROR ` + err.status + ` !!!`,
                            text: err.responseJSON.message,
                            showConfirmButton: true,
                        });

                        // $('#modal_xl_2').modal('hide');

                    }
                });
            }


        );



        // $('#date-input').on('change input', () => {
        //     let currentDate = $('#date-input').val();
        //     console.log(currentDate);
        // })

    })
</script>
