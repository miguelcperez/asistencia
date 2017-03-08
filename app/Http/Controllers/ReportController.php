<?php

namespace App\Http\Controllers;

use App\Personal;
use App\Assist;
use Illuminate\Database\Eloquent\Collection;
use PDF;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ReportController extends Controller
{
    private function report(Request $request)
    {
        $assist = (new Assist)->newQuery();

        $assist->join('personal as p1', 'assists.personal_id', '=', 'p1.id')
            ->select('assists.entry', 'p1.name', 'assists.discount_entry', 'assists.exit', 'assists.discount_exit');

        if($request->has('id')) {
            $assist->where('assists.personal_id',$request->id);
        }

        if($request->has('init_date')) {
            $assist->where('assists.created_at','>=',$request->init_date);
        }

        if($request->has('end_date')) {
            $assist->where('assists.created_at','<=',$request->end_date);
        }

        return $assist;

    }

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


    	return Datatables::of($this->report($request))->make(true);
        //return $assist->get();
    }
    public function show()
    {
    	$personal = (new Personal)->newQuery();
    	$personal->select('personal.id', 'personal.name');
    	return $personal->get();
    }

    public function total(Request $request)
    {
        $sum = $this->report($request)->sum('assists.discount_entry')
            + $this->report($request)->sum('assists.discount_exit');
        return $sum;
    }
}
