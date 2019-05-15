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


Route::group(['domain' => env("admin_domain","admin.liuhe"), 'namespace' => 'admin'],function ($router){
    
    Route::get('/','IndexController@index')->name("admin.index");
    
    
    Route::get('/case/index','FitCaseController@index')->name("case.index");
    Route::get('/case/edit','FitCaseController@edit')->name("case.edit");
    Route::get('/case/delete','FitCaseController@delete')->name("case.delete");
    Route::post('/case/save','FitCaseController@save')->name("case.save");
    
    
    Route::get('/baojia/index','BaoJiaController@index')->name("baojia.index");
    //用户管理
    //     Route::get('/members/member','members\\MemberController@index')->name("members.member");
    //     Route::post('/members/member/list','members\\MemberController@memberList')->name("members.member.list");
//     Route::group(['middleware' => ['authorize']], function($router){
//         Route::get('/','index\\IndexController@index');
//     });
});





Route::group(['domain' => env("domain","liuhe"), 'namespace' => 'home'],function ($router){
    
    Route::get('/','IndexController@index')->name("home.index");
    
    
});


Route::group(['domain' => env("m_domain","m.liuhe"), 'namespace' => 'mobile'],function ($router){
    
    // 页面跳转
    Route::get('/','IndexController@index')->name("mobile.index");
    
    // 案例展示
    Route::get('/case/list','FitCaseController@list')->name("mobile.case.list");
    Route::get('/case/{id}','FitCaseController@index')->name("mobile.case.index");
    
    Route::get('/other/xianxiamendian','OtherController@xianxiamendian')->name("mobile.other.xianxiamendian");
    
    
    
    //api
    Route::group(['namespace' => 'api','prefix' => '/api'],function ($router){
        
        Route::get('/case/list','FitCaseController@index')->name("mobile.api.case.list");
        
        Route::post('/baojia/save','BaoJiaController@save')->name("mobile.api.baojia.save");
        
    });
    

    
});



        



