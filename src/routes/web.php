<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\RestController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [UserController::class, 'index']);

//TimeControllerで勤務開始・勤務終了ボタンのデータを送信
Route::post('/time/start', [TimeController::class, 'start'])->name('time.start');
Route::post('/time/end', [TimeController::class, 'end'])->name('time.end');

//RestControllerで休憩開始・休憩終了ボタンのデータを送信
Route::post('/rest/start', [RestController::class, 'start'])->name('rest.start');
Route::post('/rest/end', [RestController::class, 'end'])->name('rest.end');

//日付別勤怠ページでのデータの取得
Route::get('/attendance', [TimeController::class, 'attendance'])->name('attendance');

//ユーザー一覧ページでの情報取得
Route::get('/user-index', [UserController::class, 'userIndex']);
