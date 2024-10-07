<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

Route::get('/courses', [CourseController::class, 'index']);        
Route::post('/courses', [CourseController::class, 'store']);       
Route::put('/courses/{id}', [CourseController::class, 'update']);  
Route::delete('/courses/{id}', [CourseController::class, 'destroy']); 

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
