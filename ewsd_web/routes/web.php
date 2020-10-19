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

Route::resource('/magazine-issues', 'MagazineIssueController')->middleware('can:isSupervisor');

Route::group(['prefix'=>'staff/magazine-issues','middleware'=>'can:isMarketingCoordinator'], function() {
    Route::get('','MagazineIssueController@index');
    Route::get('/{user_id}','MagazineIssueController@getStaffIssues')->name('magazine_issue.staff.show');
});
Route::group(['prefix'=>'admin/magazine-issues','middleware'=>'can:isSupervisor'], function() {
    Route::get('','MagazineIssueController@index');
    Route::get('/{user_id}','MagazineIssueController@getStaffIssues')->name('magazine_issue.admin.show');
});

Route::resource('/user_roles','UserRolesController')->middleware('can:isAdmin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//new routes

//! ADMIN ROUTES !//
Route::group(['prefix' => 'admin','middleware'=>'can:isAdmin'], function(){
    //dashboard route for admin
    Route::get('/', 'HomeController@index')->name('admin.dashboard');
    Route::get('/dashboard','HomeController@index')->name('admin.dashboard');

    //user account routes for admin
    Route::resource('users','UserController'); 
        //do not put resource users in prefix users groups. can cause bugs. illuminate route request errors.
    Route::prefix('users')->group(function(){
        Route::post('/assign/faculty','UserController@assignUserFaculty')->name('user_faculty.assign');
        Route::post('/unassign/faculty','UserController@unassignUserFaculty')->name('user_faculty.unassign');
        Route::post('/assign/role','UserController@assignUserRole')->name('user_role.assign');  
    });

    //faculty and users in faculty routes for admin
    Route::prefix('faculty')->group(function(){ 
        Route::get('/','FacultyController@index')->name('faculty');
        Route::get('/add','FacultyController@addView')->name('faculty.add');
        Route::post('/save','FacultyController@save')->name('faculty.save');
        Route::get('/edit/{id}','FacultyController@edit')->name('faculty.edit');
        Route::post('/update','FacultyController@update')->name('faculty.update');
        Route::get('/delete/{id}','FacultyController@delete')->name('faculty.delete');
        
        Route::get('/{id}/users/add','UserFacultyController@addUsersToFaculty')->name('faculty.users.add');
        Route::get('/{id}','FacultyController@show')->name('faculty.show');
        Route::get('/{id}/users','UserFacultyController@showFacultyUsers')->name('faculty.users.show');
        Route::post('faculty/users/url','UserFacultyController@userFaucltyRouteHelper')->name('faculty.url');
    });
    Route::resource('/user-faculty','UserFacultyController');

    //academic year routes for admin
    Route::resource('/academic-years','AcademicYearController');
    
});
//! ADMIN ROUTES !//

// Route::group(['prefix' => 'marketing-manager'],['middleware'=>'can:isMarketingManager'],function(){
    
// });
// Route::group(['prefix' => 'marketing-coordinator'],['middleware'=>'can:isMarketingCoordinator'],function(){
    
// });

// ! STUDENT ROUTES !//
Route::group(['prefix' => 'student','middleware' => 'can:isStudent'],function(){
    Route::get('/dashboard','HomeController@index')->name('student.dashboard');

    // ! Contributions
    Route::group([ 'prefix' => 'contributions' ], function(){
         // @ Marketing Coordinatior Contributions Access
        Route::get('/','ContributionController@index')->name('contribution');

        // @ Student Contributions
        Route::group([ 'middleware' => 'can:isStudent' ], function(){
            Route::get('/student/upload','ContributionController@upload')->name('contribution.upload');
            Route::post('/student/upload/store','ContributionController@store')->name('contribution.store');
            Route::get('/student','ContributionController@studentAllContribution')->name('contribution.student.all');
        });
    }); 
    // /student/contributions (Show auth all contributions)
    // /students/magazine-issue/1/contributions/create (Contribution submit form)
    // /students/magazine-issue/1/contributions/1/edit (Contribution edit form)
    // /students/magazine-issue/1/contributions/1 (Contribution detailed page & its comments & state)

});
// ! STUDENT ROUTES !//

// Route::group(['prefix' => 'guest'],['middleware' => 'can:isGuest'],function(){

// });
//Comment Routes

Route::get('/contributions/{contribution_id}', 'ContributionController@show')->name('contribution.show');
Route::post('/contributions/{contribution_id}/comments', 'CommentController@store')->name('contribution.comment.store');
Route::patch('/comments/{comment}', 'CommentController@update')->name('comment.update');
Route::delete('/comments/{comment}', 'CommentController@destroy')->name('comment.delete');



