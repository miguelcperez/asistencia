<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request) 
    {
    	$reports = \DB::table('assists')
            ->join('personal', 'assists.personal_id', '=', 'personal.id')
            ->select('assists.created_at', 'personal.name', 'assists.discount')
            ->paginate(10);
        if($request->ajax()) {
        	return View('report', ['reports' => $reports])->render();
        }
    	return  view('report', ['reports' => $reports]);
    }
    public function show()
    {
    	
    }
}
