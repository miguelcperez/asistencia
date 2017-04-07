<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Personal extends Model
{
	protected $table = "personal";

    protected $fillable = [
        'code', 'name', 'payperhour'
    ];

    public function schedules() 
    {
    	return $this->belongsToMany('App\Schedule', 'schedule_personal')->withTimestamps();
    }

    public function assists()
    {
        return $this->hasMany(Assist::class);
    }

    public static function today()
    {
        $weekdays = [
            'Monday' => 'LUNES',
            'Tuesday' => 'MARTES',
            'Wednesday' => 'MIERCOLES',
            'Thursday' => 'JUEVES',
            'Friday' => 'VIERNES',
            'Saturday' => 'SABADO',
            'Sunday' => 'DOMINGO',
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

    public static function assistToday()
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

        $day = Carbon::now()->format('l');
        $today = Carbon::now();
        $start = $today->startOfDay()->toDateTimeString();
        $end = $today->endOfDay()->toDateTimeString();

        $query = "
            SELECT U.*, A.entry, A.exit, A.created_at FROM (
                SELECT personal.id, personal.name, schedule.day, MAX(schedule.end_hour) AS end_hour_max FROM personal
                JOIN schedule_personal ON personal.id = schedule_personal.personal_id
                JOIN schedule ON schedule_personal.schedule_id = schedule.id
                WHERE schedule.day = '$weekdays[$day]'
                GROUP BY personal.id
            ) AS U
            LEFT JOIN (
                SELECT * fROM assists
                WHERE created_at between '$start' AND '$end'
            ) AS A
            ON U.id = A.personal_id
        ";

        return DB::select($query);
    }
}
