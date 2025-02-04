@extends('layout')

@section('content')
    <div class="container">
      <div class="row">
        <div class="col col-md-offset-3 col-md-6">
          <nav class="panel panel-default">
            <div class="panel-heading">フォルダを追加する</div>
            <div class="panel-body">
            <!-- フォームに違反があれば自動的に入力画面にリダイレクト、、違反内容は$errors変数に詰めてテンプレートに渡されている -->
            @if($errors->any())
                <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                </div>
            @endif
              <form action="{{ route('folders.create') }}" method="post">
              <!-- csrfトークンを使用して自サイトからのPOSTリクエストしか受け付けないようにする -->
                @csrf
                <div class="form-group">
                  <label for="title">フォルダ名</label>
                  <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}"/>
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary">送信</button>
                </div>
              </form>
            </div>
          </nav>
        </div>
      </div>
    </div>
@endsection