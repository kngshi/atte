<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Time;
use App\Models\Rest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index(){

        $user= User::select('id')->get();

        return view('index', compact('user'));
    }

    public function userIndex(){

        $users = User::Paginate(5);

        return view('user-index', compact('users'));
    }


    public function userAttendance(){

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

        return view('attendance', compact('user','times','currentDate', 'dates', 'previousDate', 'nextDate'));

    }

}
