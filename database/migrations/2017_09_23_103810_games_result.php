<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GamesResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_result', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->comment = '每期游戏结果表';
            $table->increments('id');
            $table->string('name', 100)->comment('备注');
            $table->string('code', 100)->nullable()->comment('期号');
            $table->string('result', 1000)->nullable()->comment('["1"=>[1,2,3,4,5,6],"2"=>7];key：游戏code，value：ball号码');
            
            
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
