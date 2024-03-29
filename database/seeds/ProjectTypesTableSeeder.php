<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('project_types')->insert(
        	[
        		['type' => 'Социален проект - осъществяване на общественополезна инициатива'],
        		['type' => 'Бизнес проект - развиване на бизнес план/бизнес идея'],
        		['type' => 'Проект за личностно развитие - подобряване личните умения/качества на ученика']
        	]
        );
    }
}
