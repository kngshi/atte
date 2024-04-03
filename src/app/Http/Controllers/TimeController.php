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

    Time::create([
        'user_id' => $user,
        'date' => $date,
        'work_start' => $work_start,
    ]);

    
    // リダイレクトなどの適切なレスポンスを返す
    return view( 'index', compact('user','date','work_start','workStartButtonDisabled'));
}

    public function end()
{
    $user = Auth::id();
    $work_end = Carbon::now();

    // 最新の勤務レコードを取得
    $lastRecord = Time::where('user_id', $user)->latest()->first();

    $workEndButtonDisabled = false;

    if ($lastRecord) {
        $lastRecord->update([
            'work_end' => $work_end,
        ]);
    }

       // 勤務開始ボタンの状態を取得
        $workStartButtonDisabled = $lastRecord->work_start !== null;

        // 勤務開始ボタンが押されている場合、勤務終了ボタンを非活性化
        if ($workStartButtonDisabled) {
            $workEndButtonDisabled = true;
        }

    // リダイレクトなどの適切なレスポンスを返す
     return view( 'index', compact('user','work_end','workStartButtonDisabled','workEndButtonDisabled'));
}




    // このアクションは、getメソッドで取得
    public function attendance()
    {

        $date = Carbon::parse(Time::latest('date')->first()->date)->format('Y-m-d');
    $times = Time::paginate(5);
    $rests = Rest::with('time')->get();

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

    
        return view('attendance', compact('times','date'));


    }

    public function default()
    {

        $times = Time::Paginate(7);

        $timesByDate = Time::where('user_id', auth()->id())
                        ->orderBy('date', 'desc')
                        ->paginate(1);

       $date = Carbon::parse(Time::latest('date')->first()->date)->format('Y-m-d');

        foreach ($timesByDate as $timeByDate) {
        
        $work_start = $timeByDate->work_start;
        $work_end = $timeByDate->work_end;

        $rest_start = $timeByDate->rest_start;
        $rest_end = $timeByDate->rest_end;


        if ($work_start && $work_end && $rest_start && $rest_end) {
            
            // 勤務時間の計算
            $work_total = $work_end->diff($work_start)->format('%H:%I:%S');
            // 休憩時間の計算
            $rest_total = $rest_end->diff($rest_start)->format('%H:%I:%S');

             // モデルに計算結果を追加
            $timeByDate->work_total = $work_total;
            $timeByDate->rest_total = $rest_total;

        } else {
            // 時間が取得できない場合はデフォルト値を設定するか、処理をスキップするなど適切な処理を行う
            $timeByDate->work_total = '00:00:00';
            $timeByDate->rest_total = '00:00:00';
        }

        }

        return view('attendance', compact('times','date','timesByDate'));

    }
}
