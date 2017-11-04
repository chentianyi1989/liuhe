<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ball extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ball', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->comment = '球号码表';
            $table->increments('id');
            $table->string('name', 100)->nullable()->comment('备注');
            $table->string('code', 100)->nullable()->comment('号码');
            $table->string('colour', 100)->nullable()->comment('波色');
            $table->string('zodiac', 100)->nullable()->comment('生肖');
            $table->string('shape', 100)->nullable()->comment('大小');
            $table->string('single', 100)->nullable()->comment('单双');
            $table->string('year', 100)->nullable()->comment('年份');
            
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
