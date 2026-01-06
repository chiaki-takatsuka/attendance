<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\AttendanceUser;
use App\Models\Calendar;
use Carbon\Carbon;


class ListController extends Controller
{

    //
    public function index(Request $request)
    {
        // ① 表示したい年・月（未指定なら今月）
        $year  = $request->input('year', Carbon::today()->year);
        $month = $request->input('month', Carbon::today()->month);

        // ② その月の開始日・終了日を作る
        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth   = Carbon::create($year, $month, 1)->endOfMonth();

        // ③ カレンダーテーブルから「その月の日付一覧」を取得
        $calendars = Calendar::whereBetween('calendar_date', [
            $startOfMonth->toDateString(),
            $endOfMonth->toDateString(),
        ])
            ->orderBy('calendar_date')
            ->get();

        $calendars = Calendar::whereYear('calendar_date', $year)
            ->whereMonth('calendar_date', $month)
            ->orderBy('calendar_date')
            ->get();

        // 存在しない月用のメッセージ
        $message = null;
        if ($calendars->isEmpty()) {
            $message = '選択された月のデータは存在しません。';
        }


        // ④ 勤怠テーブルから「その月の勤怠」を取得（user_id=1 仮）
        //    日付をキーにしておく（bladeで使いやすくする）
        $attendances = Attendance::where('user_id', 1)
            ->whereBetween('calendar_date', [
                $startOfMonth->toDateString(),
                $endOfMonth->toDateString(),
            ])
            ->get()
            ->keyBy('calendar_date');

        // ⑤ ユーザー（今回は仮でid=1）
        $users = AttendanceUser::where('id', 1)->get();

        // ⑥ view に渡す
        return view('attendance.list', compact(
            'calendars',
            'attendances',
            'users',
            'year',
            'month',
            'message'
        ));
    }
}
