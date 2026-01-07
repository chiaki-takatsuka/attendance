<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- 共通CSSを読み込ませる --}}
    <link href="{{ asset('css/attendance.css') }}" rel="stylesheet">
    {{-- 子blade用のCSSを読み込ませる --}}
    @yield('css')

</head>

<body>
    <header>


        {{-- 上ナビバー --}}
        <nav class="navbar">
            <ul>
                <li><a href="{{ route('attendance.index') }}">ホーム画面</a></li>
                <li><a href="{{ route('attendance.punch') }}">勤怠打刻</a></li>
                <li><a href="{{ route('attendance.list') }}">勤怠一覧</a></li>
                <li><a href="{{ route('attendance.calendars.index') }}">休日編集</a></li>
            </ul>
        </nav>
    </header>

    {{-- 内容--}}
    <main>
        @yield('content')
    </main>


    {{-- 下部 メニュ画面へ --}}
    <footer>
        <a href="{{ route('attendance.index') }}">ホーム画面へ</a>
    </footer>
</body>

</html>