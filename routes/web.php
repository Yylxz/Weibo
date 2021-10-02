<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'StaticPagesController@home')->name('home');                        // 主页
Route::get('help', 'StaticPagesController@help')->name('help');                     // 帮助
Route::get('about', 'StaticPagesController@about')->name('about');                  // 关于
Route::get('signup', 'UsersController@create')->name('signup');                     // 注册
Route::get('login', 'SessionsController@create')->name('login');                     // 显示登录界面
Route::post('login', 'SessionsController@store')->name('login');                     // 创建会话
Route::delete('logout', 'SessionsController@destroy')->name('logout');                // 退出
Route::resource('users', 'UsersController');
Route::get('users/{user}', 'UsersController@show')->name('users.show');             // 隐式路由绑定 用户信息
Route::get('users/{user}/edit', 'UsersController@edit')->name('users.edit');        // 編輯用戶
Route::patch('users/{user}', 'UsersController@update')->name('users.update');       // 更新
