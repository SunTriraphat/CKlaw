<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataContract extends Controller
{

    public function index(Request $request)
    {
        if($request->type == 'Datacon'){
            return view('DataCustomer.section-contract.view');
        }
    }


    public function create(Request $request)
    {

        if($request->type == 'createTag'){
            return view('DataCustomer.section-contract.CreateTag-Contract');
        }
        elseif($request->type == 'createTagPart'){
            return view('DataCustomer.section-contract.CreateTagPart-Contract');
        }
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
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
