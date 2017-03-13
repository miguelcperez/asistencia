<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssistRequest;
use App\Schedule;
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
        return Personal::assistToday();
    }


    public function checkIn(AssistRequest $request)
    {
        $now = Carbon::now();

        $assists = Assist::where('personal_id', $request->get('id'))
            ->whereBetween('created_at', [startOfDay(), endOfDay()])
            ->get();

        if ($assists->count() > 0) {
            $assist = $assists->first();
            $assist->entry = $now;
            $assist->save();

            return $assist;
        }

        // Computed discount
        $personal = Personal::find($request->get('id'));
        $schedules = $personal->schedules->where('day', todayES())->all();
        $discount = 0;

        foreach ($schedules as $schedule) {
            $entryTime = Carbon::createFromFormat('H:i:s', $schedule->init_hour);

            if ( $now->gte($entryTime->copy()->addMinute()) ) {
                $difference = $now->diffInMinutes($entryTime);

                if ($difference <= 10) {
                    $discount += 2; // PEN
                } elseif ($difference > 10) {
                    $discount += $personal->payperhour;
                }
            }
        }

        return Assist::create([
            'personal_id'       => $request->get('id'),
            'entry'             => $now,
            'discount_entry'    => $discount
        ]);
    }

    public function checkOut(AssistRequest $request)
    {
        $assists = Assist::where('personal_id', request('id'))
            ->whereBetween('created_at', [
                Carbon::today()->startOfDay(), Carbon::today()->endOfDay()
            ])
            ->get();

        if ($assists->count() > 0) {
            $assist = $assists->first();
            $assist->exit = Carbon::now();
            $assist->save();

            return $assist;
        }

        return Assist::create([
            'personal_id' => request('id'),
            'exit'        => Carbon::now(),
            'discount_exit'    => '0'
        ]);
    }

    public function codeValidate()
    {
        $user = Personal::where('code', request('code'))    
        ->where('id', request('id'))->first();
 
        if ($user) {
            return response()->json([
                'status' => 'success',
                'user' => $user
            ], 200);
        }

        return response()->json([
            'status' => 'fail',
        ], 422);
    }
}
