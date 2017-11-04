<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GamesRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_record', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->comment = '每期游戏记录表';
            $table->increments('id');
            $table->integer('member_id')->nullable()->comment('玩家id');
            $table->integer("ball_id")->nullable()->comment('球号');
            $table->string('code', 100)->nullable()->comment('期号');
            $table->string('game_code', 100)->nullable()->comment('游戏类型，1:平码,2:特码');
            
            $table->decimal('money',16,2)->default(0)->comment('投注金额');
            $table->string('name', 100)->comment('备注');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
