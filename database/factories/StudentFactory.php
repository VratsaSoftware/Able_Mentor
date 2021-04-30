<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName(),
        'name_second' => $faker->lastName(),
        'age' => $faker->numberBetween(18, 78),
        'email' => $faker->email(),
        'phone' => $faker->phoneNumber(), 
        'gender_id' => $faker->numberBetween(1, 2),
        'city_id' => $faker->numberBetween(1, 257),
        'school' => $faker->regexify('[A-Za-z0-9\s]{100}'),
        'class_id' => $faker->numberBetween(1, 12),
        'favorite_subjects' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'hobbies' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'hour_id' => $faker->numberBetween(1, 5),
        'english_level_id' => $faker->numberBetween(1, 6),
        'sport_id' => $faker->numberBetween(1, 21),
        'after_school_plans' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'strong_weak_sides' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'qualities_to_change' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'free_time_activities' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'difficult_situations' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'program_achievments' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'want_to_change' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'hour_id' => $faker->numberBetween(1, 5),
        'project_type_id' => $faker->numberBetween(1, 3),
        'able_mentor_info_source' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'notes' => $faker->regexify('[A-Za-z0-9\s]{1000}'),
        'is_approved' => $faker->numberBetween(0, 1),
    ];
});
