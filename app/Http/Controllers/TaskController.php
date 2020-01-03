<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // 引数にルーティングで定義した波カッコ内の値を指定してidをURLから受け取り
    public function index(Folder $folder)
    {
        // ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();

        // 選ばれたフォルダを取得する
        // FolderテーブルからIDカラム(プライマリキー)が$idの行のデータを取得
        // $current_folder = Folder::find($id);

        // 選ばれたフォルダに紐づくタスクを取得する
        // Tasks::where('folder_id', '=', $current_folder->id)->get();と同値
        // where(カラム名,比較する値),whereだけではSQL生成のみなのでのみなのでgetメソッドを呼び出す必要あり
        // $tasks = Task::where('folder_id', $current_folder->id)->get();
        // Folderクラスのtasksメソッドで全タスクを取得するように変更↓
        $tasks = $folder->tasks()->get();

        // view(テンプレートファイル名, キーがテンプレート側で参照する変数名)でテンプレートに取得したデータを渡す。
        // どのファイル(今回はtasks/index.blade.php)を表示するか？どの値をそれに渡すか？
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
        ]);
    }

    /**
     * GET /folders/{id}/tasks/create
     */
    public function showCreateForm(Folder $folder)
    {
        // tasks/create.blade.phpにfolder_idを渡す,この値を使ってURL , /folders/{id}/tasks/createを作る
        return view('tasks/create', [
            'folder_id' => $folder->id,
        ]);
    }

    // タスク作成
    public function create(Folder $folder, CreateTask $request)
    {
        // $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        // 現在選択中のフォルダ内にタスク作成
        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }

    // タスク編集フォームの表示
    /**
     * GET /folders/{id}/tasks/{task_id}/edit
     */
    public function showEditForm(Folder $folder, Task $task)
    {

        $this->checkRelation($folder, $task);

        // $task = Task::find($task_id);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    public function edit(Folder $folder, Task $task, EditTask $request)
    {

        $this->checkRelation($folder, $task);

        // リクエストされた ID でタスクデータを取得
        // $task = Task::find($task_id);

        // 編集対象のタスクデータに入力値を詰めて save
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        // 編集対象のタスクが属するタスク一覧画面へリダイレクト
        return redirect()->route('tasks.index', [
            'folder' => $task->folder_id,
        ]);
    }

    // フォルダIDとタスクIDの紐付け確認
    private function checkRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}