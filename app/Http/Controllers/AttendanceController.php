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
        $weekdays = [
            'Monday'    => 'LUNES',
            'Tuesday'   => 'MARTES',
            'Wednesday' => 'MIERCOLES',
            'Thursday'  => 'JUEVES',
            'Friday'    => 'VIERNES',
            'Saturday'  => 'SABADO',
            'Sunday'    => 'DOMINGO',
        ];

        $today = Carbon::now()->format('l');

        $users = DB::table('personal')
            ->join('schedule_personal', 'personal.id', '=', 'schedule_personal.personal_id')
            ->join('schedule', 'schedule.id', '=', 'schedule_personal.schedule_id')
            ->where('schedule.day', $weekdays[$today])
            ->groupBy('personal.id')
            ->select('personal.*', 'schedule.init_hour', 'schedule.end_hour', 'schedule.day')
            ->get();

        return $users;
    }

    public function checkIn()
    {
        $this->validate(request(), ['id' => 'required|exists:personal,id']);

        return Assist::create([
            'personal_id' => request('id'),
            'type'        => 'entry'
        ]);
    }

    public function checkOut()
    {
        $this->validate(request(), ['id' => 'required|exists:personal,id']);

        return Assist::create([
            'personal_id' => request('id'),
            'type'        => 'exit'
        ]);
    }
}
