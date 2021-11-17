<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MentorSeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('mentor_seasons')->insert(
        	[
        		['season' => '1'],
        		['season' => '2'],
        		['season' => '3'],
        		['season' => '4'],
        		['season' => '5'],
        		['season' => '6'],
        		['season' => '7'],
        		['season' => '8'],
        		['season' => '9'],
        		['season' => '10'],
        		['season' => '11'],
        		['season' => '12'],
        		['season' => '13'],
        		['season' => '14']
        	]
        );
    }
}
