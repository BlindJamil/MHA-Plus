<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// --- Public Routes ---
Route::get('/', [ProjectController::class, 'index'])->name('home');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/portfolio', [ProjectController::class, 'showAllProjectsPage'])->name('portfolio.index');
Route::post('/newsletter-subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::post('/contact-submit', [ContactController::class, 'store'])->name('contact.store');

// AJAX route for filtering welcome page projects
Route::get('/api/projects/filter', [ProjectController::class, 'getWelcomePageFilteredProjects'])->name('projects.filter');

// --- Admin Routes ---
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('projects', ProjectController::class)->except(['show']);

    // Contact Message Routes for Admin
    Route::get('messages', [ContactController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [ContactController::class, 'show'])->name('messages.show');
    Route::delete('messages/{message}', [ContactController::class, 'destroy'])->name('messages.destroy');
});

// --- Auth Routes ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
