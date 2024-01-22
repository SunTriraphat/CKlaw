<div class="modal-header">
    <h5 class="modal-title">นำเข้า/ส่งออกข้อมูล (Import & Export)</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
{{-- <div class="card p-2 mb-2 mt-2">
    <div class="row g-2">
        <div class="col bg-light text-center p-3">
            <h5>นำเข้าข้อมูล</h5>
            <img src="{{ asset('dist/img/import.png') }}" alt="" class="p-2" style="width : 150px;">
            <div class="input-group">
                <input type="file" name="file" class="mb-1 form-control" id="file"
                    aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
                <button class=" col-12 btn btn-success" id="btnImport">Import Data <span class="loadIM"></span></button>
            </div>

        </div>
    </div>
</div> --}}
<div class="card p-2">
    <div class="row g-2">
        <div class="col bg-light text-center p-3">
            <h5>ส่งออกข้อมูล</h5>
            <img src="{{ asset('dist/img/export.png') }}" alt="" class="p-2" style="width : 150px;">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3 input-bx">
                        <span> ตั้งแต่</span>
                        <input type="date" lang="th-th" value="{{ trim(@$item->fdate) }}" name="fdate"
                            id="fdate" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3 input-bx">
                        <span> ถึง</span>
                        <input type="date" lang="th-th" value="{{ trim(@$item->tdate) }}" name="tdate"
                            id="tdate" class="form-control">
                    </div>
                </div>
            </div>
            <button type="button" class=" col-12 btn btn-success" id="btnExport">Export Excel <span
                    class="loadEX"></span></button>
        </div>
    </div>
</div>
</div>
<script>
    $("#btnExport").click(function() {
        let fdate = $('#fdate').val();
        let tdate = $('#tdate').val();

        if (fdate != '' && tdate != '') {
            $('.loadEX').html(`
            <div class="spinner-border spinner-border-sm" role="status">
            </div>
            `);
            $.ajax({
                url: "{{ route('exportExe.excel') }}",
                type: "post",
                data: {
                    type: 'ExportExe',
                    _token: '{{ @csrf_token() }}',
                    'fdate': $('#fdate').val(),
                    'tdate': $('#tdate').val(),
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: (response) => {
                    var a = document.createElement('a');
                    var url = window.URL.createObjectURL(response);
                    a.href = url;
                    a.download = 'รายงานชั้นบังคับคดี.xlsx';
                    document.body.append(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                    $('.loadEX').html('')

                    Swal.fire({
                        icon: 'success',
                        text: 'ดาวโหลดไฟล์เอกสารเรียบร้อย',
                        timer: 2000,
                    })
                },
                error: (err) => {
                    $('.loadEX').html('')
                    Swal.fire({
                        icon: 'error',
                        text: 'ดาวโหลดไฟล์เอกสารไม่สำเร็จ',
                        timer: 2000,
                    })

                }
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: "ข้อมูลไม่ครบถ้วน",
                text: "โปรดเลือกช่วงเวลา !!!",
            })
        }
    })
</script>
