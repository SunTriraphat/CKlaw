<div class="modal-content" id="formCreate">
    <div class="row me-4 mt-2">
        <div class="d-flex">
            <div class="flex-shrink-0 me-4">
                {{-- <img src="{{ URL::asset('\assets/images/calculator.png') }}" alt="" style="width: 40px;"> --}}
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <h5 class="text-primary fw-semibold pb-2">ปิดบัญชี</h5>
                <p class="border-primary border-bottom mb-0"></p>

            </div>
        </div>
    </div>


    {{-- <div class="modal-body">
        <div class="col-12">
            <form id='edit_Tribunal'>
                <div class="row">
                    <div class="mb-3 input-bx">
                        <span>ยอดหนี้</span>
                        <input type="text"class="form-control"
                            value="{{ $data->CusToCom->totalSum != null ? trim(@$data->CusToCom->totalSum) : trim(@$data->CusToTri->debt_balance) }}"
                            name="total_sum" id="total_sum" required placeholder=" " readonly />
                    </div>

                    <input type="hidden"class="form-control" value="{{ trim(@$data->id) }}" name="cus_id"
                        id="cus_id" required placeholder=" " />

                    <div class="mb-3 input-bx">
                        <span>ส่วนลด</span>
                        <input type="text"class="form-control" value="{{ @$data->CusToClose->discount }}"
                            name="discount" id="discount" onkeyup="autoTotalPay()" required />
                    </div>
                    <div class="mb-3 input-bx">
                        <span>ยอดชำระ</span>
                        <input type="text"class="form-control" value="{{ @$data->CusToClose->total_pay }}"
                            name="total_pay" id="total_pay" required />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary " id="SaveBtn">ใช่</button>
                    <button type="button" class="btn btn-danger " class="close" data-bs-dismiss="modal"
                        aria-label="Close">ไม่</button>
                </div>

            </form>
        </div>


    </div> --}}


    <div class="modal-body">
        <div class="col-12">
            <form id='edit_Tribunal'>
                <div class="row">
                    <div class="mb-3 input-bx">
                        <span>ยอดหนี้</span>
                        @php
                            $totalClose = @$data->CusToCom->totalSum - @$data->CusToExe->check_balance;
                            if ($totalClose < 0) {
                                $totalClose = 0;
                            }
                        @endphp
                        <input type="text"class="form-control"
                            value="{{ ($data->CusToCom->totalSum == null
                                    ? trim(@$data->CusToTri->debt_balance)
                                    : $data->CusToCom->status == 'close')
                                ? trim(@$totalClose)
                                : trim(@$data->CusToCom->totalSum) }}"
                            name="total_sum" id="total_sum" required placeholder=" " readonly />
                        {{-- <input type="text"class="form-control"
                            value="{{ $data->CusToCom->totalSum != null 
                            ? $data->CusToCom->status == 'ประนอมหนี้เดิม' 
                                ?  trim(@$data->CusToCom->totalSum - @$data->CusToExe->check_balance) 
                                :   trim(@$data->CusToCom->totalSum)
                            : trim(@$data->CusToTri->debt_balance) }}"
                            name="total_sum" id="total_sum" required placeholder=" " readonly /> --}}
                    </div>

                    <input type="hidden"class="form-control" value="{{ trim(@$data->id) }}" name="cus_id"
                        id="cus_id" required placeholder=" " />
                    <input type="hidden"class="form-control" value="{{ trim(@$data->CusToClose->discountApp) }}"
                        name="discountApp" id="discountApp" required placeholder=" " />

                    <div class="mb-3 input-bx">
                        <span>ส่วนลด</span>
                        <input type="text"class="form-control"
                            value="{{ @$data->CusToClose->discount != null ? @$data->CusToClose->discount : 0 }}"
                            name="discount" id="discount"
                            {{ @$data->CusToClose->discountApp == 'อนุมัติ' || @$data->CusToClose->discountApp == 'รออนุมัติ'
                                ? 'readonly'
                                : '' }}
                            onkeyup="autoTotalPay()" required />
                    </div>
                    <div class="mb-3 input-bx">
                        <span>ยอดชำระ</span>
                        <input type="text"class="form-control"
                            value="{{ @$data->CusToClose->total_pay != null ? @$data->CusToClose->total_pay : $totalClose }}"
                            name="total_pay" id="total_pay" required />
                    </div>
                </div>

                <div class="modal-footer">
                    @if (@$data->status_close != 'Y')
                        {{-- @if (@$data->CusToClose->discountApp == '') --}}
                        <button type="button" class="btn btn-primary " id="SaveBtn">ใช่</button>

                        <button type="button" class="btn btn-primary " id="discountRequestBtn">ขอนุมัติส่วนลด</button>

                        @if (@$data->CusToClose->discountApp == 'รออนุมัติ')
                            @if (Auth::user()->position == 'Admin')
                                <button type="button" class="btn btn-primary "
                                    id="discountCancelBtn">ยกเลิกส่วนลด</button>
                                <button type="button" class="btn btn-primary " id="AppBtn">อนุมัติ</button>
                                <button type="button" class="btn btn-primary " id="NotAppBtn">ไม่อนุมัติ</button>
                            @else
                                <button type="button" class="btn btn-primary "
                                    id="discountCancelBtn">ยกเลิกส่วนลด</button>
                            @endif
                        @endif
                    @endif
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

    function autoTotalPay() {
        let totalSum = document.getElementById("total_sum");
        let discount = document.getElementById("discount");
        let total_pay = document.getElementById("total_pay");

        total_pay.value = parseFloat(totalSum.value) - parseFloat(discount.value);

        // period.value = period.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    }
</script>







<script type="text/javascript">
    $(function() {

        let case_type = $('#case_typeHiden').val();
        $('#case_type').val(case_type);

        // let currentDate = document.getElementById('date-input').valueAsDate = new Date();
        // console.log(currentDate);

        $('#discount').on('change input', () => {
            let discount = $('#discount').val();
            console.log(discount == '');
            if (parseFloat(discount) > 0 && discount != '') {
                $('#SaveBtn').hide();
            } else {
                $('#SaveBtn').show();
            }

        })

        $('#SaveBtn').click(function(e) {



            data = {};
            console.log('data', data);

            $('#edit_Tribunal').serializeArray().map(function(x) {
                data[x.name] = x.value;
            });

            console.log(data);
            let cus_id = $('#cus_id').val();
            console.log(cus_id);


            let link = "{{ route('Law.update', 'cus_id') }}?type={{ 'CloseStatus' }}";
            let url = link.replace('cus_id', cus_id);
            console.log(url);

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
                    let url = `{{ route('Law.show', 'ID') }}?type={{ 'showCus' }}`
                    let urlTo = url.replace('ID', result.id)
                    console.log(urlTo);
                    window.location.href = urlTo;

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

        $('#discountRequestBtn').click(function(e) {

            data = {};
            console.log('data', data);

            $('#edit_Tribunal').serializeArray().map(function(x) {
                data[x.name] = x.value;
            });

            console.log(data);
            let cus_id = $('#cus_id').val();
            console.log(cus_id);


            let link = "{{ route('Exe.update', 'cus_id') }}?type={{ 'discountRequest' }}";
            let url = link.replace('cus_id', cus_id);
            console.log(url);

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
                    let url = `{{ route('Law.show', 'ID') }}?type={{ 'showCus' }}`
                    let urlTo = url.replace('ID', result.id)
                    console.log(urlTo);
                    window.location.href = urlTo;

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
        $('#discountCancelBtn').click(function(e) {
            let discount = $('#discount').val();
            console.log(discount);
            data = {
                'discount': discount
            };
            console.log('data', data);

            $('#edit_Tribunal').serializeArray().map(function(x) {
                data[x.name] = x.value;
            });

            console.log(data);
            let cus_id = $('#cus_id').val();
            console.log(cus_id);


            let link = "{{ route('Law.update', 'cus_id') }}?type={{ 'discountAppCancel' }}";
            let url = link.replace('cus_id', cus_id);
            console.log(url);

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
                    let url = `{{ route('Law.show', 'ID') }}?type={{ 'showCus' }}`
                    let urlTo = url.replace('ID', result.id)
                    console.log(urlTo);
                    window.location.href = urlTo;

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
        $('#NotAppBtn').click(function(e) {
            let discount = $('#discount').val();
            console.log(discount);
            data = {
                'discount': discount
            };
            console.log('data', data);

            $('#edit_Tribunal').serializeArray().map(function(x) {
                data[x.name] = x.value;
            });

            console.log(data);
            let cus_id = $('#cus_id').val();
            console.log(cus_id);


            let link = "{{ route('Law.update', 'cus_id') }}?type={{ 'discountAppNot' }}";
            let url = link.replace('cus_id', cus_id);
            console.log(url);

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
                    let url = `{{ route('Law.show', 'ID') }}?type={{ 'showCus' }}`
                    let urlTo = url.replace('ID', result.id)
                    console.log(urlTo);
                    window.location.href = urlTo;

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
        $('#AppBtn').click(function(e) {
            let discount = $('#discount').val();
            console.log(discount);
            data = {
                'discount': discount
            };
            console.log('data', data);

            $('#edit_Tribunal').serializeArray().map(function(x) {
                data[x.name] = x.value;
            });

            console.log(data);
            let cus_id = $('#cus_id').val();
            console.log(cus_id);


            let link = "{{ route('Law.update', 'cus_id') }}?type={{ 'discountApp' }}";
            let url = link.replace('cus_id', cus_id);
            console.log(url);

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
                    let url = `{{ route('Law.show', 'ID') }}?type={{ 'showCus' }}`
                    let urlTo = url.replace('ID', result.id)
                    console.log(urlTo);
                    window.location.href = urlTo;

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
