<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * 初期シード
     */
    public function run(): void
    {
        $this->call([
            InitUserSeeder::class,
            InitInformationSeeder::class,
        ]);
    }
}
