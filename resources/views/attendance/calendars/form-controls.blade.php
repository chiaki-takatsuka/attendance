<div class="form-group row">
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inputId" value="{{ $calendar->calendar_date ?? '' }}" disabled>
  </div>
</div>
<div class="form-group row">
  <label for="inputName" class="col-sm-2 col-form-label">休日名</label>
  <div class="col-sm-10">
    <input type="text" class="form-control @error('holiday_name') is-invalid @enderror" id="inputName" name="holiday_name" placeholder="名称を入力してください。" value="{{ old('holiday_name', $calendar->holiday_name ?? '') }}" {{ $readOnly ? ' readonly="readonly"' : '' }}>

    @error('holiday_name')
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
  </div>
</div>