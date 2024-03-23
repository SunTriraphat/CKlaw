@extends('layouts.master')
@section('content')
@section('NewCompro', 'active')



<div class="row">

    {{-- header content --}}

   
        <div class="row mb-2">

            <div class="col-6">
                <h5 class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ชั้นศาล (Data Contracts)
                </h5>
            </div>

            <div class="col-6 text-end">
                <a href="{{ url()->previous() }}" type="button"
                    class="btn btn-danger btn-rounded waves-effect waves-light mb-2 me-2">
                    <i class="fa-solid fa-arrow-left-long"></i> ย้อนกลับ
                </a>
                <a  
                    type="button" id="updateAll"
                    class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2">
                    อัพเดตการจ่าย
                </a>

                {{-- <button type="button" href="{{ route('Law.update', $data->id) }}?type={{ 'updateDataCus3' }}" class="btn btn-warning btn-sm">ส่งตั้งเจ้าพนักงาน</button> --}}
                {{-- <button type="button" class="btn btn-danger btn-sm">ลบ <i class="fa-solid fa-trash-can"></i></button> --}}
                @if (@$Compro->status == 'close')
                    <a href="{{ route('Law.show', $data->id) }}?type={{ 'showCus' }}" type="button"
                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                        ไปหน้าชั้นศาล <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                    @if ($data->status_exe == 'Y')
                        <a type="button" href="{{ route('Exe.show', $data->id) }}?type={{ 'showExe' }}"
                            class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                            ไปหน้าชั้นบังคับคดี <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    @endif
                @else
                    @if ($data->status_exe == 'Y')
                       
                        <a data-link="{{ route('Exe.show', $data->id) }}?type={{ 'sendAnnouncement' }}"
                            type="button" data-bs-toggle="modal" data-bs-target="#modal-sm"
                            class="btn btn-warning btn-rounded waves-effect waves-light mb-2 me-2">
                            <i class="mdi mdi-plus me-1"></i> ประกาศขาดทอดตลาด
                        </a>
                        <a type="button" href="{{ route('Exe.show', $data->id) }}?type={{ 'showExe' }}"
                            class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                            ไปหน้าชั้นบังคับคดี <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    @else
                    
                        <a data-link="{{ route('LawCom.show', $data->id) }}?type={{ 'sendToAppointment' }}"
                            type="button" data-bs-toggle="modal" data-bs-target="#modal-sm"
                            class="btn btn-warning btn-rounded waves-effect waves-light mb-2 me-2">
                            <i class="mdi mdi-plus me-1"></i> ส่งตั้งเจ้าพนักงาน
                        </a>
                    @endif
                @endif
            </div>
        </div>


        {{-- left content --}}
        <div class="col-3">
            @include('DataCustomer.section-contract.Card-Contract')
        </div>

        {{-- right content --}}
        <div class="col-9">
            <div class="row mb-2">
                <div class="col-12">
                    <div class="card border border-white mb-2 p-2 h-100">
                        <div class="card-title">
                            <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i>
                                สัญญาที่ครอบครอง (Contracts)</span>
                            <button type="button" class="btn-sm float-end btn btn-light rounded-circle"><i
                                    class="fa-solid fa-pen-to-square"></i></button>
                        </div>
                        <div class="card-body">

                            @component('components.content-other.title-detail')
                              
                                @slot('data', [
                                    'typeloan' => $Tribunal->case_type,
                                    'code' => $Tribunal->CON_NO,
                                    'statusLaw' => 'ประนอมหนี้(ใหม่)',
                                    'txtprogress' => 'content',
                                    'txtdateLaw' => 'วันที่ศาลรับฟ้อง',
                                    'dateLaw' => $Tribunal->date_tribunal,
                                    ])
                                @endcomponent
                                <div class="row">

                                    <div class="nav nav-pills mb-3 row" id="pills-tab" role="tablist"
                                        style="text-align: -webkit-center;">
                                        <div class="d-flex pb-2" style="overflow:auto;">
                                            <div class="nav-item col d-grid" role="presentation">
                                                <button class="nav-link active " id="pills-home-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-1" type="button" role="tab"
                                                    aria-controls="pills-home" aria-selected="true">
                                                    <div class="col-12 mb-1"><i
                                                            class="fa-regular fa-circle-check fa-xl text-success"></i></div>
                                                    <div class="col-12 text-nowrap">ข้อมูลประนอมหนี้</div>
                                                </button>
                                            </div>
                                            <div class="nav-item col" role="presentation">
                                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-4" type="button" role="tab"
                                                    aria-controls="pills-contact" aria-selected="false">
                                                    <div class="col-12 mb-1"><i
                                                            class="fa-regular fa-circle-check fa-xl text-secondary"></i>
                                                    </div>
                                                    <div class="col-12  text-nowrap">ตารางค่างวด</div>
                                                </button>

                                            </div>
                                            <div class="nav-item col" role="presentation">
                                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-2" type="button" role="tab"
                                                    aria-controls="pills-profile" aria-selected="false">
                                                    <div class="col-12 mb-1"><i
                                                            class="fa-regular fa-circle-check fa-xl text-warning"></i></div>
                                                    <div class="col-12  text-nowrap">ตารางรับชำระ</div>
                                                </button>
                                            </div>
                                            <div class="nav-item col" role="presentation">
                                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-3" type="button" role="tab"
                                                    aria-controls="pills-contact" aria-selected="false">
                                                    <div class="col-12 mb-1"><i
                                                            class="fa-regular fa-circle-check fa-xl text-secondary"></i>
                                                    </div>
                                                    <div class="col-12  text-nowrap">บันทึกติดตาม</div>
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-1" role="tabpanel"
                                            aria-labelledby="pills-home-tab" tabindex="0">
                                            {{-- ข้อมูลประนอมหนี้ --}}
                                            @include('DataCompromise.section-NewCompromise.tab-view-compromise')
                                        </div>
                                        <div class="tab-pane fade" id="pills-4" role="tabpanel"
                                            aria-labelledby="pills-profile-tab" tabindex="0">
                                            {{-- ตารางค่างวด --}}
                                            @include('DataCompromise.section-NewCompromise.tab-view-TotalInstallment')
                                        </div>
                                        <div class="tab-pane fade" id="pills-2" role="tabpanel"
                                            aria-labelledby="pills-profile-tab" tabindex="0">
                                            {{-- ตารางผ่อนชำระ --}}
                                            @include('DataCompromise.section-NewCompromise.tab-view-TableInstallment')
                                        </div>
                                        <div class="tab-pane fade" id="pills-3" role="tabpanel"
                                            aria-labelledby="pills-contact-tab" tabindex="0">
                                            <div id='content-tracking'>
                                            {{-- บันทึกติดตาม --}}
                                            @include('DataCompromise.section-NewCompromise.tab-view-tracking')
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
    <script>
        $(function() {
            $("#updateAll").click(()=>{

                Swal.fire({
                title: 'ต้องการอัพเดทการชำระ ใช่หรือไม่ ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่ ,ต้องการอัพเดท',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#modal-sm-load').modal('show')
                        $.ajax({
                            url : "{{ route('LawCom.update',0) }}",
                            type : 'put',
                            data : {
                                type : 'updateAll',
                                _token : '{{ csrf_token() }}',
                            },
                            success : (response)=>{
                                $('#modal-sm-load').modal('hide')
                                Swal.fire({
                                icon: 'success',
                                text: 'อัพเดทข้อมูลเรียบร้อย',
                                showConfirmButton: true,
                                showCancelButton: false,  
                                })
                            },
                            error : (err)=>{
                            $('#modal-sm-load').modal('hide')
                            Swal.fire({
                                icon: 'error',
                                title : `ERROR ! ${err.status}`,
                                text: 'อัพเดทข้อมูลไม่สำเร็จ',
                                showConfirmButton: true,
                                showCancelButton: false, 
                                })
                                $("#modal-sm").modal('toggle');

                            }
                        })
                    }
                }) 

            })
           
        })
    </script>

@endsection
