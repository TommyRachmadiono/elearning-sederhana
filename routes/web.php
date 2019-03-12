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

Route::get('/', 'LoginController@index');

// Route::get('/master', function () {
// 	return view('template.master');
// });

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@cekLogin')->name('cek_login');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/register', 'LoginController@registerPage')->name('register_page');
Route::post('/register', 'LoginController@register')->name('register');


Route::middleware(['ceklogin'])->group(function () {

	// =================== HALAMAN ROUTE SETELAH LOGIN ===================
	Route::get('/home', 'UserController@index')->name('index_page');
	Route::get('course-detail/{id}', 'CourseController@courseDetailPage')->name('course_detail');
	
	Route::delete('course/{id}', 'CourseController@destroy')->name('course.destroy');

	Route::post('course', 'CourseController@addCourse')->name('course.store');
	Route::post('course/{id}', 'CourseController@update')->name('course.update');

	Route::post('post', 'CourseController@postContent')->name('post.store');
	Route::post('postedit/{id}', 'CourseController@updatePost')->name('post.update');

	Route::post('attachment', 'CourseController@addNewAttachment')->name('attachment.store');
	Route::post('comment', 'CourseController@addComment')->name('comment.store');
	Route::delete('comment/{id}', 'CourseController@destroyComment')->name('comment.destroy');
	Route::delete('file/{id}', 'CourseController@destroyFile')->name('file.destroy');
	Route::delete('post/{id}', 'CourseController@destroyPost')->name('post.destroy');
});
