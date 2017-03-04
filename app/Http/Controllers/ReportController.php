<?php

namespace App\Http\Controllers;

use App\Personal;
use App\Assist;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request) 
    {
    	return view('report');
    	/*$reports = \DB::table('assists')
            ->join('personal', 'assists.personal_id', '=', 'personal.id')
            ->select('assists.created_at', 'personal.name', 'assists.discount')
            ->paginate(10);
        if($request->ajax()) {
        	return View('report', ['reports' => $reports])->render();
        }
    	return  view('report', ['reports' => $reports]);*/
    }
    public function personalData(Request $request)
    {
    	$assist = (new Assist)->newQuery();
    	if($request->has('id')) {
    		$assist->join('personal', 'assists.personal_id', '=', 'personal.id')
            ->select('assists.created_at', 'personal.name', 'assists.discount')
            ->where('assists.personal_id',$request->id);
    	}
    	if($request->has('init_date')) {
    		$assist->join('personal as p1', 'assists.personal_id', '=', 'p1.id')
            ->select('assists.created_at', 'p1.name', 'assists.discount')
            ->where('assists.created_at','>=',$request->init_date);
    	}
    	if($request->has('end_date')) {
    		$assist->join('personal as p2', 'assists.personal_id', '=', 'p2.id')
            ->select('assists.created_at', 'p2.name', 'assists.discount')
            ->where('assists.created_at','<=',$request->end_date);
    	}

    	return $assist->get();
    }
    public function show()
    {
    	$personal = (new Personal)->newQuery();
    	$personal->select('personal.id', 'personal.name');
    	return $personal->get();
    }
}
