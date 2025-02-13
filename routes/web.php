<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\StudentGradeController;
use App\Http\Controllers\StudentAbsenceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard for Professors
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/prof', function () {
        return view('dashboard.prof');
    })->name('prof.dashboard');
});

// Dashboard for Students
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/student', function () {
        return view('dashboard.student');
    })->name('student.dashboard');
});
// Routes pour les étudiants
Route::middleware(['auth', 'verified', 'role:student'])->group(function () {
    // CRUD des cours
    Route::resource('courses', App\Http\Controllers\CourseController::class);

    // Grades routes for the student
    Route::get('/student/grades', [StudentGradeController::class, 'index'])->name('student.grades.index');
    Route::get('/student/grades/{id}', [StudentGradeController::class, 'show'])->name('student.grades.show');

    // Absences routes for the student
    Route::get('/student/absences', [StudentAbsenceController::class, 'index'])->name('student.absences.index');
    Route::get('/student/absences/{id}', [StudentAbsenceController::class, 'show'])->name('student.absences.show');
});


// Routes pour les professeurs
Route::middleware(['auth', 'verified', 'role:prof'])->group(function () {
    // CRUD des notes
    Route::resource('grades', App\Http\Controllers\GradeController::class);

    // CRUD des absences
    Route::resource('absences', App\Http\Controllers\AbsenceController::class);
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('absences', AbsenceController::class);
});
Route::resource('courses', CourseController::class);
use App\Http\Controllers\GradeController;

Route::resource('grades', GradeController::class)->middleware('auth');*/

require __DIR__.'/auth.php';
