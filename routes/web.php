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
Route::get('/', 'Web\IndexController@maintain')->name('web.maintain');

Route::group(['domain' => env("admin_domain","admin.liuhe"), 'namespace' => 'admin','middleware' => ['loginMidd']],function ($router){
    
    
    Route::group(['middleware' => 'auth.member:member'],function ($router){
        
    })
    
    
    
    Route::get('/','IndexController@index')->name("admin.index");
    
    // 案例 start
    Route::get('/case/index','FitCaseController@index')->name("case.index");
    Route::get('/case/edit','FitCaseController@edit')->name("case.edit");
    Route::get('/case/delete','FitCaseController@delete')->name("case.delete");
    Route::post('/case/save','FitCaseController@save')->name("case.save");
    // 案例 end
    
    // 员工管理 start
    Route::get('/member/index','MemberController@index')->name("member.index");
    Route::get('/member/edit','MemberController@edit')->name("member.edit");
    Route::get('/member/delete','MemberController@delete')->name("member.delete");
    Route::post('/member/save','MemberController@save')->name("member.save");
    
    // 员工管理 end
    
    // 资讯start
    Route::get('/information/index','InformationController@index')->name("information.index");
    Route::get('/information/edit','InformationController@edit')->name("information.edit");
    Route::get('/information/delete','InformationController@delete')->name("information.delete");
    Route::post('/information/save','InformationController@save')->name("information.save");
    // 资讯end
    
    Route::get('/baojia/index','BaoJiaController@index')->name("baojia.index");
    //用户管理
    //     Route::get('/members/member','members\\MemberController@index')->name("members.member");
    //     Route::post('/members/member/list','members\\MemberController@memberList')->name("members.member.list");
//     Route::group(['middleware' => ['authorize']], function($router){
//         Route::get('/','index\\IndexController@index');
//     });

    // 培训资料 start
    Route::get('/learn/index','LearnController@index')->name("learn.index");
    Route::get('/learn/edit','LearnController@edit')->name("learn.edit");
    Route::get('/learn/delete','LearnController@delete')->name("learn.delete");
    Route::post('/learn/save','LearnController@save')->name("learn.save");
    // 培训资料 end
    
    // 项目流程 start
    Route::get('/project/create','ProjectController@create')->name("project.create");
    
        
    
    
    //
    
    // login
    
});





Route::group(['domain' => env("domain","liuhe"), 'namespace' => 'home'],function ($router){
    
    Route::get('/','IndexController@index')->name("home.index");
    
    
});


Route::group(['domain' => env("m_domain","m.liuhe"), 'namespace' => 'mobile'],function ($router){
    
    // 页面跳转
    Route::get('/','IndexController@index')->name("mobile.index");
    
    // 案例展示
    
    Route::get('/case','FitCaseController@index')->name("mobile.case.index");
    Route::get('/case/{id}','FitCaseController@caseOne')->name("mobile.case.caseOne");
    
    
    Route::get('/other/xianxiamendian','OtherController@xianxiamendian')->name("mobile.other.xianxiamendian");
    Route::get('/other/baojia','OtherController@baojia')->name("mobile.other.baojia");
    Route::get('/other/yanfan','OtherController@yanfang')->name("mobile.other.yanfang");
    
    // 资讯
    Route::get('/info','InformationController@infos')->name("mobile.info.list");
    Route::get('/info/{id}','InformationController@info')->name("mobile.info.info");
    
    
    //api
    Route::group(['namespace' => 'api','prefix' => '/api'],function ($router){
        
        Route::get('/case/list','FitCaseController@index')->name("mobile.api.case.list");
        
        Route::post('/baojia/save','BaoJiaController@save')->name("mobile.api.baojia.save");
        
    });
    

    
});



        



