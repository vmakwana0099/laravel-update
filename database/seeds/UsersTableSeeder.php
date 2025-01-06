<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [

            [
                'name'       => 'Super Admin',
                'email'      => 'netquick@netclues.com',
                'password'   => bcrypt('Admin@123'),
                'personalId' => 'testbynetclues@gmail.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Admin',
                'email'      => 'ppadmin@netclues.com',
                'password'   => bcrypt('Admin@123'),
                'personalId' => 'testbynetclues@gmail.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'User',
                'email'      => 'testbynetclues@gmail.com',
                'password'   => bcrypt('Admin@123'),
                'personalId' => 'testbynetclues@gmail.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];
        foreach ($users as $key => $value) {
            DB::table('users')->insert($value);
        }

    }
}
