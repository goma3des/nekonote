@extends('layouts.admin')
@section('title', '依頼詳細内容')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h3>掲示板詳細情報</h3>
    </div>
    <div class="float-right">
    @if (Auth::user()->id === $order->client_id)
      <a href="{{ action('Admin\OrderController@edit', ['id' => $order->id] )}}" role="button" class="btn btn-secondary mb-4 mr-2">編集</a>

      <a href="{{ action('Admin\OrderController@delete', ['id' => $order->id] )}}" role="button" class="btn btn-secondary mb-4">削除</a>
    @endif
    </div>
  </div>

  <div class="row">
    <div class="order-info col-md-11 mx-auto">
      <div class="row">
        <table class="table table-bordered bg-white">
          <tbody>
            <th width="20%">タイトル</th>
            <th width="80%">{{ $order->title }}</th>
          </tbody>
          <tbody>
            <th width="20%">依頼者</th>
            <td width="80%">
              @if (empty($order->client()->name))
                ユーザは不在です。
              @else
              <a href="{{ action('Admin\UserController@show', ['id' => $order->client()->id]) }}">{{ $order->client()->name }}</a>
              @endif
            </td>
          </tbody>
          @if (!empty($order->enabler()->name))
          <tbody>
            <th width="20%">応対者</th>
            <td width="80%"><a href="{{ action('Admin\UserController@show', ['id' => $order->enabler()->id]) }}">{{ $order->enabler()->name }}</a></td>
          </tbody>
          @endif
          <tbody>
            <th width="20%">依頼内容</th>
            <td width="80%">{{ $order->content }}</td>
          </tbody>
          <tbody>
            <th width="20%">必要スキル</th>
            <td width="80%">{{ $order->required_skill }}</td>
          </tbody>
          <tbody>
            <th width="20%">期限</th>
            <td width="80%">{{ $order->deadline }}</td>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-8">
      <h4>コメント欄</h4>
    </div>
  </div>
    <div class="row">
      <div class="order-info col-md-12 mx-auto">
        <form action="{{ action('Admin\OrderController@inquire') }}" method="post">
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
        <div class="form-inline col-md-12 mb-4 mx-auto">
          <input type="text" class="form-control col-md-11 mr-4" name="inquiry" value="{{ old('inquiry') }}">
            {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $order->id }}">
          <input type="submit" class="btn btn-secondary" value="投稿">
        </div>
        </form>

        <div clas="row">
          @foreach ($messages as $message)
            @if (!empty($message) && $message->order_id == $order->id)
              <label class="col-md-10"><a href="{{ action('Admin\UserController@show', ['id'=>$message->user_id]) }}">{{ $message->userid()->name }}</a>さんのコメント 投稿日時：{{ $message->updated_at }}</label>
                @if ($message->user_id == Auth::user()->id)
                  <a class="text-right" href="{{ action('Admin\OrderController@deleteinquiry', ['id' => $message->id]) }}">削除</a>
                @endif

            <div class="col-md-11 border rounded mb-3 pt-2 pb-2 bg-white">
              {{ $message->inquiry }}
            </div>
            @endif
          @endforeach
        </div>
      </div>
    </div>


    <div class="btn-toolbar float-right mt-4">
        @if ($order->client()->id != Auth::user()->id && $order->status == '0')
        <a href="{{ action('Admin\OrderController@accept', ['id' => $order->id]) }}" role="button" class="ml-2 btn btn-secondary">依頼を受ける</a>
        @endif
        @if ($order->client()->id == Auth::user()->id && $order->status == '1')
        <a href="{{ action('Admin\OrderController@evaluate_enabler', ['id' => $order->id]) }}" role="button" class="ml-2 btn btn-secondary">対応者の評価をする</a>
        @elseif ($order->client()->id != Auth::user()->id && !empty($order->enabler()->id) && $order->enabler()->id == Auth::user()->id && $order->status == '1')
        <a href="{{ action('Admin\OrderController@evaluate_client', ['id' => $order->id]) }}" role="button" class="ml-2 btn btn-secondary">依頼者の評価をする</a>
        @endif
        <a href="{{ action('MainController@index') }}" role="button" class="ml-2 btn btn-secondary">戻る</a>
    </div>



</div>
@endsection
