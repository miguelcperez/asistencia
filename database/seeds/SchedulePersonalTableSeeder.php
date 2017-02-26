<?php

use App\Personal;
use App\Schedule;
use Illuminate\Database\Seeder;

class SchedulePersonalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = Personal::all();
        $schedules = Schedule::all();

        foreach ($users as $user) {

            $random = $schedules->random(6);

            foreach ($random as $schedule) {
                $user->schedules()->attach($schedule);
            }
        }

    }
}
