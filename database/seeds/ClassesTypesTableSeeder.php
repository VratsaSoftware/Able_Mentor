<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('classes')->insert(
        	[
        		['class_name' => 'Първи'],
        		['class_name' => 'Втори'],
        		['class_name' => 'Трети'],
        		['class_name' => 'Четвърти'],
        		['class_name' => 'Пети'],
        		['class_name' => 'Шести'],
        		['class_name' => 'Седми'],
        		['class_name' => 'Осми'],
        		['class_name' => 'Девети'],
        		['class_name' => 'Десети'],
        		['class_name' => 'Единадесети'],
        		['class_name' => 'Дванадесети']
        	]
        );
    }
}
