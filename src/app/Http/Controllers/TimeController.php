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
    // このアクションは、打刻ページで入力した内容をpostで送信
    public function store(Request $request)
    {
        $user = Auth::id();
        $time = Carbon::now();
        $date = Carbon::now()->format('Y-m-d');

        //勤務開始
        $work_start = Carbon::now();
        //勤務終了
        $work_end = Carbon::now();
        //勤務時間
        $work_total = $work_end->diff($work_start)->format('%H:%I:%S');

        Time::create([
            'user_id'=>$user,
            'date' => $date,
            'work_start' => $work_start->addHour(),
            'work_end' => $work_end->addHour(),
        ]);       

        $rest_start = Carbon::now();
        $rest_end = Carbon::now();

        $rest_total = $rest_end->diff($rest_start)-> format('%H:%I:%S');




        return view( 'index', compact('user','time','work_start','work_end','work_total','rest_total'));
    }


    public function start()
    {
        $user = Auth::id();
        $latest_time = Time::latest()->first();
        $work_start = Carbon::now();
        $date = Carbon::now();
        $buttonDisabled = false;

        if ($latest_time && $latest_time->work_start !== null) {
        $buttonDisabled = true;
    } 

    Time::create([
        'user_id' => $user,
        'date' => $date,
        'work_start' => $work_start,
    ]);


    // リダイレクトなどの適切なレスポンスを返す
    return view( 'index', compact('user','date','work_start','buttonDisabled'));
}

    public function end()
{
    $user = Auth::id();
    $work_end = Carbon::now();
    $buttonDisabled = false;

    // 最新の勤務レコードを取得
    $lastRecord = Time::where('user_id', $user)->latest()->first();

    if ($lastRecord && $lastRecord->work_start !== null) {
        $buttonDisabled = true; // ボタンを非活性化
    }

    if ($lastRecord) {
        $lastRecord->update([
            'work_end' => $work_end,
        ]);
    }

    // リダイレクトなどの適切なレスポンスを返す
     return view( 'index', compact('user','work_end','buttonDisabled'));
}


    // このアクションは、getメソッドで取得
    public function attendance()
    {

        $times = Time::simplePaginate(7);

        $timesByDate = Time::where('user_id', auth()->id())
                        ->orderBy('date', 'desc')
                        ->paginate(10);
        
        return view('attendance', compact('times','timesByDate'));
    }


}
