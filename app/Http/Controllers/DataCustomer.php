<?php

namespace App\Http\Controllers;

use App\Models\CuaAddress;
use App\Models\CusAddress;
use App\Models\Customer;
use App\Models\GuaAddress;
use App\Models\Plaintiff;
use App\Models\TB_Provinces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tribunal_debt;
use App\Models\Tribunal_status;
use App\Models\FinanceOther;
use App\Models\Guarantor;

use DB;
use App\Models\File;
use App\Models\Finance;
use App\Models\UploadFile;
use App\Exports\exportDataCustomers;
use App\Models\CloseDetail;
use App\Models\Compromise;
use Maatwebsite\Excel\Facades\Excel;

use Response;

class DataCustomer extends Controller
{

    public function index(Request $request)
    {


        if (@$request->type == 'index') {
            return view('DataCustomer.view');
        } elseif (@$request->type == 'Datacus') {
            $data = Customer::get();
            $dataGuarantor = Guarantor::get();
            return view('DataCustomer.section-cus.view-cus', compact('data', 'dataGuarantor'));
        }
    }

    public function create(Request $request)
    {
        if (@$request->type == 'importDataCus') {
            return view('DataCustomer.section-cus.Create-ImportData');
        } elseif (@$request->type == 'Createcus') {
            $Plaintiff = Plaintiff::get();
            return view('DataCustomer.section-cus.Create-Cus',compact('Plaintiff'));
        }
         elseif (@$request->type == 'ExportExcel') {
            return view('ExportExcel.view');
        }
    }


    public function store(Request $request)
    {

        // Store your user in database 


        $type = @$request->type;
        $data = Customer::get();
        $dataStatus = Tribunal_status::get();
        $dataGuarantor = Guarantor::get();



        DB::beginTransaction();
        try {
            $Customer = new Customer;
            $CusAdd = new CusAddress;


            $Customer->plaintiff = @$request->data['plaintiff'];
            $Customer->CON_NO = @$request->data['CON_NO'];
            $Customer->name = @$request->data['name'];
            $Customer->surname = @$request->data['surname'];
            $Customer->prefix = @$request->data['prefix'];
            
            $Customer->ID_num = ( @$request->data['ID_num'] != NULL ? str_replace(array('-', '_'), "", @$request->data['ID_num']) : NULL);
            $Customer->PhoneNum = ( @$request->data['PhoneNum'] != NULL ? str_replace(array('-', '_'), "", @$request->data['PhoneNum']) : NULL);

            $Customer->status_tribunal = 'N';
            $Customer->status_com = 'N';
            $Customer->status_exe = 'N';
            $Customer->status_close = 'N';
            $Customer->save();

            $CusAdd->HouseNumber = @$request->data['HouseNumber'];
            $CusAdd->Moo = @$request->data['Moo'];
            $CusAdd->Region = @$request->data['Region'];
            $CusAdd->Province = @$request->data['Province'];
            $CusAdd->District = @$request->data['District'];
            $CusAdd->Tumbon = @$request->data['Tumbon'];
            $CusAdd->Postcode = @$request->data['Postcode'];
            $CusAdd->cus_id = $Customer->id;
            $CusAdd->save();

           

            for ($i = 1; $i <= @$request->data['num']; $i++) {
                $Guarantor = new Guarantor;
                $GuaAdd = new GuaAddress;
                $Guarantor->name = @$request->data['name' . $i];
                $Guarantor->surname = @$request->data['surname' . $i];
                $Guarantor->prefix = @$request->data['prefix' . $i];
                // $Guarantor->ID_num = @$request->data['ID_num' . $i];
                // $Guarantor->PhoneNum = @$request->data['PhoneNum' . $i];

                $Guarantor->ID_num = ( @$request->data['ID_num' . $i] != NULL ? str_replace(array('-', '_'), "", @$request->data['ID_num' . $i]) : NULL);
                $Guarantor->PhoneNum = ( @$request->data['PhoneNum' . $i] != NULL ? str_replace(array('-', '_'), "", @$request->data['PhoneNum' . $i]) : NULL);
    
               
                $Guarantor->Cus_id = $Customer->id;
                $Guarantor->save();

                $GuaAdd->HouseNumber = @$request->data['HouseNumber'. $i];
                $GuaAdd->Moo = @$request->data['Moo'. $i];
                $GuaAdd->Region = @$request->data['Region'. $i];
                $GuaAdd->Province = @$request->data['Province'. $i];
                $GuaAdd->District = @$request->data['District'. $i];
                $GuaAdd->Tumbon = @$request->data['Tumbon'. $i];
                $GuaAdd->Postcode = @$request->data['Postcode'. $i];
                $GuaAdd->gua_id = $Guarantor->id;
                $GuaAdd->save();

                // $Status->save();
            }
            DB::commit();

            $message = 'บันทึกเรียบร้อย';

            $renderHTML = view('DataCustomer.section-cus.view-cus', compact('data', 'dataStatus', 'type', 'dataGuarantor'))->render();

            return response()->json(['message' => $message, 'success' => '1', 'code' => 200, $renderHTML]);
        } catch (\Exception $e) {

            DB::rollback();
            return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
        }
    }

