<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
        	[
        		CitiesTableSeeder::class,
	        	GendersTableSeeder::class,
	        	ProjectTypesTableSeeder::class,
	        	EnglishLevelsTypesTableSeeder::class,
	        	SportsTypesTableSeeder::class,
	        	SchoolClassesTypesTableSeeder::class,
                UsersTableSeeder::class,
                MentorsTableSeeder::class,
                StudentsTableSeeder::class
        	]
        );
    }
}
