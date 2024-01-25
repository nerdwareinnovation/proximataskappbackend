<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EntitlementController;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\Api\NotesController;
use App\Http\Controllers\Api\OfferingController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'createUser']);
Route::post('/login', [AuthController::class, 'loginUser']);

Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::group(['middleware' => ['web']], function () {
    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
});
Route::middleware('auth:api')->group(function() {
    Route::resource('notes', NotesController::class);
    Route::resource('task', TaskController::class);
    Route::delete('/task/{id}/delete',[TaskController::class,'isDeleted']);
    Route::patch('/task/{id}/restore',[TaskController::class,'isRestored']);
    Route::patch('/task/{id}/task-update',[TaskController::class,'updateTask']);
    Route::get('/tasks/deleted',[TaskController::class,'deletedTask']);
    Route::get('/tasks/archive',[TaskController::class,'archive']);
    Route::put('/tasks/{id}/complete',[TaskController::class,'isComplete']);
    Route::patch('/user/{id}/update',[ProfileController::class,'updateProfile']);
    Route::patch('/change-password',[ProfileController::class,'changePassword']);
    Route::post('/forgot-password',[ProfileController::class,'forgotPassword']);
    Route::post('/reset-password',[ProfileController::class,'resetPassword']);
    Route::get('/entitlement/create/{lookup}/{display}',[EntitlementController::class,'createEntitlement']);
    Route::get('/entitlement/{entitlementId}',[EntitlementController::class,'getEntitlement']);
    Route::get('/entitlement/delete/{entitlementId}',[EntitlementController::class,'delete']);
    Route::get('/entitlement/{display]}/{entitlementId}',[EntitlementController::class,'update']);
    Route::get('/entitlement',[EntitlementController::class,'listEntitlement']);
    Route::get('/entitlement/attach/{entitlementId}/{productId}',[EntitlementController::class,'attachProducts']);
    Route::get('/entitlement/detach/{entitlementId}/{productId}',[EntitlementController::class,'detachProducts']);
    Route::get('/entitlement/{entitlementId}/{productId}',[EntitlementController::class,'listProducts']);
    Route::get('/product',[ProductController::class,'getList']);
    Route::get('/product/{product}',[ProductController::class,'get']);
    Route::get('/product/delete/{product}',[ProductController::class,'delete']);
    Route::get('/product/create',[ProductController::class,'create']);
    Route::get('/offering/create/{lookup}/{display}',[OfferingController::class,'createOffering']);
    Route::get('/offering',[OfferingController::class,'listOffering']);
    Route::get('/offering/{offerings}',[OfferingController::class,'getOfferings']);
    Route::get('/offering/{display}/{current}',[OfferingController::class,'update']);
    Route::get('/offering/delete/{offerings}',[OfferingController::class,'delete']);
    Route::get('/package/{offerings}',[PackageController::class,'getPackagesWithOfferings']);
    Route::get('/package/{offerings}/{lookup}/{display}/{position}',[PackageController::class,'create']);
    Route::get('/package/{packages}',[PackageController::class,'getPackage']);
    Route::get('/package/{display}/{position}/{package}',[PackageController::class,'update']);
    Route::get('/package/delete/{package}',[PackageController::class,'delete']);
    Route::get('/package/{package}',[PackageController::class,'listofPackages']);
});


