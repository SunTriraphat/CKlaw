

<div class="card border border-white mb-2 p-2">

    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> คัดหนังสือรับรองคดีถึงที่สุด (15-30 วัน)</span>
        <a data-link="{{ route('Exe.show', @$data->cus_id) }}?type={{ 'select-case' }}" data-bs-toggle="modal"
            data-bs-target="#modal-xl" type="button" class="btn-sm float-end btn btn-light rounded-circle">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
      </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">กำหนดการคัดหนังสือ</th>
                        <td class="text-end">{{formatDateThai(@$data->date_book_selection)}}</td>
                    </tr>
                   
                </table>
            </div>
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th class="text-start">วันที่คัดหนังสือรับรองคดี</th>
                        <td class="text-end">{{formatDateThai(@$data->date_book_certificate)}}</td>
                    </tr>
                   
                </table>
            </div>
        </div>
    </div>
</div>


