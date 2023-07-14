<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->type = 'super_admin';
        $user->password = bcrypt('123456');
        $user->phone = '0123456789';
        $user->verify_phone = 1;
        $user->verify_email = 1;
        $user->save();
    }
}
