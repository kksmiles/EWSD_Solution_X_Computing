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

// ! Chart
// This has to be covered => 'middleware'=>'can:isMarketingManager'
Route::group([ 'prefix' => 'report' ], function(){
    Route::get('/charts/{year?}', 'ReportController@index')->name('charts.contribute');
    Route::any('/contributions','ReportController@contributions')->name('report.contribute');
    Route::any('/exception-report','ReportController@exceptionReport')->name('report.exception');
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

Route::resource('/magazine-issues', 'MagazineIssueController');

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
    Route::get('/', 'HomeController@index')->name('admin.home');
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
        Route::get('/','FacultyController@index')->name('faculty.index');
        Route::get('/add','FacultyController@addView')->name('faculty.add');
        Route::post('/save','FacultyController@save')->name('faculty.save');
        Route::get('/edit/{id}','FacultyController@edit')->name('faculty.edit');
        Route::post('/update','FacultyController@update')->name('faculty.update');
        Route::get('/delete/{id}','FacultyController@delete')->name('faculty.delete');
        
        Route::get('/{id}/users/add','UserFacultyController@addUsersToFaculty')->name('faculty.users.add');
        Route::get('/{faculty}','FacultyController@show')->name('faculty.show');
        Route::get('/{id}/users','UserFacultyController@showFacultyUsers')->name('faculty.users.show');
        Route::post('faculty/users/url','UserFacultyController@userFaucltyRouteHelper')->name('faculty.url');
    });
    Route::resource('/user-faculty','UserFacultyController');

    //academic year routes for admin
    Route::resource('/academic-years','AcademicYearController');
    
});
//! ADMIN ROUTES !//

Route::group(['prefix' => 'manager','middleware'=>'can:isMarketingManager'],function(){
    Route::get('/','HomeController@index')->name('manager.home');
    Route::get('/dashboard','HomeController@index')->name('manager.dashboard');
    
    Route::group(['prefix'=>'faculty'],function(){
        Route::get('/','FacultyController@index')->name('manager.faculty.index');
        Route::get('/{faculty}','FacultyController@show')->name('manager.faculty.show');
        Route::get('/{faculty}/users','UserFacultyController@showFacultyUsers')->name('manager.faculty.users.show');
        Route::get('/{faculty}/magazine-issues','MagazineIssueController@getIssuesInFaculty')->name('manager.faculty.issues.index');
        Route::get('/{faculty}/contributions','ContributionController@index')->name('manager.faculty.contributions.index');
    });

    Route::group(['prefix'=>'users'],function(){
        Route::get('/','UserController@index')->name('manager.users.index');
        Route::get('/{id}','UserController@show')->name('manager.users.show');
    });

    Route::group(['prefix'=> 'magazine-issues'],function(){
        Route::get('/','MagazineIssueController@index')->name('manager.magazine-issues.index');
        Route::get('/{id}','MagazineIssueController@show')->name('manager.magazine-issues.show');
    });
    Route::get('/selected-contributions','ContributionController@indexSelectedContributions')->name('manager.selected-contributions.index');
});
//!ADMIN ROUTES !//

//! MARKETING COORDINATOR ROUTES
Route::group(['prefix' => 'coordinator','middleware'=>'can:isMarketingCoordinator'],function(){
    //dashboard route
    Route::get('/','HomeController@index')->name('coordinator.home');
    Route::get('/dashboard','HomeController@index')->name('coordinator.dashboard');

    //faculty routes for coordinator
    Route::group(['prefix'=>'faculty'],function(){
        Route::get('/','FacultyController@index')->name('coordinator.faculty.index');
        Route::get('/{faculty}','FacultyController@show')->name('coordinator.faculty.show');
        Route::get('/{id}/users','UserFacultyController@showFacultyUsers')->name('coordinator.faculty.users.show');
    });
    
    Route::get('magazine-issues/{id}/contributions','CoordinatorContributionController@show')->name('coordinator.magazine-issues.contributions.show');
    Route::post('magazine-issues/url-helper','CoordinatorContributionController@urlHelper')->name('coordinator.magazine-issues.contributions.url');

    Route::resource('magazine-issues','MagazineIssueController',[
        'names' => [
            'index' =>  'coordinator.magazine-issues.index',
            'create'=>  'coordinator.magazine-issues.create',
            'show'  =>  'coordinator.magazine-issues.show',
            'store' =>  'coordinator.magazine-issues.store',
            'edit'  =>  'coordinator.magazine-issues.edit',
            'update'=>  'coordinator.magazine-issues.update',
            'destroy'=> 'coordinator.magazine-issues.destroy'
        ]
    ]);
    
    Route::group(['prefix'=>'contributions'],function(){
        
        Route::get('/','CoordinatorContributionController@index')->name('coordinator.contributions.index');
        // Route::get('/{id}','CoordinatorContributionController@show')->name('coordinator.magazine-issues.contributions.show');
        Route::get('/{contribution}','ContributionController@show')->name('coordinator.contributions.show');
        Route::post('/{con_id}/publish','CoordinatorContributionController@publishContribution')->name('coordinator.contributions.publish');
        Route::post('/{con_id}/reject','CoordinatorContributionController@rejectContribution')->name('coordinator.contributions.reject');
        Route::post('/{contribution_id}/comments', 'CommentController@store')->name('contribution.comment.store');
        Route::patch('/comments/{comment}', 'CommentController@update')->name('comment.update');
        Route::delete('/comments/{comment}', 'CommentController@destroy')->name('comment.delete');
    });

    Route::get('/selected-contributions','ContributionController@indexSelectedContributions')->name('manager.selected-contributions.index');


});
//! MARKETING COORDINATOR ROUTES

