<?php

use App\EducationSphere;
use Illuminate\Database\Seeder;

class EducationSphereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EducationSphere::insert([
            ['sphere' => 'Архитектура'],
            ['sphere' => 'Бизнес и Мениджмънт'],
            ['sphere' => 'Богословие'],
            ['sphere' => 'Изкуство и дизайн'],
            ['sphere' => 'Икономика'],
            ['sphere' => 'Инженерни науки'],
            ['sphere' => 'История'],
            ['sphere' => 'Компютърни науки'],
            ['sphere' => 'Медицина'],
            ['sphere' => 'Медия и масова комуникация'],
            ['sphere' => 'Национална сигурност и отбрана'],
            ['sphere' => 'Политически науки'],
            ['sphere' => 'Природни и естествени науки'],
            ['sphere' => 'Правни науки'],
            ['sphere' => 'Психология'],
            ['sphere' => 'Спорт'],
            ['sphere' => 'Туризъм, Хотелиерство, Кулинария'],
            ['sphere' => 'Филология и Лингвистика'],
            ['sphere' => 'Финанси, Счетоводство, Банкиране'],
        ]);
    }
}
