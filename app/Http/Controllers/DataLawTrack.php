<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\LawTrack;
use App\Models\Tribunal_debt;

class DataLawTrack extends Controller
{
    public function index(Request $request)
    {
        $event = LawTrack::get();

        if ($request->ajax()) {
            // dump($request->start);
            // dump($request->end);

            // $event = LawTrack::whereDate('event_start', '>=', $request->start)
            //     ->whereDate('event_end',   '<=', $request->end)
            //     ->get(['id', 'event_name', 'event_start', 'event_end']);

            $event = LawTrack::get();
            if ($request->type == 'showTrackDetail') {
                $event = LawTrack::where('id', $request->id)->first();
            }
            // dump($event);
            return response()->json($event);
        }

        if ($request->type == 'showAddTrack') {

            // $Compro = Compromise::where('cus_id', $id)->orderBy('id','DESC')->first();
            return view('DataLawTrack.DataLawTrack.view-calendar');
        }


        // return response()->json($event);
        // $renderHTML =  view('DataLawTrack.view-calendar');
        return view('DataLawTrack.view-calendar', compact('event'));

        // return response()->json(['html' => $renderHTML]);

        // C:\laragon\www\CKLawV1\resources\views\DataLawTrack\view-calendar.blade.php
    }
    public function show(Request $request, $id)
    {

        if ($request->type == 'showTrack') {

            $event = LawTrack::where('id', $id)->first();
            // dd($event);


            // $renderHTML = view('DataLawTrack.addTrack')->render();
            // dd( $renderHTML);

            return view('DataLawTrack.addTrack', compact('event'));
            // return response()->json(['html' => $renderHTML]);
        }
    }
    public function calendarEvents(Request $request)
    {
        // dump($request);



        switch ($request->type) {
            case 'create':
                $customer =  Customer::where('CON_NO', $request->CON_NO)->first();

                $status = 'ไม่สำเร็จ';
                if ($customer != null) {

                    if ($request->levels == 'ชั้นศาล') {
                        $data = Tribunal_debt::where('cus_id', $customer->id)->orderBy('id', 'DESC')->first();
                        Tribunal_debt::where('cus_id', $customer->id)->orderBy('id', 'DESC')->first()->update(['date_witness' => $request->event_start]);

                        $event = LawTrack::updateOrCreate([
                            'Law_id' =>  $data->id,
                        ], [
                            'CON_NO' => $request->CON_NO,
                            'tribunal' => $request->tribunal,
                            'black_no' => $request->black_no,
                            'red_no' => $request->red_no,
                            'exe_office' => $request->exe_office,
                            'case_type' => $request->case_type,
                            'levels' => $request->levels,
                            'plaintiff' => $request->plaintiff,
                            'defendant1' => $request->defendant1,
                            'defendant2' => $request->defendant2,
                            'defendant3' => $request->defendant3,
                            'event_start' => $request->event_start,
                            'event_end' => $request->event_end,
                        ]);
                    } else {
                        $event = LawTrack::create([
                            'CON_NO' => $request->CON_NO,
                            'tribunal' => $request->tribunal,
                            'black_no' => $request->black_no,
                            'red_no' => $request->red_no,
                            'exe_office' => $request->exe_office,
                            'case_type' => $request->case_type,
                            'levels' => $request->levels,
                            'plaintiff' => $request->plaintiff,
                            'defendant1' => $request->defendant1,
                            'defendant2' => $request->defendant2,
                            'defendant3' => $request->defendant3,
                            'event_start' => $request->event_start,
                            'event_end' => $request->event_end,
                        ]);
                    }


                    // $event = LawTrack::create([
                    //     'CON_NO' => $request->CON_NO,
                    //     'tribunal' => $request->tribunal,
                    //     'black_no' => $request->black_no,
                    //     'red_no' => $request->red_no,
                    //     'exe_office' => $request->exe_office,
                    //     'case_type' => $request->case_type,
                    //     'levels' => $request->levels,
                    //     'plaintiff' => $request->plaintiff,
                    //     'defendant1' => $request->defendant1,
                    //     'defendant2' => $request->defendant2,
                    //     'defendant3' => $request->defendant3,
                    //     'event_start' => $request->event_start,
                    //     'event_end' => $request->event_end,
                    // ]);
                    $status = 'สำเร็จ';
                }

                return response()->json(['event' => @$event, 'status' => $status]);
                break;

            case 'edit':

                $event = LawTrack::find($request->id)->update([
                    'event_start' => $request->start,
                    'event_end' => $request->end,
                ]);
                $track = LawTrack::find($request->id)->first();
                $data = Tribunal_debt::where('id', $track->law_id)->update(['date_witness' => $request->start]);

                return response()->json($event);
                break;

            case 'delete':

                $event = LawTrack::find($request->id)->delete();

                return response()->json($event);
                break;

            default:
                # ...
                break;
        }
    }
}
