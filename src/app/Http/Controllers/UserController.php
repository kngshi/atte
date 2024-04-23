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
         // セッションに勤務終了ボタンの状態を保存
        session(['workEndButtonDisabled' => true]);
        session(['restStartButtonDisabled' => true]);
        session(['restEndButtonDisabled' => true]);

        return view('index', compact('user'));
    }

    public function userIndex(){

        $users = User::Paginate(5);

        return view('user-index', compact('users'));
    }


    public function userAttendance(){

        $times = Time::all();


        return view('attendance', compact('times'));

    }

}
