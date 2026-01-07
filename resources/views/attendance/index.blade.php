@extends('attendance.base')

@section('title', '勤怠')
@section('css')
<link href="{{ asset('css/attendance-index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="attendance-index">

  <h1>勤怠メニュー</h1>

  <a href="{{ route('attendance.punch') }}">勤怠打刻</a><br>
  <a href="{{ route('attendance.list') }}">勤怠一覧</a><br>
  <a href="{{ route('attendance.calendars.index') }}">休日編集</a><br>

</div>

@endsection