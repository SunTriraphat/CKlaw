<div class="row g-1">
    {{-- header content --}}
    <div class="row mb-2 g-1" id="show-search">
        <div class="col-12">
            {{-- @php
                dump(json_decode(json_encode(@$data)));

            @endphp --}}

            <div class="row">
                <div class="col-sm-12">
                    <table id="dailytable"
                        class="table dailytable table-hover Custable nowrap dataTable no-footer dtr-inline">
                        <thead>
                            <tr role="row">
                                <th style="text-align: center;">เลขที่สัญญา</th>
                                <th style="text-align: center;">ชื่อ-สกุล</th>
                                <th style="text-align: center;">#</th>

                            </tr>
                        </thead>
                        
                        @if (@$data != null)

                            <tbody>
                                <tr>
                                    <td style="text-align: center;">
                                        {{ @$data->CONTNO }} 
                                        <input type="hidden"class="form-control"
                                        value="{{ @$data->CONTNO }}"
                                        name="CONTNO" id="CONTNO" required/>
                                    </td>
                                    <td style="text-align: center;">

                                        {{ trim(iconv('Tis-620', 'utf-8', $data->SNAM)) }}{{ trim(iconv('Tis-620', 'utf-8', $data->NAME1)) }}
                                        {{ trim(iconv('Tis-620', 'utf-8', $data->NAME2)) }}
                                        <br>
                                        @if (@$data_cusfollow != null)
                                            @foreach (@$data_cusfollow as $item)
                                                {{ trim(iconv('Tis-620', 'utf-8', $item->SNAM)) }}{{ trim(iconv('Tis-620', 'utf-8', $item->NAME1)) }}
                                                {{ trim(iconv('Tis-620', 'utf-8', $item->NAME2)) }}
                                                <br>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        <a type="button" id="add-cus"
                                            class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                            <i class="mdi mdi-plus me-1"></i> เพิ่ม
                                        </a>
                                    </td>
                                    {{-- <td style="text-align: center;">ฟ้อง{{ $item->case_type }}</td> --}}


                                </tr>

                            </tbody>
                        @endif
                        
                    </table>

                </div>
            </div>
            {{-- <table>
                <tr>
                    <th>เลขที่สัญญา</th>
                    <th>ชื่อ-สกุล</th>
                   
                </tr>
                <tr>
                    <td>{{ @$data->CONTNO }}</td>
                    <td>Maria Anders</td>
                    
                </tr>
            </table> --}}

        </div>
    </div>

</div>
<script type="text/javascript">
    $(function() {



        $('#add-cus').click(function(e) {
            Swal.fire({
                title: "คุณต้องการเพิ่มใช่หรือไม่?",

                showCancelButton: true,
                confirmButtonText: "ใช่",
                cancelButtonText: "ยกเลิก",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    console.log('ssssss');

                    let CONTNO = $('#CONTNO').val();
                    let plaintiff = $('#plaintiff').val();
                    console.log(CONTNO); 
                    console.log(plaintiff); 
                    $.ajax({
                        url: "{{ route('Cus.store') }}?type={{ 'importSeachCus' }}",
                        method: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            CONTNO: CONTNO,
                            plaintiff: plaintiff
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
                                title: 'เลขที่สัญญามีในระบบแล้ว',
                                showConfirmButton: true,
                            });

                            // $('#modal_xl_2').modal('hide');

                        }
                    });
                    // Swal.fire("Saved!", "", "success");
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });

            // $.ajax({
            //     url: url,
            //     method: "PUT",
            //     data: {
            //         _token: "{{ csrf_token() }}",
            //         data: data,
            //     },


            //     success: function(result) {


            //         Swal.fire({
            //             icon: 'success',
            //             title: `SUCCESS `,
            //             showConfirmButton: false,
            //             text: result.message,
            //             timer: 1500
            //         });
            //         console.log(result.message);
            //         $('#modal-xl').modal('hide');
            //         if (result.message == 'อัพเดตสถานะ') {
            //             location.reload();
            //         } else {
            //             $('#content-indict').html(result.html)
            //         }

            //         $('#saveEditBtn').prop('disabled', false);
            //         $('#close-cus1').prop('disabled', false);
            //         $('#loading-cus1').hide();


            //     },
            //     error: function(err) {

            //         console.log(err);
            //         Swal.fire({
            //             icon: 'error',
            //             title: `ERROR ` + err.status + ` !!!`,
            //             text: err.responseJSON.message,
            //             showConfirmButton: true,
            //         });
            //         $('#saveEditBtn').prop('disabled', false);
            //         $('#close-cus1').prop('disabled', false);
            //         $('#loading-cus1').hide();

            //         // $('#modal_xl_2').modal('hide');

            //     }
            // });


        });




    })
</script>
