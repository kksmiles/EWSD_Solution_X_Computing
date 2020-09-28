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
Route::group([ 'prefix' => 'faculty' ], function(){
    Route::get('/','FacultyController@index')->name('faculty');
    Route::get('/add','FacultyController@addView')->name('faculty.add');
    Route::post('/save','FacultyController@save')->name('faculty.save');
    Route::get('/edit/{id}','FacultyController@edit')->name('faculty.edit');
    Route::post('/update','FacultyController@update')->name('faculty.update');
    Route::get('/delete/{id}','FacultyController@delete')->name('faculty.delete');
});

Route::resource('/academicyears', 'AcademicYearController')->middleware('can:isAdmin');

Route::resource('/users', 'UserController');

Route::resource('/user_roles','UserRolesController')->middleware('can:isAdmin');

Route::resource('/user_faculty','UserFacultyController')->middleware('can:isAdmin');

Route::prefix('/user_faculty')->middleware('can:isAdmin')->group(function(){
    Route::get('/','UserFacultyController@showFaculty')->name('user_faculty.select');
    Route::get('/add/{f_id}','UserFacultyController@addUsersToFaculty')->name('user_faculty.add');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


