@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">「{{ $order->title }}」の依頼を受けました！</div>
                  <div class="card-body">
                    <div>
                      この先はこちらのEmailに直接ご連絡してやり取りをしてください。
                    </div>
                    <div class="text-center mt-4 mb-4">
                      {{$order->client()->email}}
                    </div>
                    <div class=text-right>
                    <a href="{{ action('MainController@index')}}" role="button" class="btn btn-secondary mt-2">戻る</a>
                    </div>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
