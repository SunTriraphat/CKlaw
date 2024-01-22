@extends('layouts.master')
@section('content')
@section('execution', 'active')

<div class="row g-1">

    {{-- header content --}}
    <div class="row mb-2 g-1">
        <div class="col-9">
            <h5 class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> รายงานตามหนี้
            </h5>
        </div>

        <div class="col-2 ml-5">
            <div class="text-sm-end">
                <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal"
                    data-bs-target="#modal-md" data-link="{{ route('Exe.create') }}?type={{ 'ExportExcelExe' }}">
                    <i class="fa-solid fa-download"></i> Export
                </a>
            </div>
        </div>

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
                                        {{-- <th style="text-align: center;">ประเภทคดี</th> --}}
                                        <th style="text-align: center;">ค้างกี่งวด</th>

                                        <th style="text-align: center;">ดูรายละเอียด</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        {{ $item->ViewComToInstall }}
                                        <tr>
                                            <td style="text-align: center;">{{ @$item->CON_NO }} </td>
                                            <td style="text-align: center;">{{ @$item->name }}
                                                {{ @$item->surname }}
                                            </td>
                                            <td style="text-align: center;">
                                                {{ count(@$item->ViewComToInstall) }}
                                            </td>


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
