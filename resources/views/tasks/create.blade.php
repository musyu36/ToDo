<!-- resources/views/layout.blade.phpをレイアウトファイルとして使用,つまりこのファイルをlayoutにextend,引数にはresources/viewからの相対パス -->
@extends('layout')

<!-- layout.blade.phpのyield 'styles'に対応 -->
@section('styles')
  @include('share.flatpickr.styles')
@endsection

<!-- layout.blade.phpのyield 'content'に対応 -->
@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">タスクを追加する</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('tasks.create', ['folder' => $folder_id]) }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
              </div>
              <div class="form-group">
                <label for="due_date">期限</label>
                <input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') }}" />
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

<!-- layout.blade.phpのyield 'scripts'に対応 -->
@section('scripts')
  @include('share.flatpickr.scripts')
@endsection