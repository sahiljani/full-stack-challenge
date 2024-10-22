<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\JobPostingController;
use App\Http\Controllers\JobListingController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;





Route::get('/', [JobListingController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobListingController::class, 'show'])->name('jobs.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->group(function () {
    Route::get('companies', [CompanyController::class, 'index'])->name('admin.companies.index');
    Route::post('companies', [CompanyController::class, 'store'])->name('admin.companies.store');
    Route::PUT('companies/{company}', [CompanyController::class, 'update'])->name('admin.companies.update');
    Route::DELETE('companies/{company}', [CompanyController::class, 'destroy'])->name('admin.companies.destroy');



    Route::get('/job_postings', [JobPostingController::class, 'index'])->name('admin.job_postings.index');
    Route::get('/job_postings/loadmore', [JobPostingController::class, 'loadmore'])->name('admin.job_postings.loadmore');
    Route::get('/job_postings/create', [JobPostingController::class, 'create'])->name('admin.job_postings.create');
    Route::post('/job_postings', [JobPostingController::class, 'store'])->name('admin.job_postings.store');
    Route::get('/job_postings/{id}/edit', [JobPostingController::class, 'edit'])->name('admin.job_postings.editForm');
    Route::put('/job_postings/update/{id}', [JobPostingController::class, 'update'])->name('admin.job_postings.update');
    Route::post('/job_postings/delete/{jobPosting}', [JobPostingController::class, 'destroy'])->name('admin.job_postings.destroy');
});


require __DIR__.'/auth.php';
