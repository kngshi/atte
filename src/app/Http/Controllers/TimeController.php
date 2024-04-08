<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

use App\Models\Time;
use App\Models\User;
use App\Models\Rest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class TimeController extends Controller
{

    public function start()
    {

        $user = Auth::id();
        $date = Carbon::now();
        $work_start = Carbon::now()->toTimeString();
        $latest_time = Time::latest()->first();
        $workStartButtonDisabled = false;

        if ($latest_time && $latest_time->work_start !== null) {
            $workStartButtonDisabled = true;
        }

        session(['workStartButtonDisabled' => true]);

        Time::create([
            'user_id' => $user,
            'date' => $date,
            'work_start' => $work_start,
        ]);

        return view( 'index', compact('user','date','work_start','workStartButtonDisabled'));

    }

    public function end()
    {
        // セッションに勤務終了ボタンの状態を保存
        session(['workEndButtonDisabled' => true]);
        // 他のボタンも全て非活性化
        session(['restStartButtonDisabled' => true]);
        session(['restEndButtonDisabled' => true]);

        // 勤務終了時の日付を取得
        $currentDate = Carbon::now()->toDateString();

        $user = Auth::id();
        $work_end = Carbon::now();

        // 最新の勤務レコードを取得
        $lastRecord = Time::where('user_id', $user)->latest()->first();
        $workEndButtonDisabled = false;

        if ($lastRecord) {
        // 勤務終了時刻が当日の場合
        if ($lastRecord->date == $currentDate) {
            $lastRecord->update([
                'work_end' => $work_end,
            ]);
        } else {
            // 勤務終了時刻が翌日の場合
            $lastRecord->update([
                'work_end' => Carbon::parse($currentDate)->subSecond()->toTimeString(), // 当日の23:59:59に設定
            ]);

            // 翌日の勤務開始時刻を記録
            Time::create([
                'user_id' => $user,
                'date' => $currentDate,
                'work_start' => Carbon::parse($currentDate)->startOfDay(), // 翌日の00:00:00に設定
                'work_end' => $work_end, // 翌日の勤務終了時刻を設定
            ]);
        }
}
        // 勤務開始ボタンの状態を取得
        $workStartButtonDisabled = $lastRecord->work_start !== null;

        // 勤務開始ボタンが押されている場合、勤務終了ボタンを非活性化
        if ($workStartButtonDisabled) {
            $workEndButtonDisabled = true;
        }

        return view( 'index', compact('user','work_end','workStartButtonDisabled','workEndButtonDisabled'));

    }

    public function attendance()
    {
        $user = auth()->user();
        $dates = Time::select('date')->distinct()->pluck('date')->reverse();
        $currentDate = request()->input('date', $dates->first()); // デフォルトは最初の日付

        // 現在の日付に対するデータを取得
        $times = $user->times()->whereDate('date', $currentDate)->paginate(5);
        $rests = Rest::with('time')->get();

        // 前後の日付を取得
        $previousDate = Time::where('date', '<', $currentDate)->latest('date')->value('date');
        $nextDate = Time::where('date', '>', $currentDate)->oldest('date')->value('date');

        // 時間の差を計算し、フォーマットする
        foreach ($times as $time) {
        // 勤務時間の計算
        $workDiffInSeconds = 0;
        if ($time->work_start && $time->work_end) {
            $work_start = Carbon::parse($time->work_start);
            $work_end = Carbon::parse($time->work_end);
            $workDiffInSeconds = $work_end->diffInSeconds($work_start);
        }

        $workHours = floor($workDiffInSeconds / 3600);
        $workMinutes = floor(($workDiffInSeconds % 3600) / 60);
        $workSeconds = $workDiffInSeconds % 60;
        $time->workFormattedDiff = sprintf('%02d:%02d:%02d', $workHours, $workMinutes, $workSeconds);

        // 休憩時間の計算
        $restDiffInSeconds = 0;
        foreach ($rests as $rest) {
            if ($rest->time_id == $time->id && $rest->rest_start && $rest->rest_end) {
                $rest_start = Carbon::parse($rest->rest_start);
                $rest_end = Carbon::parse($rest->rest_end);
                $restDiffInSeconds += $rest_end->diffInSeconds($rest_start);
            }
        }

        $restHours = floor($restDiffInSeconds / 3600);
        $restMinutes = floor(($restDiffInSeconds % 3600) / 60);
        $restSeconds = $restDiffInSeconds % 60;
        $time->restFormattedDiff = sprintf('%02d:%02d:%02d', $restHours, $restMinutes, $restSeconds);
    }

        return view('attendance', compact('times','currentDate', 'dates', 'previousDate', 'nextDate'));

    }

}
