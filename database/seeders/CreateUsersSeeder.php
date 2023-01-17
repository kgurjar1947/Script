<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   

    public function run()
    {
        //
        $users = [
            [
               'name'=>'Admin User',
               'email'=>'admin@gmail.com',
               'type'=>1,
               'password'=> bcrypt('Admin@123'),
               'img_name'=>'test',
               'phone'=>'123456789',
            ],
            [
               'name'=>'Manager User',
               'email'=>'manager@gmail.com',
               'type'=> 2,
               'password'=> bcrypt('Admin@123'),
               'img_name'=>'test',
               'phone'=>'123456789',
            ],
            [
               'name'=>'User',
               'email'=>'user@gmail.com',
               'type'=>0,
               'password'=> bcrypt('Admin@123'),
               'img_name'=>'test',
               'phone'=>'123456789',
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
