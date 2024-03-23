<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RestsTableSeeder extends Seeder
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
        'time_id' => '1',
        'rest_start' => '2024-02-28 12:00:00',
        'rest_end' => '2024-02-28 13:00:00',
        ];
        DB::table('rests')->insert($param);

        $param = [
        'id' => '2',
        'time_id' => '2',
        'rest_start' => '2024-02-29 12:00:00',
        'rest_end' => '2024-02-29 13:00:00',
        ];
        DB::table('rests')->insert($param);

        $param = [
        'id' => '3',
        'time_id' => '3',
        'rest_start' => '2024-03-01 12:00:00',
        'rest_end' => '2024-03-01 13:00:00',
        ];
        DB::table('rests')->insert($param);

        $param = [
        'id' => '4',
        'time_id' => '4',
        'rest_start' => '2024-03-02 12:00:00',
        'rest_end' => '2024-03-02 13:00:00',
        ];
        DB::table('rests')->insert($param);

        $param = [
        'id' => '5',
        'time_id' => '5',
        'rest_start' => '2024-03-03 12:00:00',
        'rest_end' => '2024-03-03 13:00:00',
        ];
        DB::table('rests')->insert($param);

        $param = [
        'id' => '6',
        'time_id' => '6',
        'rest_start' => '2024-03-04 12:00:00',
        'rest_end' => '2024-03-04 13:00:00',
        ];
        DB::table('rests')->insert($param);

        $param = [
        'id' => '7',
        'time_id' => '7',
        'rest_start' => '2024-03-05 12:00:00',
        'rest_end' => '2024-03-05 13:00:00',
        ];
        DB::table('rests')->insert($param);

    }
}
