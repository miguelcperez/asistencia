<?php

use App\Assist;
use App\Personal;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AssistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = Personal::all();
        $random = $users->random(5);

        foreach ($random as $user) {
            $today = $this->now();
            $today->subDay();

            Assist::create([
                'entry' =>  $today->addMinutes(rand(1, 30)),
                'exit' =>  $today->addHours(4),
                'personal_id' => $user->id,
            ]);
        }

        foreach ($random as $user) {
            $today = $this->now();

            Assist::create([
                'entry' =>  $today->addMinutes(rand(1, 30)),
                'exit' =>  $today->addHours(4),
                'personal_id' => $user->id,
            ]);
        }
    }

    private function now()
    {
        $today = Carbon::today();
        $today->addHours(rand(7, 9));

        return $today;
    }
}
