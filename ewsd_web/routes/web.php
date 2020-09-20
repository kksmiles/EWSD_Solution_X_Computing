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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/faculty','FacultyController@index')->name('faculty');
Route::get('/faculty/add','FacultyController@addView')->name('faculty.add');
Route::post('/faculty/save','FacultyController@save')->name('faculty.save');
Route::get('/faculty/edit/{id}','FacultyController@edit')->name('faculty.edit');
Route::post('/faculty/update','FacultyController@update')->name('faculty.update');
Route::get('/faculty/delete/{id}','FacultyController@delete')->name('faculty.delete');

