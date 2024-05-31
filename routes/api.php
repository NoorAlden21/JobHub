<?php

use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\VerificationController;
use App\Http\Middleware\isFreelancer;
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
Route::prefix('freelancers')->group(function () {
    Route::controller(FreelancerController::class)->group(function () {
        // Routes that do not require authentication
        Route::post('/register', 'register');
        Route::post('/login', 'login');

        // Routes that require authentication
        Route::middleware(['auth:sanctum', 'isFreelancer'])->group(function () {
            Route::post('/checkCode', 'checkCode');
            Route::post('/createProfile', 'createProfile');
            Route::get('/myJobs', 'myJobs');
            Route::get('/myApplications', 'myApplications');
            Route::post('/applyToJob/{job}', 'applyToJob');
            Route::post('/rate/{freelancer}', 'rateFreelancer');
        });
    });

    Route::prefix('jobs')->middleware(['auth:sanctum', 'isFreelancer'])->group(function () {
        Route::controller(JobController::class)->group(function () {
            Route::get('', 'index');
            Route::post('/store', 'store');
            Route::get('/{job}/applications', 'jobApplications')->middleware('isOwner');
        });
        Route::controller(FreelancerController::class)->group(function(){
            Route::post('/addToFavorites/{job}', 'addToFavorites');
        });
    });
});

// Route::controller(VerificationController::class)->middleware(['auth:sanctum'])->group(function(){
//     Route::post('/sendCode','sendCode');
//     Route::post('/checkCode','checkCode');
// });