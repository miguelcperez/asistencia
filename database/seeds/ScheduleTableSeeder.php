<?php

use Illuminate\Database\Seeder;
use App\Schedule;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$days = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES'];

		foreach ($days as $day) {

			foreach (range(7, 12) as $hour) {

                $endHour = $hour + 1;

                Schedule::create([
                    'day' => $day,
                    'init_hour' => "$hour:00:00",
                    'end_hour' => "$endHour:00:00"
                ]);
			}

		}
    }
}
