@extends('attendance.base')

@section('title', '勤怠打刻')
@section('css')
<link href="{{ asset('css/attendance-punch.css') }}" rel="stylesheet">
@endsection


@section('content')

<div class=attendance-punch>
    <h1>勤怠打刻画面</h1>
    @if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    <form method="POST" action="{{ route('attendance.store') }}">

        @csrf
        <h3>
            <div id='day'></div>
        </h3>
        <h2>
            <div id="clock"></div>
        </h2>


        <button type="submit" name="action" value="clock_in">
            出勤
        </button>


        <button type="submit" name="action" value="clock_out">
            退勤
        </button>
    </form>
</div>
<script>
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('clock').innerText = `${hours}:${minutes}:${seconds}`;
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const date = String(now.getDate()).padStart(2, '0');
        const day = now.getDay();
        const days = ["日", "月", "火", "水", "木", "金", "土"];
        document.getElementById('day').innerText = `${month}月${date}日(${days[day]})`;
    }

    // 1秒ごとに時刻を更新
    setInterval(updateClock, 1000);

    // ページロード時に初期時刻を表示
    updateClock();
</script>


@endsection