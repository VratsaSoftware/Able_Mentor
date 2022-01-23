<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seasonsData = [];

        $seasonsData[] = [
            'name' => 'Не съм бил досега.',
            'start' => Carbon::now()->subYears(50),
            'end' => Carbon::now()->subYears(50),
        ];

        for ($i = 0; $i < 16; $i++) {
            $seasonsData[] = [
                'name' => 'Сезон ' . ($i + 1),
                'start' => Carbon::now()->subYears(15 - $i),
                'end' => Carbon::now()->subYears(15 - $i)->addMonths(6),
            ];
        }

        DB::table('seasons')->insert($seasonsData);
    }
}
