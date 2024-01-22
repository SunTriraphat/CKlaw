<div class="modal-content" id="formCreate">
    <div class="row me-4 mt-2">
        <div class="d-flex m-3">
            <div class="flex-shrink-0 me-4">
                {{-- <img src="{{ URL::asset('\assets/images/calculator.png') }}" alt="" style="width: 40px;"> --}}
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <h5 class="text-primary fw-semibold pb-2">แก้ไขข้อมูล</h5>
                <p class="border-primary border-bottom mb-0"></p>

            </div>
        </div>
    </div>


    <div class="modal-body">
        <div class="card-body">

            <div class="row">
                <div class="col-6">
                    <table class="table table-sm">
                        <tr>
                            <th class="text-start">วันที่ศาลรับฟ้อง</th>
                            {{-- <td class="text-end">{{ date_format(date_create(@$data->date_tribunal), 'd/m/Y') }}</td> --}}
                            <td class="text-end">{{ formatDateThai(@$data->date_tribunal) }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">ทุนทรัพย์</th>
                            <td class="text-end">{{ number_format(@$data->capital_sue) }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">คดีหมายเลขดำที่</th>
                            <td class="text-end">{{ @$data->black_no }}</td>
                        </tr>

                    </table>
                </div>
                <div class="col-6">
                    <table class="table table-sm">

                        <tr>
                            <th class="text-start">ศาล</th>
                            <td class="text-end">{{ @$data->tribunal }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">ประเภทคดี</th>
                            <td class="text-end">{{ @$data->case_type }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">คดีหมายเลขแดงที่</th>
                            <td class="text-end">{{ @$data->red_no }}</td>
                        </tr>

                    </table>
                </div>
            </div>

        </div>

        <form id='edit_cus2' enctype="multipart/form-data">

            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3 ">

                        <span>วันที่ออกหมายตั้งเจ้าพนง.บังคับคดี </span>

                        <input type="hidden"class="form-control" value="{{ trim(@$data->cus_id) }}" name="cus_id"
                            id="cus_id" required placeholder=" " />
                        <input type="date" lang="th-th" value="{{ trim(@$data->date_app) }}" name="date_app"
                            id="date_app" class="form-control">
                    </div>

                    <div>
                        <input type="checkbox" value="Y" id="status" name="status"
                            {{ $data->status != 'ขั้นตั้งเจ้าพนักงาน' ? 'checked disabled' : '' }} />

                        <label for="status">ส่งชั้นบังคับคดี</label>
                    </div>

                    {{-- <div class="mb-3 input-bx">
                            <span>ชื่อ</span>
                            <input type="text" class="form-control" value="{{ trim(@$data->name) }}" name="name"
                                id="name" required placeholder="" />


                        </div>
                        <div class="mb-3 input-bx">
                            <span>ทุนทรัพย์ฟ้อง</span>
                            <input type="text" class="form-control" onkeyup="autoCurrenncy()"
                                value="{{ number_format(trim(@$data->capital_sue)) }}" name="capital_sue"
                                id="capital_sue" required placeholder="" />


                        </div> --}}

                </div>
                <div class="row">
                    <div class="mb-3 input-bx">
                        <span>หมายเหตุ</span>
                        <textarea class="form-control" name="app_note" id="app_note" required>{{ trim(@$data->app_note) }}</textarea>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary " id="saveEditBtn">
                    <span class="spinner-border spinner-border-sm" role="status" id="loading-cus6" aria-hidden="true"
                        style="display: none"></span>
                    บันทึก
                </button>
                <button type="button" class="btn btn-danger " id="close-cus6" class="close" data-bs-dismiss="modal"
                    aria-label="Close">ปิด</button>
            </div>

        </form>


    </div>

</div>
<script>
    function autoCurrenncy() {
        let capital_sue = document.getElementById("capital_sue");
        capital_sue.value = capital_sue.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    }
</script>







<script type="text/javascript">
    $(function() {

        let case_type = $('#case_typeHiden').val();
        $('#case_type').val(case_type);

        // let currentDate = document.getElementById('date-input').valueAsDate = new Date();
        // console.log(currentDate);
        $('#saveEditBtn').hide()
        let witness_status = $('#witness_status').val()
        if (witness_status == 'เจอคู่ความ') {
            $('#date_postponedDIV').hide()
        } else {
            $('#date_postponedDIV').show()
        }

        $('#edit_cus2').on('change input', () => {
            $('#saveEditBtn').show()
        })
        $('#witness_status').on('change input', () => {
            let witness_status = $('#witness_status').val()
            if (witness_status == 'เจอคู่ความ') {
                $('#date_postponedDIV').hide()
            } else {
                $('#date_postponedDIV').show()
            }
            let date_postponedDIV = $(this).val();
            console.log('date_postponedDIV', date_postponedDIV);
            // $('#date_postponedDIV').show()
        })








        $('#saveEditBtn').click(function(e) {


            $('#saveEditBtn').prop('disabled', true);
            $('#close-cus6').prop('disabled', true);
            $('#loading-cus6').show();
            data = {
                status: ''
            };
            console.log('data', data);



            $('#edit_cus2').serializeArray().map(function(x) {
                data[x.name] = x.value;

            });




            console.log(data);
            let cus_id = $('#cus_id').val();
            let date_witness = $('#date_witness').val();
            let date_postponed = $('#date_postponed').val();
            let witness_status = $('#witness_status').val();
            let link = "{{ route('Law.update', 'id') }}?type={{ 'updateDataCus4' }}";
            let url = link.replace('id', cus_id);
            if (date_witness != '' && witness_status != '') {
                $.ajax({
                    url: url,
                    method: "PUT",
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: data,
                    },


                    success: function(result) {
                        $('#saveEditBtn').prop('disabled', false);
                        $('#close-cus6').prop('disabled', false);
                        $('#loading-cus6').hide();
                        Swal.fire({
                            icon: 'success',
                            title: `SUCCESS `,
                            showConfirmButton: false,
                            text: result.message,
                            timer: 1500
                        });
                        $('#modal-xl').modal('hide');
                        if (result.message == 'อัพเดตสถานะ') {

                            location.reload();
                        } else {
                            $('#content-setStaff').html(result.html)
                        }
                    },
                    error: function(err) {
                        $('#saveEditBtn').prop('disabled', false);
                        $('#close-cus6').prop('disabled', false);
                        $('#loading-cus6').hide();
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
            } else {
                Swal.fire({
                    icon: 'error',
                    title: "ข้อมูลไม่ครบถ้วน",
                    text: "โปรดตรวจสอบข้อมูลให้ครบถ้วนก่อนบันทึก. !",
                })
            }

        });




    })
</script>
