
@extends('layouts.master')
@section('content')
<div class="row g-1">

    {{-- header content --}}
    <div class="row mb-2 g-1">
        <div class="col-9">
            <h5 class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> รายการทั้งหมด
            </h5>
        </div>

        <div class="col-sm-3">
            <div class="text-sm-end">
                <a class="btn btn-danger btn-rounded waves-effect waves-light mb-2 me-2" href="{{ route('Fin.index') }}?type={{ 'LawFinFuture' }}" > ย้อนกลับ</a>
   
            </div>
        </div>

    </div>


</div>
<div class="card col-lg-12">
    <div class="card-body">
        <div class="table-responsive" style="overflow-x:hidden">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="Fintable" class="table table-hover  nowrap ">
                            <thead>
                                <tr role="row">
                                    <th style="text-align: center;">เลขบิล</th>
                                    {{-- <th style="text-align: center;">ชื่อ-สกุล</th> --}}
                                    <!-- <th style="text-align: center;">ประเภทคดี</th>  -->
                                    <th style="text-align: center;">วันที่ขอเบิก</th>
                                    <th style="text-align: center;">วันที่อนุมัติ</th>
                                    <th style="text-align: center;">วันขอยกเลิก</th>
                                    <th style="text-align: center;">ขั้น</th>
                                    <th style="text-align: center;">สถานะ</th>
                                    <th style="text-align: center;">ยอดเบิกทั้งหมด</th>
                                    <th style="text-align: center;">ดูรายละเอียด</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($finance as $key => $item)
                                    
                                        <tr>

                                            <td style="text-align: center;">{{ $item->bil_no }}</td>
                                            <td style="text-align: center;">{{ $item->Date_request }}</td>
                                            <td style="text-align: center;">{{ $item->Date_approved }}</td>
                                            <td style="text-align: center;">{{ $item->Date_cancel_request }}</td>
                                            <td style="text-align: center;">{{ $item->levels }}</td>
                                            <td style="text-align: center;">{{ $item->status }}</td>



                                            <td style="text-align: center;">{{ $item->totalsum }}</td>
                                            <td style="text-align: center;">
                                               
                                                <a data-link="{{ route('Fin.show', $item->id) }}?type={{ 'showDetail' }}"
                                                    type="button" data-bs-toggle="modal" data-bs-target="#modal-lg"
                                                    class="btn btn-sm btn-warning btn-rounded waves-effect waves-light mb-2 me-2">
                                                    <i class="fa-solid fa-circle-info"></i> ดูรายละเอียด
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
    $(document).ready(function() {
        $("#Fintable").DataTable({
            "responsive": false,
            "autoWidth": false,
            "ordering": true,
            "lengthChange": true,
            "order": [
                [0, "asc"]
            ],
            "pageLength": 5,
        });
    });
    // $(function() {
    //     $("#Fintable").DataTable({
    //         "responsive": false,
    //         "autoWidth": false,
    //         "ordering": true,
    //         "lengthChange": true,
    //         "order": [
    //             [0, "asc"]
    //         ],
    //         "pageLength": 5,

    //     });
    // })
</script>

@endsection