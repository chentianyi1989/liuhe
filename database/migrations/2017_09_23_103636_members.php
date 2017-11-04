<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Members extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->comment = '每期游戏结果表';
            $table->increments('id');
            $table->string('name', 100)->comment('姓名');
            $table->string('username', 100)->nullable()->comment('用户名');
            
            $table->decimal('money',16,2)->default(0)->comment('账户余额');
            
            $table->string('last_login_ip')->comment('最后登录ip');
            $table->dateTime('last_login_at')->comment('最后登录时间');
            $table->string('password');
            $table->string('qk_pwd', 100)->nullable()->comment('取款密码');
            
            $table->string('state', 100)->nullable()->comment('状态，1启用');
            
            
            $table->rememberToken();
            $table->timestamps();
            
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
