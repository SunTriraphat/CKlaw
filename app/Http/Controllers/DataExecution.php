<?php

namespace App\Http\Controllers;

use App\Exports\exportDataExe;
use App\Models\CloseDetail;
use App\Models\Compromise;
use App\Models\Finance;
use App\Models\FinanceOther;
use App\Models\Guarantor;
use App\Models\Tribunal_debt;
use App\Models\Tribunal_status;
use App\Models\Customer;
use App\Models\Execution_debt;
use App\Models\Exe_status;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;


class DataExecution extends Controller
{

    public function index(Request $request)
    {
        $type = $request->type;
        $data = Execution_debt::get();
        $dataCountAll = Execution_debt::get();
        $type = $request->type;
        
        if ($request->type_time == NULL) {
            $type_time = 'exe_date';
        } else {
            $type_time = $request->type_time;
        }

        
        if ($request->dateStart == NULL && $request->dateEnd == NULL) {

           
            $dateStart = date('Y-m-d');
            $dateEnd = date('Y-m-d');
        } else {
            $dateStart = $request->dateStart;
            $dateEnd = $request->dateEnd;
        }
        $dataCountAll = DB::table('LawExe')
            ->when($type_time == 'exe_date', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('exe_date', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_confiscation', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_confiscation', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_announce_first', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_announce_first', [$dateStart, $dateEnd]);
            })
            ->where('status_exe', 'Y')
            ->where('status_close', 'N')
            ->where('exe_old', NULL)
            ->get();

        // $dataCount1 = Execution_debt::where('status', 'ขั้นสืบทรัพย ์')->get();
        // $dataCount1 = DB::table('LawExe')
        //     ->where('status_exe', 'Y')
        //     ->where('status_close', 'N')
        //     ->where('status', 'ขั้นสืบทรัพย์')
        //     ->where('exe_old', NULL)
        //     ->get();

