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

        <form id='edit_fin' enctype="multipart/form-data">

            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3 input-bx">
                        <span>วันที่ชำระ</span>
                        {{-- <input type="text" class="form-control" name="date_tribunal" id="date_tribunal" required /> --}}
                        <input type="date" lang="th-th" value="{{ trim(@$data->pay_date) }}" name="pay_date"
                            id="pay_date" class="form-control">
                        <input type="hidden"class="form-control" value="{{ trim(@$data->id) }}" name="id"
                            id="id" required placeholder=" " />
                        <input type="hidden"class="form-control" value="{{ trim(@$data->cus_id) }}" name="cus_id"
                            id="cus_id" required placeholder=" " />
                    </div>
                    <div class="mb-3 input-bx">
                        <span>ประเภทชำระเงิน</span>
                        <select class="form-select addOPR" id="type" name="type" required>
                            <option value="ชำระเงินสด" {{ trim(@$data->type) == 'ชำระเงินสด' ? 'selected' : '' }}>
                                ชำระเงินสด</option>
                            <option value="ชำระผ่านโอน" {{ trim(@$data->type) == 'ชำระผ่านโอน' ? 'selected' : '' }}>
                                ชำระผ่านโอน</option>


                        </select>
                    </div>

                    <div class="mb-3 input-bx">
                        <span>โอนเข้าบัญชี</span>
                        <select class="form-select addOPR" id="bank_account" name="bank_account" required>
                            <option value="กรุงศรี" {{ trim(@$data->bank_account) == 'กรุงศรี' ? 'selected' : '' }}>
                                กรุงศรี</option>
                            <option value="กรุงไทย" {{ trim(@$data->bank_account) == 'กรุงไทย' ? 'selected' : '' }}>
                                กรุงไทย</option>
                            <option value="กสิกร" {{ trim(@$data->bank_account) == 'กสิกร' ? 'selected' : '' }}>กสิกร
                            </option>
                        </select>
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
                        <span>ผู้ชำระ</span>
                        <input type="text"class="form-control" value="{{ Auth::user()->name }}" name="Payee"
                            id="Payee" required placeholder=" " disabled />


                    </div>

                    <div class="mb-3 input-bx">
                        <span>ยอดชำระ</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->pay_amount) }}"
                            name="pay_amount" id="pay_amount" required placeholder=" " />
                        <input type="hidden"class="form-control" value="{{ trim(@$data->status) }}"
                            name="status" id="status" required placeholder=" " />
                        <input type="hidden"class="form-control" value="{{ trim(@$totalValue['totalSum']) }}"
                            name="totalSum" id="totalSum" required placeholder=" " />
                    </div>

                    <div class="mb-3 input-bx">
                        <input type="hidden"class="form-control" value="{{ trim(@$data->ComFinToCom->id) }}"
                            name="com_id" id="com_id" required placeholder=" " />

                    </div>




                </div>


            </div>
            <div class="row">
                <div class="mb-3 input-bx">
                    <span>หมายเหตุ</span>
                    <textarea class="form-control" name="note" id="note" required>{{ @$data->note }}</textarea>
                </div>
                {{-- <div>
                        <input type="checkbox" value="Y" id="status" name="status"
                            {{ $data->status != 'ขั้นสืบพยาน' ? 'checked disabled' : '' }} />

                        <label for="status">ส่งบังคับคดี</label>
                    </div> --}}
            </div>

            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-primary " id="EditFinBtn">แก้ไข</button> --}}
                {{-- @if ($maxId == $data->id)
                    <button type="button" class="btn btn-primary " id="cancelBtn">ยกเลิก</button>
                @endif --}}

                <button type="button" class="btn btn-primary " id="cancelBtn">ยกเลิก</button>
                <button type="button" class="btn btn-danger " class="close" data-bs-dismiss="modal"
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

        $('#edit_cus2').on('change input', () => {
            $('#saveEditBtn').show()
        })

        $('#EditFinBtn').click(function(e) {
            let id = $('#id').val();
            let payee = $('#Payee').val();

            data = {
                status: '',
                Payee: payee,
            };
            console.log('data', data);



            $('#edit_fin').serializeArray().map(function(x) {
                data[x.name] = x.value;
            });

            console.log(payee);



            console.log(data);

            // let date_witness = $('#date_witness').val();
            // let date_postponed = $('#date_postponed').val();
            // let witness_status = $('#witness_status').val();
            let link = "{{ route('LawCom.update', 'id') }}?type={{ 'updateComFin' }}";
            let url = link.replace('id', id);

            // if (date_witness != '' && witness_status != '') {
            $('#showAll').hide();
            $(".content-loading").fadeIn().attr('style', '');
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

                    console.log(result);
                    $('#modal-xl').modal('hide');
                    $(".content-loading").fadeOut().attr('style',
                        'display:none !important'); // ** ซ่อนตัวโหลด **
                    $('#showAll').html(result.html).slideDown('slow');
                    $('#contentTable').html(result.com);
                    // dump(result.install);
                    $('#installTable').html(result.install);

                    // location.reload();
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
        $('#cancelBtn').click(function(e) {
            // let date_witness = $('#date_witness').val();
            // let date_postponed = $('#date_postponed').val();
            // let witness_status = $('#witness_status').val();

            let id = $('#id').val();
            data = {
                status: 'cancel',
            };

            $('#edit_fin').serializeArray().map(function(x) {
                data[x.name] = x.value;
            });
            console.log(data);
            let link = "{{ route('LawCom.update', 'id') }}?type={{ 'CancelComFin' }}";
            let url = link.replace('id', id);
            // if (date_witness != '' && witness_status != '') {
            $('#showAll').hide();
            $(".content-loading").fadeIn().attr('style', '');
            $.ajax({
                url: url,
                method: "PATCH",
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

                    console.log(result);
                    $('#modal-lg').modal('hide');
                    $(".content-loading").fadeOut().attr('style',
                        'display:none !important'); // ** ซ่อนตัวโหลด **
                    $('#showAll').html(result.html).slideDown('slow');
                   
                    $('#contentTable').html(result.com);
                   
                   $('#installTable').html(result.install);
                    // location.reload();
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
