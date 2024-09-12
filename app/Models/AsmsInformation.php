<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsmsInformation extends Model
{
    use HasFactory, HasRelationships;

    // エンティティのテーブル名
    protected $table = 'asms_informations';

    public $timestamps = false;

    protected $primaryKey = 'information_id';

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
            'information_id' => $this->information_id,
            'information_title' => $this->information_title,
            'information_kbn' => $this->information_kbn,
            'information_kbn_text' => $this->information_kbn ? '情報' : '重要',
            'keisai_ymd' => Carbon::parse($this->keisai_ymd)->format('Y/m/d'),
            'enable_ymd' => Carbon::parse($this->enable_start_ymd)->format('Y/m/d') . " ～ " . Carbon::parse($this->enable_end_ymd)->format('Y/m/d'),
            'enable_start_ymd' => Carbon::parse($this->enable_start_ymd)->format('Y/m/d'),
            'enable_end_ymd' => Carbon::parse($this->enable_end_ymd)->format('Y/m/d'),
            'information_naiyo' => $this->information_naiyo,
        ];
    }
}