    public function show(Request $request, $id)
    {
        if (@$request->type == 'SearchCus') {
            // ค้นหาตามเลขสัญญา
            $data = DB::connection('ibmi2')
                ->table('RSFHP.ARMAST')
                ->leftJoin('RSFHP.VIEW_CUSTMAIL', 'RSFHP.ARMAST.CUSCOD', '=', 'RSFHP.VIEW_CUSTMAIL.CUSCOD')
                ->where('RSFHP.ARMAST.CONTNO', '=', 'P01-63010004')
                ->first();
            // ค้นหาตามเลขบัตรประชาชน
            $data2 = DB::connection('ibmi2')
                ->table('RSFHP.ARMAST')
                ->leftJoin('RSFHP.VIEW_CUSTMAIL', 'RSFHP.ARMAST.CUSCOD', '=', 'RSFHP.VIEW_CUSTMAIL.CUSCOD')
                ->where('RSFHP.VIEW_CUSTMAIL.IDNO', '=', '3930600088690')
                ->first();
            $html = '';
            return response()->json(['html' => $html]);
        }
        if (@$request->type == 'showDetail') {
            $data = Customer::where('id', $id)->first();
            $dataGuarantor = Guarantor::where('cus_id', $id)->get();

            $customer = Customer::where('id', $id)->get();
            $finance = Finance::where('cus_id', $id)->get();
            $financeSum = Finance::where('cus_id', $id)->first();
            $financeOther = FinanceOther::where('cus_id', $id)->get();
            $sumNotApproved = 0;
            $sumApproved = 0;

            if ($financeSum != null) {
                if ($financeSum->status1 == 'approved') {
                    $sumApproved =  $sumApproved + $financeSum->court_fee;
                } else {
                    $sumNotApproved =  $sumNotApproved + $financeSum->court_fee;
                }
                if ($financeSum->status2 == 'approved') {
                    $sumApproved =  $sumApproved + $financeSum->send_defendant;
                } else {
                    $sumNotApproved =  $sumNotApproved + $financeSum->send_defendant;
                }
                if ($financeSum->status3 == 'approved') {
                    $sumApproved =  $sumApproved + $financeSum->mandatory_fee;
                } else {
                    $sumNotApproved =  $sumNotApproved + $financeSum->mandatory_fee;
                }
                if ($financeSum->status4 == 'approved') {
                    $sumApproved =  $sumApproved + $financeSum->copy_documents1;
                } else {
                    $sumNotApproved =  $sumNotApproved + $financeSum->copy_documents1;
                }
                if ($financeSum->status5 == 'approved') {
                    $sumApproved =  $sumApproved + $financeSum->check_ownership;
                } else {
                    $sumNotApproved =  $sumNotApproved + $financeSum->check_ownership;
                }
                if ($financeSum->status6 == 'approved') {
                    $sumApproved =  $sumApproved + $financeSum->copy_documents2;
                } else {
                    $sumNotApproved =  $sumNotApproved + $financeSum->copy_documents2;
                }
                if ($financeSum->status7 == 'approved') {
                    $sumApproved =  $sumApproved + $financeSum->point_property;
                } else {
                    $sumNotApproved =  $sumNotApproved + $financeSum->point_property;
                }

                $totalsum = $financeSum->court_fee + $financeSum->send_defendant + $financeSum->mandatory_fee + $financeSum->copy_documents1 + $financeSum->check_ownership + $financeSum->copy_documents2 + $financeSum->point_property;
                foreach ($financeOther as $item) {
                    if ($item->statusFin == 'approved') {
                        $sumApproved = $sumApproved + $item->value;
                    } else {
                        $sumNotApproved =  $sumNotApproved + $item->value;
                    }
                    $totalsum = $totalsum + $item->value;
                }
            } else {
                $totalsum = 0;
            }


           

            // dd($sum);
            return view('DataCustomer.section-contract.view', compact('data', 'dataGuarantor', 'customer', 'financeOther', 'finance', 'totalsum', 'sumApproved', 'sumNotApproved'));
        }

        if (@$request->type == 'EditDatacus') {
            $customer = Customer::where('id', $id)->get();
            $Address = CusAddress::where('cus_id', $id)->first();
            $type = 'updateDataCus';
            return view('DataCustomer.section-cus.Edit-Cus', compact('customer', 'type','Address'));
        }
        if (@$request->type == 'EditGuarantor') {
            $customer = Guarantor::where('id', $id)->get();
          
            $Address = GuaAddress::where('gua_id', $id)->first();
       
            $type = 'updateGuarantor';
            return view('DataCustomer.section-cus.Edit-Cus', compact('customer', 'type','Address'));
        }
        if (@$request->type == 'EditTribunalStatus') {
            $data = Customer::where('id', $id)->first();
            return view('DataCustomer.section-cus.Edit-TribunalStatus', compact('data'));
        }
        if (@$request->type == 'statusClose') {
            
            $data = Customer::where('id', $id)->first();
            
            return view('DataCustomer.section-cus.close-status', compact('data'));
        }
    }

    public function edit(Request $request, $id)
    {
        // 

    }

    public function update(Request $request, $id)
    {
        //
        // dd(@$request->data['prefix']);
        if (@$request->type == 'updateDataCus') {
            DB::beginTransaction();
            try {
                $Customer = Customer::where('id', $id)->first();
                $Customer->name = @$request->data['name'];
                $Customer->surname = @$request->data['surname'];
                $Customer->prefix = @$request->data['prefix'];

 
                $Customer->ID_num = ( @$request->data['ID_num'] != NULL ? str_replace(array('-', '_'), "", @@$request->data['ID_num']) : NULL);
                $Customer->PhoneNum = ( @$request->data['PhoneNum'] != NULL ? str_replace(array('-', '_'), "", @@$request->data['PhoneNum']) : NULL);
                
                $Customer->update();

                $CusAdd = CusAddress::updateOrCreate([
                    'cus_id' =>  $id, 
                ],[
                'PactCon_id' => $request->PactCon_id,
               'HouseNumber' => @$request->data['HouseNumber'],
                'Moo' => @$request->data['Moo'],
                'Region' => @$request->data['Region'],
                'Province' => @$request->data['Province'],
                'District' => @$request->data['District'],
                'Tumbon' => @$request->data['Tumbon'],
                'Postcode' => @$request->data['Postcode'],
                'cus_id' => $Customer->id,
                ]);

                $type = @$request->type;
                $data = Customer::where('id', $id)->first();
                $dataStatus = Tribunal_status::where('cus_id', $id)->orderBy('id','DESC')->first();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();

                $finance = Finance::where('cus_id', $id)->get();
                $financeOther = FinanceOther::where('cus_id', $id)->get();
                $financeSum = Finance::where('cus_id', $id)->first();

                DB::commit();

                $message = 'บันทึกเรียบร้อย';

                $renderHTML = view('DataCustomer.section-contract.view', compact('data', 'dataStatus', 'type', 'dataGuarantor', 'customer', 'finance', 'financeOther'))->render();

                return response()->json(['message' => $message, 'success' => '1', 'code' => 200, $renderHTML]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
       

        if (@$request->type == 'updateGuarantor') {

            DB::beginTransaction();
            try {
                $Guarantor = Guarantor::where('id',  @$request->data['id'])->first();
                
                $Guarantor->name = @$request->data['name'];
                $Guarantor->surname = @$request->data['surname'];
                $Guarantor->prefix = @$request->data['prefix'];

                $Guarantor->ID_num = ( @$request->data['ID_num'] != NULL ? str_replace(array('-', '_'), "", @@$request->data['ID_num']) : NULL);
                $Guarantor->PhoneNum = ( @$request->data['PhoneNum'] != NULL ? str_replace(array('-', '_'), "", @@$request->data['PhoneNum']) : NULL);
                
                $Guarantor->update();

                $GuaAdd = GuaAddress::updateOrCreate([
                    'gua_id' =>  @$request->data['id'], 
                ],[
                'PactCon_id' => $request->PactCon_id,
               'HouseNumber' => @$request->data['HouseNumber'],
                'Moo' => @$request->data['Moo'],
                'Region' => @$request->data['Region'],
                'Province' => @$request->data['Province'],
                'District' => @$request->data['District'],
                'Tumbon' => @$request->data['Tumbon'],
                'Postcode' => @$request->data['Postcode'],
                'cus_id' => $Guarantor->id,
                ]);


                $type = @$request->type;
                $data = Customer::get();
                $dataStatus = Tribunal_status::get();
                $dataGuarantor = Guarantor::where('cus_id', @$request->data['cus_id'])->get();
                $customer = Guarantor::where('cus_id', @$request->data['cus_id'])->get();

               
                $finance = Finance::where('cus_id', $id)->get();
                $financeOther = FinanceOther::where('cus_id', $id)->get();
                $financeSum = Finance::where('cus_id', $id)->first();


                DB::commit();

                $message = 'บันทึกเรียบร้อย';

                $renderHTML = view('DataCustomer.section-contract.tab-tracking-Con', compact('data', 'dataStatus', 'type', 'dataGuarantor', 'customer', 'finance', 'financeOther'))->render();

                return response()->json(["html"=>$renderHTML]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if (@$request->type == 'updateStatusTribunal') {

            $type = @$request->type;
            $data = Customer::where('id', $id)->first();
            $dataStatus = Tribunal_status::where('cus_id', $id)->orderBy('id','DESC')->first();
            DB::beginTransaction();
            try {

                $Customer = Customer::where('id', $id)->first();
                $Customer->status_tribunal = 'Y';
                $Customer->status_com = 'N';
                $Customer->status_exe = 'N';
                
                $Customer->update();

                $Tribunal_debt = new Tribunal_debt;
                $Tribunal_debt->status = 'ขั้นฟ้อง';
                $Tribunal_debt->cus_id = $id;

                $Tribunal_debt->save();

                $Status = new Tribunal_status;

                $Status->status_1 = 'Y';
                $Status->cus_id = $id;

                $ComPro = Compromise::where('cus_id',$id)->first();
                if($ComPro != NULL){
                    $ComPro->status = 'close';
                    $ComPro->update();
                }
                
                $Tribunal_debt->save();
                $Status->save();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();
                $finance = Finance::where('cus_id', $id)->get();
                $financeOther = FinanceOther::where('cus_id', $id)->get();
                $financeSum = Finance::where('cus_id', $id)->first();
                
                DB::commit();

                $message = 'บันทึกเรียบร้อย';

                $renderHTML = view('DataCustomer.section-contract.view', compact('data', 'dataStatus', 'type', 'dataGuarantor', 'customer', 'finance', 'financeOther'))->render();

                return response()->json(['id' => $id, 'message' => $message, 'success' => '1', 'code' => 200]);


                // return  redirect()->route('Cus.show', [@$request->id, 'type' => 'showDetail']);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
    }



    public function destroy($id)
    {
        //
    }

    public function SearchData(Request $request){
        if (@$request->type == 1) {      //Search Address
            if (@$request->Flag == 1) {      //ภาค
                $data = TB_Provinces::where('Zone_pro',@$request->value)
                    ->selectRaw('Province_pro, count(*) as total')
                    ->groupBy('Province_pro')
                    ->orderBY('Province_pro', 'ASC')
                    ->get();
            }
            elseif (@$request->Flag == 2) {  //จังหวัด
                $data = TB_Provinces::where('Province_pro',@$request->value)
                    ->selectRaw('District_pro, count(*) as total')
                    ->groupBy('District_pro')
                    ->orderBY('District_pro', 'ASC')
                    ->get();
            }
            elseif (@$request->Flag == 3) {  //อำเภอ
                $data = TB_Provinces::where('District_pro',@$request->value)
                    ->selectRaw('Tambon_pro, count(*) as total')
                    ->groupBy('Tambon_pro')
                    ->orderBY('Tambon_pro', 'ASC')
                    ->get();
            }
            elseif (@$request->Flag == 4) {  //ตำบล
                $data = TB_Provinces::where('Tambon_pro',@$request->value)
                    ->where('District_pro',@$request->District)
                    ->where('Province_pro',@$request->Province)
                    ->select('Postcode_pro')
                    ->first();
            }
            return response()->json($data);
        }
        
        if (@$request->type == 3) {      //Search Address
            if (@$request->Flag == 1) {      //ภาค
                $data = TB_Provinces::where('Zone_pro',@$request->value)
                    ->selectRaw('Province_pro, count(*) as total')
                    ->groupBy('Province_pro')
                    ->orderBY('Province_pro', 'ASC')
                    ->get();
            }
            elseif (@$request->Flag == 2) {  //จังหวัด
                $data = TB_Provinces::where('Province_pro',@$request->value)
                    ->selectRaw('District_pro, count(*) as total')
                    ->groupBy('District_pro')
                    ->orderBY('District_pro', 'ASC')
                    ->get();
            }
            elseif (@$request->Flag == 3) {  //อำเภอ
                $data = TB_Provinces::where('District_pro',@$request->value)
                    ->selectRaw('Tambon_pro, count(*) as total')
                    ->groupBy('Tambon_pro')
                    ->orderBY('Tambon_pro', 'ASC')
                    ->get();
            }
            elseif (@$request->Flag == 4) {  //ตำบล
                $data = TB_Provinces::where('Tambon_pro',@$request->value)
                    ->where('District_pro',@$request->District)
                    ->where('Province_pro',@$request->Province)
                    ->select('Postcode_pro')
                    ->first();
            }
            return response()->json($data);
        }
        if (@$request->type == 2) {      //Search Address
            if (@$request->Flag == 1) {      //ภาค
                $data = TB_Provinces::where('Zone_pro',@$request->value)
                    ->selectRaw('Province_pro, count(*) as total')
                    ->groupBy('Province_pro')
                    ->orderBY('Province_pro', 'ASC')
                    ->get();
            }
            elseif (@$request->Flag == 2) {  //จังหวัด
                $data = TB_Provinces::where('Province_pro',@$request->value)
                    ->selectRaw('District_pro, count(*) as total')
                    ->groupBy('District_pro')
                    ->orderBY('District_pro', 'ASC')
                    ->get();
            }
            elseif (@$request->Flag == 3) {  //อำเภอ
                $data = TB_Provinces::where('District_pro',@$request->value)
                    ->selectRaw('Tambon_pro, count(*) as total')
                    ->groupBy('Tambon_pro')
                    ->orderBY('Tambon_pro', 'ASC')
                    ->get();
            }
            elseif (@$request->Flag == 4) {  //ตำบล
                $data = TB_Provinces::where('Tambon_pro',@$request->value)
                    ->where('District_pro',@$request->District)
                    ->where('Province_pro',@$request->Province)
                    ->select('Postcode_pro')
                    ->first();
            }
            return response()->json($data);
        }
       
    }
    public function export(Request $request)
    {
        // $data = DB::table('Hp_ConCus')->get();
        if(@$request->type == '1'){
            return Excel::download(new exportDataCustomers, 'รายงานทั้งหมด.xlsx');
           
        }
        
    }
}
