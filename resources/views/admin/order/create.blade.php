@extends('layouts.admin')

@section('title', '新規依頼画面')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <h2>掲示板の新規作成</h2>
      <form action="{{ action('Admin\OrderController@create') }}" method="post" enctype="multipart/form-data">

        @if (count($errors) > 0)
          <ul>
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        @endif
        <div class="form-group row">
          <label class="col-md-2" for="title">タイトル</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2" for="content">依頼内容</label>
          <div class="col-md-10">
            <textarea class="form-control" name="content" rows="20">{{ old('content') }}</textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2" for="required_skill">スキル</label>
          <div class="col-md-10">
            <textarea class="form-control" name="required_skill" rows="10">{{ old('required_skill') }}</textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2" for="due_date-field">期限</label>
          <div class="col-md-10 input-group date datetimepicker" id="deadline" data-target-input="nearest">
            <input type="text" id="deadline-field" class="form-control datetimepicker-input" name="deadline" data-target="#deadline">
            <div class="input-group-append" data-target="#deadline" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
        </div>
        {{ csrf_field() }}
        <div class="text-right">
          <input type="submit" class="btn btn-secondary" value="登録">
          <a href="{{ action('MainController@index') }}" type="button" class="btn btn-secondary">戻る</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
