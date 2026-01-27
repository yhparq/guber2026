<?php

use App\Http\Controllers\CorporateParticipantController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('/inscripciones', function () {
    return Inertia::render('Inscripciones', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('inscripciones');

// Public Registration Routes
Route::get('/inscripcion-individual', [ParticipantController::class, 'createPublic'])->name('public.participants.create');
Route::post('/inscripcion-individual', [ParticipantController::class, 'storePublic'])->name('public.participants.store');

Route::get('/inscripcion-corporativa', [CorporateParticipantController::class, 'createPublic'])->name('public.corporate-participants.create');
Route::post('/inscripcion-corporativa', [CorporateParticipantController::class, 'storePublic'])->name('public.corporate-participants.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Participants
    Route::get('participants', [ParticipantController::class, 'index'])->name('participants.index');
    Route::get('participants/create', [ParticipantController::class, 'create'])->name('participants.create');
    Route::post('participants', [ParticipantController::class, 'store'])->name('participants.store');

    // Corporate Participants
    Route::get('corporate-participants', [CorporateParticipantController::class, 'index'])->name('corporate-participants.index');
    Route::get('corporate-participants/create', [CorporateParticipantController::class, 'create'])->name('corporate-participants.create');
    Route::post('corporate-participants', [CorporateParticipantController::class, 'store'])->name('corporate-participants.store');

    // Courses
    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('courses', [CourseController::class, 'store'])->name('courses.store');

    // Photos
    Route::get('photos', [PhotoController::class, 'index'])->name('photos.index');
    Route::get('photos/create', [PhotoController::class, 'create'])->name('photos.create');
    Route::post('photos', [PhotoController::class, 'store'])->name('photos.store');
});

require __DIR__.'/settings.php';
