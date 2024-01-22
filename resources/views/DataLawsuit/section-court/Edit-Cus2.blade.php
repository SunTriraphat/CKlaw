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

        <form id='edit_cus2' enctype="multipart/form-data">

            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3 ">

                        <span>วันที่สืบพยาน</span>

                        <input type="hidden"class="form-control" value="{{ trim(@$data->id) }}" name="id"
                            id="id" required placeholder=" " />
                        <input type="date" lang="th-th" value="{{ trim(@$data->date_witness) }}"
                            name="date_witness" id="date_witness" class="form-control">
                        <input type="hidden"class="form-control" value="{{ trim(@$data->cus_id) }}" name="cus_id"
                            id="cus_id" required placeholder=" " />
                    </div>


                    <div class="mb-3 input-bx">
                        <span>ยอดหนี้</span>
                        <input type="text" class="form-control" value="{{ trim(@$data->debt_balance) }}"
                            name="debt_balance" id="debt_balance" required placeholder="" />
                    </div>

                    <div>
                        <input type="checkbox" id="withdraw" name="withdraw" onclick="myFunction()"
                            {{ $data->withdraw == 'Y' ? 'checked disabled' : '' }} />
                        <label for="withdraw">ถอนฟ้อง</label>
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
                <div class="col-sm-6 ">
                    <div class="mb-3 input-bx">
                        <span>รายงานศาล</span>
                        <select class="form-select addOPR" value="{{ trim(@$data->witness_status) }}"
                            id="witness_status" name="witness_status" required>
                            <option value="">
                                --รายงานศาล--
                            </option>
                            <option value="ทำยอม" {{ trim(@$data->witness_status) == 'ทำยอม' ? 'selected' : '' }}>
                                ทำยอม
                            </option>
                            <option value="พิพากษา" {{ trim(@$data->witness_status) == 'พิพากษา' ? 'selected' : '' }}>
                                พิพากษา
                            </option>
                            <option value="เลื่อนนัด"
                                {{ trim(@$data->witness_status) == 'เลื่อนนัด' ? 'selected' : '' }}>เลื่อนนัด
                            </option>

                        </select>
                    </div>
                    <div class="mb-3 input-bx" id='date_postponedDIV'>
                        <span>วันเลื่อน</span>
                        <input type="date" lang="th-th" value="{{ trim(@$data->date_postponed) }}"
                            name="date_postponed" id="date_postponed" class="form-control">
                    </div>


                    <div class="mb-3 input-bx" id="withdraw_dateShow">
                        <span>ถอนฟ้องวันที่</span>
                        {{-- <input type="text" class="form-control" name="date_tribunal" id="date_tribunal" required /> --}}
                        <input type="date" lang="th-th" value="{{ trim(@$data->withdraw_date) }}"
                            name="withdraw_date" id="withdraw_date" class="form-control" required>
                    </div>

                </div>


            </div>
            <div class="row">
                <div class="mb-3 input-bx">
                    <span>หมายเหตุ</span>
                    <textarea class="form-control" name="witness_note" id="witness_note" required>{{ trim(@$data->witness_note) }}</textarea>
                </div>
                {{-- <div>
                        <input type="checkbox" value="Y" id="status" name="status"
                            {{ $data->status != 'ขั้นสืบพยาน' ? 'checked disabled' : '' }} />

                        <label for="status">ส่งบังคับคดี</label>
                    </div> --}}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary " id="saveEditBtn">
                    <span class="spinner-border spinner-border-sm" role="status" id="loading-cus2" aria-hidden="true"
                        style="display: none"></span>
                    บันทึก</button>
                <button type="button" class="btn btn-danger " id="close-cus2" class="close" data-bs-dismiss="modal"
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


<script>
    function myFunction() {
        var checkBox = document.getElementById("withdraw");
        if (checkBox.checked == true) {
            $('#withdraw_dateShow').show()
        } else {
            $('#withdraw_dateShow').hide()
        }
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
        let withdraw = $('#withdraw').val()

        if (witness_status == 'ทำยอม' || witness_status == 'พิพากษา' || witness_status == '') {
            $('#date_postponedDIV').hide()
        } else {
            $('#date_postponedDIV').show()
        }

        if (withdraw == 'Y') {
            $('#withdraw_dateShow').show()
        } else {
            $('#withdraw_dateShow').hide()
        }

        $('#edit_cus2').on('change input', () => {
            $('#saveEditBtn').show()
        })
        $('#witness_status').on('change input', () => {
            let witness_status = $('#witness_status').val()
            if (witness_status == 'ทำยอม' || witness_status == 'พิพากษา' || witness_status == '') {
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
            $('#close-cus2').prop('disabled', true);
            $('#loading-cus2').show();
            let cus_id = $('#cus_id').val();
            let withdraw = $('#withdraw').val();
          
            let withdraw_date = $('#withdraw_date').val();
            let witness_note = $('#witness_note').val();
            let validate = 'Y';
           

           

            data = {
                status: ''
            };
            console.log('data', data);



            $('#edit_cus2').serializeArray().map(function(x) {
                data[x.name] = x.value;

            });

         
             if (data['withdraw'] == 'on') {
                if (witness_note != '' && withdraw_date != '') {
                    validate = 'Y';
                } else {
                    validate = 'N';
                }

            }

            console.log('val',validate);


            console.log(data);



            let date_witness = $('#date_witness').val();
            let date_postponed = $('#date_postponed').val();
            let witness_status = $('#witness_status').val();
            let link = "{{ route('Law.update', 'id') }}?type={{ 'updateDataCus2' }}";
            let url = link.replace('id', cus_id);


            if (validate == 'Y') {
                $.ajax({
                    url: url,
                    method: "PUT",
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: data,
                    },


                    success: function(result) {
                        $('#saveEditBtn').prop('disabled', false);
                        $('#close-cus2').prop('disabled', false);
                        $('#loading-cus2').hide();
                        Swal.fire({
                            icon: 'success',
                            title: `SUCCESS `,
                            showConfirmButton: false,
                            text: result.message,
                            timer: 1500
                        });
                        $('#modal-xl').modal('hide');
                        console.log(result.message);
                        if (result.message == 'อัพเดตสถานะ') {
                            location.reload();
                        } else {
                            $('#content-pursue').html(result.html)
                            console.log(result);
                        }


                    },
                    error: function(err) {
                        $('#saveEditBtn').prop('disabled', false);
                        $('#close-cus2').prop('disabled', false);
                        $('#loading-cus2').hide();
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
                $('#saveEditBtn').prop('disabled', false);
                $('#close-cus2').prop('disabled', false);
                $('#loading-cus2').hide();
                Swal.fire({
                    icon: 'error',
                    title: "ข้อมูลไม่ครบถ้วน",
                    text: "โปรดตรวจสอบข้อมูลให้ครบถ้วนก่อนบันทึก. !",
                })
            }




        });



        // $('#date-input').on('change input', () => {
        //     let currentDate = $('#date-input').val();
        //     console.log(currentDate);
        // })

    })
</script>
