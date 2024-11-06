<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LinkController;

use App\Http\Controllers\FrontController;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\CategoryController;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\CompanyJobController;

use App\Http\Controllers\perusahaanController;

use App\Http\Controllers\CompanyUserController;

use App\Http\Controllers\JobCandidateController;





Route::get('/show-content', [FrontController::class, 'showContent'])->name('show.content');

// Rute untuk admin mengelola link
Route::prefix('admin')->group(function () {
    Route::middleware('can:manage links')->group(function () {
        Route::resource('links', LinkController::class);
    });
});

Route::middleware(['auth', 'can:manage company'])->group(function () {
    Route::resource('perusahaan', PerusahaanController::class);
});

// Company User Routes
Route::middleware(['auth', 'can:manage company_users'])->group(function () {
    Route::resource('company_users', CompanyUserController::class);
});


Route::get('/', [FrontController::class, 'index'])->name('frontend.index');
Route::get('/rekomendasiloker', [FrontController::class, 'rekomendasi'])->name('frontend.rekomendasi');
Route::get('/details/{company_job:slug}', [FrontController::class, 'details'])->name('frontend.details');
Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('frontend.category');
Route::get('/search/jobs/', [FrontController::class, 'search'])->name('frontend.search');



Route::post('/admin/company_jobs/{companyJob}/toggle', [CompanyJobController::class, 'toggleStatus'])->name('admin.company_jobs.toggle');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');













Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    

  




    Route::middleware('can:apply job')->group(function () {
        Route::get('/apply/success,', [FrontController::class, 'success_apply'])->name('frontend.apply.success');
        Route::get('/apply/{company_job:slug}', [FrontController::class, 'apply'])->name('frontend.apply');
        Route::post('/apply/{company_job:slug}/submit', [FrontController::class, 'apply_store'])->name('frontend.apply.store');
    });

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::middleware('can:apply job')->group(function () {
            Route::get('my-applications', [DashboardController::class, 'my_applications'])->name('my.applications');
            Route::get('my-applications/{jobCandidate}', [DashboardController::class, 'my_application_details'])->name('my.application.details');
            Route::put('my-applications/{jobCandidate}',  [DashboardController::class, 'update'])->name('my.application.update');
            // Route for editing the resume
            // Route::get('/job-application/{slug}/edit-resume', [JobApplicationController::class, 'editResume'])->name('frontend.apply.edit');
            // Route::post('/job-application/{slug}/update-resume', [JobApplicationController::class, 'updateResume'])->name('frontend.apply.update');

        });
    });


    Route::prefix(prefix: 'admin')->name('admin.')->group(function () {
        Route::middleware('can:manage categories')->group(function () {
            Route::resource('categories', CategoryController::class);
        });

        Route::middleware('can:manage company')->group(function () {
            Route::resource('company', CompanyController::class);
        });

        Route::middleware('can:manage jobs')->group(function () {
            Route::resource('company_jobs', CompanyJobController::class);
        });

        Route::middleware('can:manage candidates')->group(function () {
            Route::resource('job_candidates', JobCandidateController::class);
            Route::get('candidate/{job_candidate}/resume/download', [JobCandidateController::class, 'download_file'])->name('download_resume');
        });
    });
});

require __DIR__ . '/auth.php';