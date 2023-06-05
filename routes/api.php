<?php

use App\Http\Controllers\InformationController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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



Route::post('/register',[AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forget-password', [AuthController::class, 'forgetPassword']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'information'], function() {
        Route::post('/', [InformationController::class, 'store']);
    });

    Route::group(['prefix' => 'user'], function() {
        Route::get('/', [UserController::class, 'show']);
        Route::get('/information', [UserController::class, 'showUserInformation']);
        Route::post('/', [UserController::class, 'update']);
    });

    Route::group(['prefix' => 'lessons'], function() {
        Route::get('/', [LessonController::class, 'get']);
        Route::get('/{lesson}', [LessonController::class, 'show']);
        Route::post('/', [LessonController::class, 'store']);
    });
});



