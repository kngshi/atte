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
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [UserController::class, 'index']);
Route::post('/', [TimeController::class, 'store']);

// この下に、RestControllerでupdateアクションを作れば良い？
// Route::post('/', [RestController::class, 'update']);
Route::post('/', [RestController::class, 'update']);
Route::get('/attendance', [TimeController::class, 'attendance']);
