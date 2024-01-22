<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">นำเข้าข้อมูล (Import Data)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <div class="modal-body">

        {{-- tab search --}}
        <div class="row">
            <div class="col-6">
                {{-- contetn --}}
            </div>
            <div class="col-6">
                <div class="input-group mb-3 gap-2">
                    <button class="btn btn-outline-primary btn-sm rounded-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-list-ul"></i></button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Separated link</a></li>
                    </ul>
                    <input type="text" class="form-control form-control-sm rounded-pill" aria-label="Text input with dropdown button">
                    <button class="btn btn-outline-primary btn-sm rounded-pill btn-search" type="button">ค้นหา <i class="fa-solid fa-magnifying-glass"></i></button>
                  </div>
            </div>
        </div>

        {{-- content search --}}
        <div class="row">
            <div class="col-6 bg-light">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="{{URL::asset('dist/img/cus.png')}}" alt="" srcset="" style="width:120px;">
                    </div>
                    <div class="col-12 mt-2">
                        <h6 class="fw-semibold"><i class="fa-solid fa-circle-user text-primary"></i> Title Header</h6>
                        <table class="table table-sm">
                            <tr>
                                <th class="text-start">title 1</th>
                                <td class="text-end">title 1</td>
                            </tr>
                            <tr>
                                <th class="text-start">title 1</th>
                                <td class="text-end">title 1</td>
                            </tr>
                            <tr>
                                <th class="text-start">title 1</th>
                                <td class="text-end">title 1</td>
                            </tr>
                            <tr>
                                <th class="text-start">title 1</th>
                                <td class="text-end">title 1</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="col-12 mt-2">
                    <h6 class="fw-semibold"><i class="fa-solid fa-circle-user text-primary"></i> Title Header</h6>
                    <table class="table table-sm">
                        <tr>
                            <th class="text-start">title 1</th>
                            <td class="text-end">title 1</td>
                        </tr>
                        <tr>
                            <th class="text-start">title 1</th>
                            <td class="text-end">title 1</td>
                        </tr>
                        <tr>
                            <th class="text-start">title 1</th>
                            <td class="text-end">title 1</td>
                        </tr>
                        <tr>
                            <th class="text-start">title 1</th>
                            <td class="text-end">title 1</td>
                        </tr>
                        <tr>
                            <th class="text-start">title 1</th>
                            <td class="text-end">title 1</td>
                        </tr>
                    </table>
                </div>

                <div class="row">
                    <div class="col-12 d-grid">
                        <button type="button" class="btn btn-outline-success btn-sm rounded-pill ">นำเข้าข้อมูล <i class="fa-solid fa-download"></i></button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
    </div>
  </div>

  <script>
    $('.btn-search').click(()=>{
        $.ajax({
            url : '{{route('Cus.show',0)}}',
            type : 'GET',
            data : {
                type : 'SearchCus',
                _token : '{{ @csrf_token() }}'
            },
            success : (res)=>{

            },
            error : (err)=>{

            }
        })
    })
  </script>
