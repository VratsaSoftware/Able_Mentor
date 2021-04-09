<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mentor;
use Faker\Generator as Faker;

$factory->define(Mentor::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName(),
        'name_second' => $faker->lastName(),
        'age' => $faker->numberBetween(18, 78),
        'email' => $faker->email(),
        'phone' => $faker->phoneNumber(), 
        'gender_id' => $faker->numberBetween(1, 2),
        'season_id' => $faker->numberBetween(1, 14),
        'city_id' => $faker->numberBetween(1, 257),
        'work' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'experience' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'expertise' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'difficult_situations' =>  $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'want_to_change' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'hour_id' => $faker->numberBetween(1, 5),
        'project_type_id' => $faker->numberBetween(1, 3),
        'cv_path' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'able_mentor_info' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'notes' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'is_approved' => $faker->numberBetween(0, 1),
    ];
});
