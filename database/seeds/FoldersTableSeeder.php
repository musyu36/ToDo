<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // テストデータ挿入,3つのフォルダを作成
    public function run()
    {
        // firstメソッドでユーザを一行だけ取得して,下でそのIDをuser_idの値に指定
        $user = DB::table('users')->first();

        $titles = ['プライベート', '仕事', '旅行'];
        
        foreach ($titles as $title) {
            DB::table('folders')->insert([
                'title' => $title,
                'user_id' => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}