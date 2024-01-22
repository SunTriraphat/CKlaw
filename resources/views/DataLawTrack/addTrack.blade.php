{{-- <div id="test">
    <div class="modal fade" id="showTrack" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id='confirm_track'>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 input-bx">
                                    <span>เลขที่สัญญา</span>
                                    <input type="text"class="form-control" value="{{ trim(@$event->CON_NO) }}" name="CON_NO" id="CON_NO" required
                                        placeholder=" " />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>ศาล</span>
                                    <input type="text"class="form-control"  value="{{ trim(@$event->tribunal) }}" name="tribunal" id="tribunal" required
                                        placeholder=" " />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>เลขที่คดีดำ</span>
                                    <input type="text"class="form-control"  value="{{ trim(@$event->black_no) }}" name="black_no" id="black_no" required
                                        placeholder=" " />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>เลขที่คดีแดง</span>
                                    <input type="text"class="form-control"  value="{{ trim(@$event->red_no) }}" name="red_no" id="red_no" required
                                        placeholder=" " />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>สำนักงานบังคับคดี</span>
                                    <input type="text"class="form-control"  value="{{ trim(@$event->exe_office) }}" name="exe_office" id="exe_office" required
                                        placeholder=" " />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 input-bx">
                                    <span>ประเภทคดี</span>
                                    <input type="text"class="form-control"  value="{{ trim(@$event->case_type) }}" name="case_type" id="case_type" required
                                        placeholder=" " />
    
                                </div>
    
                            </div>
                        </div>
    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                id="closeAddBtn">Close</button>
                            <button type="button" class="btn btn-primary" id="submitAddBtn">Save changes</button>
                        </div>
    
                    </form>
                </div>
    
            </div>
        </div>
    </div>
</div> --}}

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
                <form id='confirm_app'>
                    <div class="row">
                        คุณแน่ใจที่จะส่งตั้งเจ้าพนักงานหรือไม่
                        <input type="hidden"class="form-control" value="{{ trim(@$data->id) }}" name="id"
                            id="id" required placeholder=" " />
                        <input type="hidden"class="form-control" value="{{ trim(@$Compro->id) }}" name="com_id"
                            id="com_id" required placeholder=" " />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary " id="confirm_appBtn">ใช่</button>
                        <button type="button" class="btn btn-danger " class="close" data-bs-dismiss="modal"
                            aria-label="Close">ไม่</button>
                    </div>

                </form>
            </div>


        </div>


    </div>






<script type="text/javascript">
    $(function() {

        $('#submitAddBtn').click(function(e) {

            let CON_NO = $('#CON_NO').val();
            let tribunal = $('#tribunal').val();
            let black_no = $('#black_no').val();
            let red_no = $('#red_no').val();
            let exe_office = $('#exe_office').val();
            let case_type = $('#case_type').val();
            console.log(CON_NO, tribunal, black_no, red_no, exe_office, case_type);

            // $.ajax({
            //     url: SITEURL + "/calendar-crud-ajax",
            //     data: {
            //         _token: "{{ csrf_token() }}",
            //         CON_NO: CON_NO,
            //         tribunal: tribunal,
            //         black_no: black_no,
            //         red_no: red_no,
            //         exe_office: exe_office,
            //         case_type: case_type,
            //         event_start: event_start,
            //         event_end: event_end,
            //         type: 'create'
            //     },
            //     type: "POST",
            //     success: function(data) {
            //         console.log('data', data);
            //         displayMessage("Event created.");
            //         calendar.fullCalendar('renderEvent', {
            //             title: data.case_type,
            //             start: event_start,
            //             end: event_end,
            //             id: data.id
            //         }, true);
            //         $('#AddTrack').modal('hide');

            //         calendar.fullCalendar('unselect');
            //     }
            // });

        });

    })
</script>
