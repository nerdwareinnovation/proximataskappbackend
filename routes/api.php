<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\Api\NotesController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\ThemeController;
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
    Route::get('/user/{id}/profile',[ProfileController::class,'getProfile']);
    Route::patch('/change-password',[ProfileController::class,'changePassword']);
    Route::post('/forgot-password',[ProfileController::class,'forgotPassword']);
    Route::post('/reset-password',[ProfileController::class,'resetPassword']);
    Route::resource('theme', ThemeController::class);

    //ASTROLOGY API
    Route::get('user',[\App\Http\Controllers\Astrology\API\LoginController::class,'user']);
    Route::get('conversation',[\App\Http\Controllers\Astrology\API\ConversationController::class,'index']);
    Route::post('messages',[\App\Http\Controllers\Astrology\API\ChatController::class,'store']);
    Route::post('storeTemplateMessage',[\App\Http\Controllers\Astrology\API\ChatController::class,'storeTemplateMessage']);
    Route::post('buyPackage',[\App\Http\Controllers\Astrology\API\PackageController::class,'buyPackage']);
    Route::post('rateQuery',[\App\Http\Controllers\Astrology\API\ChatController::class,'rateQuery']);
    Route::post('updateRating',[\App\Http\Controllers\Astrology\API\ChatController::class,'updateRating']);
    Route::get('packages',[\App\Http\Controllers\Astrology\API\CustomerPackageController::class,'index']);
    Route::get('sampleQuestions',[\App\Http\Controllers\Astrology\API\SampleQuestionsController::class,'index']);
    Route::get('astrologers',[\App\Http\Controllers\Astrology\API\AstrologerDetailsController::class,'index']);
    Route::get('detail',[\App\Http\Controllers\Astrology\API\CustomerDetailsController::class,'index']);
    Route::post('conversation',[\App\Http\Controllers\Astrology\API\ConversationController::class,'store']);
    Route::post('updateUser',[\App\Http\Controllers\Astrology\API\CustomerDetailsController::class,'update']);
    Route::post('updateUserImage',[\App\Http\Controllers\Astrology\API\CustomerDetailsController::class,'updateUserImage']);
    Route::post('conversation/read',[\App\Http\Controllers\Astrology\API\ConversationController::class,'makeConversationAsRead']);
    Route::post('updatePackage',[\App\Http\Controllers\Astrology\API\PackageController::class,'customerBuyPackage']);
});


