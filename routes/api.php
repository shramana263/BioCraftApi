<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EducationalDetailController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PdController;
use App\Http\Controllers\PersonalDetailController;
use App\Http\Controllers\SpecializationController;
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

Route::post('/registration',[AuthController::class,'registration']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user',[AuthController::class,'user']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::post('/store/personaldetails',[PersonalDetailController::class,'store']);
    Route::post('/store/educationaldetails',[EducationalDetailController::class,'store']);
    Route::post('/store/specialization',[SpecializationController::class,'store']);
    Route::post('/store/experience',[ExperienceController::class,'store']);
});
