<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\JobOfferController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\APi\UserNotificationController;
use App\Http\Controllers\Api\VapulusPaymentController;
use App\Models\ContactUs;

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

Route::group(['middleware' => 'mobileLang'] , function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('company/register', [AuthController::class, 'companyRegister']);
    Route::post('request/code', [AuthController::class, 'requestCode']);
    Route::post('verify/account', [AuthController::class, 'verifyAccount']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('verify/code', [AuthController::class, 'verifyCode']);
    Route::post('reset/password', [AuthController::class, 'resetPassword']);
    Route::post('privacy', [AuthController::class, 'getPrivacy']);
    Route::post('terms', [AuthController::class, 'getTerms']);
    Route::post('phone', [AuthController::class, 'getPhone']);
    Route::post('company/types', [AuthController::class, 'companyType']);
    Route::post('home', [HomeController::class, 'home']);
    Route::post('social/media', [HomeController::class, 'social']);
    Route::post('technical/support', [HomeController::class, 'technicalSupport']);
    Route::post('cities', [HomeController::class, 'cities']);
    Route::post('cities/{id}/districts', [HomeController::class, 'districts']);
    Route::post('job/{id}/conditions', [HomeController::class, 'jobConditions']);
    Route::post('contact/reasons', [HomeController::class, 'contactReasons']);
    Route::post('work/natures', [HomeController::class, 'workNatures']);
    Route::post('holidays', [JobOfferController::class , 'holidays']);
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('user/profile', [AuthController::class, 'getUser']);
        Route::post('user/{id}', [UserController::class, 'show']);
        Route::post('update/password', [AuthController::class, 'updatePassword']);
        Route::post('update/name', [AuthController::class, 'updateName']);
        Route::post('update/phone', [AuthController::class, 'updatePhone']);
        Route::post('update/photo', [AuthController::class, 'updatePhoto']);
        Route::post('send/code', [AuthController::class, 'sendCode']);
        Route::post('verify/user/code', [AuthController::class, 'verifyUserCode']);
        Route::post('guard/packages', [PackageController::class, 'guardPackages']);
        Route::post('company/packages', [PackageController::class, 'companyPackages']);
        Route::post('subscribe/guard/packages', [PackageController::class, 'subscribeGuardPackages']);
        Route::post('subscribe/company/packages', [PackageController::class, 'subscribeCompanyPackages']);
        Route::post('update/cv', [UserController::class, 'updateCv']);
        Route::post('update/guard/profile', [UserController::class, 'updateGuardProfile']);
        Route::post('filter/guards', [UserController::class, 'getGuards']);
        Route::post('buy/cvs', [JobOfferController::class , 'buyCvs']);
        Route::post('company/guards', [JobOfferController::class , 'companyGuards']);
        Route::post('update/company/profile', [UserController::class, 'companyUpdateProfile']);
        Route::post('create/job/offer', [JobOfferController::class , 'store']);
        Route::post('company/job_offers', [JobOfferController::class , 'companyOffer']);
        Route::post('guards/job_offers', [JobOfferController::class , 'employeesOfOffer']);
        Route::post('guard/job_offers', [JobOfferController::class , 'guardOffer']);
        Route::post('guard/accept/job_offers/{id}', [JobOfferController::class , 'acceptOffer']);
        Route::post('guard/reject/job_offers/{id}', [JobOfferController::class , 'rejectOffer']);
        Route::post('create/conversation', [ConversationController::class , 'store']);
        Route::post('company/conversations', [ConversationController::class , 'companyConversations']);
        Route::post('guard/conversations', [ConversationController::class , 'guardConversations']);
        Route::post('company/conversations/{id}/messages', [ConversationController::class , 'companyConversationMessages']);
        Route::post('guard/conversations/{id}/messages', [ConversationController::class , 'guardConversationMessages']);
        Route::post('send/message', [ConversationController::class , 'sendMessage']);
        Route::post('notifications', [UserController::class , 'getUserNotifications']);
        Route::post('notifications/read', [UserController::class , 'markNotificationAsRead']);
        Route::post('notifications/all/read', [UserController::class , 'markAllNotificationAsRead']);
        Route::post('contact/us', [ContactUsController::class , 'store']);
        Route::post('/create-pay-form', [VapulusPaymentController::class , 'createPayForm'])->name('createPayForm');
    });
});
