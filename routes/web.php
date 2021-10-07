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
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');    // 激活账号验证
Route::get('password/reset', 'PasswordController@showLinkRequestForm')->name('password.request');   // 填写email表单
Route::post('password/email', 'PasswordController@sendResetLinkEmail')->name('password.email');     // 处理email表单
Route::get('password/reset/{token}', 'PasswordController@showResetForm')->name('password.reset');   // 显示更新密码表单
Route::post('password/reset', 'PasswordController@reset')->name('password.update');                 // 更新密码
Route::resource('statuses', 'StatusesController', ['only'   => ['store', 'destroy']]);
Route::get('users/{user}/followings', 'UsersController@followings')->name('users.followings');      // 关注列表
Route::get('users/{user}/followers', 'UsersController@followers')->name('users.followers');      // 粉丝列表
Route::post('users/followers/{user}', 'FollowersController@store')->name('followers.store');     // 关注
Route::delete('users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy'); // 取关
