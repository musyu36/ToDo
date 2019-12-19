<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// TaskControllerコントローラーのindexメソッドを呼び出す(ルート名はtasks.index)
Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');
// FolderControllerコントローラーのshowCreateFormメソッドを呼び出す(ルート名はfolders.create)フォルダ作成ページの表示
Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
// FolderControllerクラスのcreateメソッドを呼び出す
// 同じ URL で HTTP メソッド違いのルートがいくつかある場合はどれか一つに名前をつければOK
Route::post('/folders/create', 'FolderController@create');

// タスク作成ページの表示
Route::get('/folders/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
//タスク作成処理を実行
Route::post('/folders/{id}/tasks/create', 'TaskController@create');

// タスク編集ページの表示
Route::get('/folders/{id}/tasks/{task_id}/edit', 'TaskController@showEditForm')->name('tasks.edit');
// タスク編集処理の実行
Route::post('/folders/{id}/tasks/{task_id}/edit', 'TaskController@edit');

// ホームページ
Route::get('/', 'HomeController@index')->name('home');

// 認証
// 以下のメソッドで会員登録、ログイン、ログアウト、パスワード再設定の各機能で必要なルーティング設定を全て定義
Auth::routes();