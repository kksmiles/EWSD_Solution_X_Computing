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

// ! Faculty
Route::group([ 'prefix' => 'faculty' ], function(){
    Route::get('/','FacultyController@index')->name('faculty');
    Route::get('/add','FacultyController@addView')->name('faculty.add');
    Route::post('/save','FacultyController@save')->name('faculty.save');
    Route::get('/edit/{id}','FacultyController@edit')->name('faculty.edit');
    Route::post('/update','FacultyController@update')->name('faculty.update');
    Route::get('/delete/{id}','FacultyController@delete')->name('faculty.delete');
});

// ! Contributions
Route::group([ 'prefix' => 'contributions' ], function(){
    // @ Student Contributions
    Route::group([ 'middleware' => 'can:isStudent' ], function(){
        Route::get('/student/upload','ContributionController@upload')->name('contribution.upload');
        Route::post('/student/upload/store','ContributionController@store')->name('contribution.store');
        Route::get('/student','ContributionController@studentAllContribution')->name('contribution.student.all');
        Route::get('/student/{id}','ContributionController@studentContributionEdit')->name('contribution.student.edit');
        Route::post('/student/updated','ContributionController@update')->name('contribution.update');
    });

   // @ Marketing Coordinatior Contributions Access
    Route::group([ 'middleware' => 'can:isMarketingCoordinator' ], function(){
        Route::get('/coordinator','CoordinatorContributionController@index')->name('contribution.coordinator.index');
        Route::get('/coordinator/{id}','CoordinatorContributionController@show')->name('contribution.coordinator.show');
        Route::post('/coordinator/{con_id}/publish','CoordinatorContributionController@publishContribution')->name('contribution.coordinator.publish');
        Route::post('/coordinator/{con_id}/reject','CoordinatorContributionController@rejectContribution')->name('contribution.coordinator.reject');
    });
});

Route::resource('/academic-years', 'AcademicYearController')->middleware('can:isAdmin');
Route::resource('/magazine-issues', 'MagazineIssueController');
Route::resource('/users', 'UserController');
Route::post('/user/assign/faculty','UserController@assignUserFaculty')->name('user_faculty.assign');
Route::post('/user/unassign/faculty','UserController@unassignUserFaculty')->name('user_faculty.unassign');
Route::post('/user/assign/role','UserController@assignUserRole')->name('user_role.assign');

Route::resource('/user_roles','UserRolesController')->middleware('can:isAdmin');
Route::resource('/user_faculty','UserFacultyController')->middleware('can:isAdmin');

Route::prefix('/user_faculty')->middleware('can:isAdmin')->group(function(){
    Route::get('/','UserFacultyController@showFaculty')->name('user_faculty.select');
    Route::get('/add/{f_id}','UserFacultyController@addUsersToFaculty')->name('user_faculty.add');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Comment Routes

Route::get('/contributions/{contribution_id}', 'ContributionController@show')->name('contribution.show');
Route::post('/contributions/{contribution_id}/comments', 'CommentController@store')->name('contribution.comment.store');
Route::patch('/comments/{comment}', 'CommentController@update')->name('comment.update');
Route::delete('/comments/{comment}', 'CommentController@destroy')->name('comment.delete');

