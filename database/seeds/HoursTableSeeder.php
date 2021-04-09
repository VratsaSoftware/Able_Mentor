<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hours')->insert(
        	[
        		['hour' => '1'],
        		['hour' => '2'],
        		['hour' => '3'],
        		['hour' => '4'],
        		['hour' => '5']
        	]
        );
    }
}
