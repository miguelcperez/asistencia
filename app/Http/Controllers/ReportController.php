<?php

namespace App\Http\Controllers;

use App\Personal;
use App\Assist;
use PDF;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ReportController extends Controller
{
    public function index(Request $request) 
    {
    	return view('report');
    	/*$reports = \DB::table('assists')
            ->join('personal', 'assists.personal_id', '=', 'personal.id')
            ->select('assists.created_at', 'personal.name', 'assists.discount')
            ->paginate(10);
    	return  view('report', ['reports' => $reports]);*/
    }
    public function personalData(Request $request)
    {
        
    	$assist = (new Assist)->newQuery();



        $assist->join('personal as p1', 'assists.personal_id', '=', 'p1.id')
           ->select(  'assists.created_at','p1.name' ,'assists.discount');

    	if($request->has('id')) {
            $assist->where('assists.personal_id',$request->id);
    	}

    	if($request->has('init_date')) {
            $assist->where('assists.created_at','>=',$request->init_date);
    	}

    	if($request->has('end_date')) {
    		$assist->where('assists.created_at','<=',$request->end_date);
    	}

        
    	return Datatables::of($assist)->make(true);
        //return $assist->get();
    }
    public function show()
    {
    	$personal = (new Personal)->newQuery();
    	$personal->select('personal.id', 'personal.name');
    	return $personal->get();
    }
}
