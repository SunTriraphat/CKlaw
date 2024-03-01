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
                    <div class="col-sm-6">
                        {{-- <div class="mb-3 ">

                            <span>เลขที่สัญญา</span>
                            <input type="text"class="form-control" value="{{ trim(@$data->TribunalToCus->CON_NO) }}" name="CON_NO"
                                id="CON_NO" required placeholder=" " />

                        </div> --}}
                        <div class="mb-3 input-bx">
                            <span>
                                ตั้งเรื่องยึดทรัพย์วันที่</span>
                            <input type="date" lang="th-th" value="{{ trim(@$data->date_confiscation) }}"
                                name="date_confiscation" id="date_confiscation" class="form-control">

                        </div>
                        <div class="mb-3 input-bx">
                            <span>
                                สำนักงานบังคับคดีจังหวัด</span>

                            <input type="text"class="form-control" value="{{ trim(@$data->exe_office) }}"
                                name="exe_office" id="exe_office" required placeholder=" " />
                        </div>

                    </div>
                    <div class="col-sm-6 ">


                        <div class="mb-3 input-bx">
                            <span>
                                รายงานการยึดทรัพย์วันที่ </span>
                            <input type="date" lang="th-th" value="{{ trim(@$data->date_report) }}"
                                name="date_report" id="date_report" class="form-control">

                            <input type="hidden"class="form-control" value="{{ trim(@$data->cus_id) }}" name="cus_id"
                                id="cus_id" required placeholder=" " />
                        </div>

                    </div>


                </div>
                <div class="row">

                    <div class="mb-3 input-bx">
                        <span>
                            ทรัพย์ที่ยึด</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->property) }}" name="property"
                            id="property" required placeholder=" " />
                    </div>
                    <div class="mb-3 input-bx">
                        <span>
                            โฉนดที่ดินเลขที่</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->deed_no) }}" name="deed_no"
                            id="deed_no" required placeholder=" " />
                    </div>
                    <div class="mb-3 input-bx">
                        <span>
                            เนื้อที่ตามโฉนดที่ดิน</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->land_deed) }}" name="land_deed"
                            id="land_deed" required placeholder=" " />
                    </div>
                    <div class="mb-3 input-bx">
                        <span>
                            ผู้ถือกรรมสิทธิ์</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->owner_deed) }}" name="owner_deed"
                            id="owner_deed" required placeholder=" " />
                    </div>
                    <div class="mb-3 input-bx">
                        <span>
                            รายจำนอง</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->mortgage_income) }}" name="mortgage_income"
                            id="mortgage_income" required placeholder=" " />
                    </div>
                    <div class="mb-3 input-bx">
                        <span>
                            ราคาที่ดินทั้งแปลงประมาณเป็นเงิน </span>
                        <input type="text"class="form-control" value="{{ trim(@$data->some_land_price) }}" name="some_land_price"
                            id="some_land_price" required placeholder=" " />
                    </div>
                    
                    <div class="mb-3 input-bx">
                        <span>
                            สภาพที่ดิน</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->land_con) }}" name="land_con"
                            id="land_con" required placeholder=" " />
                    </div>
                    <div class="mb-3 input-bx">
                        <span>
                            ราคาประมาณเป็นเงิน</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->land_price) }}" name="land_price"
                            id="land_price" required placeholder=" " />
                    </div>
                    <div class="mb-3 input-bx">
                        <span>
                            ราคาประเมิณรวม</span>
                        <input type="text"class="form-control" value="{{ trim(@$data->estimate) }}" name="estimate"
                            id="estimate" required placeholder=" " />
                    </div>

                    <div class="mb-3 input-bx">
                        <span>หมายเหตุ</span>
                        <textarea class="form-control" name="note_3" id="note_3" required>{{ @$data->note_3 }}</textarea>
                    </div>
                    
                    <div>
                        <input type="checkbox" value="Y" id="status" name="status"
                            {{ $data->status != 'ขั้นตั้งเรื่องยึดทรัพย์' ? 'checked disabled' : '' }} />
                        <label for="status_2">ส่งประกาศขายทอดตลาด</label>
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
        $('#case_type').val(case_type);

        // let currentDate = document.getElementById('date-input').valueAsDate = new Date();
        // console.log(currentDate);
        $('#saveEditBtn').hide()
        $('#edit_cus').on('change input', () => {
            $('#saveEditBtn').show()
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

            let link = "{{ route('Exe.update', 'id') }}?type={{ 'updateConfiscation' }}";
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
                            $('#content-confiscation').html(result.html)
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
