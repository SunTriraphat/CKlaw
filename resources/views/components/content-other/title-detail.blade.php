<div class="row mb-4">
    <div class="col">
        <h4>เลขที่สัญญา: {{ @$data['code'] }}</h4>
        <h6>ประเภทสัญญา: ฟ้อง{{ @$data['typeloan'] }}</h6>
        
        
    </div>
    <div class="col text-center">
        <h3>ลูกหนี้ <span class="text-danger">{{ @$data['statusLaw'] }} <i class="fa-solid fa-scale-balanced"></i></span></h3>
        <h4 class="text-danger">{{@$data['closeStatus']}} </h4>
        <h6>{{ @$data['txtprogress'] }}</h6>
        <div class="progress" style="height:10px;">
            <div class="progress-bar bg-danger" role="progressbar" aria-label="Example with label" style="width: 25%; " aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
    </div>
    <div class="col text-end">
        <h4>{{ @$data['txtdateLaw'] }}</h4>
        <h6>{{ formatDateThaiLong(@$data['dateLaw'])}}</h6>
    </div>
</div>
