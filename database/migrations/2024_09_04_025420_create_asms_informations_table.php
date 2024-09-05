<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asms_informations', function (Blueprint $table) {
            $table->id("information_id");
            $table->string("information_title", length: 100);
            $table->char("information_kbn", length: 1)->comment("0：重要、１：情報");
            $table->string("keisai_ymd", length: 8);
            $table->string("enable_start_ymd", length: 8);
            $table->string("enable_end_ymd", length: 8);
            $table->text("information_naiyo");
            $table->boolean("delete_flg")->default(false);
            $table->unsignedBigInteger("create_user_cd");
            $table->timestamp("create_time")->nullable();
            $table->unsignedBigInteger("update_user_cd");
            $table->timestamp("update_time")->nullable();
        });

        Schema::table('asms_informations', function (Blueprint $table){
            $table->foreign('create_user_cd')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('update_user_cd')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asms_informations', function (Blueprint $table) {
            $table->dropForeign('asms_informations_update_user_cd_foreign');
            $table->dropIndex('asms_informations_update_user_cd_foreign');
            $table->dropForeign('asms_informations_create_user_cd_foreign');
            $table->dropIndex('asms_informations_create_user_cd_foreign');
        });

        Schema::dropIfExists('asms_informations');
    }
};