// ! STUDENT ROUTES !//
Route::group(['prefix' => 'student','middleware' => 'can:isStudent'],function(){
    Route::get('/dashboard','HomeController@index')->name('student.dashboard');
    
    //! Student Faculties 
    Route::group(['prefix'=>'faculty'],function(){
        Route::get('/','FacultyController@index')->name('student.faculty');
        Route::get('/{id}/magazine-issues','MagazineIssueController@getIssuesInFaculty')->name('student.faculties.magazineissues');
    });

    //! Student Magazine Issues
    Route::group(['prefix'=>'magazine-issues'],function(){
        Route::get('/','MagazineIssueController@getStudentIssues')->name('student.magazine-issues');
        Route::get('/{magazine_issue}','MagazineIssueController@show')->name('student.magazine-issues.show');
        Route::get('/{magazine_issue}/contributions','MagazineIssueController@getStudentContributionsOfIssue')->name('student.magazine-issues.contributions');
    });
    // ! Contributions
    Route::group([ 'prefix' => 'contributions' ], function(){

        // @ Student Contributions
        Route::get('/upload','ContributionController@upload')->name('contribution.upload');
        Route::post('/upload/store','ContributionController@store')->name('contribution.store');
        Route::get('/','ContributionController@studentAllContribution')->name('contribution.student.all');
        Route::get('/{contribution}','ContributionController@show')->name('contribution.student.show');
        Route::get('/{id}/edit','ContributionController@studentContributionEdit')->name('contribution.student.edit');
        Route::post('/updated','ContributionController@update')->name('contribution.update');
        Route::post('/{contribution}/comments', 'CommentController@store')->name('contribution.comment.student.store');
        Route::patch('/comments/{comment}', 'CommentController@update')->name('comment.student.update');
        Route::delete('/comments/{comment}', 'CommentController@destroy')->name('comment.delete');
    });
});
// ! STUDENT ROUTES !//

// Route::group(['prefix' => 'guest'],['middleware' => 'can:isGuest'],function(){

// });
//Comment Routes

Route::get('/contributions/{contribution}', 'ContributionController@show')->name('contribution.show');
Route::post('/contributions/{contribution_id}/comments', 'CommentController@store')->name('contribution.comment.store');
Route::patch('/comments/{comment}', 'CommentController@update')->name('comment.update');
Route::delete('/comments/{comment}', 'CommentController@destroy')->name('comment.delete');

// Route::group([ 'prefix' => 'contributions' ], function(){
//     // @ Student Contributions
//    // @ Marketing Coordinatior Contributions Access
//     Route::group([ 'middleware' => 'can:isMarketingCoordinator' ], function(){
//         Route::get('/coordinator','CoordinatorContributionController@index')->name('contribution.coordinator.index');
//         Route::get('/coordinator/{id}','CoordinatorContributionController@show')->name('contribution.coordinator.show');
//         Route::post('/coordinator/{con_id}/publish','CoordinatorContributionController@publishContribution')->name('contribution.coordinator.publish');
//         Route::post('/coordinator/{con_id}/reject','CoordinatorContributionController@rejectContribution')->name('contribution.coordinator.reject');
//     });
// });
