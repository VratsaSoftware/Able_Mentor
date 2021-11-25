<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mentor;
use Faker\Generator as Faker;

$factory->define(Mentor::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName() . ' ' . $faker->lastName(),
        'age' => $faker->numberBetween(18, 78),
        'email' => $faker->email(),
        'phone' => $faker->phoneNumber(),
        'gender_id' => $faker->numberBetween(1, 2),
        'season' => $faker->numberBetween(1, 14),
        'city_id' => $faker->numberBetween(1, 257),
        'work' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'education' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'experience' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'expertise' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'difficult_situations' =>  $faker->regexify('[A-Za-z0-9\s]{100}'),
        'want_to_change' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'hours' => $faker->numberBetween(1, 5),
        'cv_path' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'able_mentor_info' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'notes' => $faker->regexify('[A-Za-z0-9\s]{100}'),
    ];
});
