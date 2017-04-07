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
        $personal = Personal::assistToday();
        foreach ($personal as $p) {
            if(Assist::where('personal_id', $p->id)->whereBetween('created_at', [startOfDay(), endOfDay()])->count() == 0)
            {
                Assist::create([
                    'personal_id'       => $p->id
                ]);
            }
        }
        return Personal::assistToday();
    }


    public function checkIn(AssistRequest $request)
    {
        $now = Carbon::now();

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
        $assists = Assist::where('personal_id', $request->get('id'))
            ->whereBetween('created_at', [startOfDay(), endOfDay()])
            ->get();
        if ($assists->count() > 0) {
            $assist = $assists->first();
            $assist->entry = $now;
            $assist->discount_entry = $discount;
            $assist->save();
            return $assist;
        }

        /*return Assist::create([
            'personal_id'       => $request->get('id'),
            'entry'             => $now,
            'discount_entry'    => $discount
        ]);*/
    }

    public function validCheckOut() 
    {
        $now = Carbon::now();
        $assists = Assist::where('personal_id', request('id'))
            ->whereBetween('created_at', [
                Carbon::today()->startOfDay(), Carbon::today()->endOfDay()
            ])
            ->get();
        // Computed discount
        $personal = Personal::find($request->get('id'));
        $schedules = $personal->schedules->where('day', todayES())->all();
        $discount = 0;
        foreach ($schedules as $schedule) {
            $exitTime = Carbon::createFromFormat('H:i:s', $schedule->end_hour);

            if ( $now->gte($exitTime->copy()->addMinute()) ) {
                $difference = $now->diffInMinutes($exitTime);
                if(var_dump($now->lt($exitTime))) {
                    return $exitTime;
                }
            }
        }
        
    }
    public function checkOut(AssistRequest $request)
    {
        $now = Carbon::now();
        $assists = Assist::where('personal_id', request('id'))
            ->whereBetween('created_at', [
                Carbon::today()->startOfDay(), Carbon::today()->endOfDay()
            ])
            ->get();
        // Computed discount
        $personal = Personal::find($request->get('id'));
        $schedules = $personal->schedules->where('day', todayES())->all();
        $discount = 0;
        foreach ($schedules as $schedule) {
            $exitTime = Carbon::createFromFormat('H:i:s', $schedule->end_hour);

            if ( $now->gte($exitTime->copy()->addMinute()) ) {
                $difference = $now->diffInMinutes($exitTime);
                if ($difference <= 30) {
                    $discount = 0;
                } elseif ($difference > 30) {
                    $discount = 2;
                }
            }
        }

        if ($assists->count() > 0) {
            $assist = $assists->first();
            $assist->exit = $exitTime;
            $assist->discount_exit = $discount;
            $assist->save();

            return $assist;
        }
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
    public function endDate()
    {
        $now = Carbon::now();
        $discount = 0;
        $assists = Assist::where('entry', null)->whereBetween('created_at', [startOfDay(), endOfDay()])->get();
            $assists->all();
        foreach ($assists as $assist) {
            $personal = Personal::find($assist->personal_id);
            $schedules = $personal->schedules->where('day', todayES())->all();
            foreach ($schedules as $schedule) {
                $discount += $personal->payperhour;
            }
            $assist->entry = $now->toDateString();
            $assist->discount_exit = $discount;
            $assist->save();
        }
        return $assists;
    }
}
