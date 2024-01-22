@extends('layouts.master')
@section('content')
@section('execution', 'active')

<div class="row g-1">

    {{-- header content --}}
    <div class="row mb-2 g-1">
        <div class="col-3">
            <h5 class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ฐานข้อมูลลูกค้าประนอมหนี้
            </h5>
        </div>

        <div class="col-6">
            <div class="container mb-2">
                <form method="get" action="{{ route('LawCom.index') }}">
                    <div class="row g-2">
                        {{-- <div class="col-xl">
                            <select class="form-select" name="type_time" id="">
                                <option value="exe_date" {{ @$type_time == 'exe_date' ? 'selected' : '' }}>วันที่ส่งบังคับคดี</option>
                                <option value="date_confiscation" {{ @$type_time == 'date_confiscation' ? 'selected' : '' }}>วันที่ตั้งเรื่องยึดทรัพย์</option>
                                <option value="date_announce_first" {{ @$type_time == 'date_announce_first' ? 'selected' : '' }}>วันขายทอดตลาด</option>
                                
                            </select>
                        </div> --}}
                        <div class="col-xl">
                            <input type="date" value="{{@$dateStart}}"
                                class="form-control rounded-pill border border-0 shadow-sm" name = "dateStart">
                        </div>
                        <div class="col-xl">
                            <input type="date" value="{{@$dateEnd}}"
                                class="form-control rounded-pill border border-0 shadow-sm" name = "dateEnd">
                            <input type="hidden" value="{{@$type}}"
                                class="form-control rounded-pill border border-0 shadow-sm" name = "type">
                        </div>
                        <div class="col-xl col-md col-lg col-sm-12 d-grid gap-2">
                            <input type="submit" class="btn btn-primary rounded-pill" value="แสดง" />
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-2 ml-3">
            <div class="text-sm-end">
                <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal"
                    data-bs-target="#modal-md" data-link="{{ route('Exe.create') }}?type={{ 'ExportExcelExe' }}">
                    <i class="fa-solid fa-download"></i> Export
                </a>
                <a data-link="{{ route('Tracking.create') }}?type={{ 'shareTrack' }}" data-bs-toggle="modal"
                    data-bs-target="#modal-xl" type="button"
                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                    <i class="mdi mdi-plus me-1"></i> แบ่งทีมตาม
                </a>
            </div>
        </div>
        {{-- <div class="col-sm-3">
            <div class="text-sm-end">
                <a data-link="{{ route('Tracking.create') }}?type={{ 'shareTrack' }}" data-bs-toggle="modal"
                    data-bs-target="#modal-xl" type="button"
                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                    <i class="mdi mdi-plus me-1"></i> แบ่งทีมตาม
                </a>
            </div>
        </div> --}}
        {{-- <div class="col-3 text-end">
            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-xl" data-link="" class="btn btn-warning btn-sm">สอบถาม <i class="fa-solid fa-magnifying-glass"></i></button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-lg" data-link="{{ route('Cus.create') }}?type={{'importDataCus'}}" class="btn btn-primary btn-sm">นำเข้า <i class="fa-solid fa-file-arrow-down"></i></button>
            <button type="button" class="btn btn-danger btn-sm">ลบ <i class="fa-solid fa-trash-can"></i></button>

        </div> --}}
    </div>


   
    <div class="card col-lg-12">
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
                                        <th style="text-align: center;">ชำระล่าสุด</th>
                                        <th style="text-align: center;">จำนวนงวดค้าง</th>
                                        <th style="text-align: center;">ทีมตาม</th>
                                        <th style="text-align: center;">ดูรายละเอียด</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td style="text-align: center;">{{ @$item->CON_NO }} </td>
                                            <td style="text-align: center;">{{ @$item->name }} {{ @$item->surname }}</td>
                                            <td style="text-align: center;">{{ @$item->ViewComToFin->pay_date }} </td>
                            
                                            
                                        
                                            <td style="text-align: center;">
                                                {{ Carbon\Carbon::parse(@$dataInstall->where('com_id', @$item->com_id)->where('totalSum', '!=', '0')->first()->due_date)->DiffInMonths($today) }}
                                            </td>
                                            <td style="text-align: center;">{{@$item->ViewComToTeamFollow->name}}</td>
                                            <td style="text-align: center;">
                                               
                                                <a href="{{ route('LawCom.show', $item->cus_id) }}?type={{ 'NewCompro' }}"
                                                    type="button"
                                                    class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2">
                                                    ดูรายละเอียด
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
