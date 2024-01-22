@extends('layouts.master')
@section('content')


    <div class="row g-1">

        {{-- header content --}}

        <div class="row mb-2">
            <div class="col-6">
                <h5 class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ฐานข้อมูลสัญญา (Data
                    Contracts)</h5>
            </div>
            <div class="col-6 text-end">

                
                @if ($data->status_tribunal == 'Y')
                    
                    <a href="{{ route('Law.show', $data->id) }}?type={{ 'showCus' }}" type="button"
                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                        ไปหน้าลูกหนี้ชั้นศาล <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                    @if ($data->status_exe == 'Y')
                        <a type="button" href="{{ route('Exe.show', $data->id) }}?type={{ 'showExe' }}"
                            class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                            <i class="mdi mdi-plus me-1"></i> ไปหน้าลูกหนี้ชั้นบังคับคดี <i
                                class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    @endif
                @else
                    <a data-link="{{ route('Cus.show', $data->id) }}?type={{ 'EditTribunalStatus' }}" type="button"
                        data-bs-toggle="modal" data-bs-target="#modal-sm"
                        class="btn btn-success btn-warning btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="fa-solid fa-scale-balanced"></i> ส่งฟ้อง
                    </a>
                @endif

                {{-- <button type="button" href="{{ route('Law.show', $data->id) }}?type={{ 'showLaw' }}"  class="btn btn-warning btn-sm">ส่งฟ้อง <i class="fa-solid fa-scale-balanced"></i></button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-xl" data-link="" class="btn btn-danger btn-sm">ลบ <i class="fa-solid fa-trash-can"></i></button> --}}

            </div>
        </div>

        {{-- left content --}}
        <div class="col-3">
            @include('DataCustomer.section-contract.Card-Contract')
        </div>

        {{-- right content --}}
        <div class="col-9">
            {{-- tab head content --}}
            <div class="card border border-white mb-1 p-2">
                <ul class="nav nav-pills row" id="pills-tab" role="tablist">
                    <li class="nav-item col text-center d-grid" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">รายละเอียด</button>
                    </li>
                    <li class="nav-item col text-center d-grid" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">ข้อมูลผู้ค้ำ</button>
                    </li>
                    <li class="nav-item col text-center d-grid" role="presentation">
                        <button class="nav-link" id="pills-finance-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-finance" type="button" role="tab" aria-controls="pills-finance"
                            aria-selected="false">การเงิน</button>
                    </li>

                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    {{-- detail con --}}

                    @include('DataCustomer.section-contract.tab-Detail-Con')
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row">
                        <div class="col-12">
                            <div id='content-tracking'>
                                @include('DataCustomer.section-contract.tab-tracking-Con')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-finance" role="tabpanel" aria-labelledby="pills-finance-tab">
                    <div id='content-finance'>
                        @include('DataCustomer.section-contract.tab-finance-Con')
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-sm-6">
                    <input type="text" data-masked="" data-inputmask="'mask': '999-99-999-9999-9'" placeholder="ISBN"
                        class="form-control">
                    <span class="help-block">data-inputmask="'mask': '999-99-999-9999-9"'</span>
                </div>
                <div class="col-sm-6">
                    <input type="text" data-masked="" data-inputmask="'mask': '99/99/9999'" placeholder="Date"
                        class="form-control">
                    <span class="help-block">data-inputmask="'mask': '99/99/9999"'</span>
                </div>
                <div class="col-sm-6">
                    <input type="text" data-masked="" data-inputmask="'mask': '(999) 999-9999'"
                        placeholder="Phone number" class="form-control">
                    <span class="help-block">data-inputmask="'mask': '(999) 999-9999"'</span>
                </div>
                <div class="col-sm-6">
                    <input type="text" data-masked="" data-inputmask="'mask': 'aaaa-9999-aa99-9999'"
                        placeholder="Custom Key" class="form-control">
                    <span class="help-block">data-inputmask="'mask': 'aaaa-9999-aa99-9999"'</span>
                </div>
                <div class="col-sm-6">
                    <input type="text" data-masked="" data-inputmask="'mask': '$ 999.999.999,99'"
                        placeholder="Currency Dolar" class="form-control">
                    <span class="help-block">data-inputmask="'mask': '$ 999.999.999,99"'</span>
                </div>
                <div class="col-sm-6">
                    <input type="text" data-masked="" data-inputmask="'mask': '€ 999.999.999,99'"
                        placeholder="Currency Euro" class="form-control">
                    <span class="help-block">data-inputmask="'mask': '€ 999.999.999,99"'</span>
                </div>
            </div> --}}



        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Inputmask().mask(document.querySelectorAll("input"));
            Inputmask().mask(document.getElementById('PhoneNumShow'));
            Inputmask().mask(document.getElementById('ID_numShow'));
            Inputmask().mask(document.getElementById('PhoneNumShow1'));
            Inputmask().mask(document.getElementById('ID_numShow1'));
            Inputmask().mask(document.getElementById('PhoneNumShow2'));
            Inputmask().mask(document.getElementById('ID_numShow2'));
           
            // Inputmask().mask(document.querySelector('.input-mask2'));

        });
    </script>


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script>
        $(document).ready(function() {
            $('#ID_num').mask('9-9999-99999-99-9');
            $('#PhoneNum').mask('999-9999999');
            $('#ID_numShow').mask('9-9999-99999-99-9');
            $('#PhoneNumShow').mask('999-9999999');
            
            let type = $('#type').val();
            console.log(type);
            // let currentDate = document.getElementById('date-input').valueAsDate = new Date();
            // console.log(currentDate);
            $('#saveEditCusBtn').hide()
            $('#edit_cus').on('change input', () => {
                $('#saveEditCusBtn').show()
            })
    
            $('#saveEditCusBtn').click(function(e) {
                data = {
                    status: ''
                };
                console.log('data', data);
    
                $('#edit_cus').serializeArray().map(function(x) {
                    data[x.name] = x.value;
                });
    
    
    
                console.log(data);
                let id = $('#id').val();
                console.log(id);
                let name = $('#name').val();
                let surname = $('#surname').val();
                let CON_NO = $('#CON_NO').val();
                let prefix = $('#prefix').val();
                let Engname = $('#Engname').val();
                let EngSurname = $('#EngSurname').val();
                let ID_num = $('#ID_num').val();
                let Nickname = $('#Nickname').val();
                let PhoneNum = $('#PhoneNum').val();
    
    
                let link = `{{ route('Cus.update', 'id') }}?type=${type}`;
                let url = link.replace('id', id);
                console.log(url);
                // if (name != '' && surname != '' && prefix != '' && ID_num != '' && PhoneNum !=
                //     '') {
    
                $.ajax({
                    url: url,
                    method: "PUT",
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
                        if (type == 'updateGuarantor') {
                            console.log('updateGuarantor');
                            $('#content-tracking').html(result.html)
                        } else {
                            location.reload();
                        }
                        console.log(result);
                        // location.reload();
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
                // } else {
                //     Swal.fire({
                //         icon: 'error',
                //         title: "ข้อมูลไม่ครบถ้วน",
                //         text: "โปรดตรวจสอบข้อมูลให้ครบถ้วนก่อนบันทึก. !",
                //     })
                // }
    
            });
    
    
    
    
            // $('#date-input').on('change input', () => {
            //     let currentDate = $('#date-input').val();
            //     console.log(currentDate);
            // })
    
        })
    </script> --}}


@endsection
