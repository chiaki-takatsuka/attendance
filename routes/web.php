<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\CalendarController;

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

    Route::get('/punch', [AttendanceController::class, 'index'])
        ->name('punch');

    Route::post('/punch', [AttendanceController::class, 'store'])
        ->name('store');  //Attendance@store

    Route::get('/list', [ListController::class, 'index'])
        ->name('list');    //勤怠一覧画面を表示


});
Route::prefix('attendance')->name('attendance')->group(function () {
    // attendance    attendance
    Route::view('', 'attendance.index')->name('.index'); //     // \App\Http\Controllers\CalendarController
    Route::prefix('calendars')->name('.calendars')->controller(CalendarController::class)->group(function () {
        // attendance/calendar    attendance.calendar
        Route::get('', 'index')->name('.index'); // attendance/calendars   attendance.calendar.index › CalendarController@index

        Route::patch('{calendar}', 'update')->name('.update'); // attendance/calendar/{calendar}     attendance.calendar.update › CalendarController@update
        Route::get('{calendar}/edit', 'edit')->name('.edit'); // attendance/calendar/{calendar}  /edit    admin.jobs.edit › CalendarController@edit

    });
});
