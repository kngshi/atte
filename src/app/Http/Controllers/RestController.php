<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

use App\Models\Rest;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class RestController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::id();
        $time = Carbon::now()-> format('H:i:s');

        //休憩開始
        $rest_start = Carbon::now();
        echo $rest_start -> format('H:i:s');
        echo "<br />";

        //休憩終了
        $rest_end = Carbon::now();
        echo $rest_end -> format('H:i:s');
        echo "<br />";

        //休憩時間
        $rest_total = $rest_end->diff($rest_start)->format('%H:%I:%S');

        return view( '/attendance', compact('user', 'time','rest_total'));
    }
}
