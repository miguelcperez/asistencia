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
        return Personal::assistToday();
    }

    public function checkIn()
    {
        $this->validate(request(), ['id' => 'required|exists:personal,id']);

        $assists = Assist::where('personal_id', request('id'))
            ->whereBetween('created_at', [
                Carbon::today()->startOfDay(), Carbon::today()->endOfDay()
            ])
            ->get();

        if ($assists->count() > 0) {
            $assist = $assists->first();
            $assist->entry = Carbon::now();
            $assist->save();

            return $assist;
        }

        return Assist::create([
            'personal_id' => request('id'),
            'entry'        => Carbon::now(),
            'discount_entry'    => '0'
        ]);
    }

    public function checkOut()
    {
        $this->validate(request(), ['id' => 'required|exists:personal,id']);

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
        $user = Personal::where('code', request('code'))->first();

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
