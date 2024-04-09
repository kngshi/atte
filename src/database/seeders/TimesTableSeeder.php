<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
        'id' => '1',
        'user_id' => '1',
        'date' => '2024-02-28',
        'work_start' => '10:00:00',
        'work_end' => '20:00:00',
        ];
        DB::table('times')->insert($param);

        $param = [
        'id' => '2',
        'user_id' => '1',
        'date' => '2024-02-29',
        'work_start' => '10:00:00',
        'work_end' => '20:00:00',
        ];
        DB::table('times')->insert($param);

        $param = [
        'id' => '3',
        'user_id' => '1',
        'date' => '2024-03-01',
        'work_start' => '10:00:00',
        'work_end' => '20:00:00',
        ];
        DB::table('times')->insert($param);

        $param = [
        'id' => '4',
        'user_id' => '1',
        'date' => '2024-03-02',
        'work_start' => '10:00:00',
        'work_end' => '20:00:00',
        ];
        DB::table('times')->insert($param);

        $param = [
        'id' => '5',
        'user_id' => '1',
        'date' => '2024-03-03',
        'work_start' => '10:00:00',
        'work_end' => '20:00:00',
        ];
        DB::table('times')->insert($param);

        $param = [
        'id' => '6',
        'user_id' => '1',
        'date' => '2024-03-04',
        'work_start' => '10:00:00',
        'work_end' => '20:00:00',
        ];
        DB::table('times')->insert($param);

        $param = [
        'id' => '7',
        'user_id' => '1',
        'date' => '2024-03-05',
        'work_start' => '10:00:00',
        'work_end' => '20:00:00',
        ];
        DB::table('times')->insert($param);

    }
}
