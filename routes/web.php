<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CompanyPackageController;
use App\Http\Controllers\Admin\CompanyTypeController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\GuardController;
use App\Http\Controllers\Admin\GuardPackageController;
use App\Http\Controllers\Admin\JobOfferController;
use App\Http\Controllers\Admin\JopConditionController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TechnicalSupportController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkNatureController;
use App\Http\Controllers\Admin\ContactReasonController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\VapulusPaymentController;
use App\Http\Controllers\Api\HomeController as ApiHomeController;
use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Controllers\Company\CompanyJobOfferController;
use App\Http\Controllers\Company\CompanyTechnicalSupportController;
use App\Http\Controllers\Company\ConversationController;
use App\Http\Controllers\Company\NewsController as CompanyNewsController;
use App\Http\Controllers\Company\PackageController;
use App\Http\Controllers\HomeController;
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
    return redirect()->route('company.home');
});

Auth::routes();
Route::get('privacy', [SettingController::class , 'getPrivacy'])->name('privacy.policy');
Route::get('terms', [SettingController::class , 'getTerms'])->name('terms');
Route::get('forget/password/get',[UserController::class , 'forgetPasswordView'])->name('forget.password.get');
Route::post('send/code',[UserController::class , 'sendCode'])->name('send.code');
Route::get('check/code/get',[UserController::class , 'checkCodeView'])->name('check.code.get');
Route::post('check/code/post',[UserController::class , 'checkCode'])->name('check.code.post');
Route::get('forget/password/view',[UserController::class , 'resetPasswordView'])->name('forget.password.view');
Route::post('forget/password/post',[UserController::class , 'resetPassword'])->name('forget.password.post');
Route::group(['middleware' => ['lang' , 'auth' , 'admin']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('settings', [SettingController::class , 'settings'])->name('settings');
    Route::post('settings/update', [SettingController::class , 'update'])->name('settings.update');
    Route::get('settings/change_lang/{lang}', [SettingController::class , 'changeLang'])->name('settings.changelang');
    Route::resource('users', UserController::class);
    Route::get('user/profile', [UserController::class , 'showUserProfile'])->name('user.profile');
    Route::put('user/profile/update', [UserController::class , 'updateUserProfile'])->name('user.profile.update');
    Route::get('update/password', [UserController::class , 'updatePasswordView'])->name('update.password');
    Route::post('update/password/post', [UserController::class , 'updatePassword'])->name('update.password.post');
    Route::resource('clients', ClientController::class);
    Route::resource('company_types', CompanyTypeController::class );
    Route::resource('companies', CompanyController::class );
    Route::resource('guards', GuardController::class );
    Route::resource('cities', CityController::class );
    Route::resource('districts', DistrictController::class );
    Route::resource('jop_conditions', JopConditionController::class );
    Route::resource('technical_supports', TechnicalSupportController::class );
    Route::resource('news', NewsController::class );
    Route::resource('company_packages', CompanyPackageController::class );
    Route::resource('guard_packages', GuardPackageController::class );
    Route::resource('notifications', NotificationController::class , ['except'=>['edit' , 'update']]);
    Route::resource('jobs' , JobOfferController::class , ['only'=>['index' , 'show']]);
    Route::resource('transactions' , TransactionController::class , ['only'=>['index']]);
    Route::resource('contact_reasons', ContactReasonController::class , ['except'=>['show']] );
    Route::resource('work_natures',WorkNatureController::class , ['except'=>['show']] );
    Route::resource('contact_us', ContactUsController::class,['only'=>['index' , 'show']] );
});

