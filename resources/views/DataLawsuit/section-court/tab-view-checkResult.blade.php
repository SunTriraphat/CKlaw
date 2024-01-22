<div class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> บันทึกการตรวจผลหมาย (Tag)</span>
        <button type="button" class="btn-sm float-end btn btn-success rounded-circle"><i class="fa-solid fa-plus"></i></button>
      </div>
    <div class="card-body">
        <div class="row">
            <div class="d-flex" style="overflow: auto;">

                {{-- add --}}
                @component('components.content-card.CardAdd')
                    @slot('data',[
                        'modalSize' => 'modal-lg',
                        'route' => 'Con.create',
                        'type' => 'createTag',
                        'id' => '555'
                    ])
                @endcomponent

                {{-- card con --}}
                @component('components.content-card.card')
                    @slot('data',[
                        'code' => '555',
                        'status' => 'ฟ้อง'
                    ])
                @endcomponent

            </div>
        </div>
    </div>
</div>

<div class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ขั้นตอนฟ้อง (45-60 วัน)</span>
        <a data-link="{{ route('Law.show', $item->id) }}?type={{ 'Editcus6' }}" data-bs-toggle="modal"
            data-bs-target="#modal-xl" type="button" class="btn-sm float-end btn btn-light rounded-circle">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
     </div>
    <div class="card-body">
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
    </div>
</div>

<div class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> หมายเหตุ (์Note)</span>
        <button type="button" class="btn-sm float-end btn btn-light rounded-circle"><i class="fa-solid fa-pen-to-square"></i></button>
      </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <p>memo.....</p>
            </div>
        </div>
    </div>
</div>
