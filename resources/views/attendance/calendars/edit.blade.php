@extends('attendance.base')

@section('title', '勤怠')
@section('css')
<link href="{{ asset('css/attendance-calendar.css') }}" rel="stylesheet">
@endsection


@section('content')
<div class="attendance-calendar">
  <form action="{{ route('attendance.calendars.update', ['calendar' => $calendar]) }}" method="POST">
    @csrf
    @method('PATCH')
    @include('attendance.calendars.form-controls', ['readOnly' => false])
    <div>
      <button type="button" class="btn btn-secondary" onclick="clearHolidayName()">
        クリア
      </button>

      <script>
        function clearHolidayName() {
          document.getElementById('inputName').value = '';
        }
      </script>

      <button type="submit" class="btn btn-primary">更新</button>

    </div><br>
    <a href="{{ route('attendance.calendars.index') }}">休日一覧へ</a><br>

  </form>
</div>
@endsection

@section('script')

@endsection