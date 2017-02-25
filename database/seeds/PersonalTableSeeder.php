<?php

use Illuminate\Database\Seeder;
use App\Personal;
class PersonalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Personal::class)->times(10)->create();
    }
}
