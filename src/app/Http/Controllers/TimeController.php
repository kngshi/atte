<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

use App\Models\Time;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class TimeController extends Controller
{
    // このアクションは、打刻ページで入力した内容をpostで送信
    public function store(Request $request)
    {
        $user = Auth::id();
        $time = Carbon::now()->format('H:i:s');

        //勤務開始
        $work_start = Carbon::now()-> format('H:i:s');
        ;echo $work_start -> format('H:i:s');
        echo "<br />";

        //勤務終了
        $work_end = Carbon::now()-> format('H:i:s');
        echo $rest_end -> format('H:i:s');
        echo "<br />";
        
        //勤務時間
        $work_total = $work_end->diff($work_start)->format('%H:%I:%S');

        return view( '/attendance', compact('user','work_start', 'work_end', 'work_total'));
    }

    // このアクションは、getメソッドで取得
    public function attendance()
    {
        $user=User::select('name')->where('id', 1)->get();
        $time = Carbon::now()->format('H:i:s');

        return view('/attendance', compact('user','time'));
    }


}