        $dataCount1 = DB::table('LawExe')
            ->when($type_time == 'exe_date', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('exe_date', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_confiscation', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_confiscation', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_announce_first', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_announce_first', [$dateStart, $dateEnd]);
            })
            ->where('status_exe', 'Y')
            ->where('status_close', 'N')
            ->where('status', 'ขั้นสืบทรัพย์')
            ->where('exe_old', NULL)
            ->get();

        $dataCount2 = DB::table('LawExe')
            ->when($type_time == 'exe_date', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('exe_date', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_confiscation', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_confiscation', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_announce_first', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_announce_first', [$dateStart, $dateEnd]);
            })
            ->where('status_exe', 'Y')
            ->where('status_close', 'N')
            ->where('status', 'ขั้นคัดโฉนด')
            ->where('exe_old', NULL)
            ->get();

        $dataCount3 =  DB::table('LawExe')
            ->when($type_time == 'exe_date', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('exe_date', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_confiscation', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_confiscation', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_announce_first', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_announce_first', [$dateStart, $dateEnd]);
            })
            ->where('status_exe', 'Y')
            ->where('status_close', 'N')
            ->where('status', 'ขั้นตั้งเรื่องยึดทรัพย์')
            ->where('exe_old', NULL)
            ->get();

        $dataCount4 = DB::table('LawExe')
            ->when($type_time == 'exe_date', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('exe_date', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_confiscation', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_confiscation', [$dateStart, $dateEnd]);
            })
            ->when($type_time == 'date_announce_first', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_announce_first', [$dateStart, $dateEnd]);
            })
            ->where('status_exe', 'Y')
            ->where('status_close', 'N')
            ->where('status', 'ขั้นประกาศขายทอดตลาด')
            ->where('exe_old', NULL)
            ->get();;

        $countAll = count($dataCountAll);
        $count1 = count($dataCount1);
        $count2 = count($dataCount2);
        $count3 = count($dataCount3);
        $count4 = count($dataCount4);

        if ($request->type == 'index') {
            return view('DataCustomer.view');
        } elseif ($request->type == 'DataExecution') {

            // $data = Execution_debt::get();
            $data = DB::table('LawExe')
                ->when($type_time == 'exe_date', function ($query) use ($dateStart, $dateEnd) {
                    return $query->whereBetween('exe_date', [$dateStart, $dateEnd]);
                })
                ->when($type_time == 'date_confiscation', function ($query) use ($dateStart, $dateEnd) {
                    return $query->whereBetween('date_confiscation', [$dateStart, $dateEnd]);
                })
                ->when($type_time == 'date_announce_first', function ($query) use ($dateStart, $dateEnd) {
                    return $query->whereBetween('date_announce_first', [$dateStart, $dateEnd]);
                })
                ->where('status_exe', 'Y')
                ->where('status_close', 'N')
                ->where('exe_old', NULL)
                ->get();
        } elseif ($request->type == 'DataExe1') {

            $data = DB::table('LawExe')
                ->when($type_time == 'exe_date', function ($query) use ($dateStart, $dateEnd) {
                    return $query->whereBetween('exe_date', [$dateStart, $dateEnd]);
                })
                ->when($type_time == 'date_confiscation', function ($query) use ($dateStart, $dateEnd) {
                    return $query->whereBetween('date_confiscation', [$dateStart, $dateEnd]);
                })
                ->when($type_time == 'date_announce_first', function ($query) use ($dateStart, $dateEnd) {
                    return $query->whereBetween('date_announce_first', [$dateStart, $dateEnd]);
                })
                ->where('status_exe', 'Y')
                ->where('status_close', 'N')
                ->where('status', 'ขั้นสืบทรัพย์')
                ->where('exe_old', NULL)
                ->get();
        } elseif ($request->type == 'DataExe2') {

            $data =  DB::table('LawExe')
                ->when($type_time == 'exe_date', function ($query) use ($dateStart, $dateEnd) {
                    return $query->whereBetween('exe_date', [$dateStart, $dateEnd]);
                })
                ->when($type_time == 'date_confiscation', function ($query) use ($dateStart, $dateEnd) {
                    return $query->whereBetween('date_confiscation', [$dateStart, $dateEnd]);
                })
                ->when($type_time == 'date_announce_first', function ($query) use ($dateStart, $dateEnd) {
                    return $query->whereBetween('date_announce_first', [$dateStart, $dateEnd]);
                })
                ->where('status_exe', 'Y')
                ->where('status_close', 'N')
                ->where('status', 'ขั้นคัดโฉนด')
                ->where('exe_old', NULL)
                ->get();
        } elseif ($request->type == 'DataExe3') {

            $data  = DB::table('LawExe')
                ->when($type_time == 'exe_date', function ($query) use ($dateStart, $dateEnd) {
                    return $query->whereBetween('exe_date', [$dateStart, $dateEnd]);
                })
                ->when($type_time == 'date_confiscation', function ($query) use ($dateStart, $dateEnd) {
                    return $query->whereBetween('date_confiscation', [$dateStart, $dateEnd]);
                })
                ->when($type_time == 'date_announce_first', function ($query) use ($dateStart, $dateEnd) {
                    return $query->whereBetween('date_announce_first', [$dateStart, $dateEnd]);
                })
                ->where('status_exe', 'Y')
                ->where('status_close', 'N')
                ->where('status', 'ขั้นตั้งเรื่องยึดทรัพย์')
                ->where('exe_old', NULL)
                ->get();
        } elseif ($request->type == 'DataExe4') {

            $data = DB::table('LawExe')
                ->when($type_time == 'exe_date', function ($query) use ($dateStart, $dateEnd) {
                    return $query->whereBetween('exe_date', [$dateStart, $dateEnd]);
                })
                ->when($type_time == 'date_confiscation', function ($query) use ($dateStart, $dateEnd) {
                    return $query->whereBetween('date_confiscation', [$dateStart, $dateEnd]);
                })
                ->when($type_time == 'date_announce_first', function ($query) use ($dateStart, $dateEnd) {
                    return $query->whereBetween('date_announce_first', [$dateStart, $dateEnd]);
                })
                ->where('status_exe', 'Y')
                ->where('status_close', 'N')
                ->where('status', 'ขั้นประกาศขายทอดตลาด')
                ->where('exe_old', NULL)
                ->get();
        }
        return view('DataLawsuit.section-execution.view-execution', compact('data', 'type', 'countAll', 'count1', 'count2', 'count3', 'count4', 'dateStart', 'dateEnd','type_time'));
        // return view('DataCustomer.section-cus.view-execution', compact('data'));


        // return view('DataLawsuit.section-court.view');
        // if ($request->type == 'DataExecution') { // View ชั้นบังคับคดี
        //     $type = $request->type;
        //     $data = Execution_debt::get();
        //     return view('DataLawsuit.section-execution.view-execution', compact('data', 'type', 'countAll', 'count1', 'count2', 'count3', 'count4'));
        // }
    }

    public function create(Request $request)
    {
        //

        if ($request->type == 'ExportExcelExe') {

            return view('ExportExcel.ExeView');
        }
    }

    public function store(Request $request)
    {
        //
        if ($request->type == 'NewExe') {

            $data = Tribunal_debt::where('cus_id', $request->data['id'])->get();
            $file_path = UploadFile::where('cus_id', $request->data['id'])->get();
            $dataStatus = Tribunal_status::where('id', $request->data['id'])->get();

            $type = $request->type;
            $data = Tribunal_debt::get();
            $dataStatus = Tribunal_status::get();

            DB::beginTransaction();
            try {
                $Execution = Execution_debt::where('cus_id', $request->data['id'])->get();
                $Execution->exe_old = 'Y';

                $Execution_debt = new Execution_debt;
                $Execution_debt->status = 'ขั้นสืบทรัพย์';
                $Execution_debt->cus_id = $request->data['id'];

                $Status = new Exe_status;
                $Status->status_1 = 'Y';
                $Status->cus_id = $request->data['id'];
                $Execution_debt->save();
                $Status->save();
                $Status->update();

                DB::commit();

                $message = 'บันทึกเรียบร้อย';

                // $renderHTML = view('DataLawsuit.section-court.view', compact('data','file_path','dataStatus'))->render();

                // return response()->json(['message' => $message, 'success' => '1', 'code' => 200, $renderHTML]);

                return response()->json(['id' => $request->data['id'], 'message' => $message, 'success' => '1', 'code' => 200]);

                // return  redirect()->route('Exe.show', [$request->data['id'], 'type' => 'showExe']);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
    }


    public function show($id, Request $request)
    {
        //

        if ($request->type == 'showExe') {
            // dd($id);
            $data = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();

            $dataStatus = Exe_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            $file_path = UploadFile::where('cus_id', $id)->get();

            $customer = Customer::where('id', $id)->get();
            $Tribunal = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            // dd($customer);
            $dataGuarantor = Guarantor::where('cus_id', $id)->get();
            $FinanceOther = FinanceOther::where('cus_id', $id)->get();
            $dataFinance = Finance::where('cus_id', $id)->get();


            return view('DataLawsuit.section-execution.view', compact('data', 'file_path', 'dataStatus', 'customer', 'dataGuarantor', 'dataStatus', 'dataFinance', 'FinanceOther', 'Tribunal'));
        }

        if ($request->type == 'select-case') {
            $data = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            return view('DataLawsuit.section-execution.section-edit.select-case', compact('data'));
        }
        if ($request->type == 'select-deed') {
            $data = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            return view('DataLawsuit.section-execution.section-edit.select-deed', compact('data'));
        }
        if ($request->type == 'investigate') {
            $data = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            return view('DataLawsuit.section-execution.section-edit.investigate', compact('data'));
        }
        if ($request->type == 'confiscation') {
            $data = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            $tribunal = Tribunal_debt::where('cus_id', $id)->first();
            return view('DataLawsuit.section-execution.section-edit.confiscation', compact('data', 'tribunal'));
        }
        if ($request->type == 'announce') {
            $data = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            $tribunal = Tribunal_debt::where('cus_id', $id)->first();
            $customer = Customer::where('id', $id)->first();

            return view('DataLawsuit.section-execution.section-edit.announce', compact('data', 'customer', 'tribunal'));
        }
        if ($request->type == 'NewExe') {
            $data = Customer::where('id', $id)->first();
            return view('DataLawsuit.section-execution.section-edit.New-Exe', compact('data'));
        }
        if ($request->type == 'sendAnnouncement') {


            $data = Execution_debt::where('cus_id', $id)->first();

            $dataGuarantor = Guarantor::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            $Compro = Compromise::where('cus_id', $id)->orderBy('id', 'DESC')->first();


            $FinanceOther = FinanceOther::where('cus_id', $id)->get();
            $dataFinance = Finance::where('cus_id', $id)->get();
            return view('DataLawsuit.section-execution.section-edit.send-Announcement', compact('data', 'dataGuarantor', 'FinanceOther', 'dataFinance', 'Compro'));
        }
        if (@$request->type == 'statusClose') {

            $data = Customer::where('id', $id)->first();
            return view('DataLawsuit.section-execution.close-status', compact('data'));
        }
    }


    public function edit(Request $request, $id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //

        // if ($request->type == 'updateSelectCase') {

        //     DB::beginTransaction();
        //     try {
        //         $Execution = Execution_debt::where('cus_id', $id)->first();
        //         $Execution->date_book_certificate = $request->data['date_book_certificate'];
        //         $Execution->date_book_selection = $request->data['date_book_selection'];

        //         if ($request->data['status'] == 'Y') {
        //             $Execution->status = 'ขั้นสืบพยาน';
        //         }

        //         $Execution->update();





        //         // $Status->update();


        //         DB::commit();

        //         $data = Execution_debt::where('cus_id', $id)->first();

        //         $message = 'อัพเดตเรียบร้อย';

        //         $renderHTML =  view('DataLawsuit.section-execution.tab-view-select-case', compact('data'))->render();
        //         return response()->json(['html' => $renderHTML, 'message' => @$message]);
        //     } catch (\Exception $e) {

        //         DB::rollback();
        //         return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
        //     }
        // }
        if ($request->type == 'updateInvestigate') {

            DB::beginTransaction();
            try {
                $Execution = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $Execution->investigate_result = $request->data['investigate_result'];
                $Execution->date_investigate_first = $request->data['date_investigate_first'];
                $Execution->property_found = $request->data['property_found'];
                $Execution->note_1 = $request->data['note_1'];
                if ($request->data['status'] == 'Y') {
                    $Execution->status = 'ขั้นคัดโฉนด';
                }
                $Execution->update();
                $Status = Exe_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                if ($request->data['status'] == 'Y') {
                    $Status->status_2 = $request->data['status'];
                    $message = 'อัพเดตสถานะ';
                } else {
                    $message = 'อัพเดตเรียบร้อย';
                }

                $Status->update();

                DB::commit();
                $data = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $dataStatus = Exe_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $file_path = UploadFile::where('cus_id', $id)->get();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();
                $FinanceOther = FinanceOther::where('cus_id', $id)->get();
                $dataFinance = Finance::where('cus_id', $id)->get();


                $renderHTML =  view('DataLawsuit.section-execution.tab-view-investigate', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
                return response()->json(['html' => $renderHTML, 'message' => @$message]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->type == 'updateSelectDeed') {

            DB::beginTransaction();
            try {
                $Execution = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();


                $Execution->owner = $request->data['owner'];
                $Execution->latitude = $request->data['latitude'];
                $Execution->date_deed_certificate = $request->data['date_deed_certificate'];
                $Execution->mortgagee = $request->data['mortgagee'];
                $Execution->estimated_price = $request->data['estimated_price'];
                $Execution->longitude = $request->data['longitude'];
                $Execution->note_2 = $request->data['note_2'];

                if ($request->data['status'] == 'Y') {
                    $Execution->status = 'ขั้นตั้งเรื่องยึดทรัพย์';
                }

                $Execution->update();

                $Status = Exe_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                if ($request->data['status'] == 'Y') {
                    $Status->status_3 = $request->data['status'];
                    $message = 'อัพเดตสถานะ';
                } else {
                    $message = 'อัพเดตเรียบร้อย';
                }

                $Status->update();


                DB::commit();

                $dataStatus = Exe_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $file_path = UploadFile::where('cus_id', $id)->get();


                $data = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();
                $FinanceOther = FinanceOther::where('cus_id', $id)->get();
                $dataFinance = Finance::where('cus_id', $id)->get();



                $renderHTML =  view('DataLawsuit.section-execution.tab-view-select-deed', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
                return response()->json(['html' => $renderHTML, 'message' => @$message]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->type == 'updateConfiscation') {

            DB::beginTransaction();
            try {
                $Execution = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $Execution->exe_office = $request->data['exe_office'];
                $Execution->date_confiscation = $request->data['date_confiscation'];
                $Execution->date_report = $request->data['date_report'];
                $Execution->property = $request->data['property'];
                $Execution->deed_no = $request->data['deed_no'];
                $Execution->land_deed = $request->data['land_deed'];
                $Execution->owner_deed = $request->data['owner_deed'];
                $Execution->mortgage_income = $request->data['mortgage_income'];
                $Execution->some_land_price = $request->data['some_land_price'];
                $Execution->land_con = $request->data['land_con'];
                $Execution->land_price = $request->data['land_price'];
                $Execution->note_3 = $request->data['note_3'];

                if ($request->data['status'] == 'Y') {
                    $Execution->status = 'ขั้นประกาศขายทอดตลาด';
                }

                $Execution->update();

                $Status = Exe_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                if ($request->data['status'] == 'Y') {
                    $Status->status_4 = $request->data['status'];
                    $message = 'อัพเดตสถานะ';
                } else {
                    $message = 'อัพเดตเรียบร้อย';
                }

                $Status->update();
                $Execution->update();

                DB::commit();

                $data = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();

                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();
                $FinanceOther = FinanceOther::where('cus_id', $id)->get();
                $file_path = UploadFile::where('cus_id', $id)->get();
                $dataFinance = Finance::where('cus_id', $id)->get();
                $dataStatus = Exe_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();

                $renderHTML =  view('DataLawsuit.section-execution.tab-view-confiscation', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
                return response()->json(['html' => $renderHTML, 'message' => @$message]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->type == 'updateAnnounce') {

            DB::beginTransaction();
            try {
                $Execution = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $Compro = Compromise::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $Execution->date_announce_first = $request->data['date_announce_first'];
                // $Execution->exe_status = $request->data['exe_status'];
                $Execution->announce_result = $request->data['announce_result'];
                $Execution->note_4 = $request->data['note_4'];
                $Execution->date_1 = $request->data['date_1'];
                $Execution->date_2 = $request->data['date_2'];
                $Execution->date_3 = $request->data['date_3'];
                $Execution->date_4 = $request->data['date_4'];
                $Execution->date_5 = $request->data['date_5'];
                $Execution->date_6 = $request->data['date_6'];
                $Execution->announce_bill_result = $request->data['announce_bill_result'];
                $Execution->check_balance = (float)$request->data['check_balance'];
                $Execution->auction_sale = (float)$request->data['auction_sale'];
                $Execution->total_refund_balance = (float)$request->data['total_refund_balance'];
                $Execution->sale_date = $request->data['sale_date'];



                // if ($request->data['status'] == 'Y') {
                //     $Tribunal->status = 'ขั้นสืบพยาน';
                // }

                $Execution->update();

                // if ($Execution->check_balance >= $Compro->totalSum) {
                //     $CloseDatail = CloseDetail::updateOrCreate([
                //         'cus_id' =>  $id,
                //     ], [
                //         'cus_id' => $id,
                //         'total_pay' => $request->data['check_balance'],
                //         'status' => 'ชั้นบังคับคดี',
                //     ]);
                //     $Customer = Customer::where('id', $id)->first();
                //     $Customer->status_close = 'Y';
                //     $Customer->update();
                // }


                // $Status = Tribunal_status::where('id', $id)->first();
                // if ($request->data['status'] == 'Y') {
                //     $Status->status_2 = $request->data['status'];
                // }


                // $Status->update();


                DB::commit();

                $data = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();
                $FinanceOther = FinanceOther::where('cus_id', $id)->get();
                $dataFinance = Finance::where('cus_id', $id)->get();
                $file_path = UploadFile::where('cus_id', $id)->get();
                $dataStatus = Exe_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();

                $message = 'อัพเดตเรียบร้อย';

                $renderHTML =  view('DataLawsuit.section-execution.tab-view-announce', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
                return response()->json(['html' => $renderHTML, 'message' => @$message]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }

        if ($request->type == 'UpdateToAnnouncement') {
            DB::beginTransaction();
            try {
                $Execution = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();

                $Execution->status = 'ขั้นประกาศขายทอดตลาด';


                $Exe_status = Exe_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();

                $Exe_status->status_4 = 'Y';
                $Exe_status->status_3 = 'Y';

                $Customer = Customer::where('id', $id)->orderBy('id', 'DESC')->first();

                $Customer->status_com = 'N';
                $Compro = Compromise::where('id', $request->data['com_id'])->first();
                $Compro->status = 'close';

                $Compro->update();

                $Customer->update();

                $Exe_status->update();
                $Execution->update();

                DB::commit();
                $data = Execution_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();

                $dataStatus = Exe_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $Tribunal = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $file_path = UploadFile::where('cus_id', $id)->get();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();
                $FinanceOther = FinanceOther::where('cus_id', $id)->get();
                $dataFinance = Finance::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();


                $message = 'อัพเดตเรียบร้อย';
                $renderHTML =  view('DataLawsuit.section-execution.view', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance', 'Tribunal'))->render();

                return response()->json(['id' => $id, 'message' => $message, 'success' => '1', 'code' => 200, $renderHTML]);
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
                    'status' => 'ชั้นบังคับคดี(ปิดบัญชี)',
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
                    'status' => 'ชั้นบังคับคดี',
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
                    'status' => 'ชั้นบังคับคดี',
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
                    'status' => 'ชั้นบังคับคดี',
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

            DB::beginTransaction();
            try {
                $CloseDatail = CloseDetail::updateOrCreate([
                    'cus_id' =>  $id,
                ], [
                    'totalSum' => $request->data['total_sum'],
                    'cus_id' => $id,
                    'discount' => @$request->data['discount'],
                    'total_pay' => @$request->data['total_pay'],
                    'status' => 'ชั้นบังคับคดี',
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
    }


    public function export(Request $request)
    {

        if (@$request->type == 'ExportExe') {
            return Excel::download(new exportDataExe, 'รายงานชั้นบังคับคดี.xlsx');
        }
    }

    public function destroy($id)
    {
        //
    }
}
