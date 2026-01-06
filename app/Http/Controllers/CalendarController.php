<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Calendar;
use App\Http\Requests\UpdateCalendarRequest;
use Carbon\Carbon;


class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *  @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        // ① 表示したい年・月（未指定なら今月）
        $year  = $request->input('year', Carbon::today()->year);
        $month = $request->input('month', Carbon::today()->month);

        // ② その月の開始日・終了日を作る
        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth   = Carbon::create($year, $month, 1)->endOfMonth();

        // ③ カレンダーテーブルから「その月の日付一覧」を取得
        $calendars = Calendar::whereYear('calendar_date', $year)
            ->whereMonth('calendar_date', $month)
            ->orderBy('calendar_date')
            ->get();



        // 存在しない月用のメッセージ
        $message = null;
        if ($calendars->isEmpty()) {
            $message = '選択された月のデータは存在しません。';
        }



        return view('attendance.calendars.index', [
            'calendars' => $calendars,
            'year' => $year,
            'month' => $month,
            'message' => $message,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendar $calendar)
    {
        // 編集画面
        return view('attendance.calendars.edit', [
            'calendar' => $calendar,
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCalendarRequest  $request
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateCalendarRequest $request, Calendar $calendar)
    {
        // 更新
        $calendar->holiday_name = $request->holiday_name;
        $calendar->update();
        // calendar_date から 年月を取得
        $year  = Carbon::parse($calendar->calendar_date)->year;
        $month = Carbon::parse($calendar->calendar_date)->month;
        return redirect()->route('attendance.calendars.index', [
            'year'  => $year,
            'month' => $month,
        ])->with('messages.success', '更新が完了しました。');
    }
}
