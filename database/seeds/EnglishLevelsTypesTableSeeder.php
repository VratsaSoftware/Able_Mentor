<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnglishLevelsTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('english_levels')->insert(
        	[
        		['level' => 'Начално (А1)'],
        		['level' => 'Основно (А2)'],
        		['level' => 'Преди средно (B1)'],
        		['level' => 'Средно (B2)'],
        		['level' => 'Напреднало (C1)'],
        		['level' => 'Професионално (C2)']
        	]
        );
    }
}
