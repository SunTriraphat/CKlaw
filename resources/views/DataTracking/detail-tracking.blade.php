<div class="modal-content" id="formCreate">



    <div class="modal-body card border border-white mt-2 p-2">

        <div class="col-12" id="show-detail">
            <div class="card-title">
                <span class=" fw-semibold text-primary"> รายละเอียดการติดตาม</span>
                <a type="button" id="addDetail" class="btn-sm btn float-end btn-secondary ">
                    <i class="fa-solid fa-plus"></i> เพิ่มการติดตาม
                </a>

            </div>
            <div class="row">
                @foreach ($TrackingDetail as $item)
                    <div class="col-6 mt-2">
                        <div class="card">
                            <div class="card-body " style="min-height: 90px">
                                <div>
                                    วันที่ติดตาม : {{ formatDateThai($item->date_tag) }}
                                </div>
                                <div>
                                    หมายเหตุ : {{ $item->note }} 
                                </div>
                                <div>
                                    สถานะ : {{ $item->status }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-primary " id="confirm_trackBtn">บันทึก</button> --}}
                <button type="button" class="btn btn-danger " class="close" data-bs-dismiss="modal"
                    aria-label="Close">ยกเลิก</button>
            </div>

        </div>



        <div class="col-12" id="add-detail">
            <form id='detail_track'>
                <div class="card-title">
                    <span class=" fw-semibold text-primary"> เพิ่มรายละเอียดการติดตาม</span>
                    <a type="button" id="showDetail" class="btn-sm btn float-end btn-secondary ">
                        รายละเอียดการติดตาม
                    </a>
                  
                    <input type="hidden"class="form-control" value="{{ trim(@$tracking->id) }}" name="track_id"
                        id="track_id" required placeholder=" " />
                 
                    <input type="hidden"class="form-control" value="{{ trim(@$tracking->com_id) }}" name="com_id"
                        id="com_id" required placeholder=" " />
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3 ">
                            <span>วันที่ตาม</span>
                            <input type="date" lang="th-th" name="date_tag" id="date_tag" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-6 ">
                        <div class="mb-3 input-bx">
                            <span>สถานะ</span>
                            <select class="form-select addOPR" value="{{ trim(@$data->status) }}" id="status"
                                name="status" required>
                                @foreach ($TrackingStatus as $Trackstatus)
                                    @if($Trackstatus->status != 'ผ่าน' && $Trackstatus->status != 'ไม่ผ่าน')
                                    <option value={{ $Trackstatus->status }}>
                                        {{ $Trackstatus->status }}
                                    </option>
                                    @endif
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="mb-3 input-bx">
                        <span>หมายเหตุ</span>
                        <textarea class="form-control" name="note" id="note" required></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary " id="confirm_trackBtn">บันทึก</button>
                        <button type="button" class="btn btn-danger " class="close" data-bs-dismiss="modal"
                            aria-label="Close">ยกเลิก</button>
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

        $('#add-detail').hide();

        $('#addDetail').click(function(e) {
            $('#add-detail').show(500);
            $('#show-detail').hide(500);
        });
        $('#showDetail').click(function(e) {
            $('#add-detail').hide(500);
            $('#show-detail').show(500);
        });

        $('#confirm_trackBtn').click(function(e) {



            data = {
                status: ''
            };
            console.log('data', data);

            $('#detail_track').serializeArray().map(function(x) {
                data[x.name] = x.value;
            });



            console.log(data);
            let com_id = $('#com_id').val();



            let link = "{{ route('Tracking.store') }}?type={{ 'InsertTrackDetail' }}";



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
                    $('#modal-lg').modal('hide');
                    $('#content-tracking').html(result.html);

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
