@extends('attendance.base')

@section('title', '勤怠')
@section('css')
<link href="{{ asset('css/attendance-calendar.css') }}" rel="stylesheet">
@endsection


@section('content')
<div class="attendance-calendar">
    {{-- 休日 更新完了時のコメント --}}
    @if (session('messages.success'))
    <div class="alert alert-success">
        <p style="color:blue;">{{ session('messages.success') }}</p>
    </div>
    @endif

    <form action="{{ route('attendance.calendars.index') }}" method="GET">
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

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>日付</th>
                    <th>休日名</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($calendars as $calendar)
                <tr>
                    <td>{{ $calendar->calendar_date }}</td>
                    <td>{{ $calendar->holiday_name }}</td>
                    <td>
                        <a href="{{ route('attendance.calendars.edit', ['calendar' => $calendar]) }}"
                            class="btn btn-primary btn-sm">
                            編集
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($message)
        <p style="color:red;">{{ $message }}</p>
        @endif

    </div>
</div>
@endsection

@section('script')
<script>
    $(function() {
        // Modal
        $('#deleteModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const modal = $(this);

            modal.find('#deleteTargetText').text(button.data('text'));
            modal.find('form').attr('action', button.data('action'));
        })
    });
</script>
@endsection