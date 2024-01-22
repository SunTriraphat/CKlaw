@extends('layouts.master')
@section('content')
@section('DataCus', 'active')

<div class="row g-1">

    {{-- header content --}}
    <div class="row mb-2 g-1">
        <div class="col-9">
            <h5 class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ฐานข้อมูลลูกค้า (Data Customer)
            </h5>
        </div>
        <div class="col-sm-3">
            <div class="text-sm-end">
                <a data-link="{{ route('Cus.create') }}?type={{ 'Createcus' }}" data-bs-toggle="modal"
                    data-bs-target="#modal-xl" type="button"
                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                    <i class="mdi mdi-plus me-1"></i> เพิ่มลูกค้า
                </a>
            </div>
        </div>
        {{-- <div class="col-3 text-end">
            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-xl" data-link="" class="btn btn-warning btn-sm">สอบถาม <i class="fa-solid fa-magnifying-glass"></i></button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-lg" data-link="{{ route('Cus.create') }}?type={{'importDataCus'}}" class="btn btn-primary btn-sm">นำเข้า <i class="fa-solid fa-file-arrow-down"></i></button>
            <button type="button" class="btn btn-danger btn-sm">ลบ <i class="fa-solid fa-trash-can"></i></button>

        </div> --}}
    </div>


    {{-- left content --}}
    {{-- <div class="col-3">
        @include('DataCustomer.section-cus.Card-Cus')
    </div> --}}

    <div class="card col-lg-2 mr-4 ">
        <div class="card-body">
        <div class="row">
            <a href="{{ route('Cus.index') }}?type={{ 'Datacus' }}"  type="button"
                class="{{$type == 'Datacus' ? 'btn btn-primary' : 'btn btn-outline-primary'}}   btn-rounded waves-effect waves-light mb-2 me-2 ">
                <i class="mdi mdi-plus me-1"></i> ลูกค้าทั้งหมด  <span class="badge badge-danger">{{$countAll}}</span>
            </a>
            <a href="{{ route('Cus.index') }}?type={{ 'Datacus1' }}"  type="button"
                class="{{$type == 'Datacus1' ? 'btn btn-primary' : 'btn btn-outline-primary'}}  btn-rounded waves-effect waves-light mb-2 me-2">
                <i class="mdi mdi-plus me-1"></i> ลูกค้าขั้นฟ้อง  <span class="badge badge-danger">{{$count1}}</span>
            </a>
            <a href="{{ route('Cus.index') }}?type={{ 'Datacus2' }}" type="button"
                class="{{$type == 'Datacus2' ? 'btn btn-primary' : 'btn btn-outline-primary'}} btn-rounded waves-effect waves-light mb-2 me-2">
                <i class="mdi mdi-plus me-1"></i>ลูกค้าขั้นสืบพยาน  <span class="badge badge-danger">{{$count2}}</span>
            </a>
            <a href="{{ route('Cus.index') }}?type={{ 'Datacus3' }}"  type="button"
                class="{{$type == 'Datacus3' ? 'btn btn-primary' : 'btn btn-outline-primary'}} btn-rounded waves-effect waves-light mb-2 me-2">
                <i class="mdi mdi-plus me-1"></i> ลูกค้าขั้นส่งบังคับ  <span class="badge badge-danger">{{$count3}}</span>
            </a>
            <a href="{{ route('Cus.index') }}?type={{ 'Datacus4' }}"  type="button"
                class="{{$type == 'Datacus4' ? 'btn btn-primary' : 'btn btn-outline-primary'}} btn-rounded waves-effect waves-light mb-2 me-2">
                <i class="mdi mdi-plus me-1"></i> ลูกค้าขั้นตรวจผลหมาย  <span class="badge badge-danger">{{$count4}}</span>
            </a>
            <a href="{{ route('Cus.index') }}?type={{ 'Datacus5' }}" type="button"
                class="{{$type == 'Datacus5' ? 'btn btn-primary' : 'btn btn-outline-primary'}} btn-rounded waves-effect waves-light mb-2 me-2">
                <i class="mdi mdi-plus me-1"></i> ลูกค้าขั้นตั้งเจ้าพนักงาน  <span class="badge badge-danger">{{$count5}}</span>
            </a><a href="{{ route('Cus.index') }}?type={{ 'Datacus6' }}" type="button"
                class="{{$type == 'Datacus6' ? 'btn btn-primary' : 'btn btn-outline-primary'}} btn-rounded waves-effect waves-light mb-2 me-2">
                <i class="mdi mdi-plus me-1"></i> ลูกค้าขั้นตั้งผลหมายตั้ง  <span class="badge badge-danger">{{$count6}}</span>
            </a>
        </div>
    </div>
    </div>
    <div class="card col-lg-9">
        <div class="card-body">
            <div class="table-responsive" style="overflow-x:hidden">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                    <div class="row">
                        <div class="col-sm-12">

                            <table id="dailytable"
                                class="table dailytable table-hover Custable nowrap dataTable no-footer dtr-inline">
                                <thead>
                                    <tr role="row">
                                        <th style="text-align: center;">เลขที่สัญญา</th>
                                        <th style="text-align: center;">ชื่อ-สกุล</th>
                                        <th style="text-align: center;">ประเภทคดี</th>
                                        <th style="text-align: center;">สถานะ</th>
                                        <th style="text-align: center;">ดูรายละเอียด</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>

                                            <td style="text-align: center;">{{ $item->CON_NO }}</td>
                                            <td style="text-align: center;">{{ $item->name }} {{ $item->surname }}
                                            </td>
                                            <td style="text-align: center;">ฟ้อง{{ $item->case_type }}</td>
                                            <td style="text-align: center;">{{ $item->status }}</td>
                                            <td style="text-align: center;">
                                                <a href="{{ route('Law.show', $item->id) }}?type={{ 'showCus' }}"
                                                    type="button"
                                                    class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2">
                                                    <i class="mdi mdi-plus me-1"></i> ดูรายละเอียด
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <script>
        $(function() {
            $(".Custable").DataTable({
                "responsive": false,
                "autoWidth": false,
                "ordering": true,
                "lengthChange": true,
                "order": [
                    [0, "asc"]
                ],
                "pageLength": 5,
                "scrollX": true,
            });
        })
    </script>

</div>


@endsection
