<?php

namespace App\Http\Controllers;

use App\Models\ComFinance;
use App\Models\ComInstall;
use App\Models\Compromise;
use App\Models\Customer;
use App\Models\TrackingDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Tribunal_debt;
use App\Models\Tribunal_status;
use App\Models\Guarantor;
use App\Models\Finance;
use App\Models\FinanceOther;
use App\Models\TeamFollow;
use App\Models\Tracking;
use App\Models\TrackingMinimum;
use App\Models\UploadFile;
use App\Models\ViewLawCom;
use DB;
use Illuminate\Support\Facades\Auth;



class DataCompromise extends Controller
{

    // public function index(Request $request)
    // {
    //     $type = $request->type;
    //     if ($request->type == 'NewCompro') {

    //         $data = Tribunal_debt::where('status_com', 'Y')->get();

    //         return view('DataCompromise.section-NewCompromise.view-all', compact('data', 'type'));
    //     } elseif ($request->type == 'OldCompro') {
    //         return view('DataCompromise.section-OldCompromise.view');
    //     }
    // }

    public function index(Request $request)
    {
        $type_time = 'date_com';
        if ($request->dateStart == NULL && $request->dateEnd == NULL) {
            $dateStart = date('Y-m-d');
            $dateEnd = date('Y-m-d');
        } else {
            $dateStart = $request->dateStart;
            $dateEnd = $request->dateEnd;
        }

        $data = ViewLawCom::where('status_com', 'Y')
            ->when($type_time == 'date_com', function ($query) use ($dateStart, $dateEnd) {
                return $query->whereBetween('date_com', [$dateStart, $dateEnd]);
            })
            ->where('status_close', 'N')
            ->where('status', '!=', 'close')
            ->orWhere('status', NULL)
            ->get();


        $dataInstall = ComInstall::get();

        $todayFormat = Carbon::now()->addMonth()->format('Y-m');
        $today = Carbon::parse($todayFormat);



        return view('DataCompromise.section-NewCompromise.view-com', compact('data', 'dataInstall', 'today', 'dateStart', 'dateEnd'));
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
    }


