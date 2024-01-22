<div class="modal-content" id="formCreate">
    <div class="row me-4 mt-2">
        <div class="d-flex m-3">
            <div class="flex-shrink-0 ">
                {{-- <img src="{{ URL::asset('\assets/images/calculator.png') }}" alt="" style="width: 40px;"> --}}
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <h5 class="text-primary fw-semibold pb-2">ขอเบิกล่วงหน้า</h5>
                <p class="border-primary border-bottom mb-0"></p>

            </div>
        </div>
    </div>


    <div class="modal-body">
        <form id='create_fin' enctype="multipart/form-data">

            <div class="row">
                <div>
                    <div class="mb-3 input-bx">
                        <span>ผู้ขอเบิก</span>
                        <input type="text"class="form-control" value="{{ Auth::user()->name }}" name="userInsert"
                            id="userInsert" required placeholder=" " readonly /> 
                       
                    </div>
                    <div class="mb-3 input-bx">
                        <span>วันที่ขอเบิก</span>
                        <input type="text"class="form-control" value="{{ date('Y-m-d') }}" name="dateInsert"
                            id="dateInsert" required placeholder=" " readonly /> 
                    </div>

                    <div class="mb-3 input-bx">
                        <span>จำนวนเงิน</span>
                        <input type="text"class="form-control" name="amount" id="amount" required
                            placeholder=" " />
                    </div>

                    <div class="mb-3 input-bx">
                        <span>รายละเอียด</span>
                        <textarea class="form-control" name="detail" id="detail" required></textarea>
                    </div>



                </div>


            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-primary " id="appBtn">
                    <span class="spinner-border spinner-border-sm" role="status" id="loading-cus1" aria-hidden="true"
                        style="display: none"></span>
                    บันทึก
                </button> --}}
                <button type="button" class="btn btn-primary " id="RequestappBtn">
                    <span class="spinner-border spinner-border-sm" role="status" id="loading-cus1" aria-hidden="true"
                        style="display: none"></span>
                    ขออนุมัติ
                </button>
                

                <button type="button" class="btn btn-danger " id="close-cus1" class="close" data-bs-dismiss="modal"
                    aria-label="Close">ปิด</button>
            </div>

        </form>


    </div>


</div>

<script type="text/javascript">
    $(function() {









       
        $('#RequestappBtn').click(function(e) {
          

            $('#RequestappBtn').prop('disabled', true);
            $('#close-cus1').prop('disabled', true);
            $('#loading-cus1').show();
            data = {
                status: 'ขออนุมัติ'
            };
            console.log('data', data);

            let amount = $('#amount').val();
            let detail = $('#detail').val();

            $('#create_fin').serializeArray().map(function(x) {
                data[x.name] = x.value;

            });
            data['type'] = 'RequestFinFuture'


            let link = "{{ route('Fin.store') }}";

            if (amount != '' && detail != '') {
                $.ajax({
                    url: link,
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: data,
                    },


                    success: function(result) {
                        $('#appBtn').prop('disabled', false);
                        $('#close-cus1').prop('disabled', false);
                        $('#loading-cus1').hide();
                        Swal.fire({
                            icon: 'success',
                            title: `SUCCESS `,
                            showConfirmButton: false,
                            text: result.message,
                            timer: 1500
                        });
                        $('#modal-sm').modal('hide');
                        // if (result.message == 'อัพเดตสถานะ') {

                        location.reload();
                        // } else {
                        //     $('#content-setStaff').html(result.html)
                        // }
                    },
                    error: function(err) {
                        $('#appBtn').prop('disabled', false);
                        $('#close-cus1').prop('disabled', false);
                        $('#loading-cus1').hide();
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
                    title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                    showConfirmButton: true,
                });
                $('#appBtn').prop('disabled', false);
                        $('#close-cus1').prop('disabled', false);
                        $('#loading-cus1').hide();
            }

        });
       




    })
</script>
