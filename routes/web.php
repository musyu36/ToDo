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

// ミドルウェアを複数のルートに適用するためルートグループにまとめる,今回はミドルウェアのauthを使ってログイン認証を求める処理を適用する
Route::group(['middleware' => 'auth'], function() {
    // ホームページ
    Route::get('/', 'HomeController@index')->name('home');

    
    // FolderControllerコントローラーのshowCreateFormメソッドを呼び出す(ルート名はfolders.create)フォルダ作成ページの表示
    Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    // FolderControllerクラスのcreateメソッドを呼び出す
    // 同じ URL で HTTP メソッド違いのルートがいくつかある場合はどれか一つに名前をつければOK
    Route::post('/folders/create', 'FolderController@create');


    Route::group(['middleware' => 'can:view,folder'], function() {
        // TaskControllerコントローラーのindexメソッドを呼び出す(ルート名はtasks.index)
        Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');
        // タスク作成ページの表示
        Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
        //タスク作成処理を実行
        Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

        // タスク編集ページの表示
        Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
        // タスク編集処理の実行
        Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');
    });

    
});

// 認証
// 以下のメソッドで会員登録、ログイン、ログアウト、パスワード再設定の各機能で必要なルーティング設定を全て定義
Auth::routes();