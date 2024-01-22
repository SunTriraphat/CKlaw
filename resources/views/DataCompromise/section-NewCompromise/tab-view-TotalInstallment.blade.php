
<div class="card border border-white mb-2 p-2">
    {{-- <input type="hidden"class="form-control" value="{{ trim(@$totalValue['interest']) }}" name="interest"
    id="interest" required placeholder=" " />
    <input type="hidden"class="form-control" value="{{ trim(@$Compro->id) }}" name="com_id"
    id="com_id" required placeholder=" " /> --}}
    <div class="card-title">
        @if(@$data->status_exe == 'Y')
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ตารางค่างวดครั้งที่ {{@$CountExe+1}}/{{formatThaiYear($Compro->date_com_start)}}</span>
        @else
        <span class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> ตารางค่างวด </span>
        @endif
        {{-- <a id="test" type="button" class="btn-sm btn float-end btn-secondary ">
            <i class="fa-solid fa-coins"></i> ทดสอบ
        </a> --}}
    </div>

    <div id='installTable'>
        @include('DataCompromise.Finance-com.install-table')
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
    $('#test').click(function(e) {
        let install = $('#interest').val();
        let com_id = $('#com_id').val();
       
        $.ajax({
                url:  "{{ route('LawCom.update' ,0) }}",
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    type: 'UpdateTotalCom',
                    install : install,
                    com_id : com_id,
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
                    location.reload();
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
    })
    
</script>

