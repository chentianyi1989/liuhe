<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Games extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->comment = '游戏表';
            $table->increments('id');
            $table->string('name', 100)->comment('备注');
            $table->string('code', 100)->nullable()->comment('1平码，2特码');
            $table->decimal('odds')->nullable()->comment('赔率');
            $table->string('state', 100)->nullable()->comment('0 关闭');
            
            
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
