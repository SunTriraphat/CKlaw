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

            <form id='edit_cus' enctype="multipart/form-data">

                <div class="row">
                    <div class="col-sm-6">
                        {{-- <div class="mb-3 ">

                            <span>เลขที่สัญญา</span>
                            <input type="text"class="form-control" value="{{ trim(@$item->TribunalToCus->CON_NO) }}" name="CON_NO"
                                id="CON_NO" required placeholder=" " />

                        </div> --}}
                        <div class="mb-3 input-bx">
                            <span>
                                กำหนดการคัดหนังสือ</span>
                            <input type="date" lang="th-th" value="{{ trim(@$item->date_book_selection) }}"
                                name="date_book_selection" id="date_book_selection" class="form-control">

                            <input type="hidden"class="form-control" value="{{ trim(@$item->cus_id) }}" name="cus_id"
                                id="cus_id" required placeholder=" " />
                        </div>

                        {{-- <div class="mb-3 input-bx">
                            <span>ชื่อ</span>
                            <input type="text" class="form-control" value="{{ trim(@$item->TribunalToCus->name) }}" name="name"
                                id="name" required placeholder="" />


                        </div> --}}

                        @if ($item->status == 'ขั้นสืบทรัพย์')
                            <div>
                                <input type="checkbox" value="Y" id="status" name="status"
                                    {{ $item->status != 'ขั้นฟ้อง' ? 'checked disabled' : '' }} />
                                <label for="status_2">ส่งสืบพยาน</label>
                            </div>
                        @endif

                    </div>
                    <div class="col-sm-6 ">
                        <div class="mb-3 input-bx">
                            <span>วันที่คัดหนังสือรับรองคดี</span>
                            <input type="date" lang="th-th" value="{{ trim(@$item->date_book_certificate) }}"
                                name="date_book_certificate" id="date_book_certificate" class="form-control">

                        </div>

                    </div>


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

            let link = "{{ route('Exe.update', 'id') }}?type={{ 'updateSelectCase' }}";
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
                            $('#content-select-case').html(result.html)
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
