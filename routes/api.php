<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\Api\NotesController;
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
});
