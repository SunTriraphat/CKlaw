<div class="card border border-white mb-2">
    <div class="card-body">
        <div class="row">
            <div class="col-12 text-center">
                <img src="{{ URL::asset(@$data['img-profile']) }}" alt="" srcset="" style="width:60%">
            </div>
            {{-- <div class="col-12 text-center mt-2">
                <div class="d-grid gap-2">
                    <button class="btn btn-sm btn-warning rounded-pill" data-bs-toggle="modal"
                        data-bs-target="#modal-xl" data-link="" type="button">แก้ไขข้อมูล (Edit Customer)</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill" data-bs-toggle="modal"
                        data-bs-target="#modal-xl" data-link="" type="button">Button</button>
                </div>
            </div> --}}

            <div class="col-12 mt-4">
                {{-- <h6 class="fw-semibold"><i class="fa-solid fa-circle-user text-primary"></i> {{ @$data['title-head'] }}
                </h6> --}}
                <table class="table table-sm">
                    @foreach (@$data['cusData'] as $key => $item)
                        <tr>
                            <th class="text-start">โจทย์</th>

                            <td class="text-end"> {{ $item->plaintiff }}  </td>


                        </tr>
                        <tr>
                            <th class="text-start">สถานะ</th>
                            @if ($item->status_tribunal == 'N')
                                <td class="text-end"> ลูกค้ารอส่งชั้นศาล </td>
                            @elseif ($item->status_tribunal == 'Y' && $item->status_com == 'N' && $item->status_exe == 'N')
                                <td class="text-end"> ลูกค้าชั้นศาล </td>
                            @elseif ($item->status_com == 'Y')
                                <td class="text-end"> ลูกค้าประนอมหนี้ </td>
                            @elseif ($item->status_tribunal == 'Y' && $item->status_com == 'N' && $item->status_exe == 'Y')
                                <td class="text-end"> ลูกค้าชั้นบังคับคดี </td>
                            @endif
                        </tr>
                        <tr>
                            <th class="text-start">ชื่อ-นามสกุล</th>

                            <td class="text-end"> {{$item->prefix}}{{ $item->name }} {{ $item->surname }} </td>

                            {{-- <td class="text-end"> {{ $item->TribunalToCus->name }} {{ $item->TribunalToCus->surname }}</td> --}}
                        </tr>


                        @foreach (@$data['Guarantor'] as $i => $data['Guarantor'])
                            @if ($data['Guarantor']->cus_id == $item->id || $data['Guarantor']->cus_id == $item->TribunalToCus->id)
                                <tr>
                                    <th class="text-start">ผู้ค้ำคนที่{{ $i + 1 }}</th>
                                    <td class="text-end"> {{$data['Guarantor']->prefix}}{{ $data['Guarantor']->name }}
                                        {{ $data['Guarantor']->surname }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
