<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Exe_status;
use App\Models\Execution_debt;
use App\Models\Finance;
use App\Models\FinanceOther;
use App\Models\Guarantor;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Redirect;
use App\Models\Tribunal_status;
use App\Models\Tribunal_debt;
use DB;


class Upload_File extends Controller
{

    public function index(Request $request)
    {

        // if ($request->type == 'Datacourt') { // View ชั้นศาล

        //     // $data = Tribunal_debt::where('id', $id);

        //     return view('DataLawsuit.section-court.view');
        // }

        return view('DataLawsuit.section-court.view');
        if ($request->type == 'DataExecution') { // View ชั้นบังคับคดี
            return view('DataLawsuit.section-execution.view');
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //

        if ($request->type == 'updateFilePath') {


            // $fileName = $request->file->getClientOriginalName();
            // $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');


            $file = UploadFile::where('cus_id', $request->id)->get();
            $count = count($file) + 1;



            $fileName = $request->CON_NO . '_' . $count . '_' . $request->file->getClientOriginalName();
            $location = public_path('assets/uploads/file/');

            $request->file('file')->move($location, $fileName);

            // $data = UploadFile::get();
            DB::beginTransaction();

            try {
                $location = 'assets/uploads/file/' . $fileName;
                $Upload = new UploadFile;
                $Upload->file_path = $location;
                $Upload->cus_id = $request->id;
                $Upload->file_name = $fileName;
                $Upload->status = $request->status;

                $Upload->save();
                DB::commit();

                $message = 'บันทึกเรียบร้อย';
                $file_path = UploadFile::where('cus_id', $request->id)->get();


                // return response()->json(['html' => $renderHTML, 'message' => $message]);

                
                // return  redirect()->route('Law.show', [$request->id, 'type' => 'showCus'])->response()->file($fileName);
                if ($request->status == 'คัดโฉนด') {
                    // $message = 'อัพเดตเรียบร้อย';
                    // $renderHTML =  view('DataLawsuit.section-execution.tab-view-select-deed', compact('data', 'file_path'))->render();
                    return  redirect()->route('Exe.show', [$request->id, 'type' => 'showExe']);
                } else {
                    return  redirect()->route('Law.show', [$request->id, 'type' => 'showCus']);
                }
            } catch (\Exception $e) {

                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'code' => $e->getCode()], 500);
            }
        }
    }


    public function show(Request $request, $id)
    {
        //

        // if ($request->type == 'showCus') {
        //     $data = Tribunal_debt::where('id', $id)->get();
        //     return view('DataLawsuit.section-court.view', compact('data'));
        // }
    }


    public function edit(Request $request, $id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
