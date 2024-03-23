<?php
require '../vendor/autoload.php';

use Carbon\Carbon;


// Carbonの表示
$currentTime = Carbon::now()->format('H:i:s');
echo $currentTime ;
echo "<br />";

// 年月日のみ
$date = new DateTime();
echo $date->format('Y-m-d') ;
echo "<br />";

// x時x分x秒
$date = new DateTime();
echo $date-> format('H:i:s');
echo "<br />";

// 勤務開始
$work_start = new DateTime();
echo $work_start -> format('Y-m-d H:i:s');
echo "<br />";

//勤務終了
$work_end = new DateTime();
echo $date-> format('H:i:s');
echo "<br />";
echo "<br />";


$dt = Carbon::now();
echo $dt->year;
echo "<br />";

$dt = Carbon::now();
echo $dt->month;
echo "<br />";


$dt = Carbon::now();
echo $dt->day;
echo "<br />";

$dt = Carbon::now();
echo $dt->hour;
echo "<br />";

$dt = Carbon::now();
echo $dt->minute;
echo "<br />";

$dt = Carbon::now();
echo $dt->second;
echo "<br />";
echo "<br />";

//勤務開始
$work_start = Carbon::now();
echo $work_start -> format('H:i:s');
echo "<br />";

//勤務終了
$work_end = Carbon::now();
echo $work_end -> format('H:i:s');
echo "<br />";

//勤務時間
$work_total = $work_end->diff($work_start)->format('%H:%I:%S');
echo $work_total->format('%H:%I:%S');
echo "<br />";
echo "<br />";

//休憩開始
$rest_start = Carbon::now()-> format('H:i:s');
echo $rest_start -> format('H:i:s');
echo "<br />";

//休憩終了
$rest_end = Carbon::now()-> format('H:i:s');
echo $rest_end -> format('H:i:s');
echo "<br />";

//休憩時間
$rest_total = $rest_end->diff($rest_start);
echo $rest_total->format('%H:%I:%S');
echo "<br />";


