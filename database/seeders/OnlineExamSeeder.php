<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OnlineExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("online_exams")->insert([
            [
                'title' => "Ielts 2022 level 3",
                'total_question' => 10,
                'duration' => "5",
                'user_id' => 1,
            ]
        ]);
    }
}
