<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // 引数にルーティングで定義した波カッコ内の値を指定してidをURLから受け取り
    public function index(int $id)
    {
        // Folderモデルのallクラスメソッドで全てのフォルダデータをdbから取得　
        $folders = Folder::all();

        // 選ばれたフォルダを取得する
        // FolderテーブルからIDカラム(プライマリキー)が$idの行のデータを取得
        $current_folder = Folder::find($id);

        // 選ばれたフォルダに紐づくタスクを取得する
        // Tasks::where('folder_id', '=', $current_folder->id)->get();と同値
        // where(カラム名,比較する値),whereだけではSQL生成のみなのでのみなのでgetメソッドを呼び出す必要あり
        $tasks = Task::where('folder_id', $current_folder->id)->get();

        // view(テンプレートファイル名, キーがテンプレート側で参照する変数名)でテンプレートに取得したデータを渡す。
        // どのファイルを表示するか？どの値をそれに渡すか？
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $id,
            'tasks' => $tasks,
        ]);
    }
}