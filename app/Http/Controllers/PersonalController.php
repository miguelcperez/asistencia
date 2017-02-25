<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function index () 
    {
    	return view('register');
    }
    public function create(Request $request) 
    {
    	$code = $request->code;
    	$name = $request->name;
    	$request->session()->flash('message', 'Registrado Correctamente');
    	return redirect()->to('registro');
    }
}
