<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
     public function create(Request $request)
    {
        
        $data = new ModelName();
        $data->column1 = $request->column1;
        $data->column2 = $request->column2;
        $data->save();

        return response()->json(['success' => 'Data is successfully added']);
    }

}
