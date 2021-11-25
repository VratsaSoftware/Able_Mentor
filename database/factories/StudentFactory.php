<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName() . ' ' . $faker->lastName(),
        'age' => $faker->numberBetween(18, 78),
        'email' => $faker->email(),
        'phone' => $faker->phoneNumber(),
        'gender_id' => $faker->numberBetween(1, 2),
        'city_id' => $faker->numberBetween(1, 257),
        'school' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'class_id' => $faker->numberBetween(1, 12),
        'favorite_subjects' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'hobbies' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'hours' => $faker->numberBetween(1, 5),
        'english_level_id' => $faker->numberBetween(1, 6),
        'sport_id' => $faker->numberBetween(1, 21),
        'after_school_plans' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'strong_weak_sides' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'qualities_to_change' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'free_time_activities' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'difficult_situations' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'program_achievments' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'want_to_change' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'able_mentor_info_source' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'notes' => $faker->regexify('[A-Za-z0-9\s]{100}'),
    ];
});
