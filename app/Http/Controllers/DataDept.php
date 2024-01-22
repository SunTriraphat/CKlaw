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


class DataDept extends Controller
{
    public function index(Request $request)
    {

        // if ($request->type == 'Datacourt') { // View ชั้นศาล

        //     // $data = Tribunal_debt::where('id', $id);

        //     return view('DataLawsuit.section-court.view');
        // }
        $data = DB::table('LawCom')
        ->where('status_com', 'Y')
        ->where('status_close', 'N')
        ->whereNot('status','close')
        ->get();
       
        return view('DataDept.view-dept', compact('data'));
     
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //

        
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
