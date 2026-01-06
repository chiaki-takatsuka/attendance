<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public function index() //打刻画面を表示
    {
        return view('attendance.punch');
    }


    public function store(Request $request)
    {
        $today = now()->toDateString();
        $userId = 1; // 仮

        // 今日の勤怠を取得
        $attendance = Attendance::where('user_id', $userId)
            ->where('calendar_date', $today)
            ->first();

        if ($request->action === 'clock_in') {

            // すでに出勤済み
            if ($attendance) {
                return redirect()
                    ->route('attendance.punch')
                    ->with('error', 'すでに出勤打刻済です');
            }

            Attendance::create([
                'user_id' => $userId,
                'calendar_date' => $today,
                'clock_in' => now(),
            ]);

            return redirect()
                ->route('attendance.punch')
                ->with('success', '出勤打刻しました');
        }

        if ($request->action === 'clock_out') {

            // 出勤していないのに退勤
            if (!$attendance) {
                return redirect()
                    ->route('attendance.punch')
                    ->with('error', '出勤打刻がありません');
            }

            // すでに退勤済み
            if ($attendance->clock_out) {
                return redirect()
                    ->route('attendance.punch')
                    ->with('error', 'すでに退勤打刻済です');
            }

            $attendance->update([
                'clock_out' => now(),
            ]);

            return redirect()
                ->route('attendance.punch')
                ->with('success', '退勤打刻しました');
        }

        abort(400);
    }
}
