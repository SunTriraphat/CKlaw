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

        <form id='edit_cus' enctype="multipart/form-data">

            <div class="row">
                <div class="col-sm-6">
                    {{-- <div class="mb-3 ">

                            <span>เลขที่สัญญา</span>
                            <input type="text"class="form-control" value="{{ trim(@$data->TribunalToCus->CON_NO) }}" name="CON_NO"
                                id="CON_NO" required placeholder=" " />

                        </div> --}}
                    <div class="mb-3 input-bx">
                        <span>คดีหมายเลขดำที่</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->black_no) }}" name="black_no"
                            id="black_no" required placeholder=" " />

                        <input type="hidden"class="form-control" value="{{ trim(@$data->cus_id) }}" name="cus_id"
                            id="cus_id" required placeholder=" " />
                    </div>

                    {{-- <div class="mb-3 input-bx">
                            <span>ชื่อ</span>
                            <input type="text" class="form-control" value="{{ trim(@$data->TribunalToCus->name) }}" name="name"
                                id="name" required placeholder="" />


                        </div> --}}
                    <div class="mb-3 input-bx">
                        <span>ทุนทรัพย์ฟ้อง</span>
                        <input type="text" class="form-control" onkeyup="autoCurrenncy()"
                            value="{{ number_format(@$data->capital_sue) }}" name="capital_sue" id="capital_sue"
                            required placeholder="" />


                    </div>
                    <div class="mb-3 input-bx">
                        <span>ศาลรับฟ้องวันที่</span>
                        {{-- <input type="text" class="form-control" name="date_tribunal" id="date_tribunal" required /> --}}
                        <input type="date" lang="th-th" value="{{ trim(@$data->date_tribunal) }}"
                            name="date_tribunal" id="date_tribunal" class="form-control">

                    </div>

                    @if ($data->status == 'ขั้นฟ้อง')
                        <div>
                            <input type="checkbox" value="Y" id="status" name="status"
                                {{ $data->status != 'ขั้นฟ้อง' ? 'checked disabled' : '' }} />
                            <label for="status_2">ส่งสืบพยาน</label>
                        </div>
                    @endif


                </div>
                <div class="col-sm-6 ">
                    <div class="mb-3 input-bx">
                        <span>คดีหมายเลขแดงที่</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->red_no) }}" name="red_no"
                            id="red_no" required />
                    </div>
                    <div class="mb-3 input-bx">
                        <span>ศาลที่รับฟ้อง</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->tribunal) }}" name="tribunal"
                            id="tribunal" required />
                    </div>
                    {{-- <div class="mb-3 input-bx">
                            <span>นามสกุล</span>
                            <input type="text" class="form-control" value="{{ trim(@$data->TribunalToCus->surname) }}"
                                name="surname" id="surname" required />
                        </div> --}}
                    <div class="mb-3 input-bx">
                        <span>ประเภทคดี</span>
                        <select class="form-select addOPR" id="case_type" name="case_type" required>
                            <option value="เช่าซื้อ">ฟ้องเช่าซื้อ</option>
                            <option value="ค่าขาดราคา">ฟ้องค่าขาดราคา</option>
                            <option value="กู้ยืม">ฟ้องกู้ยืม</option>
                        </select>
                        <input type="hidden" class="form-control" value="{{ trim(@$data->case_type) }}"
                            name="case_typeHiden" id="case_typeHiden" required />
                        {{-- <input type="text"class="form-control" value="{{ trim(@$data->case_type) }}"
                                name="case_type" id="case_type" required /> --}}
                    </div>




                    {{-- <div class="mb-3 input-bx">
                            <span>Choose file to upload</span>
                            
                            <input type="file" name="file" placeholder="Choose File" id="file">

                        </div> --}}

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary " id="saveEditBtn">
                    <span class="spinner-border spinner-border-sm" role="status" id="loading-cus1" aria-hidden="true"
                        style="display: none"></span>
                    บันทึก
                </button>
                <button type="button" class="btn btn-danger " id="close-cus1" class="close" data-bs-dismiss="modal"
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
        $('#edit_cus').on('change input', () => {
            $('#saveEditBtn').show()
        })

        $('#saveEditBtn').click(function(e) {
            $('#saveEditBtn').prop('disabled', true);
            $('#close-cus1').prop('disabled', true);
            $('#loading-cus1').show();
            data = {
                status: ''
            };
            console.log('data', data);

            $('#edit_cus').serializeArray().map(function(x) {

                data[x.name] = x.value;
            });



            console.log(data);
            let cus_id = $('#cus_id').val();
            console.log(cus_id);

            let black_no = $('#black_no').val();
            let capital_sue = $('#capital_sue').val();
            let tribunal = $('#tribunal').val();
            let case_type = $('#case_type').val();
            let date_tribunal = $('#date_tribunal').val();

            let link = "{{ route('Law.update', 'id') }}?type={{ 'updateDataCus' }}";
            let url = link.replace('id', cus_id);
            if (black_no != '' && capital_sue != '' && tribunal != '' && case_type != '' &&
                date_tribunal != '') {
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
                        console.log(result.message);
                        $('#modal-xl').modal('hide');
                        if (result.message == 'อัพเดตสถานะ') {
                            location.reload();
                        } else {
                            $('#content-indict').html(result.html)
                        }

                        $('#saveEditBtn').prop('disabled', false);
                        $('#close-cus1').prop('disabled', false);
                        $('#loading-cus1').hide();


                    },
                    error: function(err) {

                        console.log(err);
                        Swal.fire({
                            icon: 'error',
                            title: `ERROR ` + err.status + ` !!!`,
                            text: err.responseJSON.message,
                            showConfirmButton: true,
                        });
                        $('#saveEditBtn').prop('disabled', false);
                        $('#close-cus1').prop('disabled', false);
                        $('#loading-cus1').hide();

                        // $('#modal_xl_2').modal('hide');

                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: "ข้อมูลไม่ครบถ้วน",
                    text: "โปรดตรวจสอบข้อมูลให้ครบถ้วนก่อนบันทึก. !",
                })

                $('#saveEditBtn').prop('disabled', false);
                $('#close-cus1').prop('disabled', false);
                $('#loading-cus1').hide();
            }

        });



        // $('#date-input').on('change input', () => {
        //     let currentDate = $('#date-input').val();
        //     console.log(currentDate);
        // })

    })
</script>
