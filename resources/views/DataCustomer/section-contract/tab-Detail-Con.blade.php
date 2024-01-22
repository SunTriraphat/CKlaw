


<div class="row mb-2 g-1">

    {{-- @php
        $countSue = 0;
        $countWitness = 0;
        $countProperty = 0;
        $SueOtherNot = 0;
        $WitnessOtherNot = 0;
        $PropertyOtherNot = 0;
        foreach (@$financeOther as $dataOther) {
            if ($dataOther->status == 'ขั้นฟ้อง') {
                if ($dataOther->statusFin != 'approved') {
                    $SueOtherNot = $SueOtherNot + 1;
                }
                $countSue = $countSue + 1;
            }
            if ($dataOther->status == 'ขั้นสืบพยาน') {
                if ($dataOther->statusFin != 'approved') {
                    $WitnessOtherNot = $WitnessOtherNot + 1;
                }
                $countWitness = $countWitness + 1;
            }
            if ($dataOther->status == 'ขั้นตั้งเจ้าพนักงาน') {
                if ($dataOther->statusFin != 'approved') {
                    $PropertyOtherNot = $PropertyOtherNot + 1;
                }
                $countProperty = $countProperty + 1;
            }
        }
        
    @endphp --}}
   
        <div class="col-12">
            {{-- ข้อมูลสัญญา --}}
            <div class="card border border-white mb-2 p-2">
                <div class="card-title">
                    <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ข้อมูลสัญญา (Data
                        Contracts)</span>
                    <a data-link="{{ route('Cus.show', $data->id) }}?type={{ 'EditDatacus' }}" data-bs-toggle="modal"
                        data-bs-target="#modal-xl" type="button" class="btn-sm float-end btn btn-light rounded-circle">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                </div>
                
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th class="text-start">เลขที่สัญญา</th>
                                        <td class="text-end">{{ @$data->CON_NO }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">ชื่อ</th>
                                        <td class="text-end">{{ @$data->name }}</td>
                                    </tr>

                                    <tr>
                                        <th class="text-start">เลขบัตรประชาชน</th>
                                        <td class="text-end">
                                            <span class="input-mask" id="ID_numShow" data-inputmask="'mask': '9-9999-99999-99-9'">{{ @$data->ID_num }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th class="text-start">คำนำหน้า</th>
                                        <td class="text-end">{{ @$data->prefix }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">นามสกุล</th>
                                        <td class="text-end">{{ @$data->surname }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">เบอร์โทร</th>
                                        <td class="text-end">
                                            <span class="input-mask" id="PhoneNumShow" data-inputmask="'mask': '999-9999999'">{{ $data->PhoneNum }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            {{-- <div class="col-12">
                                <tr>
                                    <th class="text-start"><strong>ที่อยู่ : </strong></th>
                                    <td class="text-end">{{ @$data->address }} </td>
                                </tr>

                            </div> --}}

                        </div>
                    </div>
               

                {{-- ข้อมูลทรัพย์ --}}
                <div class="card-title">
                    <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ข้อมูลทรัพย์ (Asset
                        Details)</span>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-xl" data-link=""
                        class="btn-sm float-end btn btn-light rounded-circle"><i
                            class="fa-solid fa-pen-to-square"></i></button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <table class="table table-sm">
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-6">
                            <table class="table table-sm">
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>


                {{-- ข้อมูลการขจัด --}}

                <div class="card-title">
                    <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ข้อมูลการจัด
                        (Finance Details)</span>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-xl" data-link=""
                        class="btn-sm float-end btn btn-light rounded-circle"><i
                            class="fa-solid fa-pen-to-square"></i></button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <table class="table table-sm">
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-6">
                            <table class="table table-sm">
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                                <tr>
                                    <th class="text-start">title1</th>
                                    <td class="text-end">content 1</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-4">
            <div class="card border border-white mb-2 p-2 h-100">
                <div class="card-body">
                    <div class="card-title fw-semibold text-primary">
                        <i class="fa-solid fa-address-book"></i> การเงิน(Finance)
                        @if ((Auth::user()->position == 'Finance' || Auth::user()->position == 'Admin') && @$totalsum != 0)
                                

                                <a data-link="{{ route('Fin.show', $data->id) }}?type={{ 'UpdateFin' }}"
                                    type="button" data-bs-toggle="modal" data-bs-target="#modal-sm"
                                    class="float-end btn btn-sm btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                    อนุมัติ
                                </a>
                            @endif
                    </div>
                    @foreach ($finance as $dataFin)
                        <div class="col-12">
                            <input type="hidden"class="form-control" value="{{ trim(@$dataFin->cus_id) }}"
                                name="cus_id" id="cus_id" required placeholder=" " />

                            

                        </div>
                        <table class="table table-sm">
                            <div>
                                @if ($dataFin->court_fee != '' || $dataFin->send_defendant != '' || $countSue != 0)
                                    <div class="card-title fw-semibold text-primary"><i
                                            class="fa-solid fa-hashtag"></i> ขั้นฟ้อง
                                    </div>
                                @endif
                                @if ($dataFin->court_fee != '')
                                    <tr>
                                        <th
                                            class="text-start {{ @$dataFin->status1 != 'approved' ? 'table-danger' : 'table-success' }} ">
                                            ค่าธรรมเนียมศาลฟ้องคดี</th>
                                        <td
                                            class="text-end {{ @$dataFin->status1 != 'approved' ? 'table-danger' : 'table-success' }}">
                                            {{ number_format($dataFin->court_fee, 2) }}</td>
                                    </tr>
                                @endif

                                @if ($dataFin->send_defendant != '')
                                    <tr>
                                        <th
                                            class="text-start {{ @$dataFin->status2 != 'approved' ? 'table-danger' : 'table-success' }}">
                                            ค่าส่งหมายเรียกจำเลย</th>
                                        <td
                                            class="text-end {{ @$dataFin->status2 != 'approved' ? 'table-danger' : 'table-success' }}">
                                            {{ number_format($dataFin->send_defendant, 2) }}</td>
                                    </tr>
                                @endif
                            </div>
                        </table>

                        <table class="table table-sm">
                            <tr>
                                @if ($countSue != 0)
                                    <th
                                        class="text-start {{ @$SueOtherNot == 0 ? 'table-success' : 'table-danger' }}">
                                        อื่นๆ </th>
                                    <td class="text-end {{ @$SueOtherNot == 0 ? 'table-success' : 'table-danger' }}">
                                        <a data-toggle="collapse" href="#collapseExample" role="button"
                                            aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fa-solid fa-caret-down"></i>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        </table>


                        <div class="collapse " id="collapseExample">
                            <div class="card card-body ">
                                <div>
                                    <div class="row ">
                                        <div class="col-sm-12">
                                            @foreach (@$financeOther as $other)
                                                @if ($other->status == 'ขั้นฟ้อง')
                                                    <div
                                                        class="{{ @$other->statusFin != 'approved' ? 'alert alert-danger' : 'alert alert-success' }}">

                                                        {{ $other->name }} =
                                                        {{ number_format($other->value, 2) }}
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-sm">
                            @foreach ($finance as $data)
                                <div>

                                    @if ($countWitness != 0 || ($data->check_ownership != '' || $data->copy_documents2 != '' || $data->point_property != ''))
                                        <div class="card-title fw-semibold text-primary"> <i
                                                class="fa-solid fa-hashtag"></i> ขั้นตั้งเจ้าพนักงาน
                                        </div>
                                    @endif
                                    @if ($data->check_ownership != '')
                                        <tr>
                                            <th
                                                class="text-start {{ @$data->status5 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                ค่าตรวจกรรมสิทธิ์ทรัพย์</th>
                                            <td
                                                class="text-end {{ @$data->status5 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                {{ number_format($data->check_ownership, 2) }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($data->copy_documents2 != '')
                                        <tr>
                                            <th
                                                class="text-start {{ @$data->status6 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                ค่าคัดถ่ายและรับรองเอกสาร</th>
                                            <td
                                                class="text-end {{ @$data->status6 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                {{ number_format($data->copy_documents2, 2) }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($data->point_property != '')
                                        <tr>
                                            <th
                                                class="text-start {{ @$data->status6 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                ค่านำชี้ทรัพย์</th>
                                            <td
                                                class="text-end {{ @$data->status6 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                {{ number_format($data->point_property, 2) }}
                                            </td>
                                        </tr>
                                    @endif
                            @endforeach
                        </table>
                        <table class="table table-sm">
                            @foreach ($finance as $dataFin)
                                <div>

                                    @if ($countWitness != 0 || ($dataFin->mandatory_fee != '' || $dataFin->copy_documents1 != ''))
                                        <div class="card-title fw-semibold text-primary"> <i
                                                class="fa-solid fa-hashtag"></i> ขั้นสืบพยาน
                                        </div>
                                    @endif
                                    @if ($dataFin->mandatory_fee != '')
                                        <tr>
                                            <th
                                                class="text-start {{ @$dataFin->status3 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                ค่าส่งคำบังคับ</th>
                                            <td
                                                class="text-end {{ @$dataFin->status3 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                {{ number_format($dataFin->mandatory_fee, 2) }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($dataFin->copy_documents1 != '')
                                        <tr>
                                            <th
                                                class="text-start {{ @$dataFin->status4 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                ค่าคัดถ่ายและรับรองเอกสาร</th>
                                            <td
                                                class="text-end {{ @$dataFin->status4 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                {{ number_format($dataFin->copy_documents1, 2) }}
                                            </td>
                                        </tr>
                                    @endif
                            @endforeach
                        </table>

                        <table class="table table-sm">
                            <tr>

                                @if ($countWitness != 0)
                                    
                                    <th
                                        class="text-start  {{ @$WitnessOtherNot == 0 ? 'table-success' : 'table-danger' }}">
                                        อื่นๆ </th>
                                    <td
                                        class="text-end {{ @$WitnessOtherNot == 0 ? 'table-success' : 'table-danger' }}">
                                        <a data-toggle="collapse" href="#collapseExample2" role="button"
                                            aria-expanded="false" aria-controls="collapseExample2">
                                            <i class="fa-solid fa-caret-down"></i>
                                        </a>
                                    </td>
                                @endif
                               
                            </tr>
                        </table>
                        <div class="collapse" id="collapseExample2">
                            <div class="card card-body">
                                <div>
                                    <div class="row ">
                                        <div class="col-sm-12">
                                            @foreach (@$financeOther as $other)
                                                @if ($other->status == 'ขั้นสืบพยาน')
                                                    <div
                                                        class="{{ @$other->statusFin != 'approved' ? 'alert alert-danger' : 'alert alert-success' }}">

                                                        {{ $other->name }} =
                                                        {{ number_format($other->value, 2) }}
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-sm">
                            @foreach ($finance as $dataFin)
                                <div>

                                    @if ($countWitness != 0 || ($dataFin->check_ownership != '' || $dataFin->copy_documents2 != '' || $dataFin->point_property != ''))
                                        <div class="card-title fw-semibold text-primary"> <i
                                                class="fa-solid fa-hashtag"></i> ขั้นตั้งเจ้าพนักงาน
                                        </div>
                                    @endif
                                    @if ($dataFin->check_ownership != '')
                                        <tr>
                                            <th
                                                class="text-start {{ @$dataFin->status5 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                ค่าตรวจกรรมสิทธิ์ทรัพย์</th>
                                            <td
                                                class="text-end {{ @$dataFin->status5 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                {{ number_format($data->check_ownership, 2) }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($dataFin->copy_documents2 != '')
                                        <tr>
                                            <th
                                                class="text-start {{ @$dataFin->status6 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                ค่าคัดถ่ายและรับรองเอกสาร</th>
                                            <td
                                                class="text-end {{ @$dataFin->status6 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                {{ number_format($dataFin->copy_documents2, 2) }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($dataFin->point_property != '')
                                        <tr>
                                            <th
                                                class="text-start {{ @$dataFin->status6 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                ค่านำชี้ทรัพย์</th>
                                            <td
                                                class="text-end {{ @$dataFin->status6 != 'approved' ? 'table-danger' : 'table-success' }}">
                                                {{ number_format($dataFin->point_property, 2) }}
                                            </td>
                                        </tr>
                                    @endif
                            @endforeach
                        </table>
                        <table class="table table-sm">
                            <tr>

                                @if ($countProperty != 0)
                                    
                                    <th
                                        class="text-start {{ @$PropertyOtherNot == 0 ? 'table-success' : 'table-danger' }}">
                                        อื่นๆ </th>
                                    <td
                                        class="text-end  {{ @$PropertyOtherNot == 0 ? 'table-success' : 'table-danger' }}">
                                        <a data-toggle="collapse" href="#collapseExample3" role="button"
                                            aria-expanded="false" aria-controls="collapseExample3">
                                            <i class="fa-solid fa-caret-down"></i>
                                        </a>
                                    </td>
                                @endif
                               
                            </tr>
                        </table>

                        <div class="collapse" id="collapseExample3">
                            <div class="card card-body">
                                <div>
                                    <div class="row ">
                                        <div class="col-sm-12">
                                            @foreach (@$financeOther as $other)
                                                @if ($other->status == 'ขั้นตั้งเจ้าพนักงาน')
                                                    <div
                                                        class="{{ @$other->statusFin != 'approved' ? 'alert alert-danger' : 'alert alert-success' }}">

                                                        {{ $other->name }} =
                                                        {{ number_format($other->value, 2) }}
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($data as $data)
                        @if (@$data->CustoFinance->sumNotApproved != 0)
                            <div class="alert alert-danger" role="alert">
                                ยอดที่ไม่อนุมัติ: {{ number_format(@$data->CustoFinance->sumNotApproved, 2) }}
                            </div>
                        @endif
                        @if (@$data->CustoFinance->sumApproved != 0)
                            <div class="alert alert-success" role="alert">
                                ยอดที่อนุมัติ: {{ number_format(@$data->CustoFinance->sumApproved, 2) }}
                            </div>
                        @endif
                        @if (@$totalsum != 0)
                            <table class="table table-sm">
                                <tr>
                                    <th class=" text-danger text-start">รวม</th>
                                    <td class=" text-danger text-end">{{ number_format(@$data->CustoFinance->totalsum, 2) }}</td>
                                </tr>

                            </table>
                        @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div> --}}
   
</div>



{{-- <script src="{{ URL::asset('js/plugin.js') }}"></script> --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script> --}}

    {{-- <script>
        $(document).ready(function() {
            $('#ID_num').mask('9-9999-99999-99-9');
            $('#PhoneNum').mask('999-9999999');
            $('#ID_numShow').mask('9-9999-99999-99-9');
            $('#PhoneNumShow').mask('999-9999999');
            
            let type = $('#type').val();
            console.log(type);
            // let currentDate = document.getElementById('date-input').valueAsDate = new Date();
            // console.log(currentDate);
            $('#saveEditCusBtn').hide()
            $('#edit_cus').on('change input', () => {
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
                let id = $('#id').val();
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
    
    
                let link = `{{ route('Cus.update', 'id') }}?type=${type}`;
                let url = link.replace('id', id);
                console.log(url);
                // if (name != '' && surname != '' && prefix != '' && ID_num != '' && PhoneNum !=
                //     '') {
    
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
    </script> --}}

