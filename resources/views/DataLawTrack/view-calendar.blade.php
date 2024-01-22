@extends('layouts.master')
@section('content')
@section('LawTrak', 'active')


{{-- @extends('layouts.master')
@section('content')
@section('execution', 'active') --}}



<!-- Modal -->
<div>
    <div class="modal fade" id="AddTrack" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>

                </div>
                <div class="modal-body">
                    <form id='confirm_track'>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 input-bx">
                                    <span>เลขที่สัญญา</span>
                                    <input type="text"class="form-control" name="CON_NO" id="CON_NO" required
                                        placeholder=" " />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>สถานะ</span>
                                    <select class="form-select addOPR" id="levels" name="levels" required>
                                        {{-- <option value="ชั้นศาล">ชั้นศาล</option> --}}
                                        <option value="ชั้นบังคับคดี">ชั้นบังคับคดี</option>

                                    </select>


                                </div>
                                <div class="mb-3 input-bx">
                                    <span>ศาล</span>
                                    <input type="text"class="form-control" name="tribunal" id="tribunal" required
                                        placeholder=" " />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>เลขที่คดีดำ</span>
                                    <input type="text"class="form-control" name="black_no" id="black_no" required
                                        placeholder=" " />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>เลขที่คดีแดง</span>
                                    <input type="text"class="form-control" name="red_no" id="red_no" required
                                        placeholder=" " />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>สำนักงานบังคับคดี</span>
                                    <input type="text"class="form-control" name="exe_office" id="exe_office" required
                                        placeholder=" " />
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="mb-3 input-bx">
                                    <span>ประเภทคดี</span>
                                    <select class="form-select addOPR" id="case_type" name="case_type" required>
                                        <option value="เช่าซื้อ">เช่าซื้อ</option>
                                        <option value="ค่าขาดราคา">ค่าขาดราคา</option>
                                        <option value="กู้ยืม">กู้ยืม</option>

                                    </select>

                                </div>
                                <div class="mb-3 input-bx">
                                    <span>โจทย์</span>
                                    <input type="text"class="form-control" name="plaintiff" id="plaintiff" required
                                        placeholder=" " />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>จำเลยที่ 1</span>
                                    <input type="text"class="form-control" name="defendant1" id="defendant1" required
                                        placeholder=" " />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>จำเลยที่ 2</span>
                                    <input type="text"class="form-control" name="defendant2" id="defendant2" required
                                        placeholder=" " />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>จำเลยที่ 3</span>
                                    <input type="text"class="form-control" name="defendant3" id="defendant3" required
                                        placeholder=" " />
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                id="closeAddBtn">ปิด</button>
                            <button type="button" class="btn btn-primary" id="submitAddBtn">บันทึก</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="showTrack" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>

                </div>
                <div class="modal-body">
                    <form id='confirm_track'>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3 input-bx">
                                    <span>เลขที่สัญญา</span>
                                    <input type="text"class="form-control" name="show_CON_NO" id="show_CON_NO"
                                        required placeholder=" " disabled />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>ชั้นศาล/บังคับคดี</span>
                                    <input type="text"class="form-control" name="show_levels" id="show_levels"
                                        required placeholder=" " disabled />



                                </div>
                                <div class="mb-3 input-bx">
                                    <span>ศาล</span>
                                    <input type="text"class="form-control" name="show_tribunal" id="show_tribunal"
                                        required placeholder=" " disabled />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>เลขที่คดีดำ</span>
                                    <input type="text"class="form-control" name="show_black_no" id="show_black_no"
                                        required placeholder=" " disabled />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>เลขที่คดีแดง</span>
                                    <input type="text"class="form-control" name="show_red_no" id="show_red_no"
                                        required placeholder=" " disabled />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>สำนักงานบังคับคดี</span>
                                    <input type="text"class="form-control" name="show_exe_office"
                                        id="show_exe_office" required placeholder=" " disabled />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 input-bx">
                                    <span>ประเภทคดี</span>
                                    <input type="text"class="form-control" name="show_case_type"
                                        id="show_case_type" required placeholder=" " disabled />

                                </div>

                                <div class="mb-3 input-bx">
                                    <span>โจทย์</span>
                                    <input type="text"class="form-control" name="show_plaintiff"
                                        id="show_plaintiff" required placeholder=" " disabled />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>จำเลยที่ 1</span>
                                    <input type="text"class="form-control" name="show_defendant1"
                                        id="show_defendant1" required placeholder=" " disabled />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>จำเลยที่ 2</span>
                                    <input type="text"class="form-control" name="show_defendant2"
                                        id="show_defendant2" required placeholder=" " disabled />
                                </div>
                                <div class="mb-3 input-bx">
                                    <span>จำเลยที่ 3</span>
                                    <input type="text"class="form-control" name="show_defendant3"
                                        id="show_defendant3" required placeholder=" " disabled />
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                id="closeAddBtn">ปิด</button>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>











    <div class="container mt-5" style="max-width: 1000px">
        <h2 class="h2 text-center mb-5 border-bottom pb-3">ปฏิทินงานทนาย</h2>
        <div id='full_calendar_events'>

            <input type="hidden"class="form-control" value="{{ count($event) }}" name="count" id="count"
                required placeholder=" " />
        </div>
    </div>

    <!-- Button trigger modal -->

