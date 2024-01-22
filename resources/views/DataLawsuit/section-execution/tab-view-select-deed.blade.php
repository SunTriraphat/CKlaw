<div class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ข้อมูลคัดโฉนด</span>
        <a data-link="{{ route('Exe.show', @$data->cus_id) }}?type={{ 'select-deed' }}" data-bs-toggle="modal"
            data-bs-target="#modal-xl" type="button" class="btn-sm float-end btn btn-light rounded-circle">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <table class="table table-sm">
                 
                    <tr>
                        <th class="text-start">วันที่คัดโฉนด</th>
                        <td class="text-end">{{@$data->date_deed_certificate != NULL ? formatDateThai(@$data->date_deed_certificate) : '-'}}</td>
                    </tr>
                    <tr>
                        <th class="text-start">ผู้ถือกรรมสิทธิ์</th>
                        <td class="text-end">{{ @$data->owner }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">ละติจูด</th>
                        <td class="text-end">{{ @$data->latitude }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-sm">
                   
                    <tr>
                        <th class="text-start">ราคาประเมิณ</th>
                        <td class="text-end">{{ number_format(@$data->estimated_price) }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">ผู้รับจำนอง</th>
                        <td class="text-end">{{ @$data->mortgagee }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">ลองจิจูด</th>
                        <td class="text-end">{{ @$data->longitude }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-12">
                <tr>
                    <th class="text-start"><strong>หมายเหตุ : </strong></th>
                    <td class="text-end">{{ @$data->note_2 }} </td>
                </tr>
            </div>
        </div>
        <iframe width="100%" height="400"
            src="https://maps.google.com/maps?q={{ $data->latitude }},{{ $data->longitude }}&hl=es;z=14&amp;output=embed"></iframe>

    </div>
</div>
<a data-link="{{ route('Fin.show', $data->cus_id) }}?type={{ 'InsertFinanceDeed' }}" data-bs-toggle="modal"
    data-bs-target="#modal-xl" type="button" class="btn-sm  btn btn-secondary">
        <i class="fa-solid fa-money-bill-1"></i> เพิ่มบิลใหม่
</a>
@foreach (@$dataFinance as $finance)
    @if ($finance->levels == 'ขั้นคัดโฉนด'&& ($finance->status == NULL || $finance->status != 'ยกเลิก'))
        <div class="card border border-white mb-2 p-2">
            <div class="card-title">
                <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ค่าใช้จ่าย
                    {{ $finance->bil_no }}  </span>

                {{-- <button type="button" href="{{ route('Cus.show', $item->id) }}?type={{ 'Editcus' }}"  class="btn-sm float-end btn btn-light rounded-circle"><i class="fa-solid fa-pen-to-square"></i></button> --}}
                <a data-link="{{ route('Fin.show', $finance->id) }}?type={{ 'EditFinanceDeed' }}" data-bs-toggle="modal"
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
                                <th class="text-start">คัดถ่ายและรับรองเอกสาร</th>
                                {{-- <td class="text-end">{{ date_format(date_create(@$item->date_tribunal), 'd/m/Y') }}</td> --}}
                                <td class="text-end">{{ number_format(@$finance->copy_documents3, 2) }}</td>
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
{{-- 
<div class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> รูปโฉนด </span>
        <button type="button" class="btn-sm float-end btn btn-light rounded-circle"><i
                class="fa-solid fa-pen-to-square"></i></button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="container mt-3">
                    <div class="col-12">
                        <table class="table table-sm">
                            @foreach ($file_path as $key => $path)
                                @if ($path->status == 'คัดโฉนด')
                                    <tr>
                                        <th class="text-start">{{ $path->file_name }}</th>
                                        <th class="text-end"><a href="{{ URL::asset(@$path->file_path) }}"
                                                download>download</a></td>

                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>


                   
                    <form action="{{ route('Upload.store') }}" method="post" enctype="multipart/form-data"
                        id="upload_file">
                        @csrf


                        <input class="form-control form-control-lg" accept="image/png, image/gif, image/jpeg" type="file"
                            name="file" id="chooseFile">
                        <input type="hidden" name="type" value="updateFilePath" id="type">
                        <input type="hidden" name="status" value="คัดโฉนด" id="status">
                        <input type="hidden" value="{{ $data->cus_id }}" name="id" id="id">
                        <input type="hidden" value="{{ $data->ExecutionToCus->CON_NO }}" name="CON_NO"
                            id="CON_NO">
                        <button type="submit" id="UploadBtn" name="submit" class="btn btn-primary btn-block mt-4">
                            Upload Files
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div> --}}









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
                        // $('#content-select-deed').html(result.html)
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
