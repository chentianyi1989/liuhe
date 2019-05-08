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
    
    Route::get('/','IndexController@index')->name("admin.index");
    
    //用户管理
    //     Route::get('/members/member','members\\MemberController@index')->name("members.member");
    //     Route::post('/members/member/list','members\\MemberController@memberList')->name("members.member.list");
//     Route::group(['middleware' => ['authorize']], function($router){
//         Route::get('/','index\\IndexController@index');
//     });
});





Route::group(['domain' => env("m_domain","liuhe"), 'namespace' => 'home'],function ($router){
    
    Route::get('/','IndexController@index')->name("home.index");
    
    
});


Route::group(['domain' => env("m_domain","m.liuhe"), 'namespace' => 'mobile'],function ($router){
    
    Route::get('/','IndexController@index')->name("mobile.index");
    
    
});




