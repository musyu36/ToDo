@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダ</div>
          <div class="panel-body">
            <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
              フォルダを追加する
            </a>
          </div>
          <div class="list-group">
            @foreach($folders as $folder)
            <!-- コントローラから渡された$foldersが使える -->
            <!-- 二重括弧で変数展開 -->
            <!-- laravelのroute関数ルート名、URLの変数部分に埋める変数を渡す -->
              <a
                  href="{{ route('tasks.index', ['folder' => $folder->id]) }}"
                  class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}"
              >
              {{$folder->title}}
              <!-- URLのidとhrefのidが一致していればactiveクラスクラス付与 -->
              </a>
            @endforeach
          </div>
        </nav>
      </div>
      <div class="column col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">タスク</div>
          <div class="panel-body">
            <div class="text-right">
              <a href="{{ route('tasks.create', ['folder' => $current_folder_id]) }}" class="btn btn-default btn-block">
                タスクを追加する
              </a>
            </div>
          </div>
          <table class="table">
            <thead>
            <tr>
              <th>タイトル</th>
              <th>状態</th>
              <th>期限</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
              @foreach($tasks as $task)
                <tr>
                  <td>{{ $task->title }}</td>
                  <td>
                  <!-- taskクラスのgetStatusClassAttribute、ここではgetとAttributeを省いてstatus_classと呼び出す、status_labelも同様 -->
                    <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                  </td>
                  <!-- taskクラスのgetFormattedDueDateAttributeメソッドを呼び出す -->
                  <td>{{ $task->formatted_due_date }}</td>
                  <td><a href="{{ route('tasks.edit', ['folder' => $task->folder_id, 'task' => $task->id]) }}">編集</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection