<?php

namespace App\Http\Controllers;

use App\Exports\exportDataCustomers;
use App\Exports\exportDataLaw;
use App\Models\CloseDetail;
use App\Models\Exe_status;
use App\Models\Tribunal_debt;
use App\Models\Tribunal_status;
use App\Models\Customer;
use App\Models\Finance;
use App\Models\Execution_debt;
use App\Models\FinanceOther;
use App\Models\UploadFile;
use App\Models\Guarantor;
use App\Models\LawTrack;
use Illuminate\Http\Request;
use DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
// // use TCPDF;


class DataLawsuit extends Controller
{

    public function index(Request $request)
    {


        $type = $request->type;
        if($request->type_time == NULL){
            $type_time = 'date_tribunal';
        }else{
            $type_time = $request->type_time;
        }
        

        if ($request->dateStart == NULL && $request->dateEnd == NULL) {
            $dateStart = date('Y-m-d', strtotime('first day of january this year'));
            // $dateStart = date('Y-m-d');
            $dateEnd = date('Y-m-d', strtotime('last day of december this year'));
            // $dateEnd = date('Y-m-d');
        } else {
            $dateStart = $request->dateStart;
            $dateEnd = $request->dateEnd;
        }

        // dd( $dateStart, $dateEnd);

        $dataCount = DB::table('LawCus')
        ->when($type_time == 'date_tribunal', function ($query) use ($dateStart, $dateEnd) {
            return $query->whereBetween('date_tribunal', [$dateStart, $dateEnd]);
        })
        ->when($type_time == 'date_witness', function ($query) use ($dateStart, $dateEnd) {
            return $query->whereBetween('date_witness', [$dateStart, $dateEnd]);
        })
            ->where('status_exe', 'N')
            ->where('status_close', 'N')
            ->where('withdraw', NULL)
            ->whereNot('status', 'ชั้นบังคับคดี')
            ->get();

        $dataCount1 =
            DB::table('LawCus')
            ->when($type_time == 'date_tribunal', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_tribunal', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_witness', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_witness', [$dateStart, $dateEnd]);
            })
            ->where('status_exe', 'N')
            ->where('status_close', 'N')
            ->where('withdraw', NULL)
            ->where('status', 'ขั้นฟ้อง')->get();

        $dataCount2 =
            DB::table('LawCus')
            ->when($type_time == 'date_tribunal', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_tribunal', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_witness', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_witness', [$dateStart, $dateEnd]);
            })
            ->where('status_exe', 'N')
            ->where('status_close', 'N')
            ->where('withdraw', NULL)
            ->where('status', 'ขั้นสืบพยาน')->get();

        $dataCount3 =
            DB::table('LawCus')
            ->when($type_time== 'date_tribunal', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_tribunal', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_witness', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_witness', [$dateStart, $dateEnd]);
            })
            ->where('status_exe', 'N')
            ->where('status_close', 'N')
            ->where('withdraw', NULL)
            ->where('status', 'ขั้นส่งคำบังคับ')->get();

        $dataCount5 =
            DB::table('LawCus')
            ->when($type_time == 'date_tribunal', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_tribunal', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_witness', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_witness', [$dateStart, $dateEnd]);
            })
            ->where('status_exe', 'N')
            ->where('status_close', 'N')
            ->where('withdraw', NULL)
            ->where('status', 'ขั้นตั้งเจ้าพนักงาน')->get();

        $countAll = count($dataCount);
        $count1 = count($dataCount1);
        $count2 = count($dataCount2);
        $count3 = count($dataCount3);

        $count5 = count($dataCount5);
       
        // dd($request->type);
        if ($request->type == 'index') {
            return view('DataCustomer.view');
        } elseif ($request->type == 'DataCourt') {
            // $data = Tribunal_debt::get();
            // dd($request->dateStart, $request->dateEnd);

            $data = DB::table('LawCus')
            ->when($type_time == 'date_tribunal', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_tribunal', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_witness', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_witness', [$dateStart, $dateEnd]);
            })
                ->where('status_exe', 'N')
                ->where('withdraw', NULL)
                ->whereNot('status_close', 'Y')
                ->whereNot('status', 'ชั้นบังคับคดี')
                ->get();
        } elseif ($request->type == 'DataCourt1') {
            $data = DB::table('LawCus')
            ->when($type_time == 'date_tribunal', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_tribunal', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_witness', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_witness', [$dateStart, $dateEnd]);
            })
                ->where('status_exe', 'N')
                ->where('withdraw', NULL)
                ->whereNot('status_close', 'Y')
                ->where('status', 'ขั้นฟ้อง')
                ->get();
        } elseif ($request->type == 'DataCourt2') {
            $data = DB::table('LawCus')
            ->when($type_time == 'date_tribunal', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_tribunal', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_witness', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_witness', [$dateStart, $dateEnd]);
            })
                ->where('status_exe', 'N')
                ->where('withdraw', NULL)
                ->whereNot('status_close', 'Y')
                ->where('status', 'ขั้นสืบพยาน')
                ->get();
        } elseif ($request->type == 'DataCourt3') {
            $data = DB::table('LawCus')
            ->when($type_time == 'date_tribunal', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_tribunal', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_witness', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_witness', [$dateStart, $dateEnd]);
            })
                ->where('status_exe', 'N')
                ->where('withdraw', NULL)
                ->whereNot('status_close', 'Y')
                ->where('status', 'ขั้นส่งคำบังคับ')
                ->get();
        } elseif ($request->type == 'DataCourt4') {
            $data = DB::table('LawCus')
            ->when($type_time == 'date_tribunal', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_tribunal', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_witness', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_witness', [$dateStart, $dateEnd]);
            })

                ->where('status_exe', 'N')
                ->where('withdraw', NULL)
                ->whereNot('status_close', 'Y')
                ->where('status', 'ขั้นตรวจผลหมาย')
                ->get();
        } elseif ($request->type == 'DataCourt5') {
            $data = DB::table('LawCus')
            ->when($type_time == 'date_tribunal', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_tribunal', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_witness', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_witness', [$dateStart, $dateEnd]);
            })
                ->where('status_exe', 'N')
                ->where('withdraw', NULL)
                ->whereNot('status_close', 'Y')
                ->where('status', 'ขั้นตั้งเจ้าพนักงาน')
                ->get();
        } elseif ($request->type == 'DataCourt6') {
            $data = DB::table('LawCus')
            ->when($type_time == 'date_tribunal', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_tribunal', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_witness', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_witness', [$dateStart, $dateEnd]);
            })
                ->where('status_exe', 'N')
                ->where('withdraw', NULL)
                ->whereNot('status_close', 'Y')
                ->where('status', 'ขั้นต.ผมหมายตั้ง')
                ->get();
        }
        $dataGuarantor = Guarantor::get();
        return view('DataLawsuit.section-court.view-court', compact('data', 'type', 'countAll', 'count1', 'count2', 'count3', 'count5', 'dataGuarantor', 'dateStart', 'dateEnd','type_time'));
        // return view('DataCustomer.section-cus.view-cus', compact('data'));


        // return view('DataLawsuit.section-court.view');
        if ($request->type == 'DataExecution') { // View ชั้นบังคับคดี

            $data = Tribunal_debt::where('status', 'ชั้นบังคับคดี')->get();
            return view('DataLawsuit.section-execution.view', compact('data'));
        }
    }

    public function create(Request $request)
    {
        //

        if ($request->type == 'ExportExcelLaw') {
            return view('ExportExcel.LawView');
        }
    }

    public function store(Request $request)
    {
        //
        // if ($request->type == 'CreateTribunal') {

        //     $data = Tribunal_debt::where('cus_id', $id)->get();
        //     $file_path = UploadFile::where('cus_id', $id)->get();
        //     $dataStatus = Tribunal_status::where('id', $id)->get();

        //     $type = $request->type;
        //     $data = Tribunal_debt::get();
        //     $dataStatus = Tribunal_status::get();

        //     DB::beginTransaction();
        //     try {

        //         $Tribunal_debt = new Tribunal_debt;
        //         $Tribunal_debt->status = 'ขั้นฟ้อง';
        //         $Tribunal_debt->cus_id = $id;

        //         $Status = new Tribunal_status;
        //         $Status->status_1 = 'Y';
        //         $Tribunal_debt->save();
        //         $Status->save();

        //         DB::commit();

        //         $message = 'บันทึกเรียบร้อย';

        //         // $renderHTML = view('DataLawsuit.section-court.view', compact('data','file_path','dataStatus'))->render();

        //         // return response()->json(['message' => $message, 'success' => '1', 'code' => 200, $renderHTML]);

        //         return  redirect()->route('Law.show', [$request->id, 'type' => 'showCus']);
        //     } catch (\Exception $e) {

        //         DB::rollback();
        //         return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
        //     }
        // }
    }


    public function show($id, Request $request)
    {
        //

        if ($request->type == 'showCus') {

            $data = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            $dataStatus = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            $file_path = UploadFile::where('cus_id', $id)->get();
            $dataGuarantor = Guarantor::where('cus_id', $id)->get();
            $customer = Customer::where('id', $id)->get();
            $dataFinance = Finance::where('cus_id', $id)->get();
            $FinanceOther = FinanceOther::where('cus_id', $id)->get();

            return view('DataLawsuit.section-court.view', compact('data', 'file_path', 'dataStatus', 'dataGuarantor', 'customer', 'dataFinance', 'FinanceOther'));
        }

        if ($request->type == 'Editcus') {
            $data = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();

            return view('DataLawsuit.section-court.Edit-Cus', compact('data'));
        }
        if ($request->type == 'Editcus2') {
            $data = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            return view('DataLawsuit.section-court.Edit-Cus2', compact('data'));
        }
        if ($request->type == 'Editcus3') {
            $data = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            return view('DataLawsuit.section-court.Edit-Cus3', compact('data'));
        }
        if ($request->type == 'Editcus4') {
            $data = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            return view('DataLawsuit.section-court.Edit-Cus4', compact('data'));
        }
        if ($request->type == 'Editcus5') {
            $data = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            return view('DataLawsuit.section-court.Edit-Cus5', compact('data'));
        }
        if ($request->type == 'Editcus6') {
            $data = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            return view('DataLawsuit.section-court.Edit-Cus6', compact('data'));
        }
        if (@$request->type == 'statusClose') {

            $data = Customer::where('id', $id)->first();
            
            return view('DataLawsuit.section-court.close-status', compact('data'));
        }
    }


    public function edit(Request $request, $id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //


        if ($request->type == 'updateDataCus') {

            DB::beginTransaction();
            try {
                $Tribunal = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $Tribunal->tribunal = $request->data['tribunal'];
                $Tribunal->case_type = $request->data['case_type'];
                // $Tribunal->Date_Calcu = date('Y-m-d');
                $Tribunal->black_no = $request->data['black_no'];
                $Tribunal->red_no = $request->data['red_no'];
                $Tribunal->capital_sue = str_replace(",", "", @$request->data['capital_sue']);
                $Tribunal->date_tribunal = $request->data['date_tribunal'];
                if ($request->data['status'] == 'Y') {
                    $Tribunal->status = 'ขั้นสืบพยาน';
                }

                $Tribunal->update();
                $Status = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                if ($request->data['status'] == 'Y') {
                    $Status->status_2 = $request->data['status'];
                    $message = 'อัพเดตสถานะ';
                } else {
                    $message = 'อัพเดตเรียบร้อย';
                }

                $Status->update();

                DB::commit();
                $data = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $dataStatus = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();

                $file_path = UploadFile::where('cus_id', $id)->get();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();
                $FinanceOther = FinanceOther::where('cus_id', $id)->get();
                $dataFinance = Finance::where('cus_id', $id)->get();





                $renderHTML =  view('DataLawsuit.section-court.tab-view-indict', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
                return response()->json(['html' => $renderHTML, 'message' => @$message]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->type == 'updateDataCus2') {

            DB::beginTransaction();
            try {

                $Tribunal = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $Tribunal->date_witness = $request->data['date_witness'];
                $Tribunal->date_postponed = $request->data['date_postponed'];
                $Tribunal->witness_status = $request->data['witness_status'];
                $Tribunal->witness_note = $request->data['witness_note'];
                $Tribunal->debt_balance = (int)$request->data['debt_balance'];
                $Tribunal->withdraw_date = @$request->data['withdraw_date'];
                $Status = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();

                if (isset($request->data['withdraw']) == 'on') {
                    $Tribunal->withdraw = 'Y';
                    $message = 'อัพเดตสถานะ';
                } elseif ($request->data['witness_status'] == 'พิพากษา') {
                    $Tribunal->status = 'ขั้นส่งคำบังคับ';
                    $Status->status_3 = 'Y';
                    $message = 'อัพเดตสถานะ';
                } elseif ($request->data['witness_status'] == 'ทำยอม') {

                    $message = 'อัพเดตสถานะ';
                } else {
                    $message = '';
                }



                // if ($request->data['witness_status'] == 'พิพากษา') {
                //     $Tribunal->status = 'ขั้นส่งคำบังคับ';
                //     $message = 'อัพเดตสถานะ';
                // } else {
                //     $message = '';
                // }

                // $Status = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                // if ($request->data['witness_status'] == 'พิพากษา' ) {
                //     $Status->status_3 = 'Y';
                //     $message = 'อัพเดตสถานะ';
                // } else {
                //     $message = '';
                // }


                $Status->update();
                $Tribunal->update();




                DB::commit();
                $data = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $dataStatus = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $file_path = UploadFile::where('cus_id', $id)->get();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get()->toArray();
                if (count($dataGuarantor) != 0) {
                    $defendant2 = array_column($dataGuarantor, "name")[0] . ' ' . array_column($dataGuarantor, "surname")[0];
                    $defendant3 = "";
                    if (count($dataGuarantor) > 1) {
                        $defendant3 = array_column(@$dataGuarantor, "name")[1] . ' ' . array_column(@$dataGuarantor, "surname")[1];
                    }
                }



                $customer = Customer::where('id', $id)->first();
                $FinanceOther = FinanceOther::where('cus_id', $id)->get();
                $dataFinance = Finance::where('cus_id', $id)->get();

                LawTrack::updateOrCreate([
                    'law_id' =>  $Tribunal->id,
                ], [
                    'law_id' =>  $Tribunal->id,
                    'CON_NO' => $customer->CON_NO,
                    'tribunal' => $Tribunal->tribunal,
                    'black_no' => $Tribunal->black_no,
                    'red_no' => $Tribunal->red_no,
                    'case_type' => $Tribunal->case_type,
                    'levels' => 'ชั้นศาล',
                    'plaintiff' => $customer->plaintiff,
                    'defendant1' => @$customer->name . ' ' . @$customer->surname,

                    'defendant2' => @$defendant2,
                    'defendant3' => @$defendant3,

                    'event_start' => $Tribunal->date_witness,
                    'event_end' =>  \Carbon\Carbon::parse(@$Tribunal->date_witness)->addDay()->format('Y-m-d'),
                ]);


                $renderHTML =  view('DataLawsuit.section-court.tab-view-pursue', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
                return response()->json(['html' => $renderHTML, 'message' => $message]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->type == 'updateDataCus3') {

            DB::beginTransaction();
            try {
                $Tribunal = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();

                $Tribunal->sub_date = @$request->data['sub_date'];
                $Tribunal->command_note = $request->data['command_note'];

                if ($request->data['status'] == 'Y') {
                    $Tribunal->status = 'ขั้นตั้งเจ้าพนักงาน';
                }

                $Status = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                if ($request->data['status'] == 'Y') {
                    $Status->status_4 = $request->data['status'];
                    $message = 'อัพเดตสถานะ';
                } else {
                    $message = 'อัพเดตเรียบร้อย';
                }


                $Status->update();
                $Tribunal->update();

                DB::commit();
                $data = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $dataStatus = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $file_path = UploadFile::where('cus_id', $id)->get();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();
                $FinanceOther = FinanceOther::where('cus_id', $id)->get();
                $dataFinance = Finance::where('cus_id', $id)->get();




                $renderHTML =  view('DataLawsuit.section-court.tab-view-sendCommand', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
                return response()->json(['html' => $renderHTML, 'message' => $message]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->type == 'updateDataCus4') {

            DB::beginTransaction();
            try {
                $Tribunal = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();


                $Tribunal->date_app = $request->data['date_app'];
                $Tribunal->app_note = $request->data['app_note'];

                if ($request->data['status'] == 'Y') {
                    $Tribunal->status = 'ชั้นบังคับคดี';
                    $Execution = Execution_debt::updateOrCreate(
                        ['cus_id' => $id],
                        [
                            'status' => 'ขั้นสืบทรัพย์',
                            'exe_date' => date('Y-m-d'),
                        ]

                    );
                    $Exe_status = Exe_status::updateOrCreate(
                        ['cus_id' => $id],
                        ['status_1' => 'Y']

                    );
                }

                $Customer = Customer::where('id', $id)->first();
                $Status = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                if ($request->data['status'] == 'Y') {
                    $Status->class_execution = $request->data['status'];
                    $Customer->status_exe = 'Y';
                    $message = 'อัพเดตสถานะ';
                } else {
                    $message = 'อัพเดตเรียบร้อย';
                }


                $Customer->update();

                $Status->update();
                $Tribunal->update();

                // $Execution = new Execution_debt;
                // if ($Customer->status_exe == 'Y') {
                //     $Execution->cus_id = $id;
                //     $Execution->exe_status = 'ขั้นสืบพยาน';
                // }






                DB::commit();
                $data = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $dataStatus = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $file_path = UploadFile::where('cus_id', $id)->get();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();
                $FinanceOther = FinanceOther::where('cus_id', $id)->get();
                $dataFinance = Finance::where('cus_id', $id)->get();




                $renderHTML =  view('DataLawsuit.section-court.tab-view-setStaff', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();

                return response()->json(['html' => $renderHTML, 'message' => $message]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }

        if (@$request->type == 'CloseStatus') {



            DB::beginTransaction();
            try {


                $CloseDatail = CloseDetail::updateOrCreate([
                    'cus_id' =>  $id,
                ], [
                    'totalSum' => $request->data['total_sum'],
                    'cus_id' => $id,
                    'discount' => @$request->data['discount'],
                    'total_pay' => @$request->data['total_pay'],
                    'status' => 'ชั้นศาล(ปิดบัญชี)',
                ]);
                $Customer = Customer::where('id', $id)->first();
                $Customer->status_close = 'Y';
                $Customer->update();
                $type = @$request->type;
                $data = Customer::where('id', $id)->first();
                $dataStatus = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();

                $finance = Finance::where('cus_id', $id)->get();
                $financeOther = FinanceOther::where('cus_id', $id)->get();
                $financeSum = Finance::where('cus_id', $id)->first();

                DB::commit();

                $message = 'บันทึกเรียบร้อย';

                $renderHTML = view('DataCustomer.section-contract.view', compact('data', 'dataStatus', 'type', 'dataGuarantor', 'customer', 'finance', 'financeOther'))->render();

                // return response()->json(['message' => $message, 'success' => '1', 'code' => 200, $renderHTML]);
                return response()->json(['id' => $id, 'message' => $message, 'success' => '1', 'code' => 200]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }

        if (@$request->type == 'discountRequest') {



            DB::beginTransaction();
            try {


                $CloseDatail = CloseDetail::updateOrCreate([
                    'cus_id' =>  $id,
                ], [
                    'totalSum' => $request->data['total_sum'],
                    'cus_id' => $id,
                    'discount' => @$request->data['discount'],
                    'total_pay' => @$request->data['total_pay'],
                    'status' => 'ชั้นศาล',
                    'discountApp' => 'รออนุมัติ',
                ]);
                // $Customer = Customer::where('id', $id)->first();
                // $Customer->status_close = 'Y';
                // $Customer->update();
                $type = @$request->type;
                $data = Customer::where('id', $id)->first();
                $dataStatus = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();

                $finance = Finance::where('cus_id', $id)->get();
                $financeOther = FinanceOther::where('cus_id', $id)->get();
                $financeSum = Finance::where('cus_id', $id)->first();

                DB::commit();

                $message = 'บันทึกเรียบร้อย';

                $renderHTML = view('DataCustomer.section-contract.view', compact('data', 'dataStatus', 'type', 'dataGuarantor', 'customer', 'finance', 'financeOther'))->render();

                // return response()->json(['message' => $message, 'success' => '1', 'code' => 200, $renderHTML]);
                return response()->json(['id' => $id, 'message' => $message, 'success' => '1', 'code' => 200]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if (@$request->type == 'discountAppCancel') {
            $totalPay =  (float)@$request->data['total_pay'] + (float)@$request->data['discount'];

            DB::beginTransaction();
            try {
                $CloseDatail = CloseDetail::updateOrCreate([
                    'cus_id' =>  $id,
                ], [
                    'totalSum' => $request->data['total_sum'],
                    'cus_id' => $id,
                    'discount' => 0,
                    'total_pay' => $totalPay,
                    'status' => 'ชั้นศาล',
                    'discountApp' => 'ยกเลิกส่วนลด',
                ]);
                // $Customer = Customer::where('id', $id)->first();
                // $Customer->status_close = 'Y';
                // $Customer->update();
                $type = @$request->type;
                $data = Customer::where('id', $id)->first();
                $dataStatus = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();

                $finance = Finance::where('cus_id', $id)->get();
                $financeOther = FinanceOther::where('cus_id', $id)->get();
                $financeSum = Finance::where('cus_id', $id)->first();

                DB::commit();

                $message = 'บันทึกเรียบร้อย';

                $renderHTML = view('DataCustomer.section-contract.view', compact('data', 'dataStatus', 'type', 'dataGuarantor', 'customer', 'finance', 'financeOther'))->render();

                // return response()->json(['message' => $message, 'success' => '1', 'code' => 200, $renderHTML]);
                return response()->json(['id' => $id, 'message' => $message, 'success' => '1', 'code' => 200]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if (@$request->type == 'discountAppNot') {
            $totalPay =  (float)@$request->data['total_pay'] + (float)@$request->data['discount'];

            DB::beginTransaction();
            try {
                $CloseDatail = CloseDetail::updateOrCreate([
                    'cus_id' =>  $id,
                ], [
                    'totalSum' => $request->data['total_sum'],
                    'cus_id' => $id,
                    'discount' => 0,
                    'total_pay' => $totalPay,
                    'status' => 'ชั้นศาล',
                    'discountApp' => 'ไม่อนุมัติ',
                ]);
                // $Customer = Customer::where('id', $id)->first();
                // $Customer->status_close = 'Y';
                // $Customer->update();
                $type = @$request->type;
                $data = Customer::where('id', $id)->first();
                $dataStatus = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();

                $finance = Finance::where('cus_id', $id)->get();
                $financeOther = FinanceOther::where('cus_id', $id)->get();
                $financeSum = Finance::where('cus_id', $id)->first();

                DB::commit();

                $message = 'บันทึกเรียบร้อย';

                $renderHTML = view('DataCustomer.section-contract.view', compact('data', 'dataStatus', 'type', 'dataGuarantor', 'customer', 'finance', 'financeOther'))->render();

                // return response()->json(['message' => $message, 'success' => '1', 'code' => 200, $renderHTML]);
                return response()->json(['id' => $id, 'message' => $message, 'success' => '1', 'code' => 200]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if (@$request->type == 'discountApp') {
            $totalPay =  (float)@$request->data['total_pay'] + (float)@$request->data['discount'];

            DB::beginTransaction();
            try {
                $CloseDatail = CloseDetail::updateOrCreate([
                    'cus_id' =>  $id,
                ], [
                    'totalSum' => $request->data['total_sum'],
                    'cus_id' => $id,
                    'discount' => (float)@$request->data['discount'],
                    'total_pay' => @$request->data['total_pay'],
                    'status' => 'ชั้นศาล',
                    'discountApp' => 'อนุมัติ',
                ]);
                // $Customer = Customer::where('id', $id)->first();
                // $Customer->status_close = 'Y';
                // $Customer->update();
                $type = @$request->type;
                $data = Customer::where('id', $id)->first();
                $dataStatus = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();

                $finance = Finance::where('cus_id', $id)->get();
                $financeOther = FinanceOther::where('cus_id', $id)->get();
                $financeSum = Finance::where('cus_id', $id)->first();

                DB::commit();

                $message = 'บันทึกเรียบร้อย';

                $renderHTML = view('DataCustomer.section-contract.view', compact('data', 'dataStatus', 'type', 'dataGuarantor', 'customer', 'finance', 'financeOther'))->render();

                // return response()->json(['message' => $message, 'success' => '1', 'code' => 200, $renderHTML]);
                return response()->json(['id' => $id, 'message' => $message, 'success' => '1', 'code' => 200]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }


        //     DB::beginTransaction();
        //     try {
        //         $Tribunal = Tribunal_debt::where('cus_id', $id)->first();

        //         if ($request->data['status'] == 'Y') {
        //             $Tribunal->status = 'ขั้นต.ผลหมายตั้ง';
        //         }

        //         $Status = Tribunal_status::where('id', $id)->first();
        //         if ($request->data['status'] == 'Y') {
        //             $Status->status_6 = $request->data['status'];
        //         }


        //         $Status->update();
        //         $Tribunal->update();

        //         DB::commit();
        //         $data = Tribunal_debt::where('cus_id', $id)->get();
        //         $dataStatus = Tribunal_status::where('cus_id', $id)->get();
        //         $file_path = UploadFile::where('cus_id', $id)->get();

        //         $message = 'อัพเดตเรียบร้อย';
        //         $renderHTML =  view('DataLawsuit.section-court.view', compact('data', 'dataStatus', 'file_path'))->render();

        //         return response()->json(['message' => $message, 'success' => '1', 'code' => 200, $renderHTML]);
        //     } catch (\Exception $e) {

        //         DB::rollback();
        //         return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
        //     }
        // }
        // if ($request->type == 'updateDataCus6') {

        //     DB::beginTransaction();
        //     try {
        //         $Tribunal = Tribunal_debt::where('id', $id)->first();

        //         if ($request->data['status'] == 'Y') {
        //             $Tribunal->status = 'ชั้นบังคับคดี';
        //         }

        //         $Status = Tribunal_status::where('cus_id', $id)->first();
        //         if ($request->data['status'] == 'Y') {
        //             $Status->class_execution = $request->data['status'];
        //         }

        //         $Customer = Customer::where('id', $id)->first();


        //         if($Customer->status_exe != 'Y'){
        //             $Customer->status_tribunal = 'N';
        //             $Customer->status_exe = 'Y';
        //         }



        //         $Status->update();
        //         $Tribunal->update();
        //         $Customer->update();

        //         $Execution = new Execution_debt;
        //         if($Customer->status_exe == 'Y'){
        //             $Execution->cus_id = $id;
        //         }

        //         $Execution->save();


        //         DB::commit();
        //         $data = Tribunal_debt::where('cus_id', $id)->get();
        //         $dataStatus = Tribunal_status::where('cus_id', $id)->get();
        //         $file_path = UploadFile::where('cus_id', $id)->get();

        //         $message = 'อัพเดตเรียบร้อย';
        //         $renderHTML =  view('DataLawsuit.section-court.view', compact('data', 'dataStatus', 'file_path'))->render();

        //         return response()->json(['message' => $message, 'success' => '1', 'code' => 200, $renderHTML]);
        //     } catch (\Exception $e) {

        //         DB::rollback();
        //         return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
        //     }
        // }
    }

    public function export(Request $request)
    {
        // $data = DB::table('Hp_ConCus')->get();
        if (@$request->type == 'ExportLaw') {

            // $view = \View::make('view_Contracts.reportContract', compact('data', 'type'));

            // PDF::SetTitle('Hello World');
            // PDF::AddPage();
            // PDF::Write(0, 'Hello World');
            // PDF::Output('hello_world.pdf');

            // $view = view('ExportPDF.form-finance-pdf');
            // $html = $view->render();
            // $pdf = new PDF();
            // $pdf::SetTitle('test');
            // $pdf::AddPage("P",'A4');
            // $pdf::SetMargins(5, 5, 5, 0);
            // $pdf::SetFont('thsarabun', '', 12, '', true);
            // $pdf::SetAutoPageBreak(true,20);

            // $pdf::WriteHTML($html, true, false, true, false, '');
            // $pdf::Output('report.pdf');





            return Excel::download(new exportDataLaw, 'รายงานทั้งหมด.xlsx');
        }
    }

    public function destroy($id)
    {
        //
    }
}
