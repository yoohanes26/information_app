<?php

namespace Database\Seeders;

use App\Models\AsmsInformation;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * 初期お知らせシード
     */
    public function run(): void
    {
        // information_kbn = 0：重要、 1：情報
        $news_number = 1;
        $alert_number = 1;
        $entries = [
            [
                'information_title' => 'ニュース' . $news_number,
                'information_kbn' => '1',
                'keisai_ymd' => '20240701',
                'enable_start_ymd' => '20240701',
                'enable_end_ymd' => '20240730',
                'information_naiyo' => 'これはニュース第' . $news_number++ . '号です。',
                'delete_flg' => 0,
                'create_user_cd' => 1,
                'create_time' => Carbon::now(),
                'update_user_cd' => 1,
                'update_time' => Carbon::now(),
            ],
            [
                'information_title' => 'ニュース' . $news_number,
                'information_kbn' => '1',
                'keisai_ymd' => '20240801',
                'enable_start_ymd' => '20240801',
                'enable_end_ymd' => '20240830',
                'information_naiyo' => 'これはニュース第' . $news_number++ . '号です。',
                'delete_flg' => 0,
                'create_user_cd' => 1,
                'create_time' => Carbon::now(),
                'update_user_cd' => 1,
                'update_time' => Carbon::now(),
            ],
            [
                'information_title' => 'ニュース' . $news_number,
                'information_kbn' => '1',
                'keisai_ymd' => '20240901',
                'enable_start_ymd' => '20240901',
                'enable_end_ymd' => '20240930',
                'information_naiyo' => 'これはニュース第' . $news_number++ . '号です。',
                'delete_flg' => 0,
                'create_user_cd' => 1,
                'create_time' => Carbon::now(),
                'update_user_cd' => 1,
                'update_time' => Carbon::now(),
            ],
            [
                'information_title' => 'ニュース' . $news_number,
                'information_kbn' => '1',
                'keisai_ymd' => '20241001',
                'enable_start_ymd' => '20241001',
                'enable_end_ymd' => '20241030',
                'information_naiyo' => 'これはニュース第' . $news_number++ . '号です。',
                'delete_flg' => 0,
                'create_user_cd' => 1,
                'create_time' => Carbon::now(),
                'update_user_cd' => 1,
                'update_time' => Carbon::now(),
            ],
            [
                'information_title' => 'ニュース' . $news_number,
                'information_kbn' => '1',
                'keisai_ymd' => '20241101',
                'enable_start_ymd' => '20241101',
                'enable_end_ymd' => '20241130',
                'information_naiyo' => 'これはニュース第' . $news_number++ . '号です。',
                'delete_flg' => 0,
                'create_user_cd' => 1,
                'create_time' => Carbon::now(),
                'update_user_cd' => 1,
                'update_time' => Carbon::now(),
            ],

            [
                'information_title' => '警告' . $alert_number,
                'information_kbn' => '0',
                'keisai_ymd' => '20240901',
                'enable_start_ymd' => '20240901',
                'enable_end_ymd' => '20240909',
                'information_naiyo' => 'これは警告第' . $news_number++ . '号です。',
                'delete_flg' => 0,
                'create_user_cd' => 1,
                'create_time' => Carbon::now(),
                'update_user_cd' => 1,
                'update_time' => Carbon::now(),
            ],
            [
                'information_title' => '警告' . $alert_number,
                'information_kbn' => '0',
                'keisai_ymd' => '20240910',
                'enable_start_ymd' => '20240910',
                'enable_end_ymd' => '20240915',
                'information_naiyo' => 'これは警告第' . $news_number++ . '号です。',
                'delete_flg' => 0,
                'create_user_cd' => 1,
                'create_time' => Carbon::now(),
                'update_user_cd' => 1,
                'update_time' => Carbon::now(),
            ],
            [
                'information_title' => '警告' . $alert_number,
                'information_kbn' => '0',
                'keisai_ymd' => '20240912',
                'enable_start_ymd' => '20240912',
                'enable_end_ymd' => '20240917',
                'information_naiyo' => 'これは警告第' . $news_number++ . '号です。',
                'delete_flg' => 0,
                'create_user_cd' => 1,
                'create_time' => Carbon::now(),
                'update_user_cd' => 1,
                'update_time' => Carbon::now(),
            ],
        ];

        // asms_informationにデータを注入
        AsmsInformation::insert($entries);
    }
}
