{{-- @php
            dump($data);
        @endphp --}}

<div class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ขั้นตอนฟ้อง </span>



        {{-- <button type="button" href="{{ route('Cus.show', $data->id) }}?type={{ 'Editcus' }}"  class="btn-sm float-end btn btn-light rounded-circle"><i class="fa-solid fa-pen-to-square"></i></button> --}}
        <a data-link="{{ route('Law.show', $data->cus_id) }}?type={{ 'Editcus' }}" data-bs-toggle="modal"
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
                        <th class="text-start">วันที่ศาลรับฟ้อง</th>
                        {{-- <td class="text-end">{{ date_format(date_create(@$data->date_tribunal), 'd/m/Y') }}</td> --}}
                        <td class="text-end">
                            {{ @$data->date_tribunal != null ? formatDateThai(@$data->date_tribunal) : '-' }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">ทุนทรัพย์</th>
                        <td class="text-end">{{ number_format(@$data->capital_sue) }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">เลขคดีดำ</th>
                        <td class="text-end">{{ @$data->black_no }}</td>
                    </tr>

                </table>
            </div>
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">คดีหมายเลขแดงที่</th>
                        <td class="text-end">{{ @$data->red_no }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">ศาล</th>
                        <td class="text-end">{{ @$data->tribunal }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">ประเภทคดี</th>
                        <td class="text-end">{{ @$data->case_type }}</td>
                    </tr>

                </table>
            </div>
        </div>

    </div>
</div>

<a data-link="{{ route('Fin.show', $data->cus_id) }}?type={{ 'InsertFinanceSue' }}" data-bs-toggle="modal"
    data-bs-target="#modal-xl" type="button" class="btn-sm btn btn-secondary ">
    <i class="fa-solid fa-money-bill-1"></i> เพิ่มบิลใหม่
</a>




{{-- <a data-link="{{ route('export.pdf') }}" data-bs-toggle="modal"
        data-bs-target="#modal-xl" type="button" class="btn-sm btn btn-secondary ">
        <i class="fa-solid fa-money-bill-1"></i> ออกบิล
    </a> --}}



@foreach ($dataFinance as $finance)
    @if ($finance->levels == 'ขั้นฟ้อง' && ($finance->status == null || $finance->status != 'ยกเลิก'))
        <div class="card border border-white mb-2 p-2">
            <div class="card-title">
                <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ค่าใช้จ่ายบิล
                    {{ $finance->bil_no }} </span>

                {{-- <button type="button" href="{{ route('Cus.show', $data->id) }}?type={{ 'Editcus' }}"  class="btn-sm float-end btn btn-light rounded-circle"><i class="fa-solid fa-pen-to-square"></i></button> --}}
                <a data-link="{{ route('Fin.show', $finance->id) }}?type={{ 'EditFinanceSue' }}"
                    data-bs-toggle="modal" data-bs-target="#modal-xl" type="button"
                    class="btn-sm float-end btn btn-light rounded-circle">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                {{-- <a class="btn-sm float-end btn btn-light rounded-circle" type="button" target="_blank" href="{{ route('DomPdf.show', $finance->id) }}?type={{'exportPdf'}}">
                    <i class="fa-regular fa-file-lines"></i>                      
                  </a> --}}
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
                                <th class="text-start">ค่าธรรมเนียมศาลฟ้องคดี</th>
                                {{-- <td class="text-end">{{ date_format(date_create(@$data->date_tribunal), 'd/m/Y') }}</td> --}}
                                <td class="text-end">{{ number_format(@$finance->court_fee, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-sm">
                            <tr>
                                <th class="text-start">ค่าส่งหมายเรียกจำเลย</th>
                                <td class="text-end">{{ number_format(@$finance->send_defendant, 2) }}</td>


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
                       
                        <td class="text-end">{{ formatDateThai(@$data->date_tribunal) }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">ค่าสงหมายเรียกจำเลย</th>
                        <td class="text-end">{{ @$data->tribunal }}</td>
                    </tr>
                    
                </table>
            </div> --}}
                </div>




            </div>
        </div>
    @endif
@endforeach


{{-- <div class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> หมายเหตุ (์Note)</span>
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
                                <tr>
                                    <th class="text-start">{{ $path->file_name }}</th>
                                    <th class="text-end"><a href="{{ URL::asset(@$path->file_path) }}"
                                        download  >download</a></td>
                                      

                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <form action="{{ route('Upload.store') }}" method="post" enctype="multipart/form-data"
                        id="upload_file">
                        @csrf

                        <input class="form-control form-control-lg" accept="application/pdf" type="file"
                            name="file" id="chooseFile">
                        <input type="hidden" name="type" value="updateFilePath" id="type">
                        <input type="hidden" value="{{ $data->id }}" name="id" id="id">
                        <input type="hidden" value="{{ $data->TribunalToCus->CON_NO }}" name="CON_NO"
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

