<?php

namespace App\Http\Controllers;

use App\Models\ComInstall;
use App\Models\Customer;
use App\Models\Exe_status;
use App\Models\Execution_debt;
use App\Models\Finance;
use App\Models\FinanceOther;
use App\Models\Guarantor;
use App\Models\TeamFollow;
use App\Models\Tracking;
use App\Models\TrackingDetail;
use App\Models\TrackingStatus;
use App\Models\UploadFile;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Redirect;
use App\Models\Compromise;
use App\Models\Tribunal_status;
use App\Models\Tribunal_debt;
use App\Models\ViewLawCom;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;


class DataTracking extends Controller
{
    public function index(Request $request)
    {

        // if ($request->type == 'Datacourt') { // View ชั้นศาล

        //     // $data = Tribunal_debt::where('id', $id);

        //     return view('DataLawsuit.section-court.view');
        // }
        // $data = DB::table('LawCom')
        // ->where('status_com', 'Y')
        // ->where('status_close', 'N')
        // ->whereNot('status','close')
        // ->get();

        // return view('DataDept.view-dept', compact('data'));

    }

    public function create(Request $request)
    {
        //

        if ($request->type == 'shareTrack') {

            $TrackingStatus = TrackingStatus::get();
            $data = ViewLawCom::where('status_com', 'Y')
                ->where('status_close', 'N')
                ->where('status', '!=', 'close')
                ->orWhere('status', NULL)
                ->get();

                
      

            
            $dataTeam = TeamFollow::whereNot('status','close')->get();
            
           

            // $data = TeamFollow::whereIn('user_id', [1,2,3])
            // ->get();

            $todayFormat = Carbon::now()->addMonth()->format('Y-m');
            $today = Carbon::parse($todayFormat);
            $dataInstall = ComInstall::get();

            return view('DataTracking.share-tracking', compact('data', 'TrackingStatus', 'today', 'dataInstall', 'dataTeam'));
        }
        // if ($request->type == 'updateAllTeam') {

        //     $TrackingStatus = TrackingStatus::get();
        //     $data = ViewLawCom::where('status_com', 'Y')
        //         ->where('status_close', 'N')
        //         ->where('status', '!=', 'close')
        //         ->orWhere('status', NULL)
        //         ->get();

        //     // $data = $dataold

        //     $todayFormat = Carbon::now()->addMonth()->format('Y-m');
        //     $today = Carbon::parse($todayFormat);
        //     $dataInstall = ComInstall::get();

        //     return view('DataTracking.share-tracking', compact('data', 'TrackingStatus', 'today', 'dataInstall'));
        // }

    }

