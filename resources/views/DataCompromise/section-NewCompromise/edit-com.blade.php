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
                    <div class="mb-3 input-bx">
                        <span>ประเภทประนอมหนี้</span>
                        <select class="form-select addOPR" id="type_com" name="type_com" required>
                            <option value="ทำยอมชั้นศาล" {{ trim(@$data->type_com) == 'ทำยอมชั้นศาล' ? 'selected' : '' }}>ทำยอมชั้นศาล
                            </option>
                            <option value="ตกลงผ่อนหลังพิพากษา"
                                {{ trim(@$data->type_com) == 'ตกลงผ่อนหลังพิพากษา' ? 'selected' : '' }}>
                                ตกลงผ่อนหลังพิพากษา
                            </option>
                            <option value="ไกล่เกลี่ยชั้นบังคับคดี"
                                {{ trim(@$data->type_com) == 'ไกล่เกลี่ยชั้นบังคับคดี' ? 'selected' : '' }}>
                                ไกล่เกลี่ยชั้นบังคับคดี</option>
                            <option value="ประนอมหนี้ก่อนฟ้อง"
                                {{ trim(@$data->type_com) == 'ประนอมหนี้ก่อนฟ้อง' ? 'selected' : '' }}>
                                ประนอมหนี้ก่อนฟ้อง</option>

                        </select>
                    </div>
                    <div class="mb-3 input-bx">
                        <span>สถานที่</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->place) }}"
                             name="place" id="place" required placeholder=" " />
                     
                    </div>

                    <div class="mb-3 input-bx">
                        <span>วันที่ประนอม</span>
                        {{-- <input type="text" class="form-control" name="date_tribunal" id="date_tribunal" required /> --}}
                        <input type="date" lang="th-th" value="{{ trim(@$data->date_com_start) }}"
                            name="date_com_start" id="date_com_start" class="form-control">
                        <input type="hidden"class="form-control" value="{{ trim(@$data->id) }}" name="id"
                            id="id" required placeholder=" " />

                    </div>

                    @if (@$data->levels == 'ชั้นบังคับคดี')
                        <div class="mb-3 input-bx">
                            <span>วันที่ครบงด</span>
                            {{-- <input type="text" class="form-control" name="date_tribunal" id="date_tribunal" required /> --}}
                            <input type="date" lang="th-th" value="{{ trim(@$data->blackout_date) }}"
                                name="blackout_date" id="blackout_date" class="form-control">

                        </div>
                    @endif


                    <div class="mb-3 input-bx">
                        <span>ค่างวด</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->period) }}"
                             name="period" id="period" required placeholder=" " />
                        {{-- <input type="text"class="form-control" value="{{ trim(@$data->period) }}"
                            onkeyup="autoInstallments()" name="period" id="period" required placeholder=" " /> --}}

                    </div>
                    <div class="mb-3 input-bx">
                        <span>ระยะเวลาผ่อน</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->installments) }}"
                            name="installments" id="installments" required placeholder=" "  />
                    </div>
                    <div class="mb-3 input-bx">
                        <span>ประเภทดอกเบี้ย</span>
                        <select class="form-select addOPR" id="type_interest" name="type_interest" required >
                           
                            <option value="ยอดคงเหลือ"
                                {{ trim(@$data->type_interest) == 'ยอดคงเหลือ' ? 'selected' : '' }}>
                                ยอดคงเหลือ
                            </option>
                            <option value="ยอดต้นเงิน"
                                {{ trim(@$data->type_interest) == 'ยอดต้นเงิน' ? 'selected' : '' }}>
                                ยอดต้นเงิน</option>
                            <option value="ครบสัญญา"
                                {{ trim(@$data->type_interest) == 'ครบสัญญา' ? 'selected' : '' }}>
                                ครบสัญญา</option>

                        </select>
                    </div>

                </div>
                <div class="col-sm-6 ">
                    <div class="mb-3 input-bx">
                        <span>ยอดประนอมหนี้</span>
                        <input type="text"class="form-control" value="{{ number_format(@$data->pay_com) }}"
                            onkeyup="autoCurrenncy()" name="pay_com" id="pay_com" required placeholder=" " />

                        <input type="hidden"class="form-control" value="{{ trim(@$data->cus_id) }}" name="cus_id"
                            id="cus_id" required placeholder=" " />
                        <input type="hidden"class="form-control" value="{{ trim(@$data->totalInterest) }}"
                            name="totalInterest" id="totalInterest" required placeholder=" " />

                    </div>
                    <div class="mb-3 input-bx">
                        <span>ยอดต้นเงิน</span>
                        <input type="text"class="form-control" value="{{ number_format(@$data->principal) }}"
                            onkeyup="autoCurrenncy()" name="principal" id="principal" required placeholder=" " />

                     

                    </div>

                    <div class="mb-3 input-bx">
                        <span>วันที่ชำระงวดแรก</span>
                        {{-- <input type="text" class="form-control" name="date_tribunal" id="date_tribunal" required /> --}}
                        <input type="date" lang="th-th" value="{{ trim(@$data->date_com) }}" name="date_com"
                            id="date_com" class="form-control">

                    </div>
                    @if (@$data->levels == 'ชั้นบังคับคดี')
                        <div class="mb-3 input-bx">
                            <span>งดการขายวันที่</span>
                            {{-- <input type="text" class="form-control" name="date_tribunal" id="date_tribunal" required /> --}}
                            <input type="date" lang="th-th" value="{{ trim(@$data->stop_date) }}" name="stop_date"
                                id="stop_date" class="form-control" disabled>

                        </div>
                    @endif

                    <div class="mb-3 input-bx">
                        <span>ดอกเบี้ย %</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->interest) }}" name="interest"
                            id="interest" required placeholder=" " />

                    </div>
                    <div class="mb-3 input-bx">
                        <span>ยอดเงินก้อนแรก</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->pay_first) }}"
                             value="0" name="pay_first" id="pay_first" required
                            placeholder=" " />
                        {{-- <input type="text"class="form-control" value="{{ trim(@$data->pay_first) }}"
                            onkeyup="autoInstallments()" value="0" name="pay_first" id="pay_first" required
                            placeholder=" " /> --}}
                    </div>



                </div>
                <div class="col-sm-6 ">
                  
                    
                </div>
                <div class="col-sm-6 ">
                    {{-- <div class="mb-3 input-bx">
                        <span>หมายเหตุ</span>
                        <input type="text"class="form-control" name="not_interest_note" id="not_interest_note"
                            required placeholder=" " />
                    </div> --}}
                </div>
            </div>

            <div class="row">
                <div class="mb-3 input-bx">
                    <span>หมายเหตุ</span>
                    <textarea class="form-control" name="note" id="note" required>{{ @$data->note }}</textarea>
                </div>
                {{-- <div>
                        <input type="checkbox" value="Y" id="status" name="status"
                            {{ $item->status != 'ขั้นสืบพยาน' ? 'checked disabled' : '' }} />

                        <label for="status">ส่งบังคับคดี</label>
                    </div> --}}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary " id="saveEditBtn">บันทึก</button>
                <button type="button" class="btn btn-danger " class="close" data-bs-dismiss="modal"
                    aria-label="Close">ปิด</button>
            </div>

        </form>


    </div>


</div>
<script>
    function autoCurrenncy() {
        let pay_first = document.getElementById("pay_first");
        pay_first.value = pay_first.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        let pay_com = document.getElementById("pay_com");
        pay_com.value = pay_com.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        let principal = document.getElementById("principal");
        principal.value = principal.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        let period = document.getElementById("period");
        period.value = period.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    }

    function autoPeriod() {
        let period = document.getElementById("period");
        let pay_com = document.getElementById("pay_com");
        let interest = document.getElementById("interest");
        let installments = document.getElementById("installments");
        let pay_first = document.getElementById("pay_first");
        period.value = Math.ceil((((parseFloat(pay_com.value.replace(",", "")) - parseFloat(pay_first.value.replace(",",
            ""))) * ((parseFloat(interest.value) / 100) + 1)) / parseFloat(installments.value)).toFixed(2));
        period.value = period.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    }

    function autoInstallments() {
        let period = document.getElementById("period");
        let pay_com = document.getElementById("pay_com");

        let installments = document.getElementById("installments");
        let pay_first = document.getElementById("pay_first");

        installments.value = Math.ceil((parseFloat(pay_com.value.replace(",", "")) - parseFloat(pay_first.value.replace(
            ",", ""))) / parseFloat(period.value)).toFixed(
            2);
        // period.value = period.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    }
</script>







<script type="text/javascript">
    $(function() {

        $('#date_com_start').on('change input', () => {
            var date_com_start = new Date($("#date_com_start").val());
            if (date_com_start.getDate() < 10) {
                var dd = '0' + date_com_start.getDate();
            } else {
                var dd = date_com_start.getDate();
            }

            if (date_com_start.getMonth() + 1 < 10) {
                var mm = '0' + (date_com_start.getMonth() + 1);
            } else {
                var mm = (date_com_start.getMonth() + 1);
            }

            var y = date_com_start.getFullYear() + 1;
            $('#blackout_date').val(y + '-' + mm + '-' + dd);
        })

        console.log($('#blackout_date').val());


        let case_type = $('#case_typeHiden').val();
        $('#case_type').val(case_type);

        // let currentDate = document.getElementById('date-input').valueAsDate = new Date();
        // console.log(currentDate);
        $('#saveEditBtn').hide()
        let witness_status = $('#witness_status').val()
        if (witness_status == 'ทำยอม' || witness_status == 'พิพากษา') {
            $('#date_postponedDIV').hide()
        } else {
            $('#date_postponedDIV').show()
        }

        $('#edit_cus2').on('change input', () => {
            $('#saveEditBtn').show()
        })
        $('#witness_status').on('change input', () => {
            let witness_status = $('#witness_status').val()
            if (witness_status == 'ทำยอม' || witness_status == 'พิพากษา') {
                $('#date_postponedDIV').hide()
            } else {
                $('#date_postponedDIV').show()
            }
            let date_postponedDIV = $(this).val();
            console.log('date_postponedDIV', date_postponedDIV);
            // $('#date_postponedDIV').show()
        })








        $('#saveEditBtn').click(function(e) {


            let id = $('#id').val();

            data = {
                status: ''
            };
            console.log('data', data);



            $('#edit_cus2').serializeArray().map(function(x) {
                data[x.name] = x.value;

            });

            console.log(data);
            // let date_witness = $('#date_witness').val();
            let interest = $('#interest').val();
            let period = $('#period').val();
            let pay_first = $('#pay_first').val();
            let pay_com = $('#pay_com').val();
            let date_com = $('#date_com').val();
            let link = "{{ route('LawCom.update', 'id') }}?type={{ 'updateCom' }}";
            let url = link.replace('id', id);
            if (interest != '' && period != '' && pay_first != '' && pay_com != '' && date_com != '') {
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
            } else {
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
