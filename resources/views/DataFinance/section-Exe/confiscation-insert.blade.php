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


    <div class="modal-body">
        <div class="col-12 mt-3">
            <form id='edit_invest'>
                <div class="mb-3 input-bx">
                    <span>เลขบิล</span>
                    <input type="text" class="form-control" value="{{ @$bill_no }}" name="bil_no" id="bil_no"
                        required placeholder=" " readonly />
                </div>
                <div class="row">

                    <div class="col-sm-6">
                        <input type="hidden"class="form-control" value="{{ trim(@$customer->id) }}" name="cus_id"
                            id="cus_id" required placeholder=" " />
                        <div class="mb-3 input-bx">
                            <span>ตั้งเรื่องยึดทรัพย์</span>
                            <input type="text" class="form-control" name="setup_con" id="setup_con" required
                                placeholder=" " />
                        </div>
                    </div>
                    <div class="col-sm-6">

                        <div class="mb-3 input-bx">
                            <span>ผู้ขอเบิก</span>
                            <input type="text"class="form-control" value="{{ Auth::user()->name }}" name="Applicant"
                                id="Applicant" required placeholder=" " disabled />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <input type="hidden"class="form-control" value="{{ trim(@$customer->id) }}" name="cus_id"
                            id="cus_id" required placeholder=" " />
                        <div class="mb-3 input-bx">
                            <span>วางเงินค่าประกาศขายทอดตลาด</span>
                            <input type="text" class="form-control" name="auction_announce" id="auction_announce"
                                required placeholder=" " />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <input type="hidden"class="form-control" value="{{ trim(@$customer->id) }}" name="cus_id"
                            id="cus_id" required placeholder=" " />
                        <div class="mb-3 input-bx">
                            <span>ถอนบังคับคดี</span>
                            <input type="text" class="form-control" name="withdraw_execution" id="withdraw_execution"
                                required placeholder=" " />
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="mb-3 input-bx">

                        <button type="button" onclick='addInput()'>+Add input</button>
                        <input type="hidden"class="form-control" value="{{ @$other != null ? count(@$other) : '0' }}"
                            name="num" id="num" required placeholder=" " />
                        <input type="hidden"class="form-control" value="1" name="countNum" id="countNum" required
                            placeholder=" " />
                    </div>
                    @if ($finFuture != null)
                        <div class="col-6">
                            <input type="checkbox" value="Y" id="Finfuture" name="Finfuture" />
                            <label for="Finfuture">หักยอดเบิกล่วงหน้า</label>
                            <input type="hidden" class="form-control" value="{{ $finFuture->id }}" name="fin_id"
                                id="fin_id" required placeholder=" " />
                        </div>
                    @endif
                </div>

                {{-- <div>
                    @foreach ($dataFinance->FinanceToFinOther as $i => $oth)
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <input type="text"class="form-control" value="{{ trim(@$oth->name) }}"
                                    name="name{{ $i + 1 }}" id="name{{ $i + 1 }}" required
                                    placeholder=" "  />
                                <input type="hidden"class="form-control"
                                    value="{{ @$oth->id != null ? trim(@$oth->id) : null }}"
                                    name="id{{ $i + 1 }}" id="id{{ $i + 1 }}" required
                                    placeholder=" " />
                            </div>
                            <div class="col-sm-6 mb-2">
                                <input type="text"class="form-control" value="{{ @$oth->value }}"
                                    name="val{{ $i + 1 }}" id="val{{ $i + 1 }}" required placeholder=" "
                                     />
                            </div>
                        </div>
                    @endforeach
                </div> --}}



                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <div id='input-name'>
                            <!--Input container-->
                        </div>
                    </div>

                    <div class="col-sm-6 mb-2">
                        <div id='input-value'>
                            <!--Input container-->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 input-bx">
                        <span>หมายเหตุ</span>
                        <textarea class="form-control" name="note" id="note" required>{{ @$dataFinance->note }}</textarea>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-primary " id="saveEditBtn">
                        <span class="spinner-border spinner-border-sm" role="status" id="loading-confi"
                            aria-hidden="true" style="display: none"></span>
                        บันทึก
                    </button>

                    <button type="button" class="btn btn-danger " id="close-confi" class="close" data-bs-dismiss="modal"
                        aria-label="Close">ปิด</button>
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
    // Call addInput() function on button click
    function addInput() {
        const container_val = document.getElementById('input-value');
        const container_name = document.getElementById('input-name');
        let num = parseInt($('#num').val());
        let input = document.createElement('input');
        let name = document.createElement('input');

        input.placeholder = 'จำนวน';
        input.id = 'val' + (num + 1);
        input.name = 'val' + (num + 1);
        input.className = 'form-control mb-2';

        name.placeholder = 'ค่าใช้จ่าย';
        name.id = 'name' + (num + 1);
        name.name = 'name' + (num + 1);
        name.className = 'form-control mb-2';

        $('#num').val(num + 1);

        container_val.appendChild(input);
        container_name.appendChild(name);
    }
