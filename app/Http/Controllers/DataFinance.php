<?php

namespace App\Http\Controllers;

use App\Models\Compromise;
use App\Models\Customer;
use App\Models\Exe_status;
use App\Models\Execution_debt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tribunal_debt;
use App\Models\Tribunal_status;
use App\Models\FinanceOther;
use App\Models\Guarantor;
use App\Models\UploadFile;
use App\Models\Finance;
use App\Models\LawFinFuture;
use DB;

class DataFinance extends Controller
{

    public function index(Request $request)
    {
        $type = $request->type;
        if ($request->type == 'NewCompro') {

            $data = Tribunal_debt::where('status_com', 'Y')->get();

            return view('DataCompromise.section-NewCompromise.view-all', compact('data', 'type'));
        } elseif ($request->type == 'OldCompro') {
            return view('DataCompromise.section-OldCompromise.view');
        } elseif ($request->type == 'LawFinFuture') {
            $LawFin = LawFinFuture::get();
            $LawFinPerson = LawFinFuture::where('userInsert', Auth::user()->id)->orderBy('id', 'desc')->first();

            return view('DataFinance.LawFuture.view-finfuture', compact('LawFin', 'LawFinPerson'));
        }
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {


        // ชั้นศาล
        if ($request->data['type'] == 'InsertSue') {

            DB::beginTransaction();
            try {
                $Finance = new Finance;
                $Finance->court_fee =  $request->data['court_fee'];
                $Finance->send_defendant =  $request->data['send_defendant'];
                $Finance->totalsum = $request->data['court_fee'] + $request->data['send_defendant'];
                $Finance->cus_id = $request->data['cus_id'];

                $Finance->bil_no = $request->data['bil_no'];
                $Finance->levels = 'ขั้นฟ้อง';
                $Finance->Applicant = $request->data['Applicant'];
                $Finance->note = $request->data['note'];
                $Finance->date_fin = date('Y-m-d');


                if ($request->data['Finfuture'] == 'Y') {
                    $Finance->id_finFuture = $request->data['fin_id'];
                } else {
                    $Finance->id_finFuture = NULL;
                }


                $Finance->save();
                DB::commit();

                for ($i = 1; $i <= $request->data['count']; $i++) {
                    if (isset($request->data['name' . $i]) != '' || isset($request->data['val' . $i]) != '') {
                        $FinanceOther = new FinanceOther;
                        $FinanceOther->name = $request->data['name' . $i];
                        $FinanceOther->value = str_replace(",", "", @$request->data['val' . $i]);
                        $FinanceOther->status = 'ขั้นฟ้อง';
                        $FinanceOther->Cus_id = $request->data['cus_id'];
                        $FinanceOther->FinId = $Finance->id;

                        $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];

                        $FinanceOther->save();
                        $Finance->update();
                    }
                    // $Status->save();
                    DB::commit();
                }


                $data = Tribunal_debt::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $dataStatus = Tribunal_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $file_path = UploadFile::where('cus_id', $request->data['cus_id'])->get();
                $dataGuarantor = Guarantor::where('cus_id', $request->data['cus_id'])->get();
                $customer = Customer::where('id', $request->data['cus_id'])->get();
                $FinanceOther = FinanceOther::where('cus_id', $request->data['cus_id'])->get();
                $dataFinance = Finance::where('cus_id', $request->data['cus_id'])->get();


                $message = 'อัพเดตเรียบร้อย';
                $renderHTML =  view('DataLawsuit.section-court.tab-view-indict', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();

                return response()->json(['html' => $renderHTML]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->data['type'] == 'InsertWitness') {

            DB::beginTransaction();
            try {
                $Finance = new Finance;

                $Finance->copy_documents1 =  $request->data['copy_documents1'];
                $Finance->totalsum = $request->data['copy_documents1'];
                $Finance->cus_id = $request->data['cus_id'];

                $Finance->bil_no = $request->data['bil_no'];
                $Finance->levels = 'ขั้นสืบพยาน';
                $Finance->Applicant = $request->data['Applicant'];
                $Finance->note = $request->data['note'];
                $Finance->date_fin = date('Y-m-d');
                if ($request->data['Finfuture'] == 'Y') {
                    $Finance->id_finFuture = $request->data['fin_id'];
                } else {
                    $Finance->id_finFuture = NULL;
                }

                $Finance->save();
                DB::commit();

                for ($i = 1; $i <= $request->data['count']; $i++) {
                    if (isset($request->data['name' . $i]) != '' || isset($request->data['val' . $i]) != '') {
                        $FinanceOther = new FinanceOther;
                        $FinanceOther->name = $request->data['name' . $i];
                        $FinanceOther->value = str_replace(",", "", @$request->data['val' . $i]);
                        $FinanceOther->status = 'ขั้นสืบพยาน';
                        $FinanceOther->Cus_id = $request->data['cus_id'];
                        $FinanceOther->FinId = $Finance->id;
                        $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];

                        $FinanceOther->save();
                        $Finance->update();
                    }
                    // $Status->save();
                    DB::commit();
                }

                $data = Tribunal_debt::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $dataStatus = Tribunal_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $file_path = UploadFile::where('cus_id', $request->data['cus_id'])->get();
                $dataGuarantor = Guarantor::where('cus_id', $request->data['cus_id'])->get();
                $customer = Customer::where('id', $request->data['cus_id'])->get();
                $FinanceOther = FinanceOther::where('cus_id', $request->data['cus_id'])->get();
                $dataFinance = Finance::where('cus_id', $request->data['cus_id'])->get();

                $message = 'อัพเดตเรียบร้อย';
                $renderHTML =  view('DataLawsuit.section-court.tab-view-pursue', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
                return response()->json(['html' => $renderHTML]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->data['type'] == 'InsertCommand') {

            DB::beginTransaction();
            try {
                $Finance = new Finance;
                $Finance->mandatory_fee =  $request->data['mandatory_fee'];

                $Finance->totalsum = $request->data['mandatory_fee'];
                $Finance->cus_id = $request->data['cus_id'];

                $Finance->bil_no = $request->data['bil_no'];
                $Finance->levels = 'ขั้นส่งคำบังคับ';
                $Finance->Applicant = $request->data['Applicant'];
                $Finance->note = $request->data['note'];
                $Finance->date_fin = date('Y-m-d');

                if ($request->data['Finfuture'] == 'Y') {
                    $Finance->id_finFuture = $request->data['fin_id'];
                } else {
                    $Finance->id_finFuture = NULL;
                }
                $Finance->save();
                DB::commit();

                for ($i = 1; $i <= $request->data['count']; $i++) {
                    if (isset($request->data['name' . $i]) != '' || isset($request->data['val' . $i]) != '') {
                        $FinanceOther = new FinanceOther;
                        $FinanceOther->name = $request->data['name' . $i];
                        $FinanceOther->value = str_replace(",", "", @$request->data['val' . $i]);
                        $FinanceOther->status = 'ขั้นส่งคำบังคับ';
                        $FinanceOther->Cus_id = $request->data['cus_id'];
                        $FinanceOther->FinId = $Finance->id;
                        $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];

                        $FinanceOther->save();
                        $Finance->update();
                    }
                    // $Status->save();
                    DB::commit();
                }

                $data = Tribunal_debt::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $dataStatus = Tribunal_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $file_path = UploadFile::where('cus_id', $request->data['cus_id'])->get();
                $dataGuarantor = Guarantor::where('cus_id', $request->data['cus_id'])->get();
                $customer = Customer::where('id', $request->data['cus_id'])->get();
                $FinanceOther = FinanceOther::where('cus_id', $request->data['cus_id'])->get();
                $dataFinance = Finance::where('cus_id', $request->data['cus_id'])->get();

                $message = 'อัพเดตเรียบร้อย';
                $renderHTML =  view('DataLawsuit.section-court.tab-view-sendCommand', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
                return response()->json(['html' => $renderHTML]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->data['type'] == 'InsertProperty') {

            DB::beginTransaction();
            try {

                $Finance = new Finance;
                $Finance->check_ownership =  $request->data['check_ownership'];
                $Finance->copy_documents2 =  $request->data['copy_documents2'];
                $Finance->point_property =  $request->data['point_property'];
                $Finance->totalsum = $request->data['check_ownership'] + $request->data['copy_documents2'] + $request->data['point_property'];
                $Finance->cus_id = $request->data['cus_id'];
                $Finance->bil_no = $request->data['bil_no'];
                $Finance->Applicant = $request->data['Applicant'];
                $Finance->note = $request->data['note'];
                $Finance->date_fin = date('Y-m-d');

                $Finance->levels = 'ขั้นตั้งเจ้าพนักงาน';
                if ($request->data['Finfuture'] == 'Y') {
                    $Finance->id_finFuture = $request->data['fin_id'];
                } else {
                    $Finance->id_finFuture = NULL;
                }
                $Finance->save();
                DB::commit();

                for ($i = 1; $i <= $request->data['count']; $i++) {
                    if (isset($request->data['name' . $i]) != '' || isset($request->data['val' . $i]) != '') {
                        $FinanceOther = new FinanceOther;
                        $FinanceOther->name = $request->data['name' . $i];
                        $FinanceOther->value = str_replace(",", "", @$request->data['val' . $i]);
                        $FinanceOther->status = 'ขั้นตั้งเจ้าพนักงาน';
                        $FinanceOther->Cus_id = $request->data['cus_id'];
                        $FinanceOther->FinId = $Finance->id;
                        $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];

                        $FinanceOther->save();
                        $Finance->update();
                    }
                    // $Status->save();
                    DB::commit();
                }

                $data = Tribunal_debt::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $dataStatus = Tribunal_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $file_path = UploadFile::where('cus_id', $request->data['cus_id'])->get();
                $dataGuarantor = Guarantor::where('cus_id', $request->data['cus_id'])->get();
                $customer = Customer::where('id', $request->data['cus_id'])->get();
                $FinanceOther = FinanceOther::where('cus_id', $request->data['cus_id'])->get();
                $dataFinance = Finance::where('cus_id', $request->data['cus_id'])->get();

                $message = 'อัพเดตเรียบร้อย';
                $renderHTML =  view('DataLawsuit.section-court.tab-view-setStaff', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
                return response()->json(['html' => $renderHTML]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }

        // ชั้นบังคับคดี
        if ($request->data['type'] == 'InsertInvest') {


            DB::beginTransaction();
            try {
                $Finance = new Finance;
                $Finance->investigation_fee =  $request->data['investigation_fee'];
                $Finance->property_iden =  $request->data['property_iden'];
                $Finance->totalsum = $request->data['investigation_fee'] + $request->data['property_iden'];
                $Finance->cus_id = $request->data['cus_id'];

                $Finance->bil_no = $request->data['bil_no'];
                $Finance->levels = 'ขั้นสืบทรัพย์';
                $Finance->Applicant = $request->data['Applicant'];
                $Finance->note = $request->data['note'];
                $Finance->date_fin = date('Y-m-d');

                if ($request->data['Finfuture'] == 'Y') {
                    $Finance->id_finFuture = $request->data['fin_id'];
                } else {
                    $Finance->id_finFuture = NULL;
                }
                $Finance->save();
                DB::commit();

                for ($i = 1; $i <= $request->data['count']; $i++) {
                    if (isset($request->data['name' . $i]) != '' || isset($request->data['val' . $i]) != '') {
                        $FinanceOther = new FinanceOther;
                        $FinanceOther->name = $request->data['name' . $i];
                        $FinanceOther->value = str_replace(",", "", @$request->data['val' . $i]);
                        $FinanceOther->status = 'ขั้นสืบทรัพย์';
                        $FinanceOther->Cus_id = $request->data['cus_id'];
                        $FinanceOther->FinId = $Finance->id;

                        $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];

                        $FinanceOther->save();
                        $Finance->update();
                    }
                    // $Status->save();
                    DB::commit();
                }


                $data = Execution_debt::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $dataStatus = Exe_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $file_path = UploadFile::where('cus_id', $request->data['cus_id'])->get();
                $dataGuarantor = Guarantor::where('cus_id', $request->data['cus_id'])->get();
                $customer = Customer::where('id', $request->data['cus_id'])->get();
                $FinanceOther = FinanceOther::where('cus_id', $request->data['cus_id'])->get();
                $dataFinance = Finance::where('cus_id', $request->data['cus_id'])->get();

                $message = 'อัพเดตเรียบร้อย';
                $renderHTML =  view('DataLawsuit.section-execution.tab-view-investigate', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();

                return response()->json(['html' => $renderHTML]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->data['type'] == 'InsertDeed') {

            DB::beginTransaction();
            try {
                $Finance = new Finance;

                $Finance->copy_documents3 =  $request->data['copy_documents3'];
                $Finance->totalsum = $request->data['copy_documents3'];
                $Finance->cus_id = $request->data['cus_id'];

                $Finance->bil_no = $request->data['bil_no'];
                $Finance->levels = 'ขั้นคัดโฉนด';
                $Finance->Applicant = $request->data['Applicant'];
                $Finance->note = $request->data['note'];
                $Finance->date_fin = date('Y-m-d');
                if ($request->data['Finfuture'] == 'Y') {
                    $Finance->id_finFuture = $request->data['fin_id'];
                } else {
                    $Finance->id_finFuture = NULL;
                }

                $Finance->save();
                DB::commit();

                for ($i = 1; $i <= $request->data['count']; $i++) {
                    if (isset($request->data['name' . $i]) != '' || isset($request->data['val' . $i]) != '') {
                        $FinanceOther = new FinanceOther;
                        $FinanceOther->name = $request->data['name' . $i];
                        $FinanceOther->value = str_replace(",", "", @$request->data['val' . $i]);
                        $FinanceOther->status = 'ขั้นคัดโฉนด';
                        $FinanceOther->Cus_id = $request->data['cus_id'];
                        $FinanceOther->FinId = $Finance->id;

                        $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];

                        $FinanceOther->save();
                        $Finance->update();
                    }
                    // $Status->save();
                    DB::commit();
                }


                $data = Execution_debt::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $dataStatus = Exe_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $file_path = UploadFile::where('cus_id', $request->data['cus_id'])->get();
                $dataGuarantor = Guarantor::where('cus_id', $request->data['cus_id'])->get();
                $customer = Customer::where('id', $request->data['cus_id'])->get();
                $FinanceOther = FinanceOther::where('cus_id', $request->data['cus_id'])->get();
                $dataFinance = Finance::where('cus_id', $request->data['cus_id'])->get();


                $message = 'อัพเดตเรียบร้อย';
                $renderHTML =  view('DataLawsuit.section-execution.tab-view-select-deed', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();

                return response()->json(['html' => $renderHTML]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->data['type'] == 'InsertCon') {

            DB::beginTransaction();
            try {
                $Finance = new Finance;

                $Finance->setup_con =  $request->data['setup_con'];
                $Finance->auction_announce =  $request->data['auction_announce'];
                $Finance->withdraw_execution =  $request->data['withdraw_execution'];

                $Finance->totalsum = $request->data['setup_con'] +  $request->data['auction_announce'] + $request->data['withdraw_execution'];
                $Finance->cus_id = $request->data['cus_id'];

                $Finance->bil_no = $request->data['bil_no'];
                $Finance->levels = 'ขั้นตั้งเรื่องยึดทรัพย์';
                $Finance->Applicant = $request->data['Applicant'];
                $Finance->note = $request->data['note'];
                $Finance->date_fin = date('Y-m-d');
                if ($request->data['Finfuture'] == 'Y') {
                    $Finance->id_finFuture = $request->data['fin_id'];
                } else {
                    $Finance->id_finFuture = NULL;
                }

                $Finance->save();
                DB::commit();

                for ($i = 1; $i <= $request->data['count']; $i++) {
                    if (isset($request->data['name' . $i]) != '' || isset($request->data['val' . $i]) != '') {
                        $FinanceOther = new FinanceOther;
                        $FinanceOther->name = $request->data['name' . $i];
                        $FinanceOther->value = str_replace(",", "", @$request->data['val' . $i]);
                        $FinanceOther->status = 'ขั้นตั้งเรื่องยึดทรัพย์';
                        $FinanceOther->Cus_id = $request->data['cus_id'];
                        $FinanceOther->FinId = $Finance->id;

                        $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];

                        $FinanceOther->save();
                        $Finance->update();
                    }
                    // $Status->save();
                    DB::commit();
                }


                $data = Execution_debt::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $dataStatus = Exe_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $file_path = UploadFile::where('cus_id', $request->data['cus_id'])->get();
                $dataGuarantor = Guarantor::where('cus_id', $request->data['cus_id'])->get();
                $customer = Customer::where('id', $request->data['cus_id'])->get();
                $FinanceOther = FinanceOther::where('cus_id', $request->data['cus_id'])->get();
                $dataFinance = Finance::where('cus_id', $request->data['cus_id'])->get();


                $message = 'อัพเดตเรียบร้อย';
                $renderHTML =  view('DataLawsuit.section-execution.tab-view-confiscation', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();

                return response()->json(['html' => $renderHTML]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }

        if ($request->data['type'] == 'RequestFinFuture') {
            DB::beginTransaction();
            try {
                $LawFuture = new LawFinFuture();

                $LawFuture->userInsert = Auth::user()->id;
                $LawFuture->amount =  $request->data['amount'];
                $LawFuture->detail =  $request->data['detail'];
                $LawFuture->status =  $request->data['status'];
                $LawFuture->save();
                DB::commit();


                $message = 'อัพเดตเรียบร้อย';

                return response()->json(['message']);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        
    }
    public function show(Request $request, $id)
    {
        //
        $bill_no = Finance::generateFinnumber();

        // ชั้นศาล
        if ($request->type == 'EditFinanceSue') {
            $dataFinance = Finance::where('id', $id)->first();
            $other = FinanceOther::where('id', $id)
                ->where('status', 'ขั้นฟ้อง')
                ->get();

            $finFuture = LawFinFuture::where('userInsert', Auth::user()->id)->whereNot('amount',0)->where('status','อนุมัติ')->first();


            return view('DataFinance.sue-edit', compact('dataFinance', 'other', 'bill_no', 'finFuture'));
        }
        if ($request->type == 'EditFinanceWitness') {
            $dataFinance = Finance::where('id', $id)->first();
            $other = FinanceOther::where('id', $id)
                ->where('status', 'ขั้นสืบพยาน')
                ->get();
             $finFuture = LawFinFuture::where('userInsert', Auth::user()->id)->whereNot('amount',0)->where('status','อนุมัติ')->first();

            return view('DataFinance.witnesses-edit', compact('dataFinance', 'other', 'bill_no', 'finFuture'));
        }
        if ($request->type == 'EditFinanceCommand') {
            $dataFinance = Finance::where('id', $id)->first();
            $other = FinanceOther::where('id', $id)
                ->where('status', 'ขั้นส่งคำบังคับ')
                ->get();
             $finFuture = LawFinFuture::where('userInsert', Auth::user()->id)->whereNot('amount',0)->where('status','อนุมัติ')->first();
            return view('DataFinance.command-edit', compact('dataFinance', 'other', 'bill_no', 'finFuture'));
        }
        if ($request->type == 'EditFinanceProperty') {
            $dataFinance = Finance::where('id', $id)->first();
            $other = FinanceOther::where('id', $id)
                ->where('status', 'ขั้นตั้งเจ้าพนักงาน')
                ->get();
             $finFuture = LawFinFuture::where('userInsert', Auth::user()->id)->whereNot('amount',0)->where('status','อนุมัติ')->first();
            return view('DataFinance.property-edit', compact('dataFinance', 'other', 'bill_no', 'finFuture'));
        }

        // ชั้นบังคับคดี
        if ($request->type == 'EditFinanceInvest') {
            $dataFinance = Finance::where('id', $id)->first();
            $other = FinanceOther::where('id', $id)
                ->where('status', 'ขั้นสืบทรัพย์')
                ->get();

             $finFuture = LawFinFuture::where('userInsert', Auth::user()->id)->whereNot('amount',0)->where('status','อนุมัติ')->first();
            return view('DataFinance.section-exe.invest-edit', compact('dataFinance', 'other', 'bill_no', 'finFuture'));
        }
        if ($request->type == 'EditFinanceDeed') {
            $dataFinance = Finance::where('id', $id)->first();
            $other = FinanceOther::where('id', $id)
                ->where('status', 'ขั้นคัดโฉนด')
                ->get();

             $finFuture = LawFinFuture::where('userInsert', Auth::user()->id)->whereNot('amount',0)->where('status','อนุมัติ')->first();
            return view('DataFinance.section-exe.deed-edit', compact('dataFinance', 'other', 'bill_no', 'finFuture'));
        }
        if ($request->type == 'EditFinanceCon') {
            $dataFinance = Finance::where('id', $id)->first();
            $other = FinanceOther::where('id', $id)
                ->where('status', 'ขั้นตั้งเรื่องยึดทรัพย์')
                ->get();
             $finFuture = LawFinFuture::where('userInsert', Auth::user()->id)->whereNot('amount',0)->where('status','อนุมัติ')->first();

            return view('DataFinance.section-exe.confiscation-edit', compact('dataFinance', 'other', 'bill_no', 'finFuture'));
        }


        if ($request->type == 'UpdateFin') {
            $dataFinance = Finance::where('cus_id', $id)->get();
            return view('DataCustomer.section-cus.Update-Finance', compact('dataFinance'));
        }
        if ($request->type == 'showDetail') {
            $dataFinance = Finance::where('id', $id)->first();
            $finFuture = LawFinFuture::where('id', $dataFinance->id_finFuture)->first();

            return view('DataFinance.show-detail', compact('dataFinance', 'finFuture'));
        }
        // เพิ่มบิลชั้นศาล
        if ($request->type == 'InsertFinanceSue') {
            $customer = Customer::where('id', $id)->first();
             $finFuture = LawFinFuture::where('userInsert', Auth::user()->id)->whereNot('amount',0)->where('status','อนุมัติ')->first();


            return view('DataFinance.sue-insert', compact('customer', 'bill_no', 'finFuture'));
        }
        if ($request->type == 'InsertFinanceWitness') {
            $customer = Customer::where('id', $id)->first();
             $finFuture = LawFinFuture::where('userInsert', Auth::user()->id)->whereNot('amount',0)->where('status','อนุมัติ')->first();

            return view('DataFinance.witness-insert', compact('customer', 'bill_no', 'finFuture'));
        }
        if ($request->type == 'InsertFinanceCommand') {
            $customer = Customer::where('id', $id)->first();
             $finFuture = LawFinFuture::where('userInsert', Auth::user()->id)->whereNot('amount',0)->where('status','อนุมัติ')->first();

            return view('DataFinance.command-insert', compact('customer', 'bill_no', 'finFuture'));
        }
        if ($request->type == 'InsertFinanceProperty') {
            $customer = Customer::where('id', $id)->first();
             $finFuture = LawFinFuture::where('userInsert', Auth::user()->id)->whereNot('amount',0)->where('status','อนุมัติ')->first();

            return view('DataFinance.property-insert', compact('customer', 'bill_no', 'finFuture'));
        }
        // เพิ่มบิลชั้นบังคับคดี
        if ($request->type == 'InsertFinanceInvest') {

            $customer = Customer::where('id', $id)->first();
             $finFuture = LawFinFuture::where('userInsert', Auth::user()->id)->whereNot('amount',0)->where('status','อนุมัติ')->first();

            return view('DataFinance.section-exe.invest-insert', compact('customer', 'bill_no', 'finFuture'));
        }
        if ($request->type == 'InsertFinanceDeed') {
            $customer = Customer::where('id', $id)->first();
             $finFuture = LawFinFuture::where('userInsert', Auth::user()->id)->whereNot('amount',0)->where('status','อนุมัติ')->first();

            return view('DataFinance.section-exe.deed-insert', compact('customer', 'bill_no', 'finFuture'));
        }
        if ($request->type == 'InsertFinanceCon') {
            $customer = Customer::where('id', $id)->first();
             $finFuture = LawFinFuture::where('userInsert', Auth::user()->id)->whereNot('amount',0)->where('status','อนุมัติ')->first();

            return view('DataFinance.section-exe.confiscation-insert', compact('customer', 'bill_no', 'finFuture'));
        }

        if ($request->type == 'CreateFinFuture') {

            return view('DataFinance.LawFuture.create-fin');
        }
        if ($request->type == 'showFinFutureDetail') {
            $finance = Finance::where('id_finFuture', $id)->where('status', 'อนุมัติ')->orWhere('status', 'ขอยกเลิก')->get();
            return view('DataFinance.LawFuture.fin-future-detail', compact('finance'));
        }
        if ($request->type == 'showFinDetail') {
            $dataFinance = Finance::where('id', $id)->first();
            $finFuture = LawFinFuture::where('id', $dataFinance->id_finFuture)->first();
            return view('DataFinance.LawFuture.show-detail', compact('dataFinance', 'finFuture', 'finFuture'));
        }
    }


    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {
        //

        if ($request->type == 'UpdateInvest') {
            $Finance = Finance::where('id', $request->data['FinId'])->first();


            if ($Finance->investigation_fee !=  $request->data['investigation_fee']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->investigation_fee;
                $Finance->investigation_fee =  $request->data['investigation_fee'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->investigation_fee;

                $Finance->update();
            }
            if ($Finance->property_iden !=  $request->data['property_iden']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->property_iden;
                $Finance->property_iden =  $request->data['property_iden'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->property_iden;

                $Finance->update();
            }

            if ($request->data['Finfuture'] == 'Y') {
                $Finance->id_finFuture = $request->data['fin_id'];
            } else {
                $Finance->id_finFuture = NULL;
            }
            $Finance->bil_no =  $request->data['bil_no'];
            $Finance->levels = 'ขั้นสืบทรัพย์';
            $Finance->note = $request->data['note'];
            $Finance->update();
            DB::commit();
            for ($i = 1; $i <= $request->data['count']; $i++) {

                // $Finance = Finance::where('id', $request->data['id' . $i])->first();
                DB::beginTransaction();

                if (isset($request->data['id' . $i]) != NULL) {
                    try {
                        $FinanceOther = FinanceOther::where('id', $request->data['id' . $i])->first();
                        if ($request->data['name' . $i] != '' || $request->data['val' . $i] != '') {
                            $Finance->totalsum = $Finance->totalsum - $FinanceOther->value;
                            $FinanceOther->name = $request->data['name' . $i];
                            $FinanceOther->value =  str_replace(",", "", @$request->data['val' . $i]);
                            $FinanceOther->status = 'ขั้นสืบทรัพย์';
                            $FinanceOther->cus_id = $request->data['cus_id'];
                            $FinanceOther->FinId = $request->data['FinId'];
                            $FinanceOther->update();
                            $Finance->update();
                            $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];
                            $Finance->update();
                            DB::commit();
                        }
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                    continue;
                }
                if (isset($request->data['name' . $i]) != '' || isset($request->data['val' . $i]) != '') {
                    try {
                        $FinanceOther = new FinanceOther;
                        $FinanceOther->name = $request->data['name' . $i];
                        $FinanceOther->value =  str_replace(",", "", @$request->data['val' . $i]);
                        $FinanceOther->status = 'ขั้นสืบทรัพย์';
                        $FinanceOther->cus_id = $request->data['cus_id'];
                        $FinanceOther->FinId = $request->data['FinId'];
                        $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];
                        $FinanceOther->save();
                        $Finance->update();

                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                }




                // $Finance->court_fee = (float)($request->data['court_fee']);
                // $Finance->send_defendant = (float)($request->data['send_defendant']);
                // $Finance->other = implode(' ,', $request->data['array']);
                // $Finance->update();
            }

            $data = Execution_debt::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
            $dataStatus = Exe_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
            $file_path = UploadFile::where('cus_id', $request->data['cus_id'])->get();
            $dataGuarantor = Guarantor::where('cus_id', $request->data['cus_id'])->get();
            $customer = Customer::where('id', $request->data['cus_id'])->get();
            $FinanceOther = FinanceOther::where('cus_id', $request->data['cus_id'])->get();
            $dataFinance = Finance::where('cus_id', $request->data['cus_id'])->get();

            $message = 'อัพเดตเรียบร้อย';
            $renderHTML =  view('DataLawsuit.section-execution.tab-view-investigate', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
            return response()->json(['html' => $renderHTML]);
        }
        if ($request->type == 'UpdateDeed') {
            $Finance = Finance::where('id', $request->data['FinId'])->first();


            if ($Finance->copy_documents3 !=  $request->data['copy_documents3']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->copy_documents3;
                $Finance->copy_documents3 =  $request->data['copy_documents3'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->copy_documents3;

                $Finance->update();
            }

            $Finance->bil_no =  $request->data['bil_no'];
            $Finance->levels = 'ขั้นคัดโฉนด';
            $Finance->note = $request->data['note'];
            if ($request->data['Finfuture'] == 'Y') {
                $Finance->id_finFuture = $request->data['fin_id'];
            } else {
                $Finance->id_finFuture = NULL;
            }
            $Finance->update();
            DB::commit();
            for ($i = 1; $i <= $request->data['count']; $i++) {

                // $Finance = Finance::where('id', $request->data['id' . $i])->first();
                DB::beginTransaction();

                if (isset($request->data['id' . $i]) != NULL) {
                    try {
                        $FinanceOther = FinanceOther::where('id', $request->data['id' . $i])->first();
                        if ($request->data['name' . $i] != '' || $request->data['val' . $i] != '') {
                            $Finance->totalsum = $Finance->totalsum - $FinanceOther->value;
                            $FinanceOther->name = $request->data['name' . $i];
                            $FinanceOther->value =  str_replace(",", "", @$request->data['val' . $i]);
                            $FinanceOther->status = 'ขั้นคัดโฉนด';
                            $FinanceOther->cus_id = $request->data['cus_id'];
                            $FinanceOther->FinId = $request->data['FinId'];
                            $FinanceOther->update();
                            $Finance->update();
                            $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];
                            $Finance->update();
                            DB::commit();
                        }
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                    continue;
                }
                if (isset($request->data['name' . $i]) != '' || isset($request->data['val' . $i]) != '') {
                    try {
                        $FinanceOther = new FinanceOther;
                        $FinanceOther->name = $request->data['name' . $i];
                        $FinanceOther->value =  str_replace(",", "", @$request->data['val' . $i]);
                        $FinanceOther->status = 'ขั้นคัดโฉนด';
                        $FinanceOther->cus_id = $request->data['cus_id'];
                        $FinanceOther->FinId = $request->data['FinId'];
                        $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];
                        $FinanceOther->save();
                        $Finance->update();

                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                }




                // $Finance->court_fee = (float)($request->data['court_fee']);
                // $Finance->send_defendant = (float)($request->data['send_defendant']);
                // $Finance->other = implode(' ,', $request->data['array']);
                // $Finance->update();
            }

            $data = Execution_debt::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
            $dataStatus = Exe_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
            $file_path = UploadFile::where('cus_id', $request->data['cus_id'])->get();
            $dataGuarantor = Guarantor::where('cus_id', $request->data['cus_id'])->get();
            $customer = Customer::where('id', $request->data['cus_id'])->get();
            $FinanceOther = FinanceOther::where('cus_id', $request->data['cus_id'])->get();
            $dataFinance = Finance::where('cus_id', $request->data['cus_id'])->get();

            $message = 'อัพเดตเรียบร้อย';
            $renderHTML =  view('DataLawsuit.section-execution.tab-view-select-deed', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
            return response()->json(['html' => $renderHTML]);
        }
        if ($request->type == 'UpdateCon') {
            $Finance = Finance::where('id', $request->data['FinId'])->first();


            if ($Finance->auction_announce !=  $request->data['auction_announce']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->auction_announce;
                $Finance->auction_announce =  $request->data['auction_announce'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->auction_announce;

                $Finance->update();
            }
            if ($Finance->setup_con !=  $request->data['setup_con']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->setup_con;
                $Finance->setup_con =  $request->data['setup_con'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->setup_con;

                $Finance->update();
            }
            if ($Finance->withdraw_execution !=  $request->data['withdraw_execution']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->withdraw_execution;
                $Finance->withdraw_execution =  $request->data['withdraw_execution'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->withdraw_execution;

                $Finance->update();
            }
            if ($request->data['Finfuture'] == 'Y') {
                $Finance->id_finFuture = $request->data['fin_id'];
            } else {
                $Finance->id_finFuture = NULL;
            }

            $Finance->bil_no =  $request->data['bil_no'];
            $Finance->levels = 'ขั้นตั้งเรื่องยึดทรัพย์';
            $Finance->note = $request->data['note'];
            $Finance->update();
            DB::commit();
            for ($i = 1; $i <= $request->data['count']; $i++) {

                // $Finance = Finance::where('id', $request->data['id' . $i])->first();
                DB::beginTransaction();

                if (isset($request->data['id' . $i]) != NULL) {
                    try {
                        $FinanceOther = FinanceOther::where('id', $request->data['id' . $i])->first();
                        if ($request->data['name' . $i] != '' || $request->data['val' . $i] != '') {
                            $Finance->totalsum = $Finance->totalsum - $FinanceOther->value;
                            $FinanceOther->name = $request->data['name' . $i];
                            $FinanceOther->value =  str_replace(",", "", @$request->data['val' . $i]);
                            $FinanceOther->status = 'ขั้นตั้งเรื่องยึดทรัพย์';
                            $FinanceOther->cus_id = $request->data['cus_id'];
                            $FinanceOther->FinId = $request->data['FinId'];
                            $FinanceOther->update();
                            $Finance->update();
                            $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];
                            $Finance->update();
                            DB::commit();
                        }
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                    continue;
                }
                if (isset($request->data['name' . $i]) != '' || isset($request->data['val' . $i]) != '') {
                    try {
                        $FinanceOther = new FinanceOther;
                        $FinanceOther->name = $request->data['name' . $i];
                        $FinanceOther->value =  str_replace(",", "", @$request->data['val' . $i]);
                        $FinanceOther->status = 'ขั้นตั้งเรื่องยึดทรัพย์';
                        $FinanceOther->cus_id = $request->data['cus_id'];
                        $FinanceOther->FinId = $request->data['FinId'];
                        $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];
                        $FinanceOther->save();
                        $Finance->update();

                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                }




                // $Finance->court_fee = (float)($request->data['court_fee']);
                // $Finance->send_defendant = (float)($request->data['send_defendant']);
                // $Finance->other = implode(' ,', $request->data['array']);
                // $Finance->update();
            }

            $data = Execution_debt::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
            $dataStatus = Exe_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
            $file_path = UploadFile::where('cus_id', $request->data['cus_id'])->get();
            $dataGuarantor = Guarantor::where('cus_id', $request->data['cus_id'])->get();
            $customer = Customer::where('id', $request->data['cus_id'])->get();
            $FinanceOther = FinanceOther::where('cus_id', $request->data['cus_id'])->get();
            $dataFinance = Finance::where('cus_id', $request->data['cus_id'])->get();

            $message = 'อัพเดตเรียบร้อย';
            $renderHTML =  view('DataLawsuit.section-execution.tab-view-confiscation', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
            return response()->json(['html' => $renderHTML]);
        }

        if ($request->type == 'UpdateSue') {
            $Finance = Finance::where('id', $request->data['FinId'])->first();


            if ($Finance->court_fee !=  $request->data['court_fee']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->court_fee;
                $Finance->court_fee =  $request->data['court_fee'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->court_fee;

                $Finance->update();
            }
            if ($Finance->send_defendant !=  $request->data['send_defendant']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->send_defendant;
                $Finance->send_defendant =  $request->data['send_defendant'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->send_defendant;

                $Finance->update();
            }
            $Finance->bil_no =  $request->data['bil_no'];
            $Finance->levels = 'ขั้นฟ้อง';
            $Finance->Applicant = $request->data['Applicant'];
            $Finance->note = $request->data['note'];
            if ($request->data['Finfuture'] == 'Y') {
                $Finance->id_finFuture = $request->data['fin_id'];
            } else {
                $Finance->id_finFuture = NULL;
            }


            $Finance->update();
            DB::commit();
            for ($i = 1; $i <= $request->data['count']; $i++) {

                // $Finance = Finance::where('id', $request->data['id' . $i])->first();
                DB::beginTransaction();

                if (isset($request->data['id' . $i]) != NULL) {
                    try {
                        $FinanceOther = FinanceOther::where('id', $request->data['id' . $i])->first();
                        if ($request->data['name' . $i] != '' || $request->data['val' . $i] != '') {
                            $Finance->totalsum = $Finance->totalsum - $FinanceOther->value;
                            $FinanceOther->name = $request->data['name' . $i];
                            $FinanceOther->value =  str_replace(",", "", @$request->data['val' . $i]);
                            $FinanceOther->status = 'ขั้นฟ้อง';
                            $FinanceOther->cus_id = $request->data['cus_id'];
                            $FinanceOther->FinId = $request->data['FinId'];
                            $FinanceOther->update();
                            $Finance->update();
                            $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];
                            $Finance->update();
                            DB::commit();
                        }
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                    continue;
                }
                if (isset($request->data['name' . $i]) != '' || isset($request->data['val' . $i]) != '') {
                    try {
                        $FinanceOther = new FinanceOther;
                        $FinanceOther->name = $request->data['name' . $i];
                        $FinanceOther->value =  str_replace(",", "", @$request->data['val' . $i]);
                        $FinanceOther->status = 'ขั้นฟ้อง';
                        $FinanceOther->cus_id = $request->data['cus_id'];
                        $FinanceOther->FinId = $request->data['FinId'];
                        $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];
                        $FinanceOther->save();
                        $Finance->update();

                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                }




                // $Finance->court_fee = (float)($request->data['court_fee']);
                // $Finance->send_defendant = (float)($request->data['send_defendant']);
                // $Finance->other = implode(' ,', $request->data['array']);
                // $Finance->update();
            }

            $data = Tribunal_debt::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
            $dataStatus = Tribunal_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
            $file_path = UploadFile::where('cus_id', $request->data['cus_id'])->get();
            $dataGuarantor = Guarantor::where('cus_id', $request->data['cus_id'])->get();
            $customer = Customer::where('id', $request->data['cus_id'])->get();
            $FinanceOther = FinanceOther::where('cus_id', $request->data['cus_id'])->get();
            $dataFinance = Finance::where('cus_id', $request->data['cus_id'])->get();

            $message = 'อัพเดตเรียบร้อย';
            $renderHTML =  view('DataLawsuit.section-court.tab-view-indict', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
            return response()->json(['html' => $renderHTML]);
        }
        if ($request->type == 'UpdateWitness') {
            $Finance = Finance::where('id', $request->data['FinId'])->first();


            if ($Finance->copy_documents1 !=  $request->data['copy_documents1']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->copy_documents1;
                $Finance->copy_documents1 =  $request->data['copy_documents1'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->copy_documents1;

                $Finance->update();
            }
            $Finance->bil_no =  $request->data['bil_no'];
            $Finance->levels = 'ขั้นสืบพยาน';
            $Finance->note = $request->data['note'];
            if ($request->data['Finfuture'] == 'Y') {
                $Finance->id_finFuture = $request->data['fin_id'];
            } else {
                $Finance->id_finFuture = NULL;
            }
            $Finance->update();
            DB::commit();
            for ($i = 1; $i <= $request->data['count']; $i++) {

                // $Finance = Finance::where('id', $request->data['id' . $i])->first();
                DB::beginTransaction();

                if (isset($request->data['id' . $i]) != NULL) {
                    try {
                        $FinanceOther = FinanceOther::where('id', $request->data['id' . $i])->first();
                        if ($request->data['name' . $i] != '' || $request->data['val' . $i] != '') {
                            $Finance->totalsum = $Finance->totalsum - $FinanceOther->value;
                            $FinanceOther->name = $request->data['name' . $i];
                            $FinanceOther->value =  str_replace(",", "", @$request->data['val' . $i]);
                            $FinanceOther->status = 'ขั้นสืบพยาน';
                            $FinanceOther->cus_id = $request->data['cus_id'];
                            $FinanceOther->FinId = $request->data['FinId'];
                            $FinanceOther->update();
                            $Finance->update();
                            $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];
                            $Finance->update();
                            DB::commit();
                        }
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                    continue;
                }
                if (isset($request->data['name' . $i]) != '' || isset($request->data['val' . $i]) != '') {
                    try {
                        $FinanceOther = new FinanceOther;
                        $FinanceOther->name = $request->data['name' . $i];
                        $FinanceOther->value =  str_replace(",", "", @$request->data['val' . $i]);
                        $FinanceOther->status = 'ขั้นสืบพยาน';
                        $FinanceOther->cus_id = $request->data['cus_id'];
                        $FinanceOther->FinId = $request->data['FinId'];
                        $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];
                        $FinanceOther->save();
                        $Finance->update();

                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                }


                // $Finance->court_fee = (float)($request->data['court_fee']);
                // $Finance->send_defendant = (float)($request->data['send_defendant']);
                // $Finance->other = implode(' ,', $request->data['array']);
                // $Finance->update();
            }

            $data = Tribunal_debt::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
            $dataStatus = Tribunal_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
            $file_path = UploadFile::where('cus_id', $request->data['cus_id'])->get();
            $dataGuarantor = Guarantor::where('cus_id', $request->data['cus_id'])->get();
            $customer = Customer::where('id', $request->data['cus_id'])->get();
            $FinanceOther = FinanceOther::where('cus_id', $request->data['cus_id'])->get();
            $dataFinance = Finance::where('cus_id', $request->data['cus_id'])->get();

            $message = 'อัพเดตเรียบร้อย';
            $renderHTML =  view('DataLawsuit.section-court.tab-view-pursue', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
            return response()->json(['html' => $renderHTML]);
        }
        if ($request->type == 'UpdateCommand') {
            $Finance = Finance::where('id', $request->data['FinId'])->first();



            if ($Finance->mandatory_fee !=  $request->data['mandatory_fee']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->mandatory_fee;
                $Finance->mandatory_fee =  $request->data['mandatory_fee'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->mandatory_fee;

                $Finance->update();
            }

            $Finance->bil_no =  $request->data['bil_no'];
            $Finance->levels = 'ขั้นส่งคำบังคับ';
            $Finance->note = $request->data['note'];
            if ($request->data['Finfuture'] == 'Y') {
                $Finance->id_finFuture = $request->data['fin_id'];
            } else {
                $Finance->id_finFuture = NULL;
            }
            $Finance->update();
            DB::commit();
            for ($i = 1; $i <= $request->data['count']; $i++) {
                // $Finance = Finance::where('id', $request->data['id' . $i])->first();
                DB::beginTransaction();

                if (isset($request->data['id' . $i]) != NULL) {
                    try {
                        $FinanceOther = FinanceOther::where('id', $request->data['id' . $i])->first();
                        if ($request->data['name' . $i] != '' || $request->data['val' . $i] != '') {
                            $Finance->totalsum = $Finance->totalsum - $FinanceOther->value;
                            $FinanceOther->name = $request->data['name' . $i];
                            $FinanceOther->value =  str_replace(",", "", @$request->data['val' . $i]);
                            $FinanceOther->status = 'ขั้นส่งคำบังคับ';
                            $FinanceOther->cus_id = $request->data['cus_id'];
                            $FinanceOther->FinId = $request->data['FinId'];
                            $FinanceOther->update();
                            $Finance->update();
                            $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];
                            $Finance->update();
                            DB::commit();
                        }
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                    continue;
                }
                if (isset($request->data['name' . $i]) != '' || isset($request->data['val' . $i]) != '') {
                    try {
                        $FinanceOther = new FinanceOther;
                        $FinanceOther->name = $request->data['name' . $i];
                        $FinanceOther->value =  str_replace(",", "", @$request->data['val' . $i]);
                        $FinanceOther->status = 'ขั้นส่งคำบังคับ';
                        $FinanceOther->cus_id = $request->data['cus_id'];
                        $FinanceOther->FinId = $request->data['FinId'];
                        $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];
                        $FinanceOther->save();
                        $Finance->update();

                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                }


                // $Finance->court_fee = (float)($request->data['court_fee']);
                // $Finance->send_defendant = (float)($request->data['send_defendant']);
                // $Finance->other = implode(' ,', $request->data['array']);
                // $Finance->update();
            }

            $data = Tribunal_debt::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
            $dataStatus = Tribunal_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
            $file_path = UploadFile::where('cus_id', $request->data['cus_id'])->get();
            $dataGuarantor = Guarantor::where('cus_id', $request->data['cus_id'])->get();
            $customer = Customer::where('id', $request->data['cus_id'])->first();
            $FinanceOther = FinanceOther::where('cus_id', $request->data['cus_id'])->get();
            $dataFinance = Finance::where('cus_id', $request->data['cus_id'])->get();

            $message = 'อัพเดตเรียบร้อย';
            $renderHTML =  view('DataLawsuit.section-court.tab-view-sendCommand', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
            return response()->json(['html' => $renderHTML]);
        }
        if ($request->type == 'UpdateProperty') {
            $Finance = Finance::where('id', $request->data['FinId'])->first();


            $Finance->bil_no =  $request->data['bil_no'];

            if ($Finance->check_ownership !=  $request->data['check_ownership']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->check_ownership;
                $Finance->check_ownership =  $request->data['check_ownership'];
                $Finance->totalsum = $Finance->totalsum + $Finance->check_ownership;
                $Finance->update();
            }
            if ($Finance->copy_documents2 !=  $request->data['copy_documents2']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->copy_documents2;
                $Finance->copy_documents2 =  $request->data['copy_documents2'];


                $Finance->totalsum = $Finance->totalsum + $Finance->copy_documents2;

                $Finance->update();
            }
            if ($Finance->point_property !=  $request->data['point_property']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->point_property;
                $Finance->point_property =  $request->data['point_property'];


                $Finance->totalsum = $Finance->totalsum + $Finance->point_property;

                $Finance->update();
            }
            $Finance->note = $request->data['note'];
            if ($request->data['Finfuture'] == 'Y') {
                $Finance->id_finFuture = $request->data['fin_id'];
            } else {
                $Finance->id_finFuture = NULL;
            }
            $Finance->update();
            DB::commit();

            for ($i = 1; $i <= $request->data['count']; $i++) {
                // $Finance = Finance::where('id', $request->data['id' . $i])->first();
                DB::beginTransaction();

                if (isset($request->data['id' . $i]) != NULL) {
                    try {
                        $FinanceOther = FinanceOther::where('id', $request->data['id' . $i])->first();
                        // dd($FinanceOther);

                        if ($request->data['name' . $i] != '' || $request->data['val' . $i] != '') {
                            $Finance->totalsum = $Finance->totalsum - $FinanceOther->value;
                            $FinanceOther->name = $request->data['name' . $i];
                            $FinanceOther->value =  str_replace(",", "", @$request->data['val' . $i]);
                            $FinanceOther->status = 'ขั้นตั้งเจ้าพนักงาน';
                            $FinanceOther->cus_id = $request->data['cus_id'];
                            $FinanceOther->FinId = $request->data['FinId'];
                            $FinanceOther->update();
                            $Finance->update();
                            $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];
                            $Finance->update();
                            DB::commit();
                        }
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                    continue;
                }
                if (isset($request->data['name' . $i]) != '' || isset($request->data['val' . $i]) != '') {
                    try {
                        $FinanceOther = new FinanceOther;
                        $FinanceOther->name = $request->data['name' . $i];
                        $FinanceOther->value =  str_replace(",", "", @$request->data['val' . $i]);
                        $FinanceOther->status = 'ขั้นตั้งเจ้าพนักงาน';
                        $FinanceOther->cus_id = $request->data['cus_id'];
                        $FinanceOther->FinId = $request->data['FinId'];
                        $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];
                        $FinanceOther->save();
                        $Finance->update();

                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                }



                // $Finance->court_fee = (float)($request->data['court_fee']);
                // $Finance->send_defendant = (float)($request->data['send_defendant']);
                // $Finance->other = implode(' ,', $request->data['array']);
                // $Finance->update();
            }

            $data = Tribunal_debt::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
            $dataStatus = Tribunal_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
            $file_path = UploadFile::where('cus_id', $request->data['cus_id'])->get();
            $dataGuarantor = Guarantor::where('cus_id', $request->data['cus_id'])->get();
            $customer = Customer::where('id', $request->data['cus_id'])->get();
            $FinanceOther = FinanceOther::where('cus_id', $request->data['cus_id'])->get();
            $dataFinance = Finance::where('cus_id', $request->data['cus_id'])->get();

            $message = 'อัพเดตเรียบร้อย';
            $renderHTML =  view('DataLawsuit.section-court.tab-view-setStaff', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance'))->render();
            return response()->json(['html' => $renderHTML]);
        }

        if ($request->type == 'UpdateFin') {


            DB::beginTransaction();
            try {
                $LawFinFuture = LawFinFuture::where('id', $request->data['fin_id'])->first();
                $Finance = Finance::where('id', $id)->first();
                $Finance->status = $request->data['status'];
                if ($request->data['status'] == 'อนุมัติ') {
                    $Finance->Date_approved = date("Y-m-d");

                    $LawFinFuture->amount -= $Finance->totalsum;
                } elseif ($request->data['status'] == 'รออนุมัติ') {
                    $Finance->Date_request = date("Y-m-d");
                } elseif ($request->data['status'] == 'ขอยกเลิก') {

                    $Finance->Date_cancel_request = date("Y-m-d");
                } elseif ($request->data['status'] == 'ยกเลิก') {
                    $LawFinFuture->amount += $Finance->totalsum;
                    $Finance->Date_cancel = date("Y-m-d");
                }


                $Finance->update();
                $LawFinFuture->update();

                DB::commit();

                $type = $request->type;
                $data = Customer::get();
                $dataStatus = Tribunal_status::get();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();
                $finance = Finance::where('cus_id',  $request->data['cus_id'])->get();
                $financeSum = Finance::where('cus_id', $id)->first();
                $renderHTML = view('DataCustomer.section-contract.tab-finance-Con', compact('data', 'dataStatus', 'type', 'dataGuarantor', 'customer', 'finance'))->render();
                $message = 'บันทึกเรียบร้อย';

                return response()->json(["html" => $renderHTML]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }

            // return  redirect()->route('Cus.show', [$request->id, 'type' => 'showDetail']);
        }
        if ($request->type == 'EditFin') {
            $Finance = Finance::where('id', $id)->first();
            $Finance->bil_no = @$request->data['bil_no'];

            if ($Finance->court_fee !=  @$request->data['court_fee']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->court_fee;
                $Finance->court_fee =  @$request->data['court_fee'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->court_fee;

                $Finance->update();
            }
            if ($Finance->send_defendant !=  @$request->data['send_defendant']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->send_defendant;
                $Finance->send_defendant =  @$request->data['send_defendant'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->send_defendant;

                $Finance->update();
            }
            if ($Finance->mandatory_fee !=  @$request->data['mandatory_fee']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->mandatory_fee;
                $Finance->mandatory_fee =  @$request->data['mandatory_fee'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->mandatory_fee;

                $Finance->update();
            }
            if ($Finance->copy_documents1 !=  @$request->data['copy_documents1']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->copy_documents1;
                $Finance->copy_documents1 =  @$request->data['copy_documents1'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->copy_documents1;

                $Finance->update();
            }
            if ($Finance->check_ownership !=  @$request->data['check_ownership']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->check_ownership;
                $Finance->check_ownership =  @$request->data['check_ownership'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->check_ownership;

                $Finance->update();
            }
            if ($Finance->copy_documents2 !=  @$request->data['copy_documents2']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->copy_documents2;
                $Finance->copy_documents2 =  @$request->data['copy_documents2'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->copy_documents2;

                $Finance->update();
            }
            if ($Finance->point_property !=  @$request->data['point_property']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->point_property;
                $Finance->point_property =  @$request->data['point_property'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->point_property;

                $Finance->update();
            }
            if ($Finance->investigation_fee !=  @$request->data['investigation_fee']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->investigation_fee;
                $Finance->investigation_fee =  @$request->data['investigation_fee'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->investigation_fee;

                $Finance->update();
            }
            if ($Finance->property_iden !=  @$request->data['property_iden']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->property_iden;
                $Finance->property_iden =  @$request->data['property_iden'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->property_iden;

                $Finance->update();
            }
            if ($Finance->copy_documents3 !=  @$request->data['copy_documents3']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->copy_documents3;
                $Finance->copy_documents3 =  @$request->data['copy_documents3'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->copy_documents3;

                $Finance->update();
            }
            if ($Finance->setup_con !=  @$request->data['setup_con']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->setup_con;
                $Finance->setup_con =  @$request->data['setup_con'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->setup_con;

                $Finance->update();
            }
            if ($Finance->auction_announce !=  @$request->data['auction_announce']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->auction_announce;
                $Finance->auction_announce =  @$request->data['auction_announce'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->auction_announce;

                $Finance->update();
            }
            if ($Finance->withdraw_execution !=  @$request->data['withdraw_execution']) {
                $Finance->totalsum = $Finance->totalsum - $Finance->withdraw_execution;
                $Finance->withdraw_execution =  @$request->data['withdraw_execution'];
                $Finance->update();

                $Finance->totalsum = $Finance->totalsum + $Finance->withdraw_execution;

                $Finance->update();
            }
            DB::commit();
            for ($i = 1; $i <= $request->data['count']; $i++) {
                // $Finance = Finance::where('id', $request->data['id' . $i])->first();
                DB::beginTransaction();

                if (isset($request->data['id' . $i]) != NULL) {
                    try {
                        $FinanceOther = FinanceOther::where('id', $request->data['id' . $i])->first();
                        if ($request->data['name' . $i] != '' || $request->data['val' . $i] != '') {
                            $Finance->totalsum = $Finance->totalsum - $FinanceOther->value;
                            $FinanceOther->name = $request->data['name' . $i];
                            $FinanceOther->value =  str_replace(",", "", @$request->data['val' . $i]);
                            $FinanceOther->cus_id = $request->data['cus_id'];
                            if ($FinanceOther->statusFin == 'approved') {
                                $FinanceOther->statusFin = NULL;
                            }
                            $FinanceOther->update();
                            $Finance->update();
                            $Finance->totalsum = $Finance->totalsum + (float)@$request->data['val' . $i];
                            $Finance->update();
                            DB::commit();
                        }
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                    continue;
                }



                // $Finance->court_fee = (float)($request->data['court_fee']);
                // $Finance->send_defendant = (float)($request->data['send_defendant']);
                // $Finance->other = implode(' ,', $request->data['array']);
                // $Finance->update();
            }
            $type = $request->type;
            $data = Customer::get();
            $dataStatus = Tribunal_status::get();
            $dataGuarantor = Guarantor::where('cus_id', $id)->get();
            $customer = Customer::where('id', $id)->get();
            $finance = Finance::where('cus_id',  $request->data['cus_id'])->get();
            $financeSum = Finance::where('cus_id', $id)->first();
            $renderHTML = view('DataCustomer.section-contract.tab-finance-Con', compact('data', 'dataStatus', 'type', 'dataGuarantor', 'customer', 'finance'))->render();
            $message = 'บันทึกเรียบร้อย';

            return response()->json(["html" => $renderHTML]);
        }


        if ($request->type == 'updateFutureStatus') {

           
            DB::beginTransaction();
            try {
                $LawFinFuture = LawFinFuture::where('id', $id)->first();
               
                $LawFinFuture->status = $request->data['status'];

                $LawFinFuture->update();
                

                DB::commit();
                $message = 'อัพเดตเรียบร้อย';

                return response()->json(['message']);

                
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }

            // return  redirect()->route('Cus.show', [$request->id, 'type' => 'showDetail']);
        }

        // if ($request->data['type'] == 'RequestFinFuture') {
        //     DB::beginTransaction();
        //     try {
        //         $LawFuture = new LawFinFuture();
               

        //         $LawFuture->userInsert = Auth::user()->id;
        //         $LawFuture->amount =  $request->data['amount'];
        //         $LawFuture->detail =  $request->data['detail'];


        //         $LawFuture->save();
        //         DB::commit();


        //         $message = 'อัพเดตเรียบร้อย';

        //         return response()->json(['message']);
        //     } catch (\Exception $e) {

        //         DB::rollback();
        //         return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
        //     }
        // }

    }


    public function destroy($id)
    {
        //
    }
}
