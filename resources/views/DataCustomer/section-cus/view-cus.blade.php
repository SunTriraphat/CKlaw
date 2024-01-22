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
                {{-- <a data-link="{{ route('Cus.create') }}?type={{ 'ExportExcel' }}" data-bs-toggle="modal"
                    data-bs-target="#modal-xl" type="button"
                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                    <i class="fa-solid fa-download"></i> Export
                </a> --}}

              
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

    {{-- <div class="card col-lg-2 mr-4 ">
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
                                    {{-- <th style="text-align: center;">ประเภทคดี</th> --}}
                                    <th style="text-align: center;">สถานะ</th>
                                    {{-- <th style="text-align: center;">ยอดเบิกทั้งหมด</th> --}}
                                    <th style="text-align: center;">ดูรายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>

                                        <td style="text-align: center;">{{ $item->CON_NO }}</td>
                                        <td style="text-align: center;">{{ $item->name }} {{ $item->surname }}
                                            @foreach ($dataGuarantor as $key => $guarantor)
                                                @if ($item->id == $guarantor->cus_id)
                                                    <br>{{ $guarantor->name }} {{ $guarantor->surname }}
                                                @endif
                                            @endforeach
                                        </td>
                                        {{-- <td style="text-align: center;">ฟ้อง{{ $item->case_type }}</td> --}}
                                        @if($item->status_close == 'Y')
                                        <td style="text-align: center;"> ปิดบัญชี </td>
                                        @elseif ($item->status_tribunal == 'N')
                                            <td style="text-align: center;"> ลูกค้ารอส่งชั้นศาล </td>
                                        @elseif ($item->status_tribunal == 'Y' && $item->status_com == 'N' && $item->status_exe == 'N')
                                            <td style="text-align: center;"> ลูกค้าชั้นศาล </td>
                                        @elseif ($item->status_tribunal == 'Y' && $item->status_exe == 'Y')
                                            <td style="text-align: center;"> ลูกค้าชั้นบังคับคดี </td>
                                        @elseif ($item->status_com == 'Y')
                                            <td style="text-align: center;"> ลูกค้าประนอมหนี้ </td>
                                        @endif

                                        {{-- <td style="text-align: center;">{{ number_format(@$item->CusToFinance->totalsum,2) }}</td> --}}
                                        <td style="text-align: center;">
                                            <a href="{{ route('Cus.show', $item->id) }}?type={{ 'showDetail' }}"
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

        // let currentDate = document.getElementById('date-input').valueAsDate = new Date();
        // console.log(currentDate);

       
        $('#saveBtn').click(function() {
            let num = 0;

            if ($('#name1').val() != '' && ($('#name2').val() == '')) {
                num = 1;
            }

            if ($('#name1').val() != '' && ($('#name2').val() != '')) {
                num = 2;
            }

            console.log(num);

            let data = {
                num: num
            };

            console.log('data', data);

            $('#create_cus').serializeArray().map(function(x) {
                data[x.name] = x.value;
            });


            console.log(data);


            let name = $('#name').val();
            let surname = $('#surname').val();
            let CON_NO = $('#CON_NO').val();
            let prefix = $('#prefix').val();
            let ID_num = $('#ID_num').val();
            let PhoneNum = $('#PhoneNum').val();
            let ex_date = $('#ex_date').val();
            let address = $('#address').val();

            //  (name != '' && surname != '' && CON_NO != '' && prefix != '' && Engname != '' && EngSurname != '' && ID_num != '' && Nickname !='' && PhoneNum != '' && ex_date != '')


            // if (name != '' && surname != '' && CON_NO != '' && prefix != ''  && ID_num != ''  && PhoneNum != '') {
            $.ajax({
                url: "{{ route('Cus.store') }}?type={{ 'Datacus' }}",
                method: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    data: data
                },

                success: function(result) {

                    Swal.fire({
                        icon: 'success',
                        title: `SUCCESS `,
                        showConfirmButton: false,
                        text: result.message,
                        timer: 1500
                    });
                    $('#modal-xl').modal('hide');
                    location.reload();
                },
                error: function(err) {
                    console.log(err);
                    Swal.fire({
                        icon: 'error',
                        title: `ERROR ` + err.status + ` !!!`,
                        text: err.responseJSON.message,
                        showConfirmButton: true,
                    });

                    // $('#modal_xl_2').modal('hide');

                }
            });
            // } else {
            //     Swal.fire({
            //         icon: 'error',
            //         title: "ข้อมูลไม่ครบถ้วน",
            //         text: "โปรดตรวจสอบข้อมูลให้ครบถ้วนก่อนบันทึก. !",
            //     })
            // }

        });


        // $('#date-input').on('change input', () => {
        //     let currentDate = $('#date-input').val();
        //     console.log(currentDate);
        // })

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
