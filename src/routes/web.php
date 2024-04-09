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
require __DIR__.'/auth.php';

Route::get('/', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('index');

Route::post('/time/start', [TimeController::class, 'start'])->name('time.start');
Route::post('/time/end', [TimeController::class, 'end'])->name('time.end');

Route::post('/rest/start', [RestController::class, 'start'])->name('rest.start');
Route::post('/rest/end', [RestController::class, 'end'])->name('rest.end');

Route::get('/attendance', [TimeController::class, 'attendance'])->name('attendance');
Route::get('/user-index', [UserController::class, 'userIndex']);
