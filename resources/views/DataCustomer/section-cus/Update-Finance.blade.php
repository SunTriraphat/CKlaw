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

    @foreach ($dataFinance as $key => $item)
        <div class="modal-body">
            <div class="col-12">
                <form id='edit_cus'>
                    <div class="row">
                        คุณต้องการที่จะอมุนัติใช่หรือไม่
                        <input type="hidden"class="form-control" value="{{ trim(@$item->cus_id) }}" name="cus_id"
                            id="cus_id" required placeholder=" " />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary " id="updateFin">ใช่</button>
                        <button type="button" class="btn btn-danger " class="close" data-bs-dismiss="modal"
                            aria-label="Close">ไม่</button>
                    </div>

                </form>
            </div>


        </div>
    @endforeach

</div>
<script>
    function autoCurrenncy() {
        let capital_sue = document.getElementById("capital_sue");
        capital_sue.value = capital_sue.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    }
</script>






<script>
    $(function() {

        // let currentDate = document.getElementById('date-input').valueAsDate = new Date();
        // console.log(currentDate);
        let cus_id = $('#cus_id').val();
        console.log(cus_id);
        var link = `{{ route('Fin.update', 'id') }}?type={{ 'UpdateFin' }}`;
        var url = link.replace('id', cus_id);
        console.log(url);

        $('#updateFin').click(function() {

            $.ajax({
                url: url,
                method: "put",
                data: {
                    _token: "{{ csrf_token() }}",
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
            

        });


      

    })
</script>
