<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'Admin Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456789'),
                'role' => 'admin',
                'created_at' => NOW(),
            ], [
                'name' => 'Operator',
                'email' => 'operator@operator.com',
                'password' => bcrypt('123456789'),
                'role' => 'operator',
                'created_at' => NOW(),
            ], [
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => bcrypt('123456789'),
                'role' => null,
                'created_at' => NOW(),
            ],
        ]);
    }
}
