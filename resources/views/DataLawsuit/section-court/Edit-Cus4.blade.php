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

    @foreach ($data as $key => $item)
        <div class="modal-body">

            <form id='edit_cus2' enctype="multipart/form-data">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3 ">

                            <span>วันส่งคำบังคับ</span>

                            <input type="hidden"class="form-control" value="{{ trim(@$item->id) }}" name="id"
                                id="id" required placeholder=" " />
                            <input type="date" lang="th-th" value="{{ trim(@$item->sub_date) }}" name="sub_date"
                                id="sub_date" class="form-control" max="{{ date('Y-m-d') }}">
                        </div>


                        <div>
                            <input type="checkbox" value="Y" id="status" name="status"
                                {{ $item->status != 'ขั้นตรวจผลหมาย' ? 'checked disabled' : '' }} />

                            <label for="status">ส่งตั้งเจ้าพนักงาน</label>
                        </div>

                        {{-- <div class="mb-3 input-bx">
                            <span>ชื่อ</span>
                            <input type="text" class="form-control" value="{{ trim(@$item->name) }}" name="name"
                                id="name" required placeholder="" />


                        </div>
                        <div class="mb-3 input-bx">
                            <span>ทุนทรัพย์ฟ้อง</span>
                            <input type="text" class="form-control" onkeyup="autoCurrenncy()"
                                value="{{ number_format(trim(@$item->capital_sue)) }}" name="capital_sue"
                                id="capital_sue" required placeholder="" />


                        </div> --}}

                    </div>


                </div>
                <div class="row">
                    <div class="mb-3 input-bx">
                        <span>หมายเหตุ</span>
                        <textarea class="form-control" name="command_note" id="command_note" required>{{ trim(@$item->command_note) }}</textarea>
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
    @endforeach

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



            data = {
                status: ''
            };
            console.log('data', data);



            $('#edit_cus2').serializeArray().map(function(x) {
                data[x.name] = x.value;

            });




            console.log(data);
            let id = $('#id').val();
            let date_witness = $('#date_witness').val();
            let date_postponed = $('#date_postponed').val();
            let witness_status = $('#witness_status').val();
            let link = "{{ route('Law.update', 'id') }}?type={{ 'updateDataCus4' }}";
            let url = link.replace('id', id);
            if (date_witness != '' && witness_status != '') {
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
