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
                            <span>
                                วันที่สืบทรัพย์ครั้งแรก</span>
                            <input type="date" lang="th-th" value="{{ trim(@$data->date_investigate_first) }}"
                                name="date_investigate_first" id="date_investigate_first" class="form-control">

                            <input type="hidden"class="form-control" value="{{ trim(@$data->cus_id) }}" name="cus_id"
                                id="cus_id" required placeholder=" " />
                        </div>
                        <div class="mb-3 input-bx">
                            <span>
                                </span>
                                <select class="form-select addOPR" id="property_found" name="property_found" required>
                                    <option value="" >--ทรัพย์ที่พบเป็น--</option>
                                    <option value="ที่ดินว่างเปล่า" {{ trim(@$data->property_found) == 'ที่ดินว่างเปล่า' ? 'selected' : '' }}>ที่ดินว่างเปล่า</option>
                                    <option value="ที่ดินเกษตรกรรม"  {{ trim(@$data->property_found) == 'ที่ดินเกษตรกรรม' ? 'selected' : '' }}>ที่ดินเกษตรกรรม</option>
                                    <option value="ที่ดินพร้อมสิ่งปลูกสร้าง"  {{ trim(@$data->property_found) == 'ที่ดินพร้อมสิ่งปลูกสร้าง' ? 'selected' : '' }}>ที่ดินพร้อมสิ่งปลูกสร้าง</option>
                                    <option value="อื่นๆ"  {{ trim(@$data->property_found) == 'อื่นๆ' ? 'selected' : '' }}>อื่นๆ</option>
                                   
                                </select>
                        </div>

                       

                       
                            <div>
                                <input type="checkbox" value="Y" id="status" name="status"
                                    {{ $data->status != 'ขั้นสืบทรัพย์' ? 'checked disabled' : '' }} />
                                <label for="status_2">ส่งคัดโฉนด</label>
                            </div>
                       

                    </div>
                    <div class="col-sm-6 ">
                        <div class="mb-3 input-bx">
                            <span>ผลสืบทรัพย์</span>
                            <select class="form-select addOPR" id="investigate_result" name="investigate_result" required>
                                <option value="" >--ผลสืบทรัพย์--</option>
                                <option value="สืบทรัพย์เจอ" {{ trim(@$data->investigate_result) == 'สืบทรัพย์เจอ' ? 'selected' : '' }}>สืบทรัพย์เจอ</option>
                                <option value="สืบทรัพย์ไม่เจอ"  {{ trim(@$data->investigate_result) == 'สืบทรัพย์ไม่เจอ' ? 'selected' : '' }}>สืบทรัพย์ไม่เจอ</option>
                               
                            </select>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="mb-3 input-bx">
                        <span>หมายเหตุ</span>
                        <textarea class="form-control" name="note_1" id="note_1" required>{{@$data->note_1}}</textarea>
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

            let link = "{{ route('Exe.update', 'id') }}?type={{ 'updateInvestigate' }}";
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
                            $('#content-investigate').html(result.html)
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