</script>

<script>
    function autoCurrenncy() {
        var num = $('#num').val();
        console.log(num);
        // for(i = 1 ; i <)
        // let capital_sue = document.getElementById("capital_sue");
        // capital_sue.value = capital_sue.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    }
</script>



<script type="text/javascript">
    $(function() {

        let type = $('#type').val();
        console.log(type);
        // let currentDate = document.getElementById('date-input').valueAsDate = new Date();
        // console.log(currentDate);
        $('#saveEditBtn').hide()
        $('#edit_invest').on('change input', () => {

            $('#saveEditBtn').show()
        })

        $('#saveEditBtn').click(function(e) {

            $('#saveEditBtn').prop('disabled', true);
            $('#close-confi').prop('disabled', true);
            $('#loading-confi').show();

            let num = parseInt($('#num').val());

            let Applicant = $('#Applicant').val();
            data = {
                status: '',
                Applicant: Applicant,
                Finfuture: 'N'
            };
            console.log('data', data);

            $('#edit_invest').serializeArray().map(function(x) {
                data[x.name] = x.value;
            });


            var count = parseInt($('#countNum').val());
            console.log('count bofore', count);
            for (i = 1; i < num; i++) {

                if ($('#name' + i).val() != '' || $('#val' + i).val() != '') {
                    data['name' + i] = $('#name' + i).val();
                    data['val' + i] = $('#val' + i).val();
                    data['status' + i] = 'ขั้นฟ้อง';
                    count++;
                }
                // array.push("{name:" + other['name'] + ",value:" + other['value'] + "}");
                // array.push($('#name' + i).val());
                // array.push($('#val' + i).val());
                // array.push('ขั้นฟ้อง');
                // array.push(JSON.stringify(other));
                // array.push(other['value']);
            }
            console.log(count);
            data['count'] = count;
            // data['array'] = array;

            // console.log('array', array);


            console.log(data);
            let cus_id = $('#cus_id').val();
            console.log('id', cus_id);
            let name = $('#name').val();
            let surname = $('#surname').val();
            let CON_NO = $('#CON_NO').val();
            let prefix = $('#prefix').val();
            let Engname = $('#Engname').val();
            let EngSurname = $('#EngSurname').val();
            let ID_num = $('#ID_num').val();
            let Nickname = $('#Nickname').val();
            let PhoneNum = $('#PhoneNum').val();
            let method = $('#method').val();



            var link = "{{ route('Fin.store', 'id') }}";
            var url = link.replace('id', cus_id)
            data['type'] = 'InsertCon'


            $.ajax({
                url: url,
                method: 'POST',
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

                    $('#content-confiscation').html(result.html) ;

                    $('#saveEditBtn').prop('disabled', false);
                    $('#close-confi').prop('disabled', false);
                    $('#loading-confi').hide();
                },
                error: function(err) {
                    console.log(err);
                    Swal.fire({
                        icon: 'error',
                        title: `ERROR ` + err.status + ` !!!`,
                        text: err.responseJSON.message,
                        showConfirmButton: true,
                    });
                    $('#saveEditBtn').prop('disabled', false);
                    $('#close-confi').prop('disabled', false);
                    $('#loading-confi').hide();

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
