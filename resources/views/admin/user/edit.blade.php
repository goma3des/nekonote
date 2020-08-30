@extends('layouts.admin')
@section('title', 'アカウント編集')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2>アカウント編集</h2>
        <form action="{{ action('Admin\UserController@update') }}" method="post" enctype="multipart/form-data">
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif

          <div class="form-group row">
            <label class="col-md-2" for="email">Email</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="email" value="{{ $user->email }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="name">ユーザ名</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="name" value="{{ $user->name }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="image">画像</label>
            <div class="col-md-10">
              <input type="file" class="form-control-file" name="image" value="{{ $user->image_path }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="gender">性別</label>
            <div class="radio-inline">
              <input type="radio" name="gender" value="1" <?php if($user->gender == '1'){echo 'checked';} ?> id="male">
                <label for ="male">男性  </label>
              <input type="radio" name="gender" value="2" <?php if($user->gender == '2'){echo 'checked';} ?> id="female">
                <label for="female">女性  </label>
              <input type="radio" name="gender" value="3" <?php if($user->gender == '3'){echo 'checked';} ?> id="other">
                <label for="other">その他</label>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="occupation">職種</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="occupation" value="{{ $user->occupation }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="skill">スキル</label>
            <div class="col-md-10">
              <textarea class="form-control" name="skill" row="10">{{ $user->skill }}</textarea>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="personality">性格</label>
            <div class="col-md-10">
              <textarea class="form-control" name="personality" rows="10">{{ $user->personality }}</textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-10">
              <input type="hidden" name="id" value="{{ $user->id }}">
              {{ csrf_field() }}
              <input type="submit" class="btn btn-secondary" value="更新">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
