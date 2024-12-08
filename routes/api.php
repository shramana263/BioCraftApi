<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EducationalDetailController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PdController;
use App\Http\Controllers\PersonalDetailController;
use App\Http\Controllers\ProfileImageController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SocialNetworkController;
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
Route::get('/index/review',[ReviewController::class,'index']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user',[AuthController::class,'user']);
    Route::post('/logout',[AuthController::class,'logout']);

    Route::get('/show/personaldetails',[PersonalDetailController::class,'show']);
    Route::post('/store/personaldetails',[PersonalDetailController::class,'store']);
    Route::put('/update/personaldetails',[PersonalDetailController::class,'update']);

    Route::get('/index/educationaldetails',[EducationalDetailController::class,'index']);
    Route::post('/store/educationaldetails',[EducationalDetailController::class,'store']);
    Route::put('/update/educationaldetails/{id}',[EducationalDetailController::class,'update']);
    Route::get('/show/educationaldetails/{id}',[EducationalDetailController::class,'show']);
    Route::delete('/delete/educationaldetails/{id}',[EducationalDetailController::class,'destroy']);

    Route::get('/index/specialization',[SpecializationController::class,'index']);
    Route::post('/store/specialization',[SpecializationController::class,'store']);
    Route::put('/update/specialization/{id}',[SpecializationController::class,'update']);
    Route::get('/show/specialization/{id}',[SpecializationController::class,'show']);
    Route::delete('/delete/specialization/{id}',[SpecializationController::class,'destroy']);

    Route::get('/index/experience',[ExperienceController::class,'index']);
    Route::post('/store/experience',[ExperienceController::class,'store']);
    Route::put('/update/experience/{id}',[ExperienceController::class,'update']);
    Route::get('/show/experience/{id}',[ExperienceController::class,'show']);
    Route::delete('/delete/experience/{id}',[ExperienceController::class,'destroy']);

    Route::get('/index/skill',[SkillController::class,'index']);
    Route::post('/store/skill',[SkillController::class,'store']);
    Route::put('/update/skill/{id}',[SkillController::class,'update']);
    Route::get('/show/skill/{id}',[SkillController::class,'show']);
    Route::delete('/delete/skill/{id}',[SkillController::class,'destroy']);

    Route::get('/index/progress',[ProgressController::class,'index']);
    Route::put('/update/progress',[ProgressController::class,'update']);

    Route::post('/store/profile-image',[ProfileImageController::class,'store']);
    Route::get('/show/profile-image',[ProfileImageController::class,'show']);
    Route::get('/index/profile-image',[ProfileImageController::class,'index']);
    Route::put('/update/profile-image/{id}',[ProfileImageController::class,'update']);


    Route::post('/store/social-network',[SocialNetworkController::class,'store']);
    Route::get('/index/social-network',[SocialNetworkController::class,'index']);
    Route::put('/update/social-network/{id}',[SocialNetworkController::class,'update']);
    Route::get('/show/social-network/{id}',[SocialNetworkController::class,'show']);
    Route::delete('/delete/social-network/{id}',[SocialNetworkController::class,'destroy']);

    Route::post('/store/review', [ReviewController::class,'store']);
    Route::delete('/delete/review/{id}',[ReviewController::class,'store']);
});
