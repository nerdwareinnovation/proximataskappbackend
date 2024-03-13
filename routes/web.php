<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\EntitlementController;
use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\OfferingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
});
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
//Route::get('/dashboard',[App\Http\Controllers\BackendController::class,'test'])->name('dashboard');
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::get('/task', [App\Http\Controllers\TaskController::class, 'index'])->name('task');
    Route::get('/entitlement',[EntitlementController::class,'listEntitlement'])->name('entitlement');
    Route::post('/entitlement/create',[EntitlementController::class,'createEntitlement'])->name('createEntitlement');
    Route::get('/entitlement/get/{entitlementId}',[EntitlementController::class,'getEntitlement'])->name('entitlement.get');
    Route::get('/entitlement/attach/{entitlementId}',[EntitlementController::class,'getProducts'])->name('entitlement.attach');
    Route::get('/entitlement/detach/{entitlementId}',[EntitlementController::class,'detach'])->name('entitlement.detach');
    Route::get('/entitlement/delete/{entitlementId}',[EntitlementController::class,'delete'])->name('entitlement.delete');
    Route::post('/entitlement/update/{entitlementId}',[EntitlementController::class,'update'])->name('entitlement.update');
    Route::post('/entitlement/attach',[EntitlementController::class,'attachProducts'])->name('attachProducts');
    Route::post('/entitlement/detach',[EntitlementController::class,'detachProducts'])->name('detachProducts');
    Route::get('/entitlement/{entitlementId}',[EntitlementController::class,'listProducts'])->name('listProducts');
    Route::get('/product',[ProductController::class,'getList'])->name('getList');
    Route::get('/product/{product}',[ProductController::class,'get'])->name('getProducts');
    Route::get('/product/delete/{product}',[ProductController::class,'delete'])->name('deleteProducts');
    Route::post('/product/create',[ProductController::class,'create'])->name('createProducts');
    Route::post('/offering/create',[OfferingController::class,'createOffering'])->name('createOffering');
    Route::get('/offering',[OfferingController::class,'listOffering'])->name('listOfferings');
    Route::get('/offering/{offerings}',[OfferingController::class,'getOfferings'])->name('getOfferings');
    Route::post('/offering/update/{offerings}',[OfferingController::class,'update'])->name('updateOfferings');
    Route::get('/offering/delete/{offerings}',[OfferingController::class,'delete'])->name('deleteOfferings');
    Route::get('/package/{offerings}',[PackageController::class,'getPackagesWithOfferings'])->name('getPackagesWithOfferings');
    Route::post('/package/create',[PackageController::class,'create'])->name('createPackages');
    Route::get('/package/get/{packages}',[PackageController::class,'getPackage'])->name('getPackages');
    Route::post('/package/update/{package}',[PackageController::class,'update'])->name('updatePackages');
    Route::get('/package/delete/{package}',[PackageController::class,'delete'])->name('deletePackages');
    Route::get('/package/list/{package}',[PackageController::class,'listofPackages'])->name('listOfPackages');
    Route::post('/package/detach',[PackageController::class,'detachPackage'])->name('detachPackages');
    Route::get('/package/detach/{package}',[PackageController::class,'detach'])->name('detach.package');
    Route::get('/package/attach/{package}',[PackageController::class,'attach'])->name('attach.package');
    Route::get('/backend/dashboard',[BackendController::class,'dashboard'])->name('dashboard');
//    Route::get('/backend/astrology','DashboardController@index')->name('astrology');
;});

//Astorlogy web

Route::post('storeCustomerNotes', 'Admin\AstrologerController@storeCustomerNotes');
Route::group(['as'=>'admin.','prefix' => 'admin','middleware'=>['auth']], function () {
    Route::post('storeNote', 'CustomerNotesController@storeNote');
    Route::post('updateNote', 'CustomerNotesController@updateNote')->name('updateCustomerNotes');
    Route::get('deleteNote/{id}', 'CustomerNotesController@deleteNote')->name('deleteNote');
});
Route::group(['as'=>'admin.','prefix' => 'admin','namespace'=>'Admin','middleware'=>['auth']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::post('filterdashboard', 'DashboardController@filterDashboard')->name('filterDashboard');
    Route::get('customers', 'DashboardController@customerList')->name('customers');
    Route::get('user/disable/{id}', 'DashboardController@disableUser');
    Route::get('user/active/{id}', 'DashboardController@activateUser');
    Route::get('user/delete/{id}', 'DashboardController@deleteUser');

//    Route::get('psychologists', 'DashboardController@psychologistList')->name('psychologists');
    Route::get('psychologists', [App\Http\Controllers\Astrology\Admin\DashboardController::class,'psychologistList'])->name('psychologists');
    Route::get('addPsychologist', 'PsychologistController@addNewPsychologist')->name('addPsychologist');
    Route::post('storePsychologist', 'PsychologistController@storePsychologist')->name('storePsychologist');


    Route::get('queries', 'QueryController@queryList')->name('queries');
    Route::get('getQueryList', 'QueryController@getQueryList')->name('getQueryList');
    Route::get('getCustomerList', 'CustomerController@getCustomerList')->name('getCustomerList');
    Route::post('updateAvailableQuestion/{id}', 'CustomerController@updateAvailableQuestion')->name('updateAvailableQuestion');

    Route::get('parasiteWords', 'FilterWordsController@index')->name('parasiteWords');
    Route::get('queryCheck', 'QueryController@queryCheck')->name('query');

    Route::get('parasiteWords', 'FilterWordsController@index')->name('parasiteWords');
    Route::get('parasiteWords/delete/{id}', 'FilterWordsController@deleteParasiteWords');
    Route::post('storeParasiticWord', 'FilterWordsController@storeParasiticWord')->name('storeParasiticWord');

//    Route::get('moderators', 'ModeratorController@moderatorList')->name('moderators');
    Route::get('moderators', [App\Http\Controllers\Astrology\Admin\ModeratorController::class,'moderatorList'])->name('moderators');
    Route::get('addModerator', 'ModeratorController@addNewModerator')->name('addModerator');
    Route::post('storeModerator', 'ModeratorController@storeModerator')->name('storeModerator');
    Route::get('editModerator/{id}', 'ModeratorController@editModerator');
    Route::post('updateModerator', 'ModeratorController@updateModerator')->name('updateModerator');



//    Route::get('astrologers', 'DashboardController@astrologerList')->name('astrologers');
    Route::get('astrologers', [App\Http\Controllers\Astrology\Admin\DashboardController::class,'astrologerList'])->name('astrologers');
//    Route::post('storeAstrologers', 'AstrologerController@storeAstrologer')->name('storeAstrologer');
    Route::post('storeAstrologers',  [App\Http\Controllers\Astrology\Admin\AstrologerController::class,'storeAstrologer'])->name('storeAstrologer');
//    Route::get('addAstrologer', 'AstrologerController@addNewAstrologer')->name('addAstrologer');
    Route::get('addAstrologer', [App\Http\Controllers\Astrology\Admin\AstrologerController::class,'addNewAstrologer'])->name('addAstrologer');
    Route::get('editAstrologer/{id}', 'AstrologerController@editAstrologer')->name('editAstrologer');
    Route::post('updateAstrologer/{id}', 'AstrologerController@updateAstrologer')->name('updateAstrologer');

    Route::get('question/customerSample', 'DashboardController@customerSample')->name('customerSample');
    Route::get('question/questionCategory', 'DashboardController@questionCategory')->name('questionCategory');

    Route::get('question/questionModCategory', 'DashboardController@questionModCategory')->name('questionModCategory');
    Route::get('question/questionModCategory/edit/{id}', 'DashboardController@editQuestionModCategory')->name('editQuestionModCategory');
    Route::post('updateCategoryModerator/{id}', 'DashboardController@updateCategoryModerator')->name('updateCategoryModerator');

    Route::get('question/moderatorSample', 'DashboardController@moderatorSample')->name('moderatorSample');
    Route::post('storeCategory', 'DashboardController@storeCategory')->name('storeCategory');
    Route::post('storeCategoryModerator', 'DashboardController@storeCategoryModerator')->name('storeCategoryModerator');
    Route::post('storeCustomerQuestionSample', 'DashboardController@storeCustomerQuestionSample')->name('storeCQuestionSample');
    Route::post('updateCustomerQuestionSample/{id}', 'DashboardController@updateCustomerQuestionSample')->name('updateCQuestionSample');
    Route::post('updateCustomerSample', 'DashboardController@updateCustomerQuestionSampleOrder')->name('updateCustomerSample');
    Route::post('storeModeratorQuestionSample', 'DashboardController@storeModeratorQuestionSample')->name('storeMQuestionSample');
    Route::post('updateModeratorQuestionSample/{id}', 'DashboardController@updateModeratorQuestionSample')->name('updateMQuestionSample');
    Route::get('question/customer/delete/{id}', 'DashboardController@deleteCustomerQuestion');
    Route::get('question/customer/edit/{id}', 'DashboardController@editCustomerQuestion');
    Route::get('question/moderator/delete/{id}', 'DashboardController@deleteModeratorQuestion');
    Route::get('question/moderator/edit/{id}', 'DashboardController@editModeratorQuestion');
    Route::get('question/customerCategory/edit/{id}', 'DashboardController@editCustomerQuestionCategory');
    Route::post('question/customerCategory/update/{id}', 'DashboardController@updateCustomerQuestionCategory')->name('updateCategory');

    Route::get('question/customerCategory/delete/{id}', 'DashboardController@deleteCustomerQuestionCategory');
    Route::get('question/moderatorCategory/delete/{id}', 'DashboardController@deleteModeratorQuestionCategory');

    Route::get('customer/{id}', 'DashboardController@customer');
    Route::post('filterCustomer', 'CustomerController@filterCustomer')->name('filterCustomer');
    Route::post('filterAstrologer', 'AstrologerController@filterAstrologer')->name('filterAstrologer');
    Route::post('filterModerator', 'ModeratorController@filterModerator')->name('filterModerator');
    Route::post('filterQuery', 'QueryController@filterQuery')->name('filterQuery');

    Route::get('packages', 'PackageController@index')->name('packages');
    Route::get('transactions', 'TransactionController@index')->name('transactions');
    Route::post('storePackage', 'PackageController@storePackage')->name('storePackage');

    Route::get('systemMessage', [App\Http\Controllers\Astrology\Admin\SystemMessageController::class,'index'])->name('systemMessage');
//    Route::post('store/systemMessage', 'SystemMessageController@sendMessage')->name('sendSystemMessage');
    Route::post('store/systemMessage', [App\Http\Controllers\Astrology\Admin\SystemMessageController::class,'sendMessage'])->name('sendSystemMessage');
    Route::post('store/sendSystemPrivateMessage/{id}', 'SystemMessageController@sendSystemPrivateMessage')->name('sendSystemPrivateMessage');

    Route::get('astrologerKPI/{id}', 'AstrologerController@astrologerKPI')->name('astrologerKPI');
    Route::get('moderatorKPI/{id}', 'ModeratorController@moderatorKPI')->name('moderatorKPI');

});

Route::group(['as'=>'astrologer.','prefix' => 'astrologer','namespace'=>'Astrologer','middleware'=>['auth','astrologer']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('queries', 'DashboardController@astrologerQuery')->name('queries');
    Route::get('query/{id}', 'DashboardController@queryScreen');
    Route::get('editVedic/{id}', 'DashboardController@editCustomer');
    Route::post('updateAnswerModeration', 'DashboardController@updateAnswerModeration')->name('updateAnswerModeration');
    Route::post('updateVedicKundali', 'DashboardController@updateCustomerVedicKundali')->name('updateVedic');
    Route::get('pendingCustomers', 'DashboardController@pendingCustomers')->name('pendingCustomers');
    Route::get('getNewTask', 'DashboardController@getNewTask')->name('getNewTask');
    Route::get('postpone/{id}', 'DashboardController@postponeQuestion');
    Route::post('storeNote', 'CustomerNotesController@storeNote');
    Route::post('updateNote', 'CustomerNotesController@updateNote')->name('updateCustomerNotes');
    Route::get('deleteNote/{id}', 'CustomerNotesController@deleteNote')->name('deleteNote');
    Route::post('backToModerator', 'DashboardController@backToModerator');

    Route::post('sendReplyToModerator', 'DashboardController@sendReplyToModerator');
});

Route::group(['as'=>'customer.','prefix' => 'customer','namespace'=>'Customer','middleware'=>['auth','customer','verified']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('packages', 'DashboardController@packages')->name('packages');
    Route::get('transactions', 'DashboardController@transactions')->name('transactions');
    Route::post('sendMessage', 'DashboardController@sendMessage')->name('sendMessage');
    Route::post('rateAstrologer', 'DashboardController@rateAstrologer')->name('rateAstrologer');


//    Route::get('query/{id}', 'DashboardController@queryScreen');
//    Route::get('editVedic/{id}', 'DashboardController@editCustomer');
//    Route::post('updateVedicKundali', 'DashboardController@updateCustomerVedicKundali')->name('updateVedic');
//    Route::get('pendingCustomers', 'DashboardController@pendingCustomers')->name('pendingCustomers');
//
//    Route::post('sendReplyToModerator', 'DashboardController@sendReplyToModerator');
});
Route::get('customer/editProfile', 'HomeController@editProfile')->name('customer.editProfile');
Route::post('customer/updateProfile', 'HomeController@updateProfile')->name('customer.updateProfile');
Route::get('customer/profile', 'HomeController@userProfile')->name('customer.userProfile');

Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');

Route::group(['as'=>'psychologist.','prefix' => 'psychologist','namespace'=>'Psychologist','middleware'=>['auth','psychologist']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('queries', 'DashboardController@queryList')->name('queryList');
    Route::get('query/{id}', 'DashboardController@queryScreen');
    Route::get('query/{id}', 'DashboardController@queryScreen');
    Route::post('sendAnswerToCustomer', 'PsychologistController@sendAnswerToCustomer');
//    Route::get('editVedic/{id}', 'DashboardController@editCustomer');
//    Route::post('updateVedicKundali', 'DashboardController@updateCustomerVedicKundali')->name('updateVedic');
//    Route::get('pendingCustomers', 'DashboardController@pendingCustomers')->name('pendingCustomers');
//
//    Route::post('sendReplyToModerator', 'DashboardController@sendReplyToModerator');
});


Route::group(['as'=>'moderator.','prefix' => 'moderator','middleware'=>['auth']], function () {
//    Route::get('dashboard', 'Moderator\DashboardController@index')->name('dashboard');
    Route::get('dashboard', [App\Http\Controllers\Astrology\Moderator\DashboardController::class,'index'])->name('dashboard');
    Route::get('queries', 'Moderator\DashboardController@queryList')->name('queryList');
    Route::get('query/{id}', 'Moderator\DashboardController@queryScreen');
    Route::post('clarifyQuestionToCustomer', 'Moderator\DashboardController@clarifyQuestionToCustomer');
    Route::post('sendQuerytoAstrologer', 'Admin\AstrologerController@assignToAstrologer');
    Route::post('sendAnswerToCustomerAsPsychologist', 'Moderator\DashboardController@sendAnswerToCustomerAsPsychologist');
    Route::post('sendAnswerToCustomer', 'Admin\AstrologerController@sendAnswerToCustomer');
    Route::get('getNewTask', 'Moderator\DashboardController@getNewTask')->name('getNewTask');
    Route::get('checkTransfer', 'Moderator\DashboardController@checkTransfer')->name('checkTransfer');
    Route::get('postpone/{id}', 'Moderator\DashboardController@postponeQuestion');
    Route::post('rateAstrologer', 'Moderator\DashboardController@rateAstrologer');
    Route::post('storeNote', 'CustomerNotesController@storeNote');
    Route::post('updateNote', 'CustomerNotesController@updateNote')->name('updateCustomerNotes');
    Route::get('deleteNote/{id}', 'CustomerNotesController@deleteNote')->name('deleteNote');
    Route::post('backToAstrologer', 'Moderator\DashboardController@backToAstrologer');


//    Route::post('sendReplyToModerator', 'DashboardController@sendReplyToModerator');
});
Route::post('moderator/pinMessage', 'Moderator\DashboardController@pinMessage');
Route::post('moderator/unpinMessage', 'Moderator\DashboardController@unpinMessage');
//Route::get('/home', 'HomeController@index')->name('home');

