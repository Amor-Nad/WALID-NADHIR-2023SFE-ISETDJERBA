<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\FormationsController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContractsController;



Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/refresh', [AuthController::class, 'refresh']);
Route::get('/user', [AuthController::class, 'user']);
Route::put('/update/{id}', [AuthController::class, 'update']);
Route::delete('/delete/{id}',[AuthController::class, 'destroy']);
Route::get('/users', [AuthController::class, 'index']);

Route::post('/store', [RecordController::class, 'store']);
Route::get('/records', [RecordController::class, 'index']);
Route::delete('/records/{id}',[RecordController::class, 'destroy']);

Route::get('/formations', [FormationsController::class, 'index']);
Route::post('/formations/store', [FormationsController::class, 'store']);
Route::get('/formations/{id}', [FormationsController::class, 'show']);
Route::put('/formations/{id}', [FormationsController::class, 'update']);
Route::delete('/formations/{id}', [FormationsController::class, 'destroy']);
Route::get('/teachers', [FormationsController::class, 'getTeachers']);
Route::get('/students', [FormationsController::class, 'getStudents']);
Route::get('/teachers/{teacherId}/formations', [FormationsController::class, 'getAssignedFormations']);
Route::post('/enroll', [FormationsController::class, 'enroll']);
Route::post('/subscribe', [SubscriberController::class, 'subscribe']);
//mailling
Route::post('/contact', [ContactController::class, 'store']);
//contract
Route::get('/contracts/create', [ContractsController::class, 'create']);
Route::post('/contracts', [ContractsController::class, 'store']);
Route::get('/contracts', [ContractsController::class, 'index']);