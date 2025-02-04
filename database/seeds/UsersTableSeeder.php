<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'test',
            'email' => 'dummy@email.com',
            //bcrypt関数で暗号化してデータベースに保存
            'password' => bcrypt('test1234'), 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}