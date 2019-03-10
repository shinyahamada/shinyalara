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

Route::get('/', function () {
    return view('welcome');
});

Route::get('github', 'Github\GithubController@top');
Route::post('github/issue', 'Github\GithubController@createIssue');
Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');
Route::post('user', 'User\UserController@updateUser');
Route::get('home', 'HomeController@index');
Route::post('post', 'PostController@post');
Route::get('post', 'PostController@top');
Route::get('profile/{p_user}', 'User\UserController@info');
Route::get('logout', 'User\UserController@logout');
Route::get('like/{post_id}', 'LikeController@index');
Route::post('like/{post_id}', 'LikeController@like');
Route::post('delete/{post_id}', 'PostController@delete');
