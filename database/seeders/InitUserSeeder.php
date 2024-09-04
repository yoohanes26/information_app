<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * 初期ユーザシード
     */
    public function run(): void
    {
        // 入力したいデータをここに定義
        User::create([
            'name' => 'Yohanes',
            'email' => 'yohanes.15is2@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
