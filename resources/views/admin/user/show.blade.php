@extends('layouts.admin')
@section('title', 'アカウント')

@section('content')
  <div class="container">
    <div class="row">
        <h3 class="col-md-6">{{ $user->name }}さんのアカウント</h3>
        <div class=" col-md-6 text-right mb-3">
          @if (Auth::user()->id === $user->id)
          <a href="{{ action('Admin\UserController@edit', ['id' => $user->id]) }}" role="button" class="btn btn-secondary">アカウント情報変更</a>
          <a href="{{ action('Admin\UserController@delete', ['id' => $user->id]) }}" role="button" class="btn btn-secondary">アカウント削除</a>
          @endif
        </div>
    </div>
    <div class="row">
      <div class="user-profile col-md-4">
        @if (empty($user->image_path))
          <img src="{{ asset('storage/image/neko.jpg') }}" class="img-fluid img-responsive">
        @else
          <img src="{{ asset('storage/image/' . $user->image_path) }}" class="img-fluid img-responsive">
        @endif
      </div>
      <div class="user-info col-md-8">
        <div class="row">
          <table class="table table-bordered bg-white">
              <tbody>
                <th width="20%">性別</th>
                <td width="80%">
                  @switch($user->gender)
                    @case(1)
                      男性
                      @break
                    @case(2)
                      女性
                      @break
                    @case(3)
                      その他
                      @break
                    @endswitch
                  </td>
              </tbody>
              <tbody>
                <th width="20%">職種</th>
                <td width="80%">{{ $user->occupation }}</td>
              </tbody>
              <tbody>
                <th width="20%">スキル</th>
                <td width="80%">{{ $user->skill }}</td>
              </tbody>
              <tbody>
                <th width="20%">性格</th>
                <td width="80%">{{ $user->personality }}</td>
              </tbody>
              <tbody>
                <th width="20%">保有ポイント</th>
                <td width="80%">{{ $user->point }}　ポイント</td>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    <div class="row mt-3">
        <h3>依頼案件履歴</h3>
    </div>
    <div class="row">
      <div class="user-info col-md-12 mx-auto">
        <div class="row">
          <table class="table table-bordered bg-white">
            <thread>
              <tr>
                <th width="20%">案件名</th>
                <th width="10%">応対者名</th>
                <th width="10%">ステータス</th>
                <th width="10%">評価</th>
                <th width="50%">評価のポイント</th>
              </tr>
            </thread>
            <tbody>
              @foreach($orders as $order)
                <tr>
                  <td><a href="{{ action('Admin\OrderController@show', ['id' => $order->id ]) }}">{{ $order->title }}</a></td>
                  <td>{{ $order_name[$loop->index]['name'] }}</td>
                  <td>
                    @switch($order->status)
                      @case(0)
                        募集中
                        @break;
                      @case(1)
                        対応中
                        @break;
                      @case(2)
                        終了
                        @break;
                    @endswitch</td>
                  <td>{{ $order->client_eval_point }}</td>
                  <td>{{ $order->client_assessment }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="row">
        <h3>お手伝い案件履歴</h3>
    </div>
    <div class="row">
      <div class="user-info col-md-12 mx-auto">
        <div class="row">
          <table class="table table-bordered bg-white">
            <thread>
              <tr>
                <th width="20%">案件名</th>
                <th width="10%">依頼者名</th>
                <th width="10%">ステータス</th>
                <th width="10%">評価</th>
                <th width="50%">評価のポイント</th>
              </tr>
            </thread>
            <tbody>
              @foreach($accepts as $accept)
                <tr>
                  <td><a href="{{ action('Admin\OrderController@show', ['id' => $accept->id ]) }}">{{ $accept->title }}</a></td>
                  <td>{{ $accept_name[$loop->index]['name'] }}</td>
                  <td>
                    @switch($accept->status)
                      @case(0)
                        募集中
                        @break;
                      @case(1)
                        対応中
                        @break;
                      @case(2)
                        終了
                        @break;
                    @endswitch
                  </td>
                  <td>{{ $accept->enabler_eval_point }}</td>
                  <td>{{ $accept->enabler_assessment }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

@endsection
