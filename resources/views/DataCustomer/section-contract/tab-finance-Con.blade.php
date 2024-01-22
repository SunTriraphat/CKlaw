@php
    $totalSum = 0;
    $notApproved = 0;
    $Approved = 0;
    foreach ($finance as $key => $item) {
        if ($item->status != 'ยกเลิก') {
            $totalSum = $totalSum + $item->totalsum;
            if ($item->status == 'อนุมัติ') {
                $Approved = $Approved + $item->totalsum;
            } else {
                $notApproved = $notApproved + $item->totalsum;
            }
        }
    }
@endphp

<div class="card col-lg-12">

    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">ยอดเบิกทั้งหมด</th>
                        <td class="text-end">{{ number_format($totalSum, 2) }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-4">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">ยอดอนุมัติ</th>
                        <td class="text-end">{{ number_format($Approved, 2) }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-4">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">ยอดไม่อนุมัติ</th>
                        <td class="text-end">{{ number_format($notApproved, 2) }}</td>
                    </tr>
                </table>
            </div>

        </div>
    </div>

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
                                    @if ($item->status != 'ยกเลิก')
                                        <tr>

                                            <td style="text-align: center;">{{ $item->bil_no }}</td>
                                            <td style="text-align: center;">{{ $item->Date_request }}</td>
                                            <td style="text-align: center;">{{ $item->Date_approved }}</td>
                                            <td style="text-align: center;">{{ $item->Date_cancel_request }}</td>
                                            <td style="text-align: center;">{{ $item->levels }}</td>
                                            <td style="text-align: center;">{{ $item->status }}</td>



                                            <td style="text-align: center;">{{ $item->totalsum }}</td>
                                            <td style="text-align: center;">
                                                {{-- <a href="{{ route('Fin.show', $item->id) }}?type={{ 'showDetail' }}"
                                                type="button"
                                                class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2">
                                                <i class="mdi mdi-plus me-1"></i> ดูรายละเอียด
                                            </a> --}}

                                                <a data-link="{{ route('Fin.show', $item->id) }}?type={{ 'showDetail' }}"
                                                    type="button" data-bs-toggle="modal" data-bs-target="#modal-lg"
                                                    class="btn btn-sm btn-warning btn-rounded waves-effect waves-light mb-2 me-2">
                                                    <i class="fa-solid fa-circle-info"></i> ดูรายละเอียด
                                                </a>
                                                <a href="{{ route('DomPdf.show', $item->id) }}?type={{ 'exportPdf' }}"
                                                    type="button" target="_blank"
                                                    class="btn btn-sm btn-primary btn-rounded waves-effect waves-light mb-2 me-2">
                                                    <i class="fa-solid fa-file-invoice-dollar"></i> ออกบิล
                                                </a>

                                            </td>


                                        </tr>
                                    @endif
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
