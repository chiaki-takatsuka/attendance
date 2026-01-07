@extends('attendance.base')

@section('title', '勤怠一覧')
@section('css')
<link href="{{ asset('css/attendance-list.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="attendance-list">


    <h1>勤怠一覧</h1>
    @foreach ($users as $user)
    {{ $user->name }}さんの勤怠一覧<br>
    @endforeach
    <form action="{{ route('attendance.list') }}" method="GET">
        <select name="year">
            @for ($y = 2025; $y <= 2026; $y++)
                <option value="{{ $y }}" {{ (int)request('year') === $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
        </select>
        <select name="month">
            @for ($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}" {{ (int)request('month') === $m ? 'selected' : '' }}>{{ $m }}</option>
                @endfor
        </select>
        <button type="submit">表示</button>
    </form>
    @if ($message)
    <p style="color:red;">{{ $message }}</p>
    @endif
    <table>
        <thead>
            <tr>
                <th>日付</th>
                <th>曜日</th>
                <th>出勤時刻</th>
                <th>退勤時刻</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($calendars as $calendar)
            @php
            $attendance = $attendances[$calendar->calendar_date] ?? null;
            @endphp
            <tr>
                <td>{{ $calendar->calendar_date }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($calendar->calendar_date)->locale('ja')->dayName }}
                </td>

                <td>
                    @if ($attendance && $attendance->clock_in)
                    {{ $attendance->clock_in }}
                    @else
                    -----
                    @endif
                </td>

                <td>
                    @if ($attendance && $attendance->clock_out)
                    {{ $attendance->clock_out }}
                    @else
                    -----
                    @endif
                </td>
                <td>
                    @if ($calendar && $calendar->holiday_name)
                    {{$calendar->holiday_name }}
                    @else
                    -
                    @endif
                </td>


            </tr>
            @endforeach
        </tbody>
    </table>


</div>
@endsection