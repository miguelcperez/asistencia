<?php

namespace App\Http\Controllers;

use App\Personal;
use App\Schedule;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function create () 
    {
    	return view('register');
    }
    public function store(Request $request) 
    {
        $this->validate($request, [
            'code' => 'required|unique:personal|integer',
            'name' => 'required|string',
            'payperhour' => 'required|numeric'
        ]);
        $ids = explode(',', $request->hours_array);
    	$personal = Personal::create([
    		'code' => $request->code,
    		'name' => $request->name,
    		'payperhour' => $request->payperhour
    	]);
        foreach($ids as $id) {
           $horario = Schedule::find($id);
           $personal->schedules()->attach($horario);
        }
    	return redirect('registro')->with('message', 'Registrado Correctamente');
    }
}
