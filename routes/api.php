<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EducationalDetailController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PdController;
use App\Http\Controllers\PersonalDetailController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\SkillController;
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

    Route::get('/show/personaldetails',[PersonalDetailController::class,'show']);
    Route::post('/store/personaldetails',[PersonalDetailController::class,'store']);
    Route::put('/update/personaldetails',[PersonalDetailController::class,'update']);

    Route::get('/index/educationaldetails',[EducationalDetailController::class,'index']);
    Route::post('/store/educationaldetails',[EducationalDetailController::class,'store']);
    Route::put('/update/educationaldetails/{id}',[EducationalDetailController::class,'update']);

    Route::get('/index/specialization',[SpecializationController::class,'index']);
    Route::post('/store/specialization',[SpecializationController::class,'store']);
    Route::put('/update/specialization/{id}',[SpecializationController::class,'update']);

    Route::get('/index/experience',[ExperienceController::class,'index']);
    Route::post('/store/experience',[ExperienceController::class,'store']);
    Route::put('/update/experience/{id}',[ExperienceController::class,'update']);

    Route::get('/index/skill',[SkillController::class,'index']);
    Route::post('/store/skill',[SkillController::class,'store']);
    Route::put('/update/skill/{id}',[SkillController::class,'update']);

    Route::get('/index/progress',[ProgressController::class,'index']);
});
