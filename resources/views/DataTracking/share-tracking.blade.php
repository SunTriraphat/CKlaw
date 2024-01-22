<div class="modal-content" id="formCreate">
    <div class="row me-4 mt-2">
        <div class="d-flex">
            <div class="flex-shrink-0 me-4">
                {{-- <img src="{{ URL::asset('\assets/images/calculator.png') }}" alt="" style="width: 40px;"> --}}
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <div class="row">
                    <div class="col-6 mt-2">
                        <h5 class="text-primary fw-semibold pb-2 ">แบ่งทีมตาม</h5>
                    </div>
                    <div class="col-6 text-end mt-2">

                        <a type="button" id="editTeam" class="btn-sm btn float-end btn-secondary ">
                            <i class="fa-solid fa-plus"></i> แก้ไขทีมตาม
                        </a>
                        <a type="button" id="addTeam" class="btn-sm btn float-end btn-secondary ">
                            <i class="fa-solid fa-plus"></i> เพิ่มทีมตาม
                        </a>
                    </div>
                </div>
                <p class="border-primary border-bottom mb-0"></p>

            </div>
        </div>
    </div>


    <div class="modal-body">
        <div class="col-12">
            <form id='addTeamForm'>
                <div class="card col-lg-12">
                    <div class="card-body">
                        <div class="table-responsive" style="overflow-x:hidden">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                                <div class="row">
                                    <div class="col-sm-12">

                                        <table id="dailytable"
                                            class="table dailytable table-hover Custable nowrap dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr role="row">

                                                    <th style="text-align: center;">เลขที่สัญญา</th>
                                                    <th style="text-align: center;">ชื่อ-สกุล</th>

                                                    <th style="text-align: center;">ทีมตาม</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                @php
                                                    $count = 0;

                                                @endphp

                                                @foreach ($data as $i => $item)
                                                    @if (
                                                        $item->ViewComToTeamFollow == null &&
                                                            Carbon\Carbon::parse(
                                                                @$dataInstall->where('com_id', @$item->com_id)->where('totalSum', '!=', '0')->first()->due_date)->DiffInMonths($today) >= 2)
                                                        <tr>
                                                            <input type="hidden" class="form-control"
                                                                value={{ $item->cus_id }}
                                                                name="cus_id{{ $count + 1 }}"
                                                                id="count{{ $count + 1 }}" required
                                                                placeholder=" " />
                                                            <td style="text-align: center;">{{ @$item->CON_NO }} </td>
                                                            <td style="text-align: center;">{{ @$item->name }}
                                                                {{ @$item->surname }}

                                                            </td>
                                                            <input type="hidden"class="form-control"
                                                                value={{ $item->com_id }}
                                                                name="com_id{{ $count + 1 }}"
                                                                id="com_id{{ $count + 1 }}" required
                                                                placeholder=" " />

                                                            <td style="text-align: center;">
                                                                <select class="form-select addOPR"
                                                                    id="id{{ $count + 1 }}"
                                                                    name="id{{ $count + 1 }}" required>
                                                                    <option value="">
                                                                        --เลือกทีมตาม--</option>
                                                                    @foreach (Auth::user()->get() as $key => $user)
                                                                        <option value={{ $user->id }}>
                                                                            {{ $user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>

                                                        </tr>
                                                        @php

                                                            $count++;
                                                        @endphp
                                                    @endif
                                                @endforeach

                                                <input type="hidden"class="form-control" value={{ $count }}
                                                    name="count" id="count" required placeholder=" " />

                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">

                    <div class="col-2 mt-1">
                        <div class="mb-3 input-bx">
                            <span>เปลี่ยนเป็น</span>
                        </div>
                    </div>
                    <div class="col-6 mt-1">
                        <select class="form-select addOPR" id="teamAll" name="teamAll" required>
                            <option value="">
                                --เลือกทีมตาม--</option>
                            @foreach (Auth::user()->get() as $key => $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col mt-1">

                    </div>

                    <button type="button" class="btn btn-primary " id="confirm_trackBtn">แบ่งทีมตาม</button>
                    <button type="button" class="btn btn-danger " class="close" data-bs-dismiss="modal"
                        aria-label="Close">ยกเลิก</button>

                    {{-- <button type="button" class="btn btn-primary " id="confirm_trackBtn">ใช่</button>
                    <button type="button" class="btn btn-danger " class="close" data-bs-dismiss="modal"
                        aria-label="Close">ยกเลิก</button> --}}
                </div>

            </form>

            <form id='editTeamForm'>
                <div class="card col-lg-12">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 mt-1">
                                <div class="input-bx">
                                    <span>ทีมตาม</span>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3 input-bx">
                                    <select class="form-select addOPR" id="team" name="team" required>
                                        @foreach (Auth::user()->get() as $key => $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3 input-bx">
                                    {{-- <a data-link="{{ route('Tracking.create') }}?type={{ 'searchTeam' }}"
                                        type="button"
                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                        <i class="mdi mdi-plus me-1"></i> ค้นหา
                                    </a> --}}

                                    <button type="button" class="btn btn-primary " id="searchTeamBtn">ค้นหา</button>
                                </div>
                            </div>
                        </div>
                        <div id="teamTable">
                            @include('DataTracking.table-team')
                        </div>
                    </div>
                </div>

                <div class="modal-footer">

                    <div class="col-2 mt-1">
                        <div class="mb-3 input-bx">
                            <span>เปลี่ยนเป็น</span>
                        </div>
                    </div>
                    <div class="col-6 mt-1">
                        <select class="form-select addOPR" id="teamNew" name="teamNew" required>
                            <option value="">
                                --เลือกทีมตาม--</option>
                            @foreach (Auth::user()->get() as $key => $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col mt-1">

                    </div>

                    <button type="button" class="btn btn-primary " id="edit_trackBtn">แก้ไข</button>
                    <button type="button" class="btn btn-danger " class="close" data-bs-dismiss="modal"
                        aria-label="Close">ยกเลิก</button>


                </div>

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

<script>
    $(function() {
        $(".editTeamtable").DataTable({
            "responsive": false,
            "autoWidth": false,
            "ordering": true,
            "lengthChange": true,
            "order": [
                [0, "asc"]
            ],
            "pageLength": 5,
            "scrollX": true,
        });
    })
</script>






<script type="text/javascript">
    $(function() {
        $('#confirm_trackBtn').hide();
        $('#edit_trackBtn').hide();
        $('#editTeam').click(function(e) {
            $('#editTeamForm').show(500);
            $('#addTeamForm').hide(500);
            $('#editTeam').hide();
            $('#addTeam').show();
        });
        $('#addTeam').click(function(e) {
            $('#editTeamForm').hide(500);
            $('#addTeamForm').show(500);
            $('#addTeam').hide();
            $('#editTeam').show();
        });
        $('#addTeamForm').on('change input', () => {
            $('#confirm_trackBtn').show()
        })
        $('#editTeamForm').on('change input', () => {
            $('#edit_trackBtn').show()
        })
        $('#addTeam').hide();
        $('#editTeamForm').hide();
        $('#addTeamForm').show();

        $('#confirm_trackBtn').click(function(e) {
            data = {
                status: ''
            };
            console.log('data', data);

            $('#addTeamForm').serializeArray().map(function(x) {
                data[x.name] = x.value;
            });



            console.log(data);
            let com_id = $('#com_id').val();



            let link = "{{ route('Tracking.store') }}?type={{ 'InsertTeamFollow' }}";

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



                }
            });


        });

        $('#edit_trackBtn').click(function(e) {
            data = {
                status: ''
            };
            console.log('data', data);
            $('#editTeamForm').serializeArray().map(function(x) {
                data[x.name] = x.value;
            });

            console.log(data);
            let com_id = $('#com_id').val();
            let link = "{{ route('Tracking.update', 0) }}?type={{ 'updateTeamFollow' }}";

            $.ajax({
                url: link,
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
                }
            });
        });
        $('#searchTeamBtn').click(function(e) {
            data = {
                status: '',

            };
            console.log('data', data);
            $('#editTeamForm').serializeArray().map(function(x) {
                data[x.name] = x.value;
            });

            console.log(data);
            let com_id = $('#com_id').val();
            let link = "{{ route('Tracking.show', 0) }}";
            console.log(link);

            $.ajax({
                url: link,
                method: "GET",
                data: {
                    _token: "{{ csrf_token() }}",
                    data: data,
                    type: 'searchTeam'
                },
                success: function(result) {
                    Swal.fire({
                        icon: 'success',
                        title: `SUCCESS `,
                        showConfirmButton: false,
                        text: result.message,
                        timer: 1500
                    });
                    // $('#modal-xl').modal('hide');
                    $('#teamTable').html(result.html);
                    // location.reload();
                },
                error: function(err) {
                    console.log(err);
                    Swal.fire({
                        icon: 'error',
                        title: `ERROR ` + err.status + ` !!!`,
                        text: err.responseJSON.message,
                        showConfirmButton: true,
                    });
                }
            });
        });

    })
</script>
