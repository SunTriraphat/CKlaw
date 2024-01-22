<div class="modal-content" id="formCreate">
    <div class="row me-4 mt-2">
        <div class="d-flex">
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
        <div class="col-12">
            <form id='confirm_track'>
                <div class="row">
                    คุณแน่ใจที่จะสร้างการติดตามใหม่

                    <input type="hidden"class="form-control" value="{{ trim(@$data->id) }}" name="com_id"
                        id="com_id" required placeholder=" " />
                    <input type="hidden"class="form-control" value="{{ trim(@$data->cus_id) }}" name="cus_id"
                        id="cus_id" required placeholder=" " />
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary " id="confirm_trackBtn">ใช่</button>
                    <button type="button" class="btn btn-danger " class="close" data-bs-dismiss="modal"
                        aria-label="Close">ไม่</button>
                </div>

            </form>
        </div>


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

        // let case_type = $('#case_typeHiden').val();
        // $('#case_type').val(case_type);

        // let currentDate = document.getElementById('date-input').valueAsDate = new Date();
        // console.log(currentDate);

        $('#confirm_trackBtn').click(function(e) {



            data = {
                status: ''
            };
            console.log('data', data);

            $('#confirm_track').serializeArray().map(function(x) {
                data[x.name] = x.value;
            });



            console.log(data);
            let com_id = $('#com_id').val();



            let link = "{{ route('Tracking.store') }}?type={{ 'InsertTrackMonth' }}";

            $.ajax({
                url: link,
                method: "POST",
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
                    $('#modal-sm').modal('hide');
                    $('#content-tracking').html(result.html);
                    // let url = `{{ route('Law.show', 'ID') }}?type={{ 'showCus' }}`
                    // let urlTo = url.replace('ID', result.id)
                    // console.log(urlTo);
                    // window.location.href = urlTo;

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


        });
        // $('#date-input').on('change input', () => {
        //     let currentDate = $('#date-input').val();
        //     console.log(currentDate);
        // })

    })
</script>
