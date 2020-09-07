@extends('layouts.front')

@section('content')
<div class="container">
  <hr color="#c0c0c0">
    <div class="row">
      <div class="top col-md-10 mx-auto">
        <p>ようこそ、ねこのてシェアリングへ！<br>業務時間を有効活用したい、自分のスキルを役立てたい、猫の手が借りたいほど忙しい、そんな人を結びつけるためのサービスです。</p>
      </div>
    </div>

    <div class="row">
      <div class="flex-container">
        @foreach($orders as $order)
        <div class="flex-item">
            <div class="card mx-2 shadow-sm">
              <div class="card-body text-dark">
                <h4 class="card-title">{{ Str::limit($order->title, 50) }}</h4>
                <ul class="list-unstyled mt-3 mb-4">
                  <li>
                    @if (empty($order->client()->name))
                      依頼者：ユーザは不在です。
                    @else
                    依頼者：<a href="{{ action('Admin\UserController@show', ['id' => $order->client()->id]) }}">{{ $order->client()->name }}</a>
                    @endif
                  </li>
                  <li>必要とするスキル：</li>
                  <li class="skill">{{ Str::limit($order->required_skill, 90) }}</li>
                  <li>期限：{{ $order->deadline }}</li>
                </ul>
                @switch ($order->status)
                  @case('0')
                    <a href="{{ action('Admin\OrderController@show', ['id' => $order->id]) }}" role="button" class="btn btn-success">募集中</a>
                    @break
                  @case('1')
                    <a href="{{ action('Admin\OrderController@show', ['id' => $order->id]) }}" role="button" class="btn btn-warning">対応中</a>
                    @break
                  @case('2')
                    <a href="{{ action('Admin\OrderController@show', ['id' => $order->id]) }}" role="button" class="btn btn-secondary">終了</a>
                    @break
                @endswitch
                <a href="{{ action('Admin\OrderController@show', ['id' => $order->id]) }}" class="pull-right">詳細を見る</a>
              </div>
            </div>
        </div>
        @endforeach
      </div>
    </div>
</div>
@endsection
