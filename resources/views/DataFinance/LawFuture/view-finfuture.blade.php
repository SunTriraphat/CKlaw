@extends('layouts.master')
@section('content')
@section('DataCus', 'active')

<div class="row g-1">

    {{-- header content --}}
    <div class="row mb-2 g-1">
        <div class="col-9">
            <h5 class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i>รายการเบิกล่วงหน้า
            </h5>
        </div>

        <div class="col-sm-3">
            <div class="text-sm-end">
                @if (@$LawFinPerson->amount == 0 || @$LawFinPerson == null)
                    <a data-link="{{ route('Fin.show', 0) }}?type={{ 'CreateFinFuture' }}" data-bs-toggle="modal"
                        data-bs-target="#modal-sm" type="button"
                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i> ขอเบิกล่วงหน้า
                    </a>
                @else
                    <p class="text-danger">ขอเบิกเรียบร้อย</p>
                    {{-- <a data-link="{{ route('Fin.show', 0) }}?type={{ 'CreateFinFuture' }}" data-bs-toggle="modal"
                        data-bs-target="#modal-sm" type="button"
                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i> ขอเบิกล่วงหน้า
                    </a> --}}
                @endif
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


                        <table id="dailytable"
                            class="table dailytable table-hover Custable nowrap dataTable no-footer dtr-inline">
                            <thead>
                                <tr role="row">
                                    <th style="text-align: center;">ลำดับ</th>
                                    <th style="text-align: center;">ชื่อ-สกุล ผู้ขอเบิก</th>
                                    {{-- <th style="text-align: center;">ประเภทคดี</th> --}}
                                    <th style="text-align: center;">จำนวนเงิน</th>
                                    {{-- <th style="text-align: center;">ยอดเบิกทั้งหมด</th> --}}
                                    <th style="text-align: center;">ดูรายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (@$LawFin != null)
                                    @foreach (@$LawFin as $key => $item)
                                        @if($item->status == 'ไม่อนุมัติ')
                                        <tr>
                                            <td style="text-align: center;"><del>{{ $loop->iteration }}</del></td>
                                            <td style="text-align: center;"><del>{{ @$item->LawFinToUser->name }}</del>
                                            </td>
                                            {{-- <td style="text-align: center;">ฟ้อง{{ $item->case_type }}</td> --}}
                                            <td style="text-align: center;"><del>{{ $item->amount }} </del></td>
                                            {{-- <td style="text-align: center;">{{ number_format(@$item->CusToFinance->totalsum,2) }}</td> --}}
                                            <td style="text-align: center;">


                                               
                                            </td>
                                        </tr>
                                        @else

                                        <tr>
                                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                                            <td style="text-align: center;">{{ @$item->LawFinToUser->name }}
                                            </td>
                                            {{-- <td style="text-align: center;">ฟ้อง{{ $item->case_type }}</td> --}}
                                            <td style="text-align: center;">{{ $item->amount }} </td>
                                            {{-- <td style="text-align: center;">{{ number_format(@$item->CusToFinance->totalsum,2) }}</td> --}}
                                            <td style="text-align: center;">


                                                @if ($item->status == 'ขออนุมัติ')
                                                    @if(Auth::user()->position == 'Finance' || Auth::user()->position == 'Admin')
                                                    <a id="AppBtn" type="button"
                                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                                        <i class="mdi mdi-plus me-1"></i> ยืนยันการอนุมัติ
                                                    </a>
                                                    <input type="hidden"class="form-control"
                                                        value="{{ $item->id }}" name="id" id="id"
                                                        required placeholder=" " />
                                                    @else
                                                        <p class="text-warning">รอการอนุมัติ</p>
                                                    @endif
                                                @else
                                                    <a href="{{ route('Fin.show', $item->id) }}?type={{ 'showFinFutureDetail' }}"
                                                        type="button"
                                                        class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2">
                                                        <i class="mdi mdi-plus me-1"></i> ดูรายละเอียด
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>

                                        @endif
                                    @endforeach
                                @endif

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


        $('#AppBtn').click(function() {
            let id = $('#id').val();
            console.log(id);
            let link = "{{ route('Fin.update', 'id') }}?type={{ 'updateFutureStatus' }}";
            let url = link.replace('id', id);


            Swal.fire({
                title: "คุณแน่ใจที่จะอนุมัติขอเบิกล่วงหน้า",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "อนุมัติ",
                denyButtonText: `ไม่อนุมัติ`

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    data = {
                        status: 'อนุมัติ'
                    };
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
                            location.reload();

                        },
                        error: function(err) {

                            Swal.fire({
                                icon: 'error',
                                title: `ERROR ` + err.status + ` !!!`,
                                text: err.responseJSON.message,
                                showConfirmButton: true,
                            });
                            location.reload();


                            // $('#modal_xl_2').modal('hide');

                        }
                    });
                } else if (result.isDenied) {
                    data = {
                        status: 'ไม่อนุมัติ'
                    };
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
                            location.reload();

                        },
                        error: function(err) {

                            Swal.fire({
                                icon: 'error',
                                title: `ERROR ` + err.status + ` !!!`,
                                text: err.responseJSON.message,
                                showConfirmButton: true,
                            });
                            location.reload();


                            // $('#modal_xl_2').modal('hide');

                        }
                    });
                }
            });

        });




    })
</script>
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