    public function store(Request $request)
    {
        if ($request->type == 'InsertCom') {
            DB::beginTransaction();
            try {

                $lastCom = Compromise::where('cus_id', $request->data['cus_id'])->orderBy('id', 'desc')->first();
                $teamFollow = TeamFollow::where('com_id', $lastCom->id)->first();
                if ($teamFollow != NULL) {
                    $teamFollow->status = 'close';
                    $teamFollow->update();
                }
                $Compromise = new Compromise;
                $Compromise->type_com = $request->data['type_com'];
                $Compromise->date_com = $request->data['date_com'];
                $Compromise->pay_com = str_replace(",", "", $request->data['pay_com']);
                $Compromise->pay_first =  str_replace(",", "", $request->data['pay_first']);
                $Compromise->installments = $request->data['installments'];
                $Compromise->period = str_replace(",", "", $request->data['period']);
                $Compromise->note = @$request->data['note'];
                $Compromise->cus_id = $request->data['cus_id'];
                $Compromise->interest = $request->data['interest'];
                $Compromise->totalInterest = $request->data['totalInterest'];
                $Compromise->not_interest = @$request->data['not_interest'];
                $Compromise->not_interest_note = @$request->data['not_interest_note'];
                if (isset($request->data['blackout_date'])) {
                    $Compromise->blackout_date = @$request->data['blackout_date'];
                }
                $Compromise->date_com_start = @$request->data['date_com_start'];
                if ($request->data['status_exe'] == 'Y') {
                    $Compromise->levels = 'ชั้นบังคับคดี';
                } else {
                    $Compromise->levels = 'ชั้นศาล';
                }

                $Compromise->totalInterest = $request->data['totalInterest'];
                $Compromise->status = 'ประนอมใหม่';

                $Compromise->totalSum = (float)($Compromise->pay_com) - (float)($Compromise->pay_first);
                $Compromise->save();

                $customer = Customer::where('id', $request->data['cus_id'])->first();
                $customer->status_com = 'Y';
                $customer->update();

                $ComFin = ComFinance::where('cus_id', $request->data['cus_id'])
                    ->whereNot('status', 'cancel')
                    ->update(['status' => 'ประนอมหนี้เดิม']);


                $date_com = Carbon::parse($request->data['date_com'])->format('Y-m');

                for ($i = 0; $i <= ($Compromise->installments - 1); $i++) {
                    $ComInstall = new ComInstall;
                    $ComInstall->pay_amount =  $Compromise->period;
                    $ComInstall->com_id = $Compromise->id;
                    $ComInstall->no_pay = $i + 1;
                    if ($i > 0) {
                        $ComInstall->due_date = Carbon::parse($date_com)->addMonths($i)->endOfMonth()->toDateString();
                    } else {
                        $ComInstall->due_date = $Compromise->date_com;
                    }
                    $ComInstall->totalSum = $ComInstall->pay_amount;
                    $ComInstall->save();
                }

                $type = '';
                $this->calInterest($request->data['cus_id'], $type, $Compromise->id);
                $totalValue = $this->calInterest($request->data['cus_id'], $type, $Compromise->id);

                $type = $request->type;
                $data = Tribunal_debt::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $dataStatus = Tribunal_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $dataGuarantor = Guarantor::where('cus_id', $request->data['cus_id'])->get();
                $customer = Customer::where('id', $request->data['cus_id'])->get();

                $finance = Finance::where('cus_id', $request->data['cus_id'])->get();
                $financeOther = FinanceOther::where('cus_id', $request->data['cus_id'])->get();
                $financeSum = Finance::where('cus_id', $request->data['cus_id'])->first();

                DB::commit();
                $message = 'บันทึกเรียบร้อย';

                // $renderHTML = view('DataCompromise.Finance-com.com-table', compact('ComFin', 'Compro', 'ComFinTotal', 'ComInstall'))->render();
                // $renderHTML2 = view('DataCompromise.Finance-com.install-table', compact('ComFin', 'Compro', 'ComFinTotal', 'ComInstall'))->render();
                // return response()->json(['com' => $renderHTML, 'install' => $renderHTML2]);

                $renderHTML = view('DataCustomer.section-contract.view', compact('data', 'dataStatus', 'type', 'dataGuarantor', 'customer', 'finance', 'financeOther', 'totalValue'))->render();
                return response()->json(['message' => $message, 'success' => '1', 'code' => 200, $renderHTML]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->type == 'InsertComFin') {

            $lastDayofMonth = Carbon::parse($request->data['pay_date'])->addMonth()->endOfMonth()->toDateString();
            DB::beginTransaction();
            try {
                $ComFinance = new ComFinance;
                $ComFinance->pay_date = $request->data['pay_date'];
                $ComFinance->type = $request->data['type'];
                $ComFinance->pay_amount = $request->data['pay_amount'];
                $ComFinance->note = $request->data['note'];

                $ComFinance->due_date = $lastDayofMonth;
                $ComFinance->Payee = $request->data['Payee'];
                $ComFinance->cus_id = $request->data['cus_id'];

                $Compro = Compromise::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();

                if ($Compro->status == 'close' || $Compro->status == 'ประนอมใหม่') {
                    if ($Compro->levels == 'ชั้นศาล') {
                        $ComFinance->status = 'ออกหมายตั้งแล้ว';
                    } else {
                        $ComFinance->status = 'งดการขาย';

                        $ComFinance2 = ComFinance::where('cus_id', $request->data['cus_id'])
                            ->where('status', 'งดการขาย')
                            ->orderBy('pay_date', 'ASC')
                            ->first();

                        if ($ComFinance2 != NULL) {
                            $firstDate = Carbon::parse(@$ComFinance2->pay_date);
                            $recentDate = Carbon::parse($request->data['pay_date']);
                            if ($recentDate < $firstDate) {
                                $Compro->stop_date = $request->data['pay_date'];
                            }
                        } else {
                            $Compro->stop_date = $request->data['pay_date'];
                        }
                    }
                } else {
                    $ComFinance->status = 'ชำระเรียบร้อย';
                }

                $ComFinance->save();
                $ComFinTotal = ComFinance::where('cus_id',  $request->data['cus_id'])
                    // ->whereNot('status', 'cancel')
                    ->orderBy('pay_date', 'DESC')
                    ->get();

                $ComFin = ComFinance::where('cus_id',  $request->data['cus_id'])
                    ->Where('status', '!=', 'ประนอมหนี้เดิม')
                    // ->Where('status', '!=', 'cancel')
                    ->orderBy('pay_date', 'DESC')
                    ->get();


                $ComInstall = ComInstall::where('com_id', $request->data['com_id'])
                    ->whereNot('totalSum', '0')
                    ->get();

                $totalPay = $ComFinance->pay_amount;
                $diffPay = $ComFinance->pay_amount;
                $flagDiffpay =  $ComFinance->pay_amount;

                foreach ($ComInstall as $item) {

                    $interest = $item->interest;

                    $interest -= $flagDiffpay;


                    if ($diffPay >= $item->interest) {
                        ComInstall::find($item->id)->update([
                            'interest' => 0
                        ]);
                        $diffPay -= $item->totalSum;
                    } else {
                        ComInstall::find($item->id)->update([
                            'interest' => $item->interest - $diffPay
                        ]);
                    }

                    $totalPay -= $item->totalSum;

                    if ($totalPay >= 0) {
                        $test = 0;
                    } else {
                        $test = floatval($item->totalSum) - (floatval($item->totalSum) + floatval($totalPay));
                    }
                    ComInstall::find($item->id)->update([
                        'totalSum' => $test
                    ]);
                    // dump($test);
                    if ($totalPay > 0) {
                        continue;
                    } else {
                        break;
                    }
                }
                $Compro->update();
                if (count($ComFinTotal) == 0) {
                    $type = 'Firstinsert';
                } else {
                    $type = '';
                }

                $ComInstall = ComInstall::where('com_id', $request->data['com_id'])->get();
                $todayFormat = Carbon::now()->addMonth()->format('Y-m');
                $today = Carbon::parse($todayFormat);

                $Tracking = Tracking::where('com_id', $request->data['com_id'])
                    ->where('startDate', '<=', date('Y-m-d'))
                    ->where('endDate', '>=', date('Y-m-d'))
                    ->orderBy('date_tag', 'DESC')->first();


                $due_date = Carbon::parse(@$ComInstall->where('totalSum', '!=', '0')->where('due_date', '<', date('Y-m-d'))->first()->due_date);
                $diffDay = $due_date->DiffInMonths($today);
                $Minimum = TrackingMinimum::where('num', $diffDay)->first();

                if ($diffDay >= 2 || $Tracking != NULL) {
                    if ($Tracking == NULL) {
                        if ($request->data['pay_amount'] >= $Compro->period * $Minimum->minimum) {
                            $TrackAdd = new Tracking;
                            $TrackAdd->userinsert =  Auth::user()->id;
                            $TrackAdd->date_tag =   Carbon::now();
                            $TrackAdd->com_id =  @$request->data['com_id'];
                            $TrackAdd->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
                            $TrackAdd->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
                            $TrackAdd->status = 'ผ่าน';
                            $TrackAdd->totalPay += $request->data['pay_amount'];
                            $TrackAdd->save();
                        } else {
                            $TrackAdd = new Tracking;
                            $TrackAdd->userinsert =  Auth::user()->id;
                            $TrackAdd->date_tag =   Carbon::now();
                            $TrackAdd->com_id =  @$request->data['com_id'];
                            $TrackAdd->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
                            $TrackAdd->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
                            $TrackAdd->totalPay += $request->data['pay_amount'];
                            $TrackAdd->status = 'ไม่ผ่าน';
                            $TrackAdd->save();
                        }
                    } else {
                        $totalTrackPay = $Tracking->totalPay + $request->data['pay_amount'];
                        if ($totalTrackPay >= $Compro->period * $Minimum->minimum) {
                            $TrackDetail = new TrackingDetail;
                            $TrackDetail->userinsert =  Auth::user()->id;
                            $TrackDetail->date_tag =   Carbon::now()->format('Y-m-d');
                            $TrackDetail->com_id =  @$request->data['com_id'];
                            $TrackDetail->status = 'ผ่าน';
                            $TrackDetail->save();
                            $Tracking->status = 'ผ่าน';
                            $Tracking->totalPay = $totalTrackPay;
                            $Tracking->update();
                        } else {
                            $TrackDetail = new TrackingDetail;
                            $TrackDetail->userinsert =  Auth::user()->id;
                            $TrackDetail->date_tag =   Carbon::now()->format('Y-m-d');
                            $TrackDetail->com_id =  @$request->data['com_id'];
                            $TrackDetail->status = 'ไม่ผ่าน';
                            $TrackDetail->save();
                            $Tracking->status = 'ไม่ผ่าน';
                            $Tracking->totalPay = $totalTrackPay;
                            $Tracking->update();
                        }
                    }
                } else {
                }

                $Tracking = Tracking::where('com_id', @$request->data['com_id'])->orderBy('date_tag', 'DESC')->get();

                $status_tag = '';
                $today =  Carbon::now()->addMonth()->format('Y-m');
                foreach ($Tracking as $item) {
                    $date_tag = Carbon::parse($item->date_tag)->format('Y-m');
                    $today =  Carbon::now()->format('Y-m');
                    if ($date_tag == $today) {
                        $status_tag = 'เดือนนี้สร้างไปแล้ว';
                        break;
                    }
                }




                // $this->calInterest($request->data['cus_id'], $type, $Compro->id);
                // $totalValue = $this->calInterest($request->data['cus_id'], $type, $Compro->id);

                DB::commit();

                $message = 'อัพเดตเรียบร้อย';
                $renderHTML = view('DataCompromise.Finance-com.com-table', compact('ComFin', 'Compro', 'ComFinTotal', 'ComInstall'))->render();
                $renderHTML2 = view('DataCompromise.Finance-com.install-table', compact('ComFin', 'Compro', 'ComFinTotal', 'ComInstall'))->render();
                $renderHTML3 =  view('DataCompromise.section-NewCompromise.tab-view-tracking', compact('Tracking', 'Compro', 'status_tag', 'ComInstall', 'today'))->render();
                return response()->json(['com' => $renderHTML, 'install' => $renderHTML2, 'track' => $renderHTML3]);
                // return  redirect()->route('Law.show', [$request->data['cus_id'], 'type' => 'showCus']);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->type == 'InsertComFinForward') {

            $lastDayofMonth = Carbon::parse($request->data['pay_date'])->addMonth()->endOfMonth()->toDateString();

            DB::beginTransaction();
            try {
                $ComFinance = new ComFinance;
                $ComFinance->pay_date = $request->data['pay_date'];
                $ComFinance->type = $request->data['type'];
                $ComFinance->pay_amount = $request->data['pay_amount'];
                $ComFinance->note = $request->data['note'];

                $ComFinance->due_date = $lastDayofMonth;
                $ComFinance->Payee = $request->data['Payee'];
                $ComFinance->cus_id = $request->data['cus_id'];
                $ComFinance->status = 'ชำระล่วงหน้า';

                $Compro = Compromise::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();


                $ComFinance->save();


                $ComFinTotal = ComFinance::where('cus_id',  $request->data['cus_id'])
                    // ->whereNot('status', 'cancel')
                    ->orderBy('pay_date', 'DESC')
                    ->get();



                $ComFin = ComFinance::where('cus_id',  $request->data['cus_id'])
                    ->Where('status', '!=', 'ประนอมหนี้เดิม')
                    // ->Where('status', '!=', 'cancel')
                    ->orderBy('pay_date', 'DESC')
                    ->get();

                // if ($request->data['interest'] == 0) {
                //     $Compro->totalSum = $request->data['totalSum'] - $request->data['pay_amount'] - $request->data['old_interest'];
                // } else {
                //     $Compro->totalInterest = $Compro->totalInterest +  $request->data['interest'];

                //     $Compro->totalSum = $request->data['totalSum'] - $request->data['pay_amount'] + $request->data['interest'] - $request->data['old_interest'];
                // }

                $ComInstall = ComInstall::where('com_id', $request->data['com_id'])
                    ->whereNot('totalSum', '0')
                    ->orderBy('no_pay', 'DESC')
                    ->get();

                // dd($ComInstall);
                // dump( $ComInstall->sum('pay_amount') );
                // $Compro->totalSum -= $ComFinance->pay_amount;

                $totalPay = $ComFinance->pay_amount;
                $diffPay = $ComFinance->pay_amount;
                $flagDiffpay =  $ComFinance->pay_amount;
                foreach ($ComInstall as $item) {
                    // $difpay = $ComFinance->pay_amount - $item->totalSum;
                    $interest = $item->interest;
                    $diffPay -= $item->interest;
                    $item->interest -= $flagDiffpay;

                    if (@$interest == 0 || $item->interest <= 0) {
                        ComInstall::find($item->id)->update([
                            'interest' => 0
                        ]);

                        if ($diffPay >= $item->pay_amount) {
                            $diffPay -= $item->pay_amount;
                            ComInstall::find($item->id)->update([
                                'pay_balance' =>  0
                            ]);

                            // $Compro->totalSum -= $item->pay_amount;
                        } else {
                            $item->pay_amount -= $diffPay;

                            ComInstall::find($item->id)->update([
                                'pay_balance' =>  $item->pay_amount
                            ]);
                            // dd($Compro->totalSum);
                        }
                    }

                    // dump($Compro->totalSum);

                    $totalPay -= $item->totalSum;

                    if ($totalPay >= 0) {
                        $test = 0;
                        // $status = 'close'
                    } else {
                        $test = floatval($item->totalSum) - (floatval($item->totalSum) + floatval($totalPay));
                    }

                    ComInstall::find($item->id)->update([
                        'totalSum' => $test,
                        'status' => "ชำระล่วงหน้า",
                    ]);


                    // dump($test);
                    if ($totalPay > 0) {
                        continue;
                    } else {

                        break;
                    }
                }
                $Compro->update();
                if (count($ComFinTotal) == 0) {
                    $type = 'Firstinsert';
                } else {
                    $type = '';
                }

                $ComInstall = ComInstall::where('com_id', $request->data['com_id'])->get();
                // $this->calInterest($request->data['cus_id'], $type, $Compro->id);
                // $totalValue = $this->calInterest($request->data['cus_id'], $type, $Compro->id);

                DB::commit();

                $message = 'อัพเดตเรียบร้อย';
                $renderHTML = view('DataCompromise.Finance-com.com-table', compact('ComFin', 'Compro', 'ComFinTotal', 'ComInstall'))->render();
                $renderHTML2 = view('DataCompromise.Finance-com.install-table', compact('ComFin', 'Compro', 'ComFinTotal', 'ComInstall'))->render();
                return response()->json(['com' => $renderHTML, 'install' => $renderHTML2]);
                // return  redirect()->route('Law.show', [$request->data['cus_id'], 'type' => 'showCus']);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
    }

    public function show(Request $request, $id)
    {
        //


        if ($request->type == 'sendToAppointment') {

            $data = Customer::where('id', $id)->first();
            $dataGuarantor = Guarantor::where('cus_id', $id)->get();
            $Compro = Compromise::where('cus_id', $id)->orderBy('id', 'DESC')->first();


            $FinanceOther = FinanceOther::where('cus_id', $id)->get();
            $dataFinance = Finance::where('cus_id', $id)->get();
            return view('DataCustomer.section-cus.send-Appointment', compact('data', 'dataGuarantor', 'FinanceOther', 'dataFinance', 'Compro'));
        }
        if ($request->type == 'NewCompro') {

            $data = Customer::where('id', $id)->first();
            $Tribunal = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            DB::beginTransaction();
            try {
                $Compro = Compromise::where('cus_id', $id)->first();

                // dd( $Compro);
                if ($Compro == NULL) {
                    $Compro = new Compromise;
                    $Compro->pay_com = (int)$Tribunal->debt_balance;
                    if ($data->status_exe == 'Y' && $data->status_tribunal == 'Y') {
                        $Compro->levels = 'ชั้นบังคับคดี';
                    }

                    if ($data->status_exe == 'N' && $data->status_tribunal == 'Y') {
                        $Compro->levels = 'ชั้นศาล';
                    }


                    $Compro->Cus_id = $id;
                    $Compro->save();
                    $customer = Customer::where('id', $id)->first();
                    $customer->status_com = 'Y';
                    $customer->update();
                }

                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();

                $Compro = Compromise::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                // dd($Compro);
                $ComInstall = ComInstall::where('com_id', $Compro->id)->orderBy('id', 'ASC')->get();

                // dd($ComInstall);

                $ComproExe = Compromise::where('cus_id', $id)->where('levels', 'ชั้นบังคับคดี')->get();
                $CountExe = count($ComproExe);

                // dd($CountExe);
                $ComFinTotal = ComFinance::where('cus_id', $id)

                    ->orderBy('id', 'DESC')
                    ->get();

                $ComFin = ComFinance::where('cus_id',  $id)
                    ->whereNot('status', 'ประนอมหนี้เดิม')

                    ->orderBy('pay_date', 'DESC')
                    ->get();

                $type = '';
                $this->calInterest($id, $type, $Compro->id);
                $totalValue = $this->calInterest($id, $type, $Compro->id);
                $status_tag = '';
                $Tracking = Tracking::where('com_id', $Compro->id)->get();

                foreach ($Tracking as $item) {

                    $date_tag = Carbon::parse($item->date_tag)->format('Y-m');
                    $today =  Carbon::now()->format('Y-m');

                    if ($date_tag == $today) {
                        $status_tag = 'เดือนนี้สร้างไปแล้ว';
                        break;
                    }
                }

                $todayFormat = Carbon::now()->addMonth()->format('Y-m');
                $today = Carbon::parse($todayFormat);


                $Tracking = Tracking::where('com_id', $Compro->id)->get();


                DB::commit();

                $message = 'บันทึกเรียบร้อย';
                // $renderHTML = view('DataCompromise.section-NewCompromise.view', compact('data'))->render();

                return  view('DataCompromise.section-NewCompromise.view', compact('data', 'dataGuarantor', 'customer', 'Compro', 'ComFin', 'totalValue', 'ComFinTotal', 'CountExe', 'Tribunal', 'ComInstall', 'status_tag', 'Tracking', 'today'));

                // return response()->json(['message' => $message, 'success' => '1', 'code' => 200, $renderHTML]);
                // return  redirect()->route('Law.show', [$request->id, 'type' => 'showCus']);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }

        if ($request->type == 'EditCom') {

            $data =  Compromise::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            $type = '';
            $this->calInterest($id, $type, $data->id);
            $totalValue = $this->calInterest($id, $type, $data->id);

            // $Compro = Compromise::where('cus_id', $id)->orderBy('id','DESC')->first();
            return view('DataCompromise.section-NewCompromise.edit-com', compact('data', 'totalValue'));
        }
        if ($request->type == 'InsertCom') {
            $ComFin = ComFinance::where('cus_id', $id)
                ->orderBy('id', 'DESC')
                ->first();
            $type = '';
            $data =  Compromise::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            $Cus = Customer::where('id', $id)->first();

            $this->calInterest($id, $type, $data->id);
            $totalValue = $this->calInterest($id, $type, $data->id);

            // $data = Compromise::where('cus_id', $id)->get();
            $data =  Compromise::where('cus_id', $id)->orderBy('id', 'DESC')->first();


            return view('DataCompromise.section-NewCompromise.com-insert', compact('data', 'ComFin', 'totalValue', 'Cus'));
        }
        if ($request->type == 'InsertComFin') {

            $data =  Compromise::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            $type = '';

            $this->calInterest($id, $type, $data->id);
            $totalValue = $this->calInterest($id, $type, $data->id);

            return view('DataCompromise.Finance-com.insert-finance', compact('data', 'totalValue'));
        }
        if ($request->type == 'InsertComFinForward') {

            $data =  Compromise::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            $type = '';

            $this->calInterest($id, $type, $data->id);
            $totalValue = $this->calInterest($id, $type, $data->id);

            return view('DataCompromise.Finance-com.Forward-finance', compact('data', 'totalValue'));
        }
        if ($request->type == 'showComFinDetail') {

            $data =  ComFinance::where('id', $id)->first();
            $maxId = ComFinance::orderBy('id', 'DESC')->first();
            $maxId = $maxId->id;



            // $Compro =  Compromise::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();


            // $type = '';
            // $this->calInterest($id, $type);
            // $totalValue = $this->calInterest($id, $type);

            return view('DataCompromise.Finance-com.edit-finance', compact('data', 'maxId'));
        }
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
        if ($request->type == 'UpdateToAppointment') {
            DB::beginTransaction();
            try {
                $Tribunal = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $Tribunal->status = 'ขั้นตั้งเจ้าพนักงาน';

                $Status = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $Status->status_3 = 'Y';
                $Status->status_4 = 'Y';

                $Customer = Customer::where('id', $id)->first();

                $Customer->status_com = 'N';
                $Compro = Compromise::where('id', $request->data['com_id'])->first();
                $Compro->status = 'close';

                $Compro->update();

                $Customer->update();

                $Status->update();
                $Tribunal->update();

                DB::commit();
                $data = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $dataStatus = Tribunal_status::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $Tribunal = Tribunal_debt::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                $file_path = UploadFile::where('cus_id', $id)->get();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();
                $FinanceOther = FinanceOther::where('cus_id', $id)->get();
                $dataFinance = Finance::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();


                $message = 'อัพเดตเรียบร้อย';
                $renderHTML =  view('DataLawsuit.section-court.view', compact('data', 'dataStatus', 'file_path', 'dataGuarantor', 'customer', 'FinanceOther', 'dataFinance', 'Tribunal'))->render();

                return response()->json(['id' => $id, 'message' => $message, 'success' => '1', 'code' => 200, $renderHTML]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }

        if ($request->type == 'updateCom') {

            DB::beginTransaction();
            try {
                $Compromise = Compromise::where('id', $id)->first();

                $Compromise->type_com = $request->data['type_com'];

                $Compromise->date_com = $request->data['date_com'];
                if (isset($request->data['blackout_date'])) {
                    $Compromise->blackout_date = @$request->data['blackout_date'];
                }
                $Compromise->date_com_start = @$request->data['date_com_start'];

                $Compromise->stop_date = @$request->data['stop_date'];

                $Compromise->pay_com = str_replace(",", "", $request->data['pay_com']);
                $Compromise->pay_first =  str_replace(",", "", $request->data['pay_first']);
                $Compromise->installments = $request->data['installments'];
                $Compromise->period = str_replace(",", "", $request->data['period']);
                $Compromise->note = $request->data['note'];
                $Compromise->cus_id = $request->data['cus_id'];
                $Compromise->interest = $request->data['interest'];
                $Compromise->not_interest = @$request->data['not_interest'];
                $Compromise->not_interest_note = $request->data['not_interest_note'];
                $Compromise->totalSum = (float)($Compromise->pay_com) - (float)($Compromise->pay_first);

                $Compromise->update();

                $ComFin = ComFinance::where('cus_id', $request->data['cus_id'])
                    ->whereNot('status', 'cancel')
                    ->update(['status' => 'ประนอมหนี้เดิม']);
                $date_com = Carbon::parse($request->data['date_com'])->format('Y-m');
                $dataCominstall = ComInstall::where('com_id', $Compromise->id)->get();
                // dd(count($dataCominstall));


                if (isset($Compromise->installments, $Compromise->period)) {
                    if (count($dataCominstall) == 0)
                        for ($i = 0; $i <= ($request->data['installments'] - 1); $i++) {
                            $ComInstall = new ComInstall;
                            $ComInstall->pay_amount =  $Compromise->period;
                            $ComInstall->com_id = $Compromise->id;
                            $ComInstall->no_pay = $i + 1;

                            if ($i > 0) {
                                $ComInstall->due_date = Carbon::parse($date_com)->addMonths($i)->endOfMonth()->toDateString();
                            } else {
                                $ComInstall->due_date = $Compromise->date_com;
                            }
                            $ComInstall->totalSum = $ComInstall->pay_amount;
                            $ComInstall->save();
                        }
                }

                $type = $request->type;
                $data = Customer::where('id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();

                $dataStatus = Tribunal_status::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $dataGuarantor = Guarantor::where('cus_id', $id)->get();
                $customer = Customer::where('id', $id)->get();

                $finance = Finance::where('cus_id', $id)->get();
                $financeOther = FinanceOther::where('cus_id', $id)->get();
                $financeSum = Finance::where('cus_id', $id)->first();

                $typeInstall = '';
                DB::commit();
                $this->calInterest($request->data['cus_id'], $typeInstall, $Compromise->id);
                $totalValue = $this->calInterest($request->data['cus_id'], $typeInstall, $Compromise->id);




                $message = 'บันทึกเรียบร้อย';
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->type == 'CancelComFin') {



            DB::beginTransaction();
            try {

                $ComFinance = ComFinance::where('id', $id)->first();
                $ComFinance->status = 'cancel';

                // ComInstall::find($id)->update([
                //     'status' => 'cancel'
                // ]);


                $ComFinance->update();
                // dd($ComFinance->status);
                // dd($request->data['com_id']);
                DB::commit();


                $ComFinTotal = ComFinance::where('cus_id',  $request->data['cus_id'])
                    // ->whereNot('status', 'cancel')
                    ->orderBy('pay_date', 'DESC')
                    ->get();




                $ComFin = ComFinance::where('cus_id',  $request->data['cus_id'])
                    ->Where('status', '!=', 'ประนอมหนี้เดิม')
                    // ->Where('status', '!=', 'cancel')
                    ->orderBy('pay_date', 'DESC')
                    ->get();

                $Compro = Compromise::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                // $Compro->totalSum = $Compro->totalSum + $request->data['old_pay_amount'] - $request->data['old_interest'];
                // $Compro->totalInterest = $Compro->totalInterest - $request->data['old_interest'];
                // $Compro->update();
                if ($request->data['status'] == 'ชำระล่วงหน้า') {
                    $ComInstall = ComInstall::where('com_id', $request->data['com_id'])
                        ->whereRaw('totalSum-interestShow-pay_amount <>0')
                        ->where('status', 'ชำระล่วงหน้า')
                        ->orderBy('due_date', 'DESC')
                        ->get();
                } else {
                    $ComInstall = ComInstall::where('com_id', $request->data['com_id'])
                        ->whereRaw('totalSum-interestShow-pay_amount <>0')
                        ->where('status', NULL)
                        ->orderBy('due_date', 'DESC')
                        ->get();
                }





                // dd($ComInstall);
                $diffPay = $request->data['pay_amount'];
                $totalPay = $request->data['pay_amount'];


                foreach ($ComInstall as $item) {
                    $difInterest = $item->interestShow - $item->interest;




                    // if ( $diffPay >= $item->interestShow ) {
                    //     ComInstall::find($item->id)->update([
                    //         'interest' => 0
                    //     ]);
                    //     $diffPay -= $item->totalSum; 
                    // }else{
                    //     ComInstall::find($item->id)->update([
                    //         'interest' => $item->interest + $diffPay
                    //     ]);
                    //     $diffPay -= $difInterest;
                    // }




                    if ($diffPay > $difInterest) {
                        $item->interest += $difInterest;
                        ComInstall::find($item->id)->update([
                            'interest' => $item->interest
                        ]);
                        $diffPay -= $item->totalSum;
                    } else {
                        $item->interest += $diffPay;
                        ComInstall::find($item->id)->update([
                            'interest' => $item->interest
                        ]);
                        // $diffPay -= $item->totalSum; 
                    }

                    $total_balance =  $item->interest + $item->pay_amount;
                    // $diffPay -= $item->pay_amount;
                    // dump('1',$diffPay);

                    //    dump($diffPay + $item->totalSum);
                    if ($totalPay > $total_balance) {
                        // dump($total_balance);
                        ComInstall::find($item->id)->update([
                            'totalSum' =>  $total_balance
                        ]);
                        // dd($ComInstall->totalSum);
                        $totalPay -= $total_balance;
                    } else {
                        // ComInstall::find($item->id)->update([
                        //     'totalSum' => $diffPay + $item->interest
                        // ]);
                        // $diffPay +=  $item->interest;
                        if ($totalPay + $item->totalSum <= $total_balance) {
                            ComInstall::find($item->id)->update([
                                'totalSum' => $totalPay + $item->totalSum
                            ]);
                            $totalPay = 0;
                        } else {
                            ComInstall::find($item->id)->update([
                                'totalSum' => $total_balance
                            ]);
                            dump($totalPay);
                            $totalPay -= $total_balance - $item->totalSum;
                        }
                        //    dump($totalPay);

                        // if($diffPay + $item->totalSum <= $total_balance ){
                        //     ComInstall::find($item->id)->update([
                        //         'totalSum' => $diffPay + $item->totalSum
                        //     ]);
                        //     // dd(ComInstall::find($item->id)->totalSum);

                        //     $diffPay -= $ComInstall;

                        //     // continue;
                        // }else{
                        //     ComInstall::find($item->id)->update([
                        //         'totalSum' => $item->pay_amount + $item->interest
                        //     ]);
                        //     $diffPay -= $item->pay_amount;

                        //     // dd($ComInstall);
                        // }



                        // break;

                    }

                    if ($item->status == 'ชำระล่วงหน้า') {
                        ComInstall::find($item->id)->update([
                            'status' => NULL
                        ]);
                    }

                    // dump($diffPay);
                    // dump(abs(-457));
                    if ($totalPay == 0) {
                        break;
                    }
                }




                $ComInstall = ComInstall::where('com_id', $request->data['com_id'])->get();
                // $type = '';
                // $this->calInterest($request->data['cus_id'], $type, $Compro->id);
                // $totalValue = $this->calInterest($request->data['cus_id'], $type, $Compro->id);


                // $message = 'อัพเดตเรียบร้อย';
                // $renderHTML = view('DataCompromise.Finance-com.com-table', compact('ComFin', 'Compro', 'ComFinTotal', 'ComInstall'))->render();

                $message = 'อัพเดตเรียบร้อย';
                $renderHTML = view('DataCompromise.Finance-com.com-table', compact('ComFin', 'Compro', 'ComFinTotal', 'ComInstall'))->render();
                $renderHTML2 = view('DataCompromise.Finance-com.install-table', compact('ComFin', 'Compro', 'ComFinTotal', 'ComInstall'))->render();
                return response()->json(['com' => $renderHTML, 'install' => $renderHTML2]);
                // return response()->json([$renderHTML]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }

        if ($request->type == 'updateComFin') {

            DB::beginTransaction();
            try {
                $lastDayofMonth = Carbon::parse($request->data['pay_date'])->addMonth()->endOfMonth()->toDateString();


                $Compro = Compromise::where('cus_id', $request->data['cus_id'])->orderBy('id', 'DESC')->first();
                $Compro->totalSum = $Compro->totalSum + $request->data['old_pay_amount'] - $request->data['pay_amount'] + $request->data['interest'] - $request->data['old_interest'];
                $Compro->totalInterest = $Compro->totalInterest + $request->data['interest'] - $request->data['old_interest'];

                $ComFinance2 = ComFinance::where('cus_id', $request->data['cus_id'])
                    ->where('status', 'งดการขาย')
                    ->orderBy('pay_date', 'ASC')
                    ->first();

                $firstDate = Carbon::parse(@$ComFinance2->pay_date);

                $recentDate = Carbon::parse($request->data['pay_date']);
                if ($recentDate < $firstDate) {
                    $Compro->stop_date = $request->data['pay_date'];
                }

                $ComFinance = ComFinance::where('id', $id)->first();

                $ComFinance->pay_date = @$request->data['pay_date'];
                $ComFinance->type = @$request->data['type'];
                $ComFinance->bank_account = @$request->data['bank_account'];

                $ComFinance->pay_amount = @$request->data['pay_amount'];
                $ComFinance->due_date = $lastDayofMonth;
                $ComFinance->note = @$request->data['note'];
                $ComFinance->interest = @$request->data['interest'];
                $ComFinance->update();


                DB::commit();

                $ComFinTotal = ComFinance::where('cus_id',  $request->data['cus_id'])

                    ->whereNot('status', 'cancel')
                    ->orderBy('pay_date', 'DESC')
                    ->get();


                $ComFin = ComFinance::where('cus_id',  $request->data['cus_id'])

                    ->Where('status', '!=', 'cancel')
                    ->Where('status', '!=', 'ประนอมหนี้เดิม')
                    ->orderBy('pay_date', 'DESC')
                    ->get();




                $Compro->update();
                $type = '';
                $this->calInterest($request->data['cus_id'], $type);
                $totalValue = $this->calInterest($request->data['cus_id'], $type);


                $message = 'อัพเดตเรียบร้อย';
                $renderHTML = view('DataCompromise.Finance-com.com-table', compact('ComFin', 'Compro', 'totalValue', 'ComFinTotal'))->render();
                return response()->json([$renderHTML]);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->type == 'UpdateTotalCom') {
            $ComInstall = ComInstall::where('com_id', $request->com_id)->get();
        }
    }

    public function destroy($id)
    {
        //
    }

    public function calInterest($id, $type, $com_id)
    {

        $Compro = Compromise::where('cus_id', $id)->orderBy('id', 'DESC')->first();

        $ComFin = ComFinance::where('cus_id', $id)

            ->Where('status', '!=', 'cancel')
            ->Where('status', '!=', 'ประนอมหนี้เดิม')
            ->orderBy('pay_date', 'ASC')
            ->get();
        $ComInstall = ComInstall::where('com_id', $com_id)
            ->whereNot('totalSum', 0)
            ->get();

        $ComInstallDate = ComInstall::where('com_id', $com_id)
            ->whereNot('totalSum', 0)
            ->orderBy('due_date', 'ASC')
            ->first();
        // dd($ComInstall);
        $totalPay = @$ComFin->sum('pay_amount') + @$Compro->pay_first;
        $countCom = count($ComFin);

        $DiffMonthcount = 0;
        $DiffMonthRow = 0;
        $totalSum = $Compro->totalSum;

        $totalInterest = 0;

        if ($ComInstall != NULL && $ComInstallDate != NULL) {
            $todayFormat = Carbon::now()->format('Y-m');
            $today = Carbon::parse($todayFormat);

            $dueDateFomat = Carbon::parse($ComInstallDate->due_date)->format('Y-m');
            $duedate = Carbon::parse($dueDateFomat);

            $diffMonth = $duedate->diffInMonths($today);
            if ($diffMonth >= 1) {
                $Totalinterest = ceil((($totalSum * (@$Compro->interest / 100)) / 12)) * $diffMonth;
                $interest = ceil((($totalSum * (@$Compro->interest / 100)) / 12));
            } else {
                $interest = 0;
            }



            $totalSum = $totalSum + $interest;
            $array_total = ['countCom' => $countCom, 'totalSum' => $totalSum, 'DiffMonthRow' => $DiffMonthRow, 'DiffMonthcount' => $DiffMonthcount, 'interest' => $interest, 'Totalinterest' => @$Totalinterest];

            for ($i = 0; $i < $diffMonth; $i++) {

                DB::beginTransaction();
                try {

                    $ComInstallUpdate = ComInstall::where('id', $ComInstall[$i]->id)
                        ->whereNot('totalSum', '0')
                        ->first();


                    $Compro = Compromise::where('cus_id', $id)->orderBy('id', 'DESC')->first();
                   
                    if ($Compro->not_interest == 'Y' && $ComInstallUpdate->no_pay == '1') {
                        $ComInstallUpdate->interest = 0;
                        $ComInstallUpdate->interestShow = 0;
                        $ComInstallUpdate->totalSum = $ComInstallUpdate->pay_amount + $ComInstallUpdate->interest;
                        $Compro->totalInterest = ComInstall::where('com_id', $com_id)->sum('interestShow');
                        $Compro->SumInterest = $Compro->totalSum + $Compro->totalInterest;
                        $Compro->nowInterest = ComInstall::where('com_id', $com_id)->sum('interest');

                        $Compro->totalSum = ComInstall::where('com_id', $com_id)->sum('totalSum') - $Compro->nowInterest;


                        $Compro->update();
                        $ComInstallUpdate->update();
                        DB::commit();
                        continue;
                    }


                    if ($ComInstallUpdate->interestShow == 0) {
                       
                        $ComInstallUpdate->interest = $interest;
                        $ComInstallUpdate->interestShow = $interest;
                        $ComInstallUpdate->totalSum = $ComInstallUpdate->pay_amount + $ComInstallUpdate->interest;
                    }
                    $Compro->totalInterest = ComInstall::where('com_id', $com_id)->sum('interestShow');
                    $Compro->SumInterest = $Compro->totalSum + $Compro->totalInterest;
                    $Compro->nowInterest = ComInstall::where('com_id', $com_id)->sum('interest');

                    $Compro->totalSum = ComInstall::where('com_id', $com_id)->sum('totalSum') - $Compro->nowInterest;


                    $Compro->update();
                    $ComInstallUpdate->update();
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                }
                continue;
            }
            return $array_total;
        }
    }
}
