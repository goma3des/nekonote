@extends('layouts.admin')
@section('title', 'アカウント新規作成')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2>アカウント作成</h2>
        <form action="{{ action('Admin\UserController@create') }}" method="post" enctype="multipart/form-data">
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif

          <div class="form-group row">
            <label class="col-md-2" for="name">ユーザ名</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="password">パスワード</label>
            <div class="col-md-10">
              <input type="password" class="form-control" name="password" value="{{ old('password') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="email">Email</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="email" value="{{ old('email') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="gender">性別</label>
            <div class="radio-inline">
              <input type="radio" name="gender" value="1" id="male">
                <label for ="male">男性  </label>
              <input type="radio" name="gender" value="2" id="female">
                <label for="female">女性  </label>
              <input type="radio" name="gender" value="3" id="other">
                <label for="other">その他</label>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="occupation">職種</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="occupation" value="{{ old('occupation') }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="skill">スキル</label>
            <div class="col-md-8">
              <input type="text" class="form-control" name="skill" value="{{ old('skill') }}">
            </div>
            <div class="col-md-2">
              <input type="text" class="form-control" name="slevel" value="{{ old ('slevel') }}">
            </div>
          </div>
          <p class="text-right">
            レベル：１→初心者レベル、２→中級者レベル、３→上級者レベル
          </p>
          <div class="text-right">
          <input type="submit" class="btn btn-secondary mb-4" value="追加" >
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="personality">性格</label>
            <div class="col-md-10">
              <textarea class="form-control" name="personality" rows="10">{{ old('personality') }}</textarea>
            </div>
          </div>
          {{ csrf_field() }}
          <div class="text-right">
          <input type="submit" class="btn btn-secondary" value="登録">
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
