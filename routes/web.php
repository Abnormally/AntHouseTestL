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

Route::get('/', 'MainController@index')
    ->name('index');

Route::get('/search', 'MainController@search')
    ->name('students.search');

Route::get('/{id}', 'MainController@getStudent')
    ->where('id', '[0-9]+')
    ->name('students.id');

Route::get('/{column}/{direction}', 'MainController@setSortCookie')
    ->where('column', 'firstName|lastName|squad|points')
    ->where('direction', 'asc|desc')
    ->name('students.sort');

Route::group(['prefix' => 'register'], function () {
    Route::get('/', 'MainController@registrationPage')
        ->name('students.register');

    Route::post('/', 'MainController@registration')
        ->name('');
});

/* // Just for tests
Route::get('/create_students/{amount}', 'MainController@createStudents')
    ->where('amount', '[0-9]+')
    ->name('students.create');
*/