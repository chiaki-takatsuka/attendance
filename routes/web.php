<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ListController;

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
    return redirect()->route('attendance.index'); // /attendanceにリダイレクト→機能一覧画面が表示される
});

Route::prefix('attendance')->name('attendance.')->group(function () {
    Route::get('/', function () {
        return view('attendance.index'); //機能一覧画面を表示
    })->name('index');

    Route::get('/punch', function () {
        return view('attendance.punch'); //勤怠打刻画面を表示
    })->name('punch');

    Route::post('/punch', [AttendanceController::class, 'store'])
        ->name('store');  //Attendance@store

    Route::get('/list', [ListController::class, 'show'])
        ->name('list');    //勤怠一覧画面を表示

});
