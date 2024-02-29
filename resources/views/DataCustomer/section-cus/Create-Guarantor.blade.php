@include('public_Script.scriptAddress')
{{-- @include('js.plugin.js') --}}

<div class="modal-content" id="formCreate">
    <div class="row me-4 mt-2">
        <div class="d-flex m-3">
            <div class="flex-shrink-0 me-4">
                {{-- <img src="{{ URL::asset('\assets/images/calculator.png') }}" alt="" style="width: 40px;"> --}}
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <h5 class="text-primary fw-semibold pb-2">เพิ่มผู้ค้ำ</h5>
                <p class="border-primary border-bottom mb-0"></p>

            </div>
        </div>
    </div>


        <div class="modal-body">
            <div class="col-12 mt-3">
                <form id='edit_cus' enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">

                           
                                <input type="hidden"class="form-control" value="{{ trim(@$customer->id) }}"
                                    name="cus_id" id="cus_id" required placeholder=" " />
                           
                            <div class="mb-3 input-bx">
                                <span>เลขบัตรประชาชน</span>
                                <input type="text" class="form-control input-mask"
                                    name="ID_num" id="ID_num" data-inputmask="'mask': '9-9999-99999-99-9'"
                                    data-bs-toggle="tooltip" title="เลขบัตรประชาชน" required />
                            </div>
                            <div class="mb-3 input-bx">
                                <span>ชื่อ</span>
                                <input type="text" class="form-control" 
                                    name="name" id="name" required placeholder=" " />
                                <input type="hidden"class="form-control"  name="id"
                                    id="id" required placeholder=" " />
                                
                               
                            </div>
                            <div class="mb-3 input-bx">
                                <span>เบอร์โทร</span>
                                <input type="text" class="form-control input-mask"
                                     name="PhoneNum" id="PhoneNum"
                                    data-bs-toggle="tooltip" data-inputmask="'mask': '999-9999999'" required
                                    placeholder="" />
                            </div>




                         
                        </div>
                        <div class="col-sm-6 ">

                            <div class="mb-3 input-bx">
                                <span>คำนำหน้า</span>

                                <select value="{{ @$item->prefix }}" class="form-select addOPR" id="prefix"
                                    name="prefix" required>
                                    <option value="นาย">นาย
                                    </option>
                                    <option value="นาง">นาง
                                    </option>
                                    <option value="นางสาว">นางสาว
                                    </option>
                                </select>

                            </div>
                            <div class="mb-3 input-bx">
                                <span>นามสกุล</span>
                                <input type="text" class="form-control" 
                                    name="surname" id="surname" required />
                            </div>

                           


                        </div>

                        <div class="row">
                           
                            <div class="col-12 col-lg-6">
                                <div class="form-group row mb-0">
                                    <p class="col-sm-4 col-form-label text-right text-red">Tag Address. : </p>
                                    <div class="col-sm-7">
                                        <input type="text" value="{{ @$data->Code_BrokerAdds }}"
                                            class="form-control form-control-sm textSize-13" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group row mb-0">
                                    <p class="col-sm-4 col-form-label text-right d-none d-sm-block text-red">
                                        บ้านเลขที่ / หมู่ : </p>
                                    <div class="col-12 col-sm-7">
                                        <div class="row">
                                            <div class="col-6 pr-0">
                                                <p
                                                    class="col-12 d-sm-none col-form-label col-form-label-sm textSize-13 text-right text-red">
                                                    บ้านเลขที่ :</p>
                                                <input type="text" name="HouseNumber"
                                                    value="{{ @$Address->HouseNumber }}"
                                                    class="form-control form-control-sm textSize-13"
                                                    placeholder = "บ้านเลขที่" required />
                                            </div>
                                            <div class="col-6">
                                                <p
                                                    class="col-12 d-sm-none col-form-label col-form-label-sm textSize-13 text-right">
                                                    หมู่ :</p>
                                                <input type="text" name="Moo" value="{{ @$Address->Moo }}"
                                                    class="form-control form-control-sm textSize-13"
                                                    placeholder = "หมู่" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group row mb-0">
                                    <p class="col-sm-4 col-form-label text-right">ภูมิภาค : </p>
                                    <div class="col-sm-7">
                                        @php
                                            $dataZone = \App\Models\TB_Provinces::selectRaw('Zone_pro, count(*) as total')
                                                ->groupBy('Zone_pro')
                                                ->orderBY('Zone_pro', 'ASC')
                                                ->get();
                                        @endphp
                                        <select class="form-control form-control-sm textSize-13 houseZone"
                                            name="Region" id="Region" required>
                                            <option value="">--- ภูมิภาค ---</option>
                                            @foreach ($dataZone as $key => $Zone)
                                                <option value="{{ $Zone->Zone_pro }}"
                                                    {{ $Zone->Zone_pro == @$Address->Region ? 'selected' : '' }}>
                                                    {{ $Zone->Zone_pro }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group row mb-0">
                                    <p class="col-sm-4 col-form-label text-right">จังหวัด : </p>
                                    <div class="col-sm-7">
                                        @php
                                            $Province = \App\Models\TB_Provinces::where('Zone_pro', @$Address->Region)
                                                ->selectRaw('Province_pro, count(*) as total')
                                                ->groupBy('Province_pro')
                                                ->orderBY('Province_pro', 'ASC')
                                                ->get();
                                        @endphp
                                        <select class="form-control form-control-sm textSize-13 houseProvince"
                                            name="Province" required>
                                            <option value="" selected>--- จังหวัด ---</option>
                                            @foreach ($Province as $key => $value)
                                                <option value="{{ $value->Province_pro }}"
                                                    {{ $value->Province_pro == @$Address->Province ? 'selected' : '' }}>
                                                    {{ $value->Province_pro }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group row mb-0">
                                    <p class="col-sm-4 col-form-label text-right">อำเภอ : </p>
                                    <div class="col-sm-7">
                                        @php
                                            $District = \App\Models\TB_Provinces::where('Province_pro', @$Address->Province)
                                                ->selectRaw('District_pro, count(*) as total')
                                                ->groupBy('District_pro')
                                                ->orderBY('District_pro', 'ASC')
                                                ->get();
                                        @endphp
                                        <select class="form-control form-control-sm textSize-13 houseDistrict"
                                            name="District" required>
                                            <option value="" selected>--- อำเภอ ---</option>
                                            @foreach ($District as $key => $value)
                                                <option value="{{ $value->District_pro }}"
                                                    {{ $value->District_pro == @$Address->District ? 'selected' : '' }}>
                                                    {{ $value->District_pro }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group row mb-0">
                                    <p class="col-sm-4 col-form-label text-right">ตำบล : </p>
                                    <div class="col-sm-7">
                                        @php
                                            $Tambon = \App\Models\TB_Provinces::where('District_pro', @$Address->District)
                                                ->selectRaw('Tambon_pro, count(*) as total')
                                                ->groupBy('Tambon_pro')
                                                ->orderBY('Tambon_pro', 'ASC')
                                                ->get();
                                        @endphp
                                        <select class="form-control form-control-sm textSize-13 houseTambon"
                                            name="Tumbon" required>
                                            <option value="" selected>--- ตำบล ---</option>
                                            @foreach ($Tambon as $key => $value)
                                                <option value="{{ $value->Tambon_pro }}"
                                                    {{ $value->Tambon_pro == @$Address->Tumbon ? 'selected' : '' }}>
                                                    {{ $value->Tambon_pro }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group row mb-0">
                                    <p class="col-sm-4 col-form-label text-right">เลขไปรษณีย์ : </p>
                                    <div class="col-sm-7">
                                        <input type="number" name="Postcode" value="{{ @$Address->Postcode }}"
                                            class="form-control form-control-sm textSize-13 Postal"
                                            placeholder="เลขไปรษณีย์" required />
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary " id="saveEditCusBtn">บันทึก</button>
                        <button type="button" class="btn btn-danger " class="close" data-bs-dismiss="modal"
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


{{-- <script src="{{ URL::asset('assets/js/plugin.js') }}"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script> --}}

<script>
    $(document).ready(function() {
        Inputmask().mask(document.getElementById('ID_num'));
        Inputmask().mask(document.getElementById('PhoneNum'));
        let type = $('#type').val();
        console.log(type);
        // let currentDate = document.getElementById('date-input').valueAsDate = new Date();
        // console.log(currentDate);
        $('#saveEditCusBtn').hide()

        $('#edit_cus').on('change input', () => {
            $('#saveEditCusBtn').show()
        })
        $('#ID_num,#PhoneNum').on('keypress', () => {
            $('#saveEditCusBtn').show()
        })

        $('#saveEditCusBtn').click(function(e) {
            data = {
                status: ''
            };
            console.log('data', data);

            $('#edit_cus').serializeArray().map(function(x) {
                data[x.name] = x.value;
            });



            console.log(data);
            let cus_id = $('#cus_id').val();
            console.log(id);
            let name = $('#name').val();
            let surname = $('#surname').val();
            let CON_NO = $('#CON_NO').val();
            let prefix = $('#prefix').val();
            let Engname = $('#Engname').val();
            let EngSurname = $('#EngSurname').val();
            let ID_num = $('#ID_num').val();
            let Nickname = $('#Nickname').val();
            let PhoneNum = $('#PhoneNum').val();


         
           
            
            // if (name != '' && surname != '' && prefix != '' && ID_num != '' && PhoneNum !=
            //     '') {

            $.ajax({
                url:"{{ route('Cus.store') }}?type={{ 'CreateGuarantor' }}",
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
                    if (type == 'updateGuarantor') {
                        console.log('updateGuarantor');
                        $('#content-tracking').html(result.html)
                    } else {
                        location.reload();
                    }
                    console.log(result);
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
                    // $('#modal_xl_2').modal('hide');
                }
            });
            // } else {
            //     Swal.fire({
            //         icon: 'error',
            //         title: "ข้อมูลไม่ครบถ้วน",
            //         text: "โปรดตรวจสอบข้อมูลให้ครบถ้วนก่อนบันทึก. !",
            //     })
            // }
        });

        // $('#date-input').on('change input', () => {
        //     let currentDate = $('#date-input').val();
        //     console.log(currentDate);
        // })

    })
</script>