    public function store(Request $request)
    {
        //

        if ($request->type == 'InsertTrackMonth') {


            DB::beginTransaction();
            try {
                $TrackAdd = new Tracking;
                $TrackAdd->userinsert =  Auth::user()->id;
                $TrackAdd->date_tag =   Carbon::now();
                $TrackAdd->com_id =  @$request->data['com_id'];
                $TrackAdd->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
                $TrackAdd->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
                $TrackAdd->save();
                DB::commit();

                $message = 'อัพเดตเรียบร้อย';
                $data = Tracking::get();

                $Tracking = Tracking::where('com_id', @$request->data['com_id'])->orderBy('date_tag', 'DESC')->get();

                $status_tag = '';
                foreach ($Tracking as $item) {
                    $date_tag = Carbon::parse($item->date_tag)->format('Y-m');
                    $today =  Carbon::now()->format('Y-m');
                    if ($date_tag == $today) {
                        $status_tag = 'เดือนนี้สร้างไปแล้ว';
                        break;
                    }
                }

                $Compro = Compromise::where('cus_id', @$request->data['cus_id'])->orderBy('id', 'DESC')->first();

                $renderHTML =  view('DataCompromise.section-NewCompromise.tab-view-tracking', compact('Tracking', 'status_tag', 'Compro'))->render();

                return response()->json(['html' => $renderHTML, 'message' => $message]);
                // return  redirect()->route('Law.show', [$request->data['cus_id'], 'type' => 'showCus']);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->type == 'InsertTrackDetail') {


            DB::beginTransaction();
            try {
                $TrackDetail = new TrackingDetail;
                $TrackDetail->userinsert =  Auth::user()->id;
                $TrackDetail->date_tag =   @$request->data['date_tag'];
                $TrackDetail->com_id =  @$request->data['com_id'];
                $TrackDetail->note =  @$request->data['note'];
                $TrackDetail->status =  @$request->data['status'];
                $TrackDetail->save();

                $TrackAdd = Tracking::where('id', @$request->data['track_id'])->first();

                $TrackAdd->status =  @$request->data['status'];

                $TrackAdd->update();

                DB::commit();

                $message = 'อัพเดตเรียบร้อย';

                $Tracking = Tracking::where('com_id', @$request->data['com_id'])->orderBy('date_tag', 'DESC')->get();

                $status_tag = '';
                foreach ($Tracking as $item) {
                    $date_tag = Carbon::parse($item->date_tag)->format('Y-m');
                    $today =  Carbon::now()->format('Y-m');
                    if ($date_tag == $today) {
                        $status_tag = 'เดือนนี้สร้างไปแล้ว';
                        break;
                    }
                }

                $Compro = Compromise::where('id', @$request->data['com_id'])->orderBy('id', 'DESC')->first();


                $renderHTML =  view('DataCompromise.section-NewCompromise.tab-view-tracking', compact('Tracking', 'status_tag', 'Compro'))->render();

                return response()->json(['html' => $renderHTML, 'message' => $message]);
                // return  redirect()->route('Law.show', [$request->data['cus_id'], 'type' => 'showCus']);
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
        if ($request->type == 'InsertTeamFollow') {

            DB::beginTransaction();
            try {
                for ($i = 1; $i <= (int)$request->data['count']; $i++) {
                    if ($request->data['teamAll'] == '') {
                        if (isset(User::find($request->data['id' . $i])->name)) {
                            $TeamFollow = new TeamFollow;
                            $TeamFollow->name = User::find($request->data['id' . $i])->name;
                            $TeamFollow->user_id = $request->data['id' . $i];
                            $TeamFollow->com_id = $request->data['com_id' . $i];
                            $TeamFollow->cus_id = $request->data['cus_id' . $i];
                            $TeamFollow->status = 'active';
                            $TeamFollow->save();
                        }
                    } else {
                        DB::table('TeamFollow')->insert([
                            'user_id' =>  $request->data['teamAll'],
                            'name' => User::find($request->data['teamAll'])->name,
                            'com_id' => $request->data['com_id' . $i],
                            'cus_id' => $request->data['cus_id' . $i],
                            'status' => 'active',
                        ]);
                    }
                }

                DB::commit();

                // $renderHTML =  view('DataCompromise.section-NewCompromise.tab-view-tracking', compact('Tracking', 'status_tag'))->render();

                // return response()->json(['html' => $renderHTML, 'message' => $message]);
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

        if ($request->type == 'addTrack') {
            $data = Compromise::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            // dd($data);
            return view('DataTracking.add-tracking', compact('data'));
        } elseif ($request->type == 'trackDetail') {

            $tracking = Tracking::where('id', $id)->orderBy('id', 'DESC')->first();

            // $data = Compromise::where('id', $tracking->com_id)->orderBy('id', 'DESC')->first();
            $TrackingDetail = TrackingDetail::where('com_id', $tracking->com_id)->orderBy('id', 'DESC')->get();
            $TrackingStatus = TrackingStatus::get();

            return view('DataTracking.detail-tracking', compact('tracking', 'TrackingStatus', 'TrackingDetail'));
        } elseif ($request->type == 'searchTeam') {

            $TrackingStatus = TrackingStatus::get();
            $data = ViewLawCom::where('status_com', 'Y')
                ->where('status_close', 'N')
                ->where('status', '!=', 'close')
                ->orWhere('status', NULL)
                ->get();
            $dataTeam = TeamFollow::whereIn('user_id', [$request->data['team']])
                ->get();

                

            // dd($data);

            // $data = $dataold
            // $team = $request->data['team'];

            // $data = $dataold->filter(function ($query) use ($team){
            //     if(@$query->ViewComToTeamFollow->user_id != NULL){
            //         return @$query->ViewComToTeamFollow->user_id = 3 ;
            //     }

            // });


            $todayFormat = Carbon::now()->addMonth()->format('Y-m');
            $today = Carbon::parse($todayFormat);
            $dataInstall = ComInstall::get();
            $renderHTML =  view('DataTracking.table-team', compact('data', 'TrackingStatus', 'today', 'dataInstall', 'dataTeam'))->render();

            return response()->json(["html" => $renderHTML]);
        }
    }

    public function edit(Request $request, $id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
        if ($request->type == 'updateTeamFollow') {
            // $data = Compromise::where('cus_id', $id)->orderBy('id', 'DESC')->first();
            // $tracking = TrackingDetail::where('com_id', $data->id)->orderBy('id', 'DESC')->get();
            // $TrackingStatus = TrackingStatus::get();

            for ($i = 1; $i <= (int)$request->data['countEdit']; $i++) {
                // dump($i);
                if ($request->data['teamNew'] == '') {
                    if (isset(User::find($request->data['id' . $i])->name)) {
                        $TeamFollow = TeamFollow::where('com_id', $request->data['com_id' . $i])->orderBy('id', 'DESC')->first();
                        $TeamFollow->name = User::find($request->data['id' . $i])->name;
                        $TeamFollow->user_id = $request->data['id' . $i];
                        $TeamFollow->com_id = $request->data['com_id' . $i];
                        $TeamFollow->update();
                    }
                } else {
                    DB::table('TeamFollow')->where('user_id', $request->data['id' . $i])->update(['user_id' =>  $request->data['teamNew'], 'name' => User::find($request->data['teamNew'])->name]);
                    // $TeamFollow = TeamFollow::update(['user_id' => $request->data['teamNew'] ]);
                }
            }

            DB::commit();
            // return view('DataTracking.detail-tracking', compact('data', 'tracking', 'TrackingStatus'));
        }
    }

    public function destroy($id)
    {
        //
    }
}
