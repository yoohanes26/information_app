<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsmsInformation extends Model
{
    use HasFactory, HasRelationships;

    // エンティティのテーブル名
    protected $table = 'asms_informations';

    // 入力できるフィールドをここに定義
    protected $fillable = [
        'information_title',
        'information_kbn', // 0：重要、1：情報
        'keisai_ymd',
        'enable_start_ymd',
        'enable_end_ymd',
        'information_naiyo',
        'delete_flg',
        'create_user_cd',
        'create_time',
        'update_user_cd',
        'update_time'
    ];

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('delete_flg', '=', 0);
    }

    //　本エンティティと関連するユーザのエンティティと関係づける（登録者ユーザコードに基づく）
    public function create_user(){
        return $this->belongsTo(User::class, 'create_user_cd');
    }

    //　本エンティティと関連するユーザのエンティティと関係づける（更新者ユーザコードに基づく）
    public function update_user(){
        return $this->belongsTo(User::class, 'update_user_cd');
    }

    // データをJSONフォーマットで返す
    public function format(){
        return [
            'information_title' => $this->information_title,
            'information_kbn' => $this->information_kbn,
            'keisai_ymd' => $this->keisai_ymd,
            'enable_start_ymd' => $this->enable_start_ymd,
            'enable_end_ymd' => $this->enable_end_ymd,
            'information_naiyo' => $this->information_naiyo,
            'delete_flg' => $this->delete_flg,
            'create_user_cd' => $this->create_user_cd,
            'create_time' => $this->create_time,
            'update_user_cd' => $this->update_user_cd,
            'update_time' => $this->update_time,
        ];
    }
}
