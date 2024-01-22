@extends('layouts.master')
@section('content')
@section('OldCompro', 'active')



<div class="row">

    {{-- header content --}}
    <div class="row mb-2">
        <div class="col-9">
            <h5 class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ชั้นศาล (Data Contracts)</h5>
        </div>
        <div class="col-3 text-end">
            <button type="button" class="btn btn-warning btn-sm">ส่งฟ้อง <i class="fa-solid fa-scale-balanced"></i></button>
            <button type="button" class="btn btn-danger btn-sm">ลบ <i class="fa-solid fa-trash-can"></i></button>

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
                        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> สัญญาที่ครอบครอง (Contracts)</span>
                        <button type="button" class="btn-sm float-end btn btn-light rounded-circle"><i class="fa-solid fa-pen-to-square"></i></button>
                      </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col">
                                <h4>ประเภทสัญญา</h4>
                                <h6>202320242025</h6>
                            </div>
                            <div class="col text-center">
                                <h3>ลูกหนี้ <span class="text-danger">ประนอมหนี้(เก่า) <i class="fa-solid fa-scale-balanced"></i></span></h3>
                                <h6>Content</h6>
                                <div class="progress" style="height:10px;">
                                    <div class="progress-bar bg-danger" role="progressbar" aria-label="Example with label" style="width: 25%; " aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                            </div>
                            <div class="col text-end">
                                <h4>วันที่ฟ้อง</h4>
                                <h6>Content</h6>
                            </div>
                        </div>
                        <div class="row">

                                <div class="nav nav-pills mb-3 row" id="pills-tab" role="tablist" style="text-align: -webkit-center;">
                                    <div class="d-flex pb-2" style="overflow:auto;">
                                        <div class="nav-item col d-grid" role="presentation">
                                        <button class="nav-link active " id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                            <div class="col-12 mb-1"><i class="fa-regular fa-circle-check fa-xl text-success"></i></div>
                                            <div class="col-12">ฟ้อง</div>

                                        </button>
                                        </div>
                                        <div class="nav-item col" role="presentation">
                                          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                            <div class="col-12 mb-1"><i class="fa-regular fa-circle-check fa-xl text-warning"></i></div>
                                            <div class="col-12  text-nowrap">สืบพยาน</div>
                                         </button>

                                        </div>
                                        <div class="nav-item col" role="presentation">
                                          <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-3" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                                            <div class="col-12 mb-1"><i class="fa-regular fa-circle-check fa-xl text-secondary"></i></div>
                                            <div class="col-12  text-nowrap">ส่งคำบังคับ</div>
                                        </button>

                                        </div>
                                        <div class="nav-item col" role="presentation">
                                          <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-4" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" >
                                            <div class="col-12 mb-1"><i class="fa-regular fa-circle-check fa-xl text-secondary"></i></div>
                                            <div class="col-12  text-nowrap">ตรวจผลหมาย</div></button>

                                        </div>
                                        <div class="nav-item col" role="presentation">
                                        <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-5" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" >
                                            <div class="col-12 mb-1"><i class="fa-regular fa-circle-check fa-xl text-secondary"></i></div>
                                            <div class="col-12  text-nowrap">ตั้งเจ้าพนักงาน</div></button>

                                        </div>
                                          <div class="nav-item col" role="presentation">
                                            <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-6" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" >
                                                <div class="col-12 mb-1"><i class="fa-regular fa-circle-check fa-xl text-secondary"></i></div>
                                                <div class="col-12 text-nowrap">ต.ผลหมายตั้ง</div>
                                            </button>

                                          </div>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                        {{-- ฟ้อง --}}
                                        @include('DataLawsuit.section-court.tab-view-indict')
                                    </div>
                                    <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                        {{-- สืบพยาน --}}
                                        @include('DataLawsuit.section-court.tab-view-pursue')
                                    </div>
                                    <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                                        {{-- ส่งคำบังคับ --}}
                                        @include('DataLawsuit.section-court.tab-view-sendCommand')
                                    </div>
                                    <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">
                                        {{-- ตรวจผลหมาย --}}
                                        @include('DataLawsuit.section-court.tab-view-examine')
                                    </div>
                                    <div class="tab-pane fade" id="pills-5" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">
                                        {{-- ตั้งเจ้าพนักงาน --}}
                                        @include('DataLawsuit.section-court.tab-view-setStaff')
                                    </div>
                                    <div class="tab-pane fade" id="pills-6" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">
                                        {{-- ต.ผลหมายตั้ง --}}
                                        @include('DataLawsuit.section-court.tab-view-checkResult')
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
