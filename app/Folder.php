<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// php側でデータの入れ物になるクラス、基本的にモデルクラス一つがテーブル一つに対応
class Folder extends Model
{
    public function tasks()
    {
        // $this->hasMany('App\Task', 'folder_id', 'id');と同値
        // フォルダ内の全てのタスクを取得してくる
        // hasMany(関連するモデル名,関連するテーブルが持つ外部キーカラム名,hasManyが定義されている側のテーブルが持つ、外部キーに紐づけられたカラムの名前)つまり第２と第３は同値になる必要がある
        // 第２引数は'テーブル名単数形_id'、第３引数はid
        return $this->hasMany('App\Task');
    }
}