Route::group(['prefix' => 'company'], function () {
    Route::get('login' , [CompanyController::class , 'companyLoginView'])->name('company.login');
    Route::post('login/post' , [CompanyController::class , 'companyLogin'])->name('company.post.login');
    Route::get('register' , [CompanyController::class , 'companyRegister'])->name('company.register');
    Route::post('register/post' , [CompanyController::class , 'companyRegisterPost'])->name('company.post.register');
    Route::get('verify' , [CompanyController::class , 'companyVerify'])->name('company.verify');
    Route::post('verify/post' , [CompanyController::class , 'companyVerifyPost'])->name('company.post.verify');
    Route::post('resend/code' , [CompanyController::class , 'requestCode'])->name('company.resend.code');
    Route::group(['middleware' => ['lang' , 'company']], function () {
        Route::post('logout' , [CompanyController::class , 'companyLogout'])->name('company.logout');
        Route::get('/home', [CompanyController::class, 'home'])->name('company.home');
        Route::get('profile', [CompanyController::class , 'showUserProfile'])->name('company.profile');
        Route::put('profile/update', [CompanyController::class , 'updateUserProfile'])->name('company.profile.update');
        Route::get('update/password', [CompanyController::class , 'updatePasswordView'])->name('company.update.password');
        Route::post('update/password/post', [CompanyController::class , 'updatePassword'])->name('company.update.password.post');
        Route::get('settings/change_lang/{lang}', [SettingController::class , 'changeLang'])->name('company.settings.changelang');
        Route::get('/news/{news}', [CompanyNewsController::class, 'show'])->name('company.show.news');
        Route::get('/filter', [CompanyJobOfferController::class, 'viewFilter'])->name('company.filter');
        Route::get('/filter/post', [CompanyJobOfferController::class, 'filter'])->name('company.filter.post');
        Route::get('/guard/{id}/profile', [CompanyJobOfferController::class, 'guardProfile'])->name('guard.profile');
        Route::get('packages', [PackageController::class, 'index'])->name('company.packages');
        Route::get('subscribe/packages', [PackageController::class, 'subscribe'])->name('company.packages.subscribe');
        Route::get('/guards', [CompanyJobOfferController::class, 'guards'])->name('company.guards');
        Route::get('/guards/filter', [CompanyJobOfferController::class, 'guardsFilter'])->name('company.guards.filter');
        Route::get('/guards/filter/get', [CompanyJobOfferController::class, 'guardsFilterGet'])->name('company.guards.filter.get');
        Route::get('/job-offers', [CompanyJobOfferController::class, 'jobOffers'])->name('company.jobOffers');
        Route::get('/technical_supports', [CompanyTechnicalSupportController::class, 'index'])->name('company.technical_supports');
        Route::post('/technical_supports/store', [CompanyTechnicalSupportController::class, 'store'])->name('company.technical_supports.store');
        Route::post('/buyCvs', [CompanyJobOfferController::class, 'buyCvs'])->name('company.buyCvs');
        Route::post('create-pay-form', [PackageController::class, 'createPayForm'])->name('company.createPayForm');
        Route::post('/create_job_offer', [CompanyJobOfferController::class, 'createJobOffer'])->name('company.create_job_offer');
        Route::get('/create_job_offer/view', [CompanyJobOfferController::class, 'createJobOfferView'])->name('company.create_job_offer.view');
        Route::post('/send_job_offer', [CompanyJobOfferController::class, 'sendJobOffer'])->name('company.send_job_offer');
        Route::get('/job_offers/guards', [CompanyJobOfferController::class, 'guardsOfOffer'])->name('company.guards.job_offer');
        Route::get('/view/bill', [PackageController::class, 'bill'])->name('company.view.bill');
        Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.list');
        Route::get('/conversations/{id}/messages', [ConversationController::class, 'companyConversationMessages'])->name('conversations.messages');
        Route::post('/conversations/messages/send', [ConversationController::class, 'sendMessage'])->name('conversations.messages.send');
        Route::post('/conversations/create', [ConversationController::class, 'store'])->name('conversations.create');
        Route::post('notifications/read', [ApiUserController::class , 'markNotificationAsRead'])->name('notifications.read');
        Route::post('notifications/all/read', [ApiUserController::class , 'markAllNotificationAsRead'])->name('notifications.read.all');
    });
});

Route::post('cities/{id}/districts', [ApiHomeController::class, 'districts'])->name('city.districts');

Route::group(['prefix' => 'guard/vapulus-payment', 'as' => 'vapulusPayment.' , 'middleware'=>['lang']], function () {
    Route::get('/pay-form/{package_id}/{user_id}', [VapulusPaymentController::class,'guardPayForm'])->name('guard.payForm');
    Route::post('/pay', [VapulusPaymentController::class,'guardPay'])->name('guard.pay');
    Route::get('/success-callback/{package_id}/{user_id}', [VapulusPaymentController::class,'guardSuccessCallback'])->name('guard.successCallback');
    Route::get('/fail-callback/{package_id}/{user_id}', [VapulusPaymentController::class,'guardFailCallback'])->name('guard.failCallback');
});

Route::group(['prefix' => 'company/vapulus-payment', 'as' => 'vapulusPayment.' , 'middleware'=>['lang']], function () {
    Route::get('/pay-form/{package_id}/{user_id}/{package_type}/{no_of_cvs}', [VapulusPaymentController::class,'companyPayForm'])->name('company.payForm');
    Route::post('/pay', [VapulusPaymentController::class,'companyPay'])->name('company.pay');
    Route::get('/success-callback/{package_id}/{user_id}/{package_type}/{no_of_cvs}', [VapulusPaymentController::class,'companySuccessCallback'])->name('company.successCallback');
    Route::get('/fail-callback/{package_id}/{user_id}/{package_type}/{no_of_cvs}', [VapulusPaymentController::class,'companyFailCallback'])->name('company.failCallback');
});

