<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

use App\Models\Rest;
use App\Models\User;
use App\Models\Time;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class RestController extends Controller
{

    public function start(Request $request)
    {
        session(['restStartButtonDisabled' => true]);
        // セッションに休憩終了ボタンの状態をリセット
        session()->forget('restEndButtonDisabled');
        session(['workEndButtonDisabled' => true]);

        $time = Auth::id();
        // timesテーブルから最新のレコードを取得
        $latest_time = Time::latest()->first();
        $rest_start = Carbon::now();

        if ($latest_time) {
        $time_id = $latest_time->id;
        } else {
        // 最新のレコードが存在しない場合は、エラーメッセージを設定する
        return back()->withErrors('No time record found.');
        }

        $restStartButtonDisabled = false;

        Rest::create([
        'time_id' => $time_id,
        'rest_start' => $rest_start
        ]);

        // リダイレクトなどの適切なレスポンスを返す
        return view( 'index', compact('time_id','rest_start'));
    }

    public function end(Request $request)
    {
        // セッションに休憩終了ボタンの状態を保存
        session(['restEndButtonDisabled' => true]);
        // セッションに休憩開始ボタンの状態を再度活性化
        session()->forget('restStartButtonDisabled');
        session(['workEndButtonDisabled' => false]);

        $user = Auth::id();
        // timesテーブルから最新のレコードを取得
        $latest_time = Time::latest()->first();
        $rest_end = Carbon::now();

        $restEndButtonDisabled = false;

        // 最新のレコードが存在する場合、その time_id を取得
        if ($latest_time) {
        $time_id = $latest_time->id;
        }
        else {
        // 最新のレコードが存在しない場合は、適切なエラー処理を行う
        return back()->withErrors('No time record found.');
        }

        // 最新の勤務レコードを取得
        $rest_record = Rest::where('time_id', $time_id)->latest()->first();

        if ($rest_record) {
        $rest_record->update(['rest_end' => $rest_end]);
        } else {
         // レコードが見つからなかった場合は、適切なエラー処理を行う
        return back()->withErrors('No rest record found for the given time.');
        }

        return view( 'index', compact('time_id','rest_end'));
    }

}
