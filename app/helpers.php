<?php

use Carbon\Carbon;

function todayES() {
    $today = Carbon::now()->format('l');

    $weekdays = [
        'Monday' => 'LUNES',
        'Tuesday' => 'MARTES',
        'Wednesday' => 'MIERCOLES',
        'Thursday' => 'JUEVES',
        'Friday' => 'VIERNES',
        'Saturday' => 'SABADO',
        'Sunday' => 'DOMINGO',
    ];

    return $weekdays[$today];
}

function startOfDay()
{
    return Carbon::today()->startOfDay();
}

function endOfDay() {
    return Carbon::today()->endOfDay();
}