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
;});
