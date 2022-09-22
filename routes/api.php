<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::resource('/home/jobtype', 'JobtypeController');
Route::resource('/home/jobtype', 'App\Http\Controllers\JobtypeController');
Route::resource('/home/circular', 'App\Http\Controllers\CircularController');
Route::resource('/home/createaccount', 'App\Http\Controllers\CreateAccountController');
Route::resource('/home/userinfo', 'App\Http\Controllers\UserInfoController');
Route::resource('/home/companyuserinfo', 'App\Http\Controllers\CompanyUserInfoController');
Route::resource('/home/uploadcvorvideo', 'App\Http\Controllers\UploadUsersCVorVideoController');
Route::resource('/home/uploadskillvideos', 'App\Http\Controllers\UploadUsersSkillVideosController');
Route::resource('/home/deletecvorvideo', 'App\Http\Controllers\DeleteCvOrVideoController');
Route::resource('/home/appliedforjob', 'App\Http\Controllers\AppliedForJobController');
Route::resource('/home/searchdata', 'App\Http\Controllers\SearchController');
Route::resource('/home/userandcompanyprofile', 'App\Http\Controllers\UserAndCompanyProfiles');
Route::resource('/home/pagination', 'App\Http\Controllers\PaginationController');
Route::get('/home/acceptagreement', 'App\Http\Controllers\UserAcceptPayAgreement@acceptAgreement');
Route::post('/home/userpaidamount', 'App\Http\Controllers\UserAcceptPayAgreement@userPaidAmount');
Route::get('/home/userpayhistory', 'App\Http\Controllers\UserAcceptPayAgreement@userPaymentHistory');
Route::get('/home/callsignout', 'App\Http\Controllers\SignOutController@signOutFunction');
Route::get('/home/usersprofilenotification', 'App\Http\Controllers\UserAcceptPayAgreement@showUsersNotification');
Route::post('/home/usersclickednotification', 'App\Http\Controllers\UserAcceptPayAgreement@userClickedNotification');
Route::post('/home/updateusersvisitednumber', 'App\Http\Controllers\UserAcceptPayAgreement@updateUsersNumberOfVisited');
Route::post('/home/getnamesofvideos', 'App\Http\Controllers\UserInfoController@getNamesofVideos');
Route::post('/home/uploadvideofiles', 'App\Http\Controllers\UploadUsersVideosController@uploadVideoFiles');




// none user
Route::post('/home/finduserbyemailorphone', 'App\Http\Controllers\NoneUserController@findUserByEmailOrPhone');
Route::post('/home/verifyteachername', 'App\Http\Controllers\NoneUserController@verifyTeachersName');
Route::post('/home/changepasswordcalled', 'App\Http\Controllers\NoneUserController@changePasswordCalled');



// admin
Route::post('/home/getuserpaymentlist', 'App\Http\Controllers\UserAcceptPayAgreement@getUsersPaymentListFromDatabase');
Route::post('/home/getpaginateduserpayment', 'App\Http\Controllers\UserAcceptPayAgreement@userPaymentPaginatedData');
Route::post('/home/getuserpaymentsearch', 'App\Http\Controllers\UserPaymentSearch@searchByTextFields');
Route::post('/home/updateuserpayment', 'App\Http\Controllers\UserAcceptPayAgreement@updateUserPayment');



/*
//************************Routes************************
Route::get('/home/demo', 'App\Http\Controllers\DemoController@ThisMethod');
Route::post('/home/demo', 'App\Http\Controllers\DemoController@ThatMethod');
//************************Routes*************************


//************************Methods************************
public function ThisMethod(){
    return "hello This method";
}
public function ThatMethod(){
    return "hello That method";
}
//************************Methods************************


//************************Call from vuejs************************
axios.get('/api/home/demo').then((response) => {
    console.log(response); 
    
});
axios.post('/api/home/demo').then((response) => {
    console.log(response); 
    
});
//************************Call from vuejs************************
*/
