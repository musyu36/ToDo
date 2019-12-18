<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100', //最大100文字
            'due_date' => 'required|date|after_or_equal:today', //日付を表す値かつ、today以降の日付
        ];
    }

    public function attributes()
    {
        return [
            // タスクタイトル,期日日を入力
            'title' => 'タイトル',
            'due_date' => '期限日',
        ];
    }

    public function messages()
    {
        return [
            // キーでメッセージが表示されるべきルールを指定
            //ドット区切りで左側(due_date)が項目、右側(after_or_equal)がルールを意味する
            //一般的なルールはvalidation.phpに記述するがmessagesメソッドでは個別のFormRequestクラスの内部でのみ有効なメッセージを定義することができる
            'due_date.after_or_equal' => ':attribute には今日以降の日付を入力してください。',
        ];
    }
}