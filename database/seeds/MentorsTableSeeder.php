<?php

use Illuminate\Database\Seeder;
use App\Mentor;

class MentorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Mentor::class, 100)->create();
    }
}
