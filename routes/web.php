<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['domain' => env("m_domain","admin.liuhe"), 'namespace' => 'admin'],function ($router){
    
    Route::get('/','index\\IndexController@index');
    
    
    //用户管理
    Route::get('/members/member','members\\MemberController@index')->name("members.member");
    Route::post('/members/member/list','members\\MemberController@memberList')->name("members.member.list");
    Route::post('/members/member/add','members\\MemberController@add')->name("members.member.add");
    Route::post('/members/member/update','members\\MemberController@updateUser')->name("members.member.update");
    Route::post('/members/member/recharge','members\\MemberController@recharge')->name("members.member.recharge");
    Route::post('/members/member/withdrawal','members\\MemberController@withdrawal')->name("members.member.withdrawal");
    
    
    Route::get('/members/gameRecord','members\\GameRecordController@index')->name("members.gameRecord");
    Route::post('/members/gameRecord/list','members\\GameRecordController@gameRecordList')->name("members.gameRecord.list");
    
    Route::get('/members/logMoney','members\\LogMoneyController@index')->name("members.logMoney");
    Route::get('/members/logMoney/list','members\\LogMoneyController@logMoneyList')->name("members.logMoney.list");
    
    Route::get('/members/loginLog','members\\LoginLogController@index')->name("members.loginLog");
    Route::post('/members/loginLog/list','members\\LoginLogController@loginLogList')->name("members.loginLog.list");
    
    
    // 游戏管理
    Route::get('/game/game_result','game\\GameResultController@index')->name("game.gameResult");
    Route::post('/game/game_result/list','game\\GameResultController@gameResultList')->name("game.gameResult.list");
    
    Route::get('/game/game','game\\GameController@index')->name("game.game");
    Route::post('/game/game/list','game\\GameController@gameList')->name("game.game.list");
    Route::get('/game/sys_config','game\\GameController@sysConfig')->name("game.game.sysConfig");
    Route::post('/game/sys_config/update','game\\GameController@sysConfigUpdate')->name("game.game.sysConfig.update");
    
    Route::get('/game/ball','game\\BallController@index')->name("game.ball");
    Route::post('/game/ball/list','game\\BallController@ballList')->name("game.ball.list");
    
    Route::get('/game/info','game\\GameInfoController@index')->name("game.info");
    
});


Route::group(['domain' => env("m_domain","liuhe"), 'namespace' => 'home'],function ($router){
    
    Route::get('/','IndexController@index')->name("home");
    
    Route::get('/recharge','IndexController@rechargeRecord')->name("home.recharge");
    
    Route::get('/index2','IndexController@index2');
    Route::post('/bet','IndexController@bet')->name("home.bet");
    
    
    Route::get('/uesr/game_record','RecordController@gameRecord')->name("user.game_record");
    Route::get('/uesr/del_game_record','RecordController@delGameRecord')->name("user.del_game_record");
    Route::get('/uesr/game_record_history','RecordController@gameRecordHistory')->name("user.game_record_history");
    
    Route::get('/uesr/game_result','RecordController@gameResultRecord')->name("user.game_result");
    
    Route::get('/uesr/mb','IndexController@mb')->name("user.mb");
    
    
    Route::post('/uesr/login','LoginController@login')->name("user.login");
    Route::get('/uesr/logout','LoginController@logout')->name("user.logout");
    
    Route::post('/login','IndexController@ajaxLogin')->name("home.login");
    
    
});





