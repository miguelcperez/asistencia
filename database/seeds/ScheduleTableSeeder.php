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
        factory(Schedule::class)->create([
    		'day' => 'Lunes',
    		'init_hour' => '07:00:00',
    		'end_hour' => '08:00:00'
    	]);
    	factory(Schedule::class)->create([
    		'day' => 'Lunes',
    		'init_hour' => '08:00:00',
    		'end_hour' => '09:00:00'
    	]);
    	factory(Schedule::class)->create([
    		'day' => 'Lunes',
    		'init_hour' => '09:00:00',
    		'end_hour' => '10:00:00'
    	]);
    	factory(Schedule::class)->create([
    		'day' => 'Lunes',
    		'init_hour' => '10:00:00',
    		'end_hour' => '11:00:00'
    	]);
    	factory(Schedule::class)->create([
    		'day' => 'Lunes',
    		'init_hour' => '11:00:00',
    		'end_hour' => '12:00:00'
    	]);
    	factory(Schedule::class)->create([
    		'day' => 'Lunes',
    		'init_hour' => '12:00:00',
    		'end_hour' => '13:00:00'
    	]);
    }
}
