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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();
//ログイン中ページ、auth認証ずみ



//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top','PostsController@index');

Route::get('/profile','UsersController@profile');

//修正前
//Route::get('/search','UsersController@index');

//修正後
Route::get('/search', 'UsersController@search');

Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');

//ログアウト機能
Route::get('/logout', 'Auth\LoginController@showLoginForm')->name('login');

// 投稿表示
Route::get('/posts/index', 'PostsController@index')->name('posts.index');

// 投稿を押したら（登録）
Route::post('/posts/index', 'PostsController@added')->name('posts.added');


// 投稿編集
Route::post('/post/update', 'PostsController@update');
// 投稿削除
Route::delete('/post/{id}/delete', 'PostsController@destroy');


Route::get('/profile', 'UsersController@profile'); //プロフィールページ
Route::get('/search', 'UsersController@search'); //検索

Route::get('/follow-list', 'FollowsController@followList'); //フォローリスト
Route::get('/follower-list', 'FollowsController@followerList'); //フォロワーリスト

//プロフィール編集機能
Route::post('/profile', 'UsersController@profiledit')->name('profile.updated');

//検索機能
Route::post('/search', 'UsersController@search');

//フォロー機能(viewでrouteへルパによってルーティングの表示をさせる)
Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
//フォロー解除機能
Route::delete('users/{user}/unfollow','UsersController@unfollow')->name('unfollow');
