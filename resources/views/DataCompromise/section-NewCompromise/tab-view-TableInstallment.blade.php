
<div class="card border border-white mb-2 p-2">
    <div class="card-title">
        @if(@$data->status_exe == 'Y')
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ประนอมหนี้ครั้งที่ {{@$CountExe + 1}}/{{formatThaiYear($Compro->date_com_start)}}</span>
        @else
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ประนอมหนี้ </span>
        @endif
        <a data-link="{{ route('LawCom.show', $Compro->cus_id) }}?type={{ 'InsertComFin' }}" data-bs-toggle="modal"
            data-bs-target="#modal-xl" type="button" class="btn-sm btn float-end btn-secondary ml-2">
            <i class="fa-solid fa-coins"></i> รับชำระ
        </a>

        <a data-link="{{ route('LawCom.show', $Compro->cus_id) }}?type={{ 'InsertComFinForward' }}" data-bs-toggle="modal"
            data-bs-target="#modal-xl" type="button" class="btn-sm btn float-end btn-secondary ml-2">
            <i class="fa-solid fa-coins"></i> รับชำระล่วงหน้า
        </a>
    </div>

    <div id='contentTable'>
        @include('DataCompromise.Finance-com.com-table')
    </div>
   
</div>

<div class="content-loading" style="display: none !important">
    <div class="lds-facebook h-loading">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>





<div class="modal fade" id="Modal-xl" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="ModalScrollableTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-scrollable"></div><!-- /.modal-dialog -->
</div>

<div class="card border border-white mb-2 p-2">
    <div class="card-title">
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> หมายเหตุ (์Note)</span>
        <button type="button" class="btn-sm float-end btn btn-light rounded-circle"><i
                class="fa-solid fa-pen-to-square"></i></button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <p>memo.....</p>
            </div>
        </div>
    </div>
</div>



<script>
    $(function() {
        $('#TBInstallments').DataTable()
    })
</script>

