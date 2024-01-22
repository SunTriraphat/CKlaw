@extends('layouts.master')
@section('content')
@section('DataCourt', 'active')

<style>
    .nav-pills {
        --bs-nav-pills-border-radius: 0.375rem;
        --bs-nav-pills-link-active-color: #fff;
    }

    .nav {

        --bs-nav-link-color: green;

    }
</style>



<div class="row">


    {{-- header content --}}
    <div class="row mb-2">

        <div class="col-6">
            <h5 class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ชั้นศาล (Data Contracts)

            </h5>

        </div>
        <div class="col-sm-6">
            <div class="text-sm-end">
                <a href="{{ route('Cus.show', $data->cus_id) }}?type={{ 'showDetail' }}" type="button"
                    class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2">
                    <i class="mdi mdi-plus me-1"></i> ข้อมูลลูกค้า
                </a>
                {{-- <a href="{{ route('Cus.show', $data->cus_id) }}?type={{ 'statusClose' }}" type="button"
                    data-bs-toggle="modal" data-bs-target="#modal-sm"
                    class="btn btn-danger btn-rounded waves-effect waves-light mb-2 me-2">
                    <i class="mdi mdi-plus me-1"></i> ปิดบัญชี
                </a> --}}
                @if(@$data->debt_balance != NULL)
                <a data-link="{{ route('Law.show', $data->cus_id) }}?type={{ 'statusClose' }}" type="button"
                    data-bs-toggle="modal" data-bs-target="#modal-sm"
                    class="btn  btn-danger btn-rounded waves-effect waves-light mb-2 me-2">
                     ปิดบัญชี
                </a>
                @endif
                @if (@$data->witness_status == 'ทำยอม' || @$data->witness_status == 'พิพากษา')
                    <a href="{{ route('LawCom.show', $data->cus_id) }}?type={{ 'NewCompro' }}" type="button"
                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i> ประนอมหนี้
                    </a>
                @endif

                @if ($data->TribunalToCus->status_exe == 'Y' )
                    <a type="button" href="{{ route('Exe.show', $data->cus_id) }}?type={{ 'showExe' }}"
                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i> ข้อมูลชั้นบังคับคดี
                    </a>
                    @endif
                @if( $data->withdraw == 'Y')
                    <a data-link="{{ route('Cus.show', $data->cus_id) }}?type={{ 'EditTribunalStatus' }}" type="button"
                        data-bs-toggle="modal" data-bs-target="#modal-sm"
                        class="btn  btn-warning btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="fa-solid fa-scale-balanced"></i> ส่งฟ้องใหม่
                    </a>
                @endif
            </div>

        </div>


        <div class="col-3 text-end">
            {{-- @foreach ($data as $key => $data)
                <div class="text-sm-end">
                    <a data-link="{{ route('Cus.show', $data->id) }}?type={{ 'Editcus' }}" data-bs-toggle="modal"
                        data-bs-target="#modal-xl" type="button"
                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i> แก้ไขข้อมูล
                    </a>
                </div>
            @endforeach --}}
            {{-- <button type="button" class="btn btn-warning btn-sm">ส่งฟ้อง <i
                    class="fa-solid fa-scale-balanced"></i></button>
            <button type="button" class="btn btn-danger btn-sm">ลบ <i class="fa-solid fa-trash-can"></i></button> --}}

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
                                'typeloan' => $data->case_type,
                                'code' => $data->TribunalToCus->CON_NO,
                                'statusLaw' => 'ชั้นศาล',
                                'txtprogress' => 'content',
                                'txtdateLaw' => 'วันที่ศาลรับฟ้อง',
                                'dateLaw' => $data->date_tribunal,
                                ])
                            @endcomponent


                            <div class="row">


                                <div class="nav nav-pills mb-3 row" id="pills-tab" role="tablist"
                                    style="text-align: -webkit-center;">
                                    <div class="d-flex pb-2" style="overflow:auto;">
                                        <div class="nav-item col d-grid" role="presentation">
                                            <button class="nav-link {{ $data->status == 'ขั้นฟ้อง' ? 'active ' : '' }} "
                                                id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-1"
                                                type="button" role="tab" aria-controls="pills-home"
                                                {{ $dataStatus->status_1 == 'Y' ? '' : 'disabled' }}>
                                                <div class="col-12 mb-1">
                                                    @if ($dataStatus->status_1 == 'Y' && $dataStatus->status_2 == 'Y')
                                                        <i class="fa-regular fa-circle-check fa-xl "></i>
                                                    @else
                                                        <i
                                                            class="fa-regular fa-circle-xmark fa-xl {{ $dataStatus->status_1 == 'Y' ? 'text-warning fa-exclamation' : 'text-secondary fa-circle-xmark' }} "></i>
                                                    @endif
                                                </div>
                                                <div class="col-12">ฟ้อง</div>

                                            </button>
                                        </div>
                                        <div class="nav-item col" role="presentation">
                                            <button class="nav-link {{ $data->status == 'ขั้นสืบพยาน' ? 'active' : '' }}"
                                                id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-2"
                                                type="button" role="tab" aria-controls="pills-profile"
                                                {{ $dataStatus->status_2 == 'Y' ? '' : 'disabled' }}>
                                                <div class="col-12 mb-1">
                                                    @if ($dataStatus->status_2 == 'Y' && $dataStatus->status_3 == 'Y')
                                                        <i class="fa-regular fa-circle-check fa-xl "></i>
                                                    @else
                                                        <i
                                                            class="fa-regular fa-circle-xmark fa-xl {{ $dataStatus->status_2 == 'Y' ? 'text-warning fa-exclamation' : 'text-secondary fa-circle-xmark' }} "></i>
                                                    @endif
                                                </div>
                                                <div class="col-12  text-nowrap">สืบพยาน</div>
                                            </button>

                                        </div>
                                        <div class="nav-item col" role="presentation">
                                            <button
                                                class="nav-link {{ $data->status == 'ขั้นส่งคำบังคับ' ? 'active' : '' }}"
                                                id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-3"
                                                type="button" role="tab" aria-controls="pills-contact"
                                                {{ $dataStatus->status_3 == 'Y' ? '' : 'disabled' }}>

                                                <div class="col-12 mb-1">
                                                    @if ($dataStatus->status_3 == 'Y' && $dataStatus->status_4 == 'Y')
                                                        <i class="fa-regular fa-circle-check fa-xl "></i>
                                                    @else
                                                        <i
                                                            class="fa-regular fa-circle-xmark fa-xl {{ $dataStatus->status_3 == 'Y' ? 'text-warning fa-exclamation' : 'text-secondary fa-circle-xmark' }} "></i>
                                                    @endif


                                                </div>
                                                <div class="col-12  text-nowrap">ส่งคำบังคับ</div>
                                            </button>

                                        </div>
                                        {{-- <div class="nav-item col" role="presentation">
                                                    <button
                                                        class="nav-link {{ $data->status == 'ขั้นตรวจผลหมาย' ? 'active' : '' }}"
                                                        id="pills-disabled-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-4" type="button" role="tab"
                                                        aria-controls="pills-disabled" aria-selected="false"
                                                        {{ $dataStatus->status_4 == 'Y' ? '' : 'disabled' }}>
                                                        <div class="col-12 mb-1">
                                                            @if ($dataStatus->status_4 == 'Y' && $dataStatus->status_5 == 'Y')
                                                                <i class="fa-regular fa-circle-check fa-xl "></i>
                                                            @else
                                                                <i
                                                                    class="fa-regular fa-xl {{ $dataStatus->status_4 == 'Y' ? 'text-warning fa-exclamation' : 'text-secondary fa-circle-xmark' }} "></i>
                                                            @endif
                                                        </div>
                                                        <div class="col-12  text-nowrap">ตรวจผลหมาย</div>
                                                    </button>

                                                </div> --}}
                                        <div class="nav-item col" role="presentation">
                                            <button
                                                class="nav-link {{ $data->status == 'ขั้นตั้งเจ้าพนักงาน' || $data->status == 'ชั้นบังคับคดี' ? 'active' : '' }}"
                                                id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-5"
                                                type="button" role="tab" aria-controls="pills-disabled"
                                                aria-selected="false" {{ $dataStatus->status_4 == 'Y' ? '' : 'disabled' }}>
                                                <div class="col-12 mb-1">
                                                    @if ($dataStatus->status_4 == 'Y' && $dataStatus->class_execution == 'Y')
                                                        <i class="fa-regular fa-circle-check fa-xl "></i>
                                                    @else
                                                        <i
                                                            class="fa-regular fa-circle-xmark fa-xl {{ $dataStatus->status_4 == 'Y' ? 'text-warning fa-exclamation' : 'text-secondary fa-circle-xmark' }} "></i>
                                                    @endif
                                                </div>
                                                <div class="col-12  text-nowrap">ตั้งเจ้าพนักงาน</div>
                                            </button>

                                        </div>
                                        {{-- <div class="nav-item col" role="presentation">
                                                    <button
                                                        class="nav-link {{ $data->status == 'ขั้นต.ผลหมายตั้ง' || $data->status == 'ชั้นบังคับคดี' ? 'active' : '' }}"
                                                        id="pills-disabled-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-6" type="button" role="tab"
                                                        aria-controls="pills-disabled" aria-selected="false"
                                                        {{ $dataStatus->status_6 == 'Y' ? '' : 'disabled' }}>
                                                        <div class="col-12 mb-1">
                                                            @if ($dataStatus->status_6 == 'Y' && $dataStatus->class_execution == 'Y')
                                                                <i class="fa-regular fa-circle-check fa-xl "></i>
                                                            @else
                                                                <i
                                                                    class="fa-regular fa-circle-xmark fa-xl  {{ $dataStatus->status_6 == 'Y' ? 'text-warning fa-exclamation' : 'text-secondary fa-circle-xmark' }} "></i>
                                                            @endif
                                                        </div>
                                                        <div class="col-12 text-nowrap">ต.ผลหมายตั้ง</div>
                                                    </button>

                                                </div> --}}
                                    </div>
                                </div>

                                <hr>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade {{ $data->status == 'ขั้นฟ้อง' ? 'show active' : '' }} "
                                        id="pills-1" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                        {{-- ฟ้อง --}}
                                        <div id='content-indict'>
                                            @include('DataLawsuit.section-court.tab-view-indict')
                                        </div>
                                    </div>
                                    <div class="tab-pane fade {{ $data->status == 'ขั้นสืบพยาน' ? 'show active' : '' }} "
                                        id="pills-2" role="tabpanel" aria-labelledby="pills-profile-tab"
                                        tabindex="0">
                                        {{-- สืบพยาน --}}
                                        <div id='content-pursue'>
                                            @include('DataLawsuit.section-court.tab-view-pursue')
                                        </div>
                                    </div>
                                    <div class="tab-pane fade {{ $data->status == 'ขั้นส่งคำบังคับ' ? 'show active' : '' }} "
                                        id="pills-3" role="tabpanel" aria-labelledby="pills-contact-tab"
                                        tabindex="0">
                                        {{-- ส่งคำบังคับ --}}
                                        <div id='content-sendCommand'>
                                            @include('DataLawsuit.section-court.tab-view-sendCommand')
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane fade {{ $data->status == 'ขั้นตรวจผลหมาย' ? 'show active' : '' }}"
                                        id="pills-4" role="tabpanel" aria-labelledby="pills-disabled-tab"
                                        tabindex="0">
                                        ตรวจผลหมาย
                                        @include('DataLawsuit.section-court.tab-view-examine')
                                    </div> --}}
                                    <div class="tab-pane fade {{ $data->status == 'ขั้นตั้งเจ้าพนักงาน' || $data->status == 'ชั้นบังคับคดี' ? 'show active' : '' }}"
                                        id="pills-5" role="tabpanel" aria-labelledby="pills-disabled-tab"
                                        tabindex="0">
                                        {{-- ตั้งเจ้าพนักงาน --}}
                                        <div id='content-setStaff'>
                                            @include('DataLawsuit.section-court.tab-view-setStaff')
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane fade {{ $data->status == 'ขั้นต.ผลหมายตั้ง' || $data->status == 'ชั้นบังคับคดี' ? 'show active' : '' }}"
                                        id="pills-6" role="tabpanel" aria-labelledby="pills-disabled-tab"
                                        tabindex="0">
                                        ต.ผลหมายตั้ง
                                        @include('DataLawsuit.section-court.tab-view-checkResult')
                                    </div> --}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
