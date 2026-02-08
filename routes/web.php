<?php

use App\Models\CorporateParticipant;
use App\Models\Course;
use App\Models\Participant;
use App\Models\Photo;
use App\Http\Controllers\CorporateParticipantController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DniController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
        'photos' => Photo::latest()->take(6)->get(),
    ]);
})->name('home');

Route::get('/galeria', function () {
    return Inertia::render('Gallery', [
        'photos' => Photo::latest()->get(),
    ]);
})->name('galeria');

// DNI Search API
Route::get('/api/dni/{dni}', [DniController::class, 'buscar'])->name('api.dni');

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
        return redirect()->route('participants.index');
    })->name('dashboard');

    // Participants
    Route::get('participants', [ParticipantController::class, 'index'])->name('participants.index');
    Route::get('participants/create', [ParticipantController::class, 'create'])->name('participants.create');
    Route::post('participants', [ParticipantController::class, 'store'])->name('participants.store');
    Route::get('participants/{participant}/edit', [ParticipantController::class, 'edit'])->name('participants.edit');
    Route::put('participants/{participant}', [ParticipantController::class, 'update'])->name('participants.update');
    Route::delete('participants/{participant}', [ParticipantController::class, 'destroy'])->name('participants.destroy');

    // Corporate Participants
    Route::get('corporate-participants', [CorporateParticipantController::class, 'index'])->name('corporate-participants.index');
    Route::get('corporate-participants/create', [CorporateParticipantController::class, 'create'])->name('corporate-participants.create');
    Route::post('corporate-participants', [CorporateParticipantController::class, 'store'])->name('corporate-participants.store');
    Route::get('corporate-participants/{corporateParticipant}/edit', [CorporateParticipantController::class, 'edit'])->name('corporate-participants.edit');
    Route::put('corporate-participants/{corporateParticipant}', [CorporateParticipantController::class, 'update'])->name('corporate-participants.update');
    Route::delete('corporate-participants/{corporateParticipant}', [CorporateParticipantController::class, 'destroy'])->name('corporate-participants.destroy');

    // Courses
    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('courses', [CourseController::class, 'store'])->name('courses.store');

    // Photos
    Route::get('photos', [PhotoController::class, 'index'])->name('photos.index');
    Route::get('photos/create', [PhotoController::class, 'create'])->name('photos.create');
    Route::post('photos', [PhotoController::class, 'store'])->name('photos.store');
    Route::delete('photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
});

require __DIR__.'/settings.php';
