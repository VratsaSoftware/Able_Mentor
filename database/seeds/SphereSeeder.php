<?php

use App\Sphere;
use Illuminate\Database\Seeder;

class SphereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sphere::insert([
            ['name' => 'Авиация'],
            ['name' => 'Архитектура и строителство'],
            ['name' => 'Дизайн, Криейтив, Изкство'],
            ['name' => 'Държавна администрация'],
            ['name' => 'Екология'],
            ['name' => 'Енергетика'],
            ['name' => 'Инжинерни науки'],
            ['name' => 'Литература'],
            ['name' => 'Маркетинг, реклама и ПР'],
            ['name' => 'Медии и телекомуникации'],
            ['name' => 'Медицина и фармация'],
            ['name' => 'Музика'],
            ['name' => 'Образование'],
            ['name' => 'Организиране на събития'],
            ['name' => 'Право'],
            ['name' => 'Ресторантьорство и туризъм'],
            ['name' => 'Спорт'],
            ['name' => 'Счетоводство и финанси'],
            ['name' => 'Театър и кино'],
            ['name' => 'Търговия и продажби'],
            ['name' => 'Философия и психология'],
            ['name' => 'Човешки ресурси'],
        ]);
    }
}