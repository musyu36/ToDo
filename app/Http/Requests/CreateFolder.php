<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // authorizeメソッドでリクエストの内容に基づいた権限チェックをする
        // 今回は使用しないのでtrueを返す
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
            // 'HTMLのinput要素のname属性' => 'ルール'
            // NULL不可かつ20文字以内
            'title' => 'required|max:20',
        ];
    }
    

    // 入力欄の名称をカスタマイズ
    public function attributes()
    {
        return [
            'title' => 'フォルダ名',
        ];
    }
}
