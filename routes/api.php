<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\FrontController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CompanyJobController;


// Rute registrasi
Route::post('/register', [AuthController::class, 'register']);

// Rute login
Route::post('/login', [AuthController::class, 'login']);

// Rute logout (dengan middleware sanctum)
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('api-category', CategoryController::class);

Route::get('jobs', [FrontController::class, 'index']);
Route::get('jobs/details/{company_job:slug}', [FrontController::class, 'details']);


Route::post('jobs/{companyJob}/apply', [FrontController::class, 'apply_store'])->middleware('auth:sanctum');
Route::get('categories/{category}/jobs', [FrontController::class, 'category']);
Route::get('search', [FrontController::class, 'search']);
Route::get('content', [FrontController::class, 'showContent']);
Route::get('rekomendasi', [FrontController::class, 'rekomendasi']);




Route::apiResource('company-jobs', CompanyJobController::class);
Route::patch('company-jobs/{companyJob}/toggle-status', [CompanyJobController::class, 'toggleStatus']);