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
                            <th class="text-start">ศาล</th>
                            {{-- <td class="text-end">{{ date_format(date_create(@$data->date_tribunal), 'd/m/Y') }}</td> --}}
                            <td class="text-end">{{ @$tribunal->tribunal }}</td>
                        </tr>
                        <tr>
                            <th class="text-start">สำนักงานบังคับคดีจังหวัด</th>
                            {{-- <td class="text-end">{{ date_format(date_create(@$data->date_tribunal), 'd/m/Y') }}</td> --}}
                            <td class="text-end">{{ @$data->exe_office }}</td>
                        </tr>

                        {{-- <tr>
                                <th class="text-start">คดีหมายเลขดำที่</th>
                                <td class="text-end">{{ @$tribunal->black_no }}</td>
                            </tr> --}}

                    </table>
                </div>
                <div class="col-6">
                    <table class="table table-sm">


                        <tr>
                            <th class="text-start">คดีหมายเลขแดงที่</th>
                            <td class="text-end">{{ @$tribunal->red_no }}</td>
                        </tr>

                    </table>
                </div>
            </div>

        </div>
        <form id='edit_cus' enctype="multipart/form-data">

            <div class="row">
                <h5 class="text-danger" style="text-align: center ">
                    เจ้าพนักงานบังคับคดีจะขายทอดตลาดที่ดินตามโฉนดของจำเลย
                    {{ @$customer->prefix }}{{ @$customer->name }} {{ @$customer->surname }} ในคดีนี้รวม 6 นัด</h5>
                <div class="col-sm-6 mt-3">
                    <div class="mb-3 input-bx">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">นัดที่1</span>
                            </div>
                            <input type="date" lang="th-th" value="{{ trim(@$data->date_1) }}" name="date_1"
                                id="date_1" class="form-control">
                        </div>

                    </div>
                    <div class="mb-3 input-bx">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">นัดที่3</span>
                            </div>
                            <input type="date" lang="th-th" value="{{ trim(@$data->date_3) }}" name="date_3"
                                id="date_3" class="form-control">
                        </div>

                    </div>
                    <div class="mb-3 input-bx">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">นัดที่5</span>
                            </div>
                            <input type="date" lang="th-th" value="{{ trim(@$data->date_5) }}" name="date_5"
                                id="date_5" class="form-control">
                        </div>
                    </div>
                    {{-- <div class="mb-3 ">

                            <span>เลขที่สัญญา</span>
                            <input type="text"class="form-control" value="{{ trim(@$data->TribunalToCus->CON_NO) }}" name="CON_NO"
                                id="CON_NO" required placeholder=" " />

                        </div> --}}
                    <div class="mb-3 input-bx">
                        <span>
                            กำหนดประกาศขายครั้งเเรก</span>
                        <input type="date" lang="th-th" value="{{ trim(@$data->date_announce_first) }}"
                            name="date_announce_first" id="date_announce_first" class="form-control">

                        <input type="hidden"class="form-control" value="{{ trim(@$data->cus_id) }}" name="cus_id"
                            id="cus_id" required placeholder=" " />
                    </div>

                    {{-- <div class="mb-3 input-bx">
                        <span>สถานะบังคับคดี</span>

                        <select class="form-select addOPR" id="exe_status" name="exe_status" required>
                           
                            <option value="ถอนบังคับคดีปิดบัญชี"
                                {{ trim(@$data->exe_status) == 'ถอนบังคับคดีปิดบัญชี' ? 'selected' : '' }}>
                                ถอนบังคับคดีปิดบัญชี</option>
                            <option value="ถอนบังคับคดียึดรถ"
                                {{ trim(@$data->exe_status) == 'ถอนบังคับคดียึดรถ' ? 'selected' : '' }}>
                                ถอนบังคับคดียึดรถ</option>
                            <option value="ประนอมหลังยึดทรัพย์"
                                {{ trim(@$data->exe_status) == 'ประนอมหลังยึดทรัพย์' ? 'selected' : '' }}>
                                ประนอมหลังยึดทรัพย์</option>
                            <option value="ถอนบังคับคดียอดเหลือน้อย"
                                {{ trim(@$data->exe_status) == 'ถอนบังคับคดียอดเหลือน้อย' ? 'selected' : '' }}>
                                ถอนบังคับคดียอดเหลือน้อย</option>
                            <option value="ถอนบังคับคดีขายเต็มจำนวน"
                                {{ trim(@$data->exe_status) == 'ถอนบังคับคดีขายเต็มจำนวน' ? 'selected' : '' }}>
                                ถอนบังคับคดีขายเต็มจำนวน</option>
                        </select>

                    </div> --}}



                    @if ($data->status == 'ขั้นฟ้อง')
                        <div>
                            <input type="checkbox" value="Y" id="status" name="status"
                                {{ $data->status != 'ขั้นฟ้อง' ? 'checked disabled' : '' }} />
                            <label for="status_2">ส่งสืบพยาน</label>
                        </div>
                    @endif

                </div>
                <div class="col-sm-6 mt-3">
                    <div class="mb-3 input-bx">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">นัดที่2</span>
                            </div>
                            <input type="date" lang="th-th" value="{{ trim(@$data->date_2) }}" name="date_2"
                                id="date_2" class="form-control">
                        </div>
                       
                    </div>
                    <div class="mb-3 input-bx">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">นัดที่4</span>
                            </div>
                            <input type="date" lang="th-th" value="{{ trim(@$data->date_4) }}" name="date_4"
                                id="date_4" class="form-control">
                        </div>
                       

                    </div>
                    <div class="mb-3 input-bx">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">นัดที่6</span>
                            </div>
                            <input type="date" lang="th-th" value="{{ trim(@$data->date_6) }}" name="date_6"
                                id="date_6" class="form-control">
                        </div>
                      

                    </div>
                    <div class="mb-3 input-bx">
                        <span>
                            ผลประกาศขาย</span>
                        <select class="form-select addOPR" id="announce_result" name="announce_result" required>
                            <option value="">--ผลประกาศขาย--</option>
                            <option value="ขายได้" {{ trim(@$data->announce_result) == 'ขายได้' ? 'selected' : '' }}>
                                ขายได้</option>
                            <option value="ขายไม่ได้"
                                {{ trim(@$data->announce_result) == 'ขายไม่ได้' ? 'selected' : '' }}>ขายไม่ได้</option>
                            <option value="งดการขาย"
                                {{ trim(@$data->announce_result) == 'งดการขาย' ? 'selected' : '' }}>งดการขาย</option>

                        </select>


                    </div>

                </div>


            </div>
            <div class="row" id="announce_bill">
                <div class="col-sm-6 ">
                    <div class="mb-3 input-bx">
                        <span>
                            ครบหนี้/ไม่ครบหนี้</span>
                        <select class="form-select addOPR" id="announce_result" name="announce_bill_result" required>
                            <option value="">--เลือก--</option>
                            <option value="ครบหนี้"
                                {{ trim(@$data->announce_bill_result) == 'ครบหนี้' ? 'selected' : '' }}>ครบหนี้
                            </option>
                            <option value="ไม่ครบหนี้"
                                {{ trim(@$data->announce_bill_result) == 'ไม่ครบหนี้' ? 'selected' : '' }}>ไม่ครบหนี้
                            </option>
                        </select>
                    </div>

                    <div class="mb-3 input-bx">
                        <span>รับเช็คจากบังคับคดีจำนวน</span>
                        <input type="text" class="form-control" value="{{ trim(@$data->check_balance) }}"
                            name="check_balance" id="check_balance" required placeholder="" />
                    </div>
                    <div class="mb-3 input-bx">
                        <span>เงินได้จากการขายทอดตลาด</span>
                        <input type="text" class="form-control" value="{{ trim(@$data->auction_sale) }}"
                            name="auction_sale" id="auction_sale" required placeholder="" />
                    </div>

                </div>
                <div class="col-sm-6 ">
                    <div class="mb-3 input-bx">
                        <span>
                            ขายได้เมื่อวันที่ </span>
                        <input type="date" lang="th-th" value="{{ trim(@$data->sale_date) }}" name="sale_date"
                            id="sale_date" class="form-control">

                    </div>
                    <div class="mb-3 input-bx">
                        <span>ค่าใช้จ่ายเหลือคืน</span>
                        <input type="text" class="form-control" value="{{ trim(@$data->total_refund_balance) }}"
                            name="total_refund_balance" id="total_refund_balance" required placeholder="" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 input-bx">
                    <span>หมายเหตุ</span>
                    <textarea class="form-control" name="note_4" id="note_4" required>{{ @$data->note_4 }}</textarea>
                </div>

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
        let capital_sue = document.getElementById("capital_sue");
        capital_sue.value = capital_sue.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    }
</script>







<script type="text/javascript">
    $(function() {

        let case_type = $('#case_typeHiden').val();
        let announce_result = $('#announce_result').val();
        $('#case_type').val(case_type);
        $('#announce_result').val(announce_result);

        // let currentDate = document.getElementById('date-input').valueAsDate = new Date();
        // console.log(currentDate);
        $('#saveEditBtn').hide()
        $('#announce_bill').hide()
        $('#edit_cus').on('change input', () => {
            $('#saveEditBtn').show()
        })


        if (announce_result == 'ขายได้') {
            $('#announce_bill').show()
        } else {
            $('#announce_bill').hide()
        }


        $('#announce_result').on('change input', () => {
            let announce_result = $('#announce_result').val()
            if (announce_result == 'ขายได้') {
                $('#announce_bill').show()
            } else {
                $('#announce_bill').hide()
            }

            // $('#date_postponedDIV').show()
        })



        $('#saveEditBtn').click(function(e) {



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

            let link = "{{ route('Exe.update', 'id') }}?type={{ 'updateAnnounce' }}";
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
                        console.log(result.html);
                        if (result.message == 'อัพเดตสถานะ') {
                            location.reload();
                        } else {
                            $('#content-announce').html(result.html)
                        }



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
