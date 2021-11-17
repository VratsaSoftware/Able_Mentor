<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SportsTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sports')->insert(
        	[
        		['name' => 'Бадминтон'],
        		['name' => 'Тенис на маса'],
        		['name' => 'Тенис'],
        		['name' => 'Волейбол'],
        		['name' => 'Баскетбол'],
        		['name' => 'Мажоретни танци'],
        		['name' => 'Гимнастика'],
        		['name' => 'Алпинизъм'],
        		['name' => 'Колоездене'],
        		['name' => 'Бойни спортове'],
        		['name' => 'Футбол'],
        		['name' => 'Хандбал'],
        		['name' => 'Начално (А1)'],
        		['name' => 'Лека атлетика'],
        		['name' => 'Алпийски ски'],
        		['name' => 'Хокей'],
        		['name' => 'Вдигане на тежести'],
        		['name' => 'Шах'],
        		['name' => 'Гребане'],
        		['name' => 'Плуване'],
        		['name' => 'Други']
        	]
        );
    }
}