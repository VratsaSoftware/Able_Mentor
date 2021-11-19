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
        $admin = new User;
        $admin->name = 'Admin Admin';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('123456789');
        $admin->remember_token = bcrypt('123456789');
        $admin->role = 'admin';
        $admin->approved = 1;
        $admin->save();
    }
}
