<?php

namespace App\Http\Controllers;

use App\Assist;
use App\Personal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function personalToday()
    {
        return Personal::today();
    }

    public function checkIn()
    {
        $today = Carbon::now();
        $hour = substr($today->toTimeString(),0,5);
        $this->validate(request(), ['id' => 'required|exists:personal,id']);
        return Assist::create([
            'personal_id' => request('id'),
            'type'        => 'entry', 
            'hour'        => $hour, 
            'discount'    => '0'
        ]);
    }

    public function checkOut()
    {
        $today = Carbon::now();
        $hour = substr($today->toTimeString(),0,5);
        $this->validate(request(), ['id' => 'required|exists:personal,id']);
        return Assist::create([
            'personal_id' => request('id'),
            'type'        => 'exit',
            'hour'        => $hour,
            'discount'    => '0'
        ]);
    }
}
