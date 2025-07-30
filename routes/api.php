<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\PolicyController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    Route::get('/job-seeker/all-jobs', [JobController::class, 'getAllJobs']);
    Route::get('/job-seeker/job-details/{id}', [JobController::class, 'getJobDetails']);
    Route::post('/job-seeker/jobs/{id}/mark-favorite', [FavoriteController::class, 'markFavorite']);
    Route::get('/job-seeker/favorite-jobs', [FavoriteController::class, 'getFavoriteJobs']);
    Route::post('/job-seeker/jobs/applied/{id}', [ApplicationController::class, 'applyForJob']);
});

Route::get('/all-companies', [CompanyController::class, 'getAllCompanies']);
Route::get('/faqs', [FaqController::class, 'getAllFaqs']);
Route::get('/policies', [PolicyController::class, 'getAllPolicies']);
