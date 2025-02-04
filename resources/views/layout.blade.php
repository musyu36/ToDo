<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
  @yield('styles')
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
  <nav class="my-navbar">
    <a class="my-navbar-brand" href="/">ToDo App</a>
    <div class="my-navbar-control">
    <!-- Auth:checkでログイン状態をチェック -->
      @if(Auth::check())
      <!-- Auth:userでログイン中のユーザを取得、返り値はUserモデルのインスタンス、コントローラなどでも使用可能 -->
        <span class="my-navbar-item">ようこそ, {{ Auth::user()->name }}さん</span>
        ｜
        <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      @else
        <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
        ｜
        <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
      @endif
    </div>
  </nav>
</header>
<main>
  @yield('content')
</main>
@if(Auth::check())
  <script>
    document.getElementById('logout').addEventListener('click', function(event) {
      // preventDefaultでデフォルトの動作を防ぐ(ここではaタグのhrefに遷移)
      event.preventDefault();
      // route('logout')のURLにPOSTリクエストを送信するだけでログアウト可能
      // ログアウトリンクのクリックイベントでリンクのログアウトボタンの下のフォームを送信している,POSTリクエストに必要なデータはCSRFトークンのみ
      document.getElementById('logout-form').submit();
    });
  </script>
@endif
@yield('scripts')
</body>
</html>