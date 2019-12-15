<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
// CreateFolderクラスをインポートしてcreateメソッドの引数の型名をCreateFolderに変更
use App\Http\Requests\CreateFolder;

class FolderController extends Controller
{
    // get
    public function showCreateForm()
    {
        // folders/create.blade.phpを表示
        return view('folders/create');
    }

    // post 入力値として$requestを受け取り
    public function create(CreateFolder $request){
        // フォルダモデルのインスタンスを作成
        $folder = new Folder();

        // タイトルに入力値を代入
        $folder->title = $request->title;

        // インスタンスの状態をデータベースに書き込む
        $folder->save();

        // その後、tasks.indexルートをリダイレクト先に指定
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);

    }


}
