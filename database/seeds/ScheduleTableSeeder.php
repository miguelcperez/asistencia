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
        $firstHours = ['7:30', '8:25', '9:10', '9:55', '11:00', '11:50', '12:35'];
        $secondHours = ['08:25', '09:10', '09:55', '10:40', '11:50', '12:35', '13:20'];

		foreach ($days as $day) {

			foreach ($firstHours as $index => $hour) {

                $endHour = $secondHours[$index];
                Schedule::create([
                    'day' => $day,
                    'init_hour' => "$hour:00",
                    'end_hour' => "$endHour:00"
                ]);
			}
		}
    }
}
