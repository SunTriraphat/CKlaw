@extends('layouts.master')
@section('content')
@section('execution', 'active')



<div class="row">

    {{-- header content --}}

    <div class="row mb-2">
        <div class="col-4">
            <h5 class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ชั้นบังคับคดี 
               
            
            </h5>
           
        </div>

        <div class="col-8 text-end">
           
            <a href="{{ route('Cus.show', $data->cus_id) }}?type={{ 'showDetail' }}" type="button"
                class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2">
                <i class="mdi mdi-plus me-1"></i> ข้อมูลลูกค้า
                
            </a>
            
            @if($data->ExecutionToCus->status_close != 'Y')
            <a data-link="{{ route('Exe.show', $data->cus_id) }}?type={{ 'statusClose' }}" type="button"
                data-bs-toggle="modal" data-bs-target="#modal-sm"
                class="btn btn-danger btn-rounded waves-effect waves-light mb-2 me-2">
                <i class="mdi mdi-plus me-1"></i> ปิดบัญชี
            </a>
           
            @endif
            @if (@$dataStatus->status_3 == 'Y' || @$dataStatus->status_4 == 'Y')
                <a href="{{ route('LawCom.show', $data->cus_id) }}?type={{ 'NewCompro' }}" type="button"
                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                    ประนอมหนี้
                </a>
            @endif

        

            <a href="{{ route('Law.show', $data->cus_id) }}?type={{ 'showCus' }}" type="button"
                class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                ข้อมูลชั้นศาล
            </a>
            <a data-link="{{ route('Exe.show', $data->cus_id) }}?type={{ 'NewExe' }}" type="button"
                data-bs-toggle="modal" data-bs-target="#modal-sm"
                class="btn btn-warning btn-rounded waves-effect waves-light mb-2 me-2">
                <i class="fa-solid fa-scale-balanced"></i> ส่งสืบทรัพย์ใหม่
            </a>
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

                        @php
                            $closeStatus = '';
                            if($data->ExecutionToCus->status_close == 'Y'){
                                $closeStatus = '(ปิดบัญชีแล้ว)';
                            }
                        @endphp
                        @component('components.content-other.title-detail')
                            @slot('data', [
                                'typeloan' => $Tribunal->case_type,
                                'code' => $Tribunal->TribunalToCus->CON_NO,
                                'statusLaw' => 'ชั้นบังคับคดี',
                                'txtprogress' => 'content',
                                'txtdateLaw' => 'วันที่ศาลรับฟ้อง',
                                'dateLaw' => $Tribunal->date_tribunal,
                                'closeStatus' => $closeStatus
                                ])
                            @endcomponent

                            <div class="row">
                               
                                <div class="nav nav-pills mb-3 row " id="pills-tab" role="tablist"
                                    style="text-align: -webkit-center; ">
                                    <div class="d-flex pb-2">
                                        {{-- <div class="nav-item col d-grid" role="presentation">
                                            <button class="nav-link active " id="pills-home-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-1" type="button" role="tab"
                                                aria-controls="pills-home" aria-selected="true">
                                                <div class="col-12 mb-1"><i
                                                        class="fa-regular fa-circle-check fa-xl text-success"></i></div>
                                                <div class="col-12 text-nowrap">คัดหนังสือรับรองคดี</div>

                                            </button>
                                        </div> --}}
                                        <div class="nav-item col" role="presentation">
                                            <button
                                                class="nav-link {{ $data->status == 'ขั้นสืบทรัพย์' ? 'active ' : '' }} "
                                                id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-2"
                                                type="button" role="tab" aria-controls="pills-profile"
                                                aria-selected="false"
                                                {{ @$dataStatus->status_1 == 'Y' ? '' : 'disabled' }}>
                                                <div class="col-12 mb-1">
                                                    @if (@$dataStatus->status_1 == 'Y' && @$dataStatus->status_2 == 'Y')
                                                        <i class="fa-regular fa-circle-check fa-xl "></i>
                                                    @else
                                                        <i
                                                            class="fa-regular fa-circle-xmark fa-xl {{ @$dataStatus->status_1 == 'Y' ? 'text-warning fa-exclamation' : 'text-secondary fa-circle-xmark' }} ">
                                                        </i>
                                                    @endif
                                                </div>

                                                <div class="col-12  text-nowrap">สืบทรัพย์(บังคับคดี)</div>
                                            </button>

                                        </div>
                                        <div class="nav-item col" role="presentation">
                                            <button class="nav-link {{ $data->status == 'ขั้นคัดโฉนด' ? 'active ' : '' }} "
                                                id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-3"
                                                type="button" role="tab" aria-controls="pills-contact"
                                                aria-selected="false"
                                                {{ @$dataStatus->status_2 == 'Y' ? '' : 'disabled' }}>
                                                <div class="col-12 mb-1">
                                                    @if (@$dataStatus->status_2 == 'Y' && @$dataStatus->status_3 == 'Y')
                                                        <i class="fa-regular fa-circle-check fa-xl "></i>
                                                    @else
                                                        <i
                                                            class="fa-regular fa-circle-xmark fa-xl {{ @$dataStatus->status_2 == 'Y' ? 'text-warning fa-exclamation' : 'text-secondary fa-circle-xmark' }} ">
                                                        </i>
                                                    @endif
                                                </div>

                                                <div class="col-12  text-nowrap">คัดโฉนด/ถ่ายภาพ</div>
                                            </button>
                                        </div>
                                        <div class="nav-item col" role="presentation">
                                            <button
                                                class="nav-link {{ $data->status == 'ขั้นตั้งเรื่องยึดทรัพย์' ? 'active ' : '' }}"
                                                id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-4"
                                                type="button" role="tab" aria-controls="pills-disabled"
                                                aria-selected="false"
                                                {{ @$dataStatus->status_3 == 'Y' ? '' : 'disabled' }}>
                                                <div class="col-12 mb-1">
                                                    @if (@$dataStatus->status_3 == 'Y' && @$dataStatus->status_4 == 'Y')
                                                        <i class="fa-regular fa-circle-check fa-xl "></i>
                                                    @else
                                                        <i
                                                            class="fa-regular fa-circle-xmark fa-xl {{ @$dataStatus->status_3 == 'Y' ? 'text-warning fa-exclamation' : 'text-secondary fa-circle-xmark' }} ">
                                                        </i>
                                                    @endif
                                                </div>

                                                <div class="col-12  text-nowrap">ตั้งเรื่องยึดทรัพย์</div>
                                            </button>
                                        </div>
                                        <div class="nav-item col" role="presentation">
                                            <button
                                                class="nav-link {{ $data->status == 'ขั้นประกาศขายทอดตลาด' ? 'active ' : '' }}"
                                                id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-5"
                                                type="button" role="tab" aria-controls="pills-disabled"
                                                aria-selected="false"
                                                {{ @$dataStatus->status_4 == 'Y' ? '' : 'disabled' }}>
                                                <div class="col-12 mb-1">
                                                    @if (@$dataStatus->status_4 == 'Y' && @$dataStatus->status_5 == 'Y')
                                                        <i class="fa-regular fa-circle-check fa-xl "></i>
                                                    @else
                                                        <i
                                                            class="fa-regular fa-circle-xmark fa-xl {{ @$dataStatus->status_4 == 'Y' ? 'text-warning fa-exclamation' : 'text-secondary fa-circle-xmark' }} ">
                                                        </i>
                                                    @endif
                                                </div>

                                                <div class="col-12  text-nowrap">ประกาศขายทอดตลาด</div>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="tab-content" id="pills-tabContent">


                                    {{-- <div class="tab-pane fade show active" id="pills-1" role="tabpanel"
                                        aria-labelledby="pills-home-tab" tabindex="0">
                                        
                                        <div id='content-select-case'>
                                            @include('DataLawsuit.section-execution.tab-view-select-case')
                                        </div>
                                    </div> --}}
                                    <div class="tab-pane fade  {{ $data->status == 'ขั้นสืบทรัพย์' ? 'show active' : '' }}"
                                        id="pills-2" role="tabpanel" aria-labelledby="pills-profile-tab"
                                        tabindex="0">
                                        {{-- สืบพยาน --}}
                                        <div id='content-investigate'>
                                            @include('DataLawsuit.section-execution.tab-view-investigate')
                                        </div>
                                    </div>
                                    <div class="tab-pane fade  {{ $data->status == 'ขั้นคัดโฉนด' ? 'show active' : '' }}"
                                        id="pills-3" role="tabpanel" aria-labelledby="pills-contact-tab"
                                        tabindex="0">
                                        {{-- ส่งคำบังคับ --}}
                                        <div id='content-select-deed'>
                                            @include('DataLawsuit.section-execution.tab-view-select-deed')
                                        </div>
                                    </div>
                                    <div class="tab-pane fade  {{ $data->status == 'ขั้นตั้งเรื่องยึดทรัพย์' ? 'show active' : '' }}"
                                        id="pills-4" role="tabpanel" aria-labelledby="pills-disabled-tab"
                                        tabindex="0">
                                        {{-- ตรวจผลหมาย --}}
                                        <div id='content-confiscation'>
                                            @include('DataLawsuit.section-execution.tab-view-confiscation')
                                        </div>
                                    </div>
                                    <div class="tab-pane fade  {{ $data->status == 'ขั้นประกาศขายทอดตลาด' ? 'show active' : '' }}"
                                        id="pills-5" role="tabpanel" aria-labelledby="pills-disabled-tab"
                                        tabindex="0">
                                        {{-- ตั้งเจ้าพนักงาน --}}
                                        <div id='content-announce'>
                                            @include('DataLawsuit.section-execution.tab-view-announce')
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

@endsection
