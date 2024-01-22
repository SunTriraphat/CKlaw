   {{-- tag content --}}


   <div class="row mb-2 g-1">
       @foreach ($dataGuarantor as $i => $dataGuarantor)
           <div class="col-12">
               {{-- ข้อมูลสัญญา --}}

               <div class="card border border-white mb-2 p-2">
                   <div class="card-title">
                       <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ข้อมูลผู้ค้ำคนที่
                           {{ $i + 1 }} </span>
                       <a data-link="{{ route('Cus.show', $dataGuarantor->id) }}?type={{ 'EditGuarantor' }}"
                           data-bs-toggle="modal" data-bs-target="#modal-xl" type="button"
                           class="btn-sm float-end btn btn-light rounded-circle">
                           <i class="fa-solid fa-pen-to-square"></i>
                       </a>
                   </div>

                   <div class="card-body">
                       <div class="row">
                           <div class="col-6">
                               <table class="table table-sm">

                                   <tr>
                                       <th class="text-start">คำนำหน้า</th>
                                       <td class="text-end">{{ @$dataGuarantor->prefix }}</td>
                                   </tr>
                                   <tr>
                                       <th class="text-start">ชื่อ</th>
                                       <td class="text-end">{{ @$dataGuarantor->name }}</td>
                                   </tr>


                                   <tr>
                                       <th class="text-start">เบอร์โทร</th>
                                       <td class="text-end" id="PhoneNumShow{{$i+1}}" data-inputmask="'mask': '999-9999999'">{{ @$dataGuarantor->PhoneNum }}</td>
                                   </tr>
                               </table>
                           </div>
                           <div class="col-6">
                               <table class="table table-sm">
                                   <tr>
                                       <th class="text-start">เลขบัตรประชาชน</th>
                                       <td class="text-end" id="ID_numShow{{$i+1}}" data-inputmask="'mask': '9-9999-99999-99-9'">{{ @$dataGuarantor->ID_num }}</td>
                                   </tr>

                                   <tr>
                                       <th class="text-start">นามสกุล</th>
                                       <td class="text-end">{{ @$dataGuarantor->surname }}</td>
                                   </tr>

                               </table>
                           </div>
                           {{-- <div class="col-12">

                               <tr>
                                   <th class="text-start"><strong>ที่อยู่ : </strong></th>
                                   <td class="text-end">{{ @$dataGuarantor->address }} </td>
                               </tr>

                           </div> --}}

                       </div>
                   </div>

               </div>

           </div>
       @endforeach
   </div>


{{-- 
   <script src="{{ URL::asset('js/plugin.js') }}"></script>
   <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script> --}}

   <script>
       $(function() {
           $('#tableTrack').DataTable()
       })
   </script>
