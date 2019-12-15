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
// FolderControllerコントローラーのshowCreateFormメソッドを呼び出す(ルート名はfolders.create)
Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
// FolderControllerクラスのcreateメソッドを呼び出す
// 同じ URL で HTTP メソッド違いのルートがいくつかある場合はどれか一つに名前をつければOK
Route::post('/folders/create', 'FolderController@create');