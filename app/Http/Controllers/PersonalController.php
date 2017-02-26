<?php

namespace App\Http\Controllers;

use App\Personal;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function index () 
    {
    	return view('register');
    }
    public function create(Request $request) 
    {
        return dd($request->all());
    	$request_data = $request->all();
    	$personal = Personal::Create([
    		'code' => $request_data['code'],
    		'name' => $request_data['name'],
    		'payperhour' => $request_data['payperhour']
    	]);
    	$request->session()->flash('message', 'Registrado Correctamente');
    	return redirect()->to('registro');
    }
}