</div>


{{-- Scripts --}}


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
    $(document).ready(function() {
        var SITEURL = "{{ url('/') }}";
        let i = 0;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       





        var calendar = $('#full_calendar_events').fullCalendar({
            editable: true,
            editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
            },

            events: SITEURL + "/calendar-event",
            // displayEventTime: true,
            eventRender: function(event, element, view) {

                // console.log(event.allDay);
                // console.log(view);
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },

            selectable: true,
            selectHelper: true,
            select: function(event_start, event_end, allDay) {
                // console.log(event_name);ะ
                i++
                console.log(i);

                $('#AddTrack').modal('show');
                var event_start = $.fullCalendar.formatDate(event_start, "Y-MM-DD HH:mm:ss");
                var event_end = $.fullCalendar.formatDate(event_end, "Y-MM-DD HH:mm:ss");

                console.log(event_start, event_end);

                $('#submitAddBtn').click(function(e) {
                    let CON_NO = $('#CON_NO').val();
                    let tribunal = $('#tribunal').val();
                    let black_no = $('#black_no').val();
                    let red_no = $('#red_no').val();
                    let exe_office = $('#exe_office').val();
                    let case_type = $('#case_type').val();
                    let levels = $('#levels').val();
                    let plaintiff = $('#plaintiff').val();
                    let defendant1 = $('#defendant1').val();
                    let defendant2 = $('#defendant2').val();
                    let defendant3 = $('#defendant3').val();
                    console.log(CON_NO, tribunal, black_no, red_no, exe_office, case_type,
                        levels);

                    $.ajax({
                        url: SITEURL + "/calendar-crud-ajax",
                        data: {
                            _token: "{{ csrf_token() }}",
                            CON_NO: CON_NO,
                            tribunal: tribunal,
                            black_no: black_no,
                            red_no: red_no,
                            exe_office: exe_office,
                            case_type: case_type,
                            levels: levels,
                            plaintiff: plaintiff,
                            defendant1: defendant1,
                            defendant2: defendant2,
                            defendant3: defendant3,
                            event_start: event_start,
                            event_end: event_end,
                            type: 'create'
                        },
                        type: "POST",
                        success: async function(data) {
                            console.log('data', data);
                            if (data.status == 'สำเร็จ') {

                                await Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "สร้างสำเร็จ",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#AddTrack').modal('hide');
                                location.reload();
                            } else {
                                await Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: "สร้างไม่สำเร็จ",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                // displayMessageErr("สร้างไม่สำเร็จ..");
                            }
                            console.log(data.event);
                            if (data.event != null) {
                                if (data.event.levels == 'ชั้นศาล') {
                                    $color = "#FF502D";
                                } else {
                                    $color = "#2D90FF";
                                }
                            }

                            // calendar.fullCalendar('renderEvent', {
                            //     title: data.case_type,
                            //     start: event_start,
                            //     end: event_end,
                            //     id: data.id,
                            //     color: $color,
                            // }, true);



                            calendar.fullCalendar('unselect');
                        }
                    });

                });

                $('#closeAddBtn').click(function(e) {
                    $('.modal').modal('hide').data('bs.modal', null);
                    location.reload();

                });


            },
            eventDrop: function(event, delta) {
                console.log(event.end);
                let event_start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                let event_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                console.log(event_start);
                // console.log(event_end);

                Swal.fire({
                    title: "คุณต้องการแก้ไขวันที่ใช่หรือไม่",
                    showDenyButton: true,

                    confirmButtonText: "ใช่",
                    denyButtonText: `ไม่ใช่`,

                }).then((result) => {
                    console.log(result);

                    if (result.isConfirmed) {
                        $.ajax({
                            url: SITEURL + '/calendar-crud-ajax',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: event.id,
                                title: event.title,
                                start: event_start,
                                end: event_end,
                                type: 'edit'
                            },
                            type: "POST",
                            success: function(response) {
                                displayMessage("Event updated");
                            }
                        });
                    } else if (result.isDenied) {
                        location.reload();
                    }

                });
                // $.ajax({
                //     url: SITEURL + '/calendar-crud-ajax',
                //     data: {
                //         _token: "{{ csrf_token() }}",
                //         id: event.id,
                //         title: event.title,
                //         start: event_start,
                //         end: event_end,
                //         type: 'edit'
                //     },
                //     type: "POST",
                //     success: function(response) {
                //         displayMessage("Event updated");
                //     }
                // });
            },
            eventClick: function(event) {

                console.log(event.id);
                $.ajax({
                    type: "GET",
                    url: "{{ route('LawTrack.index') }}",
                    data: {
                        id: event.id,
                        type: 'showTrackDetail'
                    },
                    success: function(response) {
                        console.log(response);
                        console.log('asdasdd');

                        $('#show_CON_NO').val(response.CON_NO);
                        $('#show_tribunal').val(response.tribunal);
                        $('#show_black_no').val(response.black_no);
                        $('#show_red_no').val(response.red_no);
                        $('#show_exe_office').val(response.exe_office);
                        $('#show_case_type').val(response.case_type);
                        $('#show_levels').val(response.levels);
                        $('#show_plaintiff').val(response.plaintiff);
                        $('#show_defendant1').val(response.defendant1);
                        $('#show_defendant2').val(response.defendant2);
                        $('#show_defendant3').val(response.defendant3);
                        $('#showTrack').modal('show');

                    }
                });
                // var eventDelete = confirm("Are you sure?");
                // if (eventDelete) {
                //     $.ajax({
                //         type: "POST",
                //         url: SITEURL + '/calendar-crud-ajax',
                //         data: {
                //             _token: "{{ @CSRF_token() }}",
                //             id: event.id,
                //             type: 'delete'
                //         },
                //         success: function(response) {

                //             calendar.fullCalendar('removeEvents', event.id);
                //             displayMessage("Event removed");
                //         }
                //     });
                // }




                // var eventDelete = confirm("Are you sure?");
                // if (eventDelete) {
                //     $.ajax({
                //         type: "GET",
                //         url: "{{ route('event.index') }}",
                //         data: {
                //             id: event.id,
                //             type: 'delete'
                //         },
                //         success: function(response) {

                //             calendar.fullCalendar('removeEvents', event.id);
                //             displayMessage("Event removed");
                //         }
                //     });
                // }
            },
        });

        $count = $('#count').val();
        console.log($count);


        $.ajax({
            url: "{{ route('event.index') }}",
            data: {
                _token: "{{ @CSRF_token() }}",
                type: 'getAll'
            },
            type: "GET",
            success: function(data) {
                console.log('data', data);
                for ($i = 0; $i < $count; $i++) {

                    if (data[$i].levels == 'ชั้นศาล') {
                        $color = "#FF502D";
                    } else {
                        $color = "#2D90FF";
                    }
                    calendar.fullCalendar('renderEvent', {

                        id: data[$i].id,
                        title: data[$i].levels,
                        start: data[$i].event_start,
                        end: data[$i].event_end,
                        color: $color
                    }, true)


                }

                // calendar.fullCalendar('renderEvent',  {
                //     id : 2,
                //     title: "69598",
                //     start: "2023-11-10",
                //     end: "2023-11-11",
                // }, true);

                calendar.fullCalendar('unselect');
            }
        });


    });

    function displayMessage(message) {
        toastr.success(message, 'Event');
    }

    function displayMessageErr(message) {
        toastr.error(message, 'Event');
    }
</script>

@endsection
