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
            ->select('assists.id','assists.entry', 'p1.name', 'assists.discount_entry', 'assists.exit', 'assists.discount_exit', 'assists.justify');

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
    	return Datatables::of($this->report($request))
            ->addColumn('action', function ($assist) {
                $id = $assist->id;
                $state = $assist->justify;
                    return '<button class="btn btn-xs btn-primary btn-action" data-remote="/reporte/'.$id.'/'.$state.'">
                    <i class="glyphicon glyphicon-plus"></i> Justificar</button>';
                })
            ->editColumn('justify', function($assist){
                if($assist->justify == 0){
                    return 'No';
                } else {
                    return 'Si';
                }
            })->make(true);
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
        $sum = $this->report($request)->where('justify', '=', '0')->sum('assists.discount_entry')
            + $this->report($request)->where('justify', '=', '0')->sum('assists.discount_exit');
        return $sum;
    }

    public function changeState($id, $state)
    {
        $assist = (New Assist)->newQuery();
        $assist->select('assists.id', 'assists.justify');
        if($state == 0) {
            return $assist->where('assists.id', '=', $id)->update(['assists.justify' => 1]);
        } else {
            return $assist->where('assists.id', '=', $id)->update(['assists.justify' => 0]);
        }
    }

    public function printPdf() 
    {
        $pdf = PDF::loadView('report');
        return $pdf->download('reporte.pdf');
    }
}
