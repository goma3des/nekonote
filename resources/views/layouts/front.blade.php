<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front.css') }}" rel="stylesheet">
  </head>

  <body>
    <div id="app">
      <nav class="navbar navbar-expand-md navbar-light bg-secondary shadow-sm">
        <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fa fa-paw"></i> ねこのてシェアリング  <i class="fa fa-paw"></i>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left side of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right side of Navbar -->
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="{{ action('Admin\OrderController@add') }}">依頼する</a>
              </li>
              @guest
              <li>
                <a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a>
              </li>
              <li>
                <a class="nav-link" href="{{ route('register') }}">{{ __('messages.Register') }}</a>
              </li>
              @else
              <li class="nav-item">
                @if (empty(Auth::user()->image_path))
                  <a class="nav-link" href="{{ action('Admin\UserController@show', ['id' => Auth::user()->id]) }}"><img src="https://nekonote-sharing.s3-ap-northeast-1.amazonaws.com/neko.jpg" style="width:25px;height:25px" class="rounded-circle">{{ Auth::user()->name }}</a>
                @else
                  <a class="nav-link" href="{{ action('Admin\UserController@show', ['id' => Auth::user()->id]) }}"><img src="{{ Auth::user()->image_path }}" style="width:25px;height:25px" class="rounded-circle">{{ Auth::user()->name }}</a>
                @endif
              </li>
              <li>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('messages.Logout') }}</a>
              </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
                @endguest
            </ul>

          </div>
        </div>
      </nav>

      <main class="py-4">
        @yield('content')
      </main>

    </div>
  </body>
</html>
