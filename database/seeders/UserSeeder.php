<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => "admin",
                'email' => "admin@gmail.com",
                'password' => "123456",
            ],
            [
                'name' => "admin2",
                'email' => "admin2@gmail.com",
                'password' => "123456",
            ]
        ]);
    }
}
