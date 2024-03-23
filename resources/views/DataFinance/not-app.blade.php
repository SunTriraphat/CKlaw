@extends('layouts.master')
@section('content')
@section('NotAppFin', 'active')


<div class="row g-1">

    {{-- header content --}}
    <div class="row mb-2 g-1">
        <div class="col-9">
            <h5 class=" fw-semibold text-primary"><i class="fa-solid fa-address-book"></i> รายการเบิกที่รออนุมัติ
            </h5>
        </div>

      
       
    </div>


    
</div>
<div class="card col-lg-12">
    <div class="card-body">
        <div class="table-responsive" style="overflow-x:hidden">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                <div class="row">
                    <div class="col-sm-12">


                        <table id="dailytable"
                            class="table dailytable table-hover Custable nowrap dataTable no-footer dtr-inline">
                            <thead>
                                <tr role="row">
                                    <th style="text-align: center;">เลขที่สัญญา</th>
                                    <th style="text-align: center;">ชื่อ-สกุล</th>
                                    <th style="text-align: center;">จำนวน</th>
                                  
                                    <th style="text-align: center;">ดูรายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>

                                        <td style="text-align: center;">{{ $item->CON_NO }}</td>
                                        <td style="text-align: center;">{{ $item->name }} {{ $item->surname }}
                                            {{-- @foreach ($dataGuarantor as $key => $guarantor)
                                                @if ($item->id == $guarantor->cus_id)
                                                    <br>{{ $guarantor->name }} {{ $guarantor->surname }}
                                                @endif
                                            @endforeach --}}
                                        </td>
                                        <td style="text-align: center;">{{count(DB::table('Notapp')->where('status','รออนุมัติ')->where('cus_id',$item->cus_id)->get())}}</td>
                                      

                                        {{-- <td style="text-align: center;">{{ number_format(@$item->CusToFinance->totalsum,2) }}</td> --}}
                                        <td style="text-align: center;">
                                            <a href="{{ route('Cus.show', $item->cus_id) }}?type={{ 'showDetail' }}"
                                                type="button"
                                                class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2">
                                                <i class="mdi mdi-plus me-1"></i> ดูรายละเอียด
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>


<script>
    $(function() {
        $(".Custable").DataTable({
            "responsive": false,
            "autoWidth": false,
            "ordering": true,
            "lengthChange": true,
            "order": [
                [0, "asc"]
            ],
            "pageLength": 5,
            "scrollX": true,
        });
    })
</script>



</div>


@endsection
