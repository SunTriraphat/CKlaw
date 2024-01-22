{{--  --}}

<div id="trackShow"  class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> เพิ่มรายละเอียดการติดตาม</span>
       
        @if ($status_tag != 'เดือนนี้สร้างไปแล้ว' && Carbon\Carbon::parse(@$ComInstall->where('totalSum', '!=', '0')->first()->due_date)->DiffInMonths($today)>=2)
            <a data-link="{{ route('Tracking.show', $Compro->cus_id) }}?type={{ 'addTrack' }}" data-bs-toggle="modal"
                data-bs-target="#modal-sm" type="button" class="btn-sm btn float-end btn-secondary ml-2">
                <i class="fa-solid fa-plus"></i> เพิ่มการติดตาม
            </a>
        @endif

         {{-- <a data-link="{{ route('Tracking.show', $Compro->cus_id) }}?type={{ 'addTrack' }}" data-bs-toggle="modal"
                data-bs-target="#modal-sm" type="button" class="btn-sm btn float-end btn-secondary ml-2">
                <i class="fa-solid fa-plus"></i> เพิ่มการติดตาม
            </a> --}}
    </div>

    <div style="overflow-x: scroll ; max-width: 1000px; display:flex;">

        @foreach ($Tracking as $itemTrack)
            <div style="max-width: 300px ; min-width: 300px; ">
                <div class="card">
                    <div class="card-body ">
                        <h5 class="card-title">{{ formatDateThaiMY($itemTrack->date_tag) }}</h5>
                        <p class="card-text">
                            สถานะ : {{$itemTrack->status}}
                        </p>

                        <a data-link="{{ route('Tracking.show', $itemTrack->id) }}?type={{ 'trackDetail' }}"
                            data-bs-toggle="modal" data-bs-target="#modal-lg" type="button" class=" btn btn-primary ">
                            รายละเอียด
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- <div class="card-body">
        <div class="row">
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">วันทีจากระบบ</th>
                        <td class="text-end">content 1</td>
                    </tr>
                    <tr>
                        <th class="text-start">วันทีโทร</th>
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
                        <th class="text-start">วันที่ตรวจจริง</th>
                        <td class="text-end">content 1</td>
                    </tr>
                    <tr>
                        <th class="text-start">วันทีไปรับ</th>
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
    </div> --}}
</div>
