@extends('layouts.admin')
@section('title', '評価入力画面')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h3>応対者の評価をしましょう</h3>
    </div>
  </div>

  <div class="row">
    <div class="order-info col-md-11 mx-auto">
      <div clas="row">
        <table class="table table-bordered bg-white">
          <tbody>
            <th width="20%">タイトル</th>
            <td width="80%">{{ $order->title }}</td>
          </tbody>
          <tbody>
            <th width="20%">依頼者</th>
            <td width="80%">
              @if (empty($order->client()->name))
                ユーザは不在です。
              @else
              <a href="{{ action('Admin\OrderController@show', ['id' => $order->client()->id]) }}">{{ $order->client()->name }}</a>
              @endif
            </td>
          </tbody>
          <tbody>
            <th width="20%">応対者</th>
            <td width="80%">{{ $order->enabler()->name }}</td>
          </tbody>
          <form action="{{ action('Admin\OrderController@evaluate_enabler') }}" method="post">
            @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
            @endif
          <tbody>
              <th width="20%">評価</th>
              <td width="80%">
                  <div class="evaluation text-left">
                    <input id ="paw1" type="radio" name="enabler_eval_point" value="5">
                    <label for="paw1"><i class="fa fa-paw mr-1"></i> </label>
                    <input id ="paw2" type="radio" name="enabler_eval_point" value="4">
                    <label for="paw2"><i class="fa fa-paw mr-1"></i></label>
                    <input id ="paw3" type="radio" name="enabler_eval_point" value="3">
                    <label for="paw3"><i class="fa fa-paw mr-1"></i></label>
                    <input id ="paw4" type="radio" name="enabler_eval_point" value="2">
                    <label for="paw4"><i class="fa fa-paw mr-1"></i></label>
                    <input id ="paw5" type="radio" name="enabler_eval_point" value="1">
                    <label for="paw5"><i class="fa fa-paw mr-1"></i></label>
                  </div>
              </td>
            </tbody>
            <tbody>
              <th width="20%">評価のポイント</th>
              <td width="80%">
                <input type="text" class="form-control" name="enabler_assessment" value="{{ old('enabler_assessment') }}">
              </td>
            </tbody>
            <!-- <tbody>
                <th width="20%">依頼を終了する</th>
                <td width="80%">
                    <div class="status text-left">
                      <input id ="yes" type="radio" name="status" value=2>
                      <label for="yes">はい</label>
                      <input id ="no" type="radio" name="status" value=1>
                      <label for="no">いいえ</label>
                    </div>
                </td>
              </tbody> -->

            </table>
            <div class="text-right">
              <input type="hidden" name="id" value="{{ $order->id }}">
              {{ csrf_field() }}
              <input type="submit" class="btn btn-secondary pull-right" value="評価">
              <a href="{{ action('Admin\OrderController@show', ['id' => $order->id]) }}" type="button" class="btn btn-secondary">戻る</a>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection
