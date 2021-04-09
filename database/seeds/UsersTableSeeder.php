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
        $admin->name = 'Admin';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('123456');
        $admin->remember_token = bcrypt('123456');
        $admin->name_second = 'Adminov';
        $admin->is_admin = 1;
        $admin->is_approved = 1;
        $admin->save();
    }
}
