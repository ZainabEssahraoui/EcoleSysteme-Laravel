<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\AuthenticatedSessionController;

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
        return view('dashboard.prof', ['user' => auth()->user()]);
    })->name('prof.dashboard');
});

// Dashboard for Students
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/student', function () {
        return view('dashboard.student', ['user' => auth()->user()]);
    })->name('student.dashboard');
});




// Routes for Professors
Route::middleware(['role:prof'])->group(function () {
    // CRUD for Grades
    Route::resource('grades', GradeController::class);

    // CRUD for Absences
    Route::resource('absences', AbsenceController::class);
});

// Routes for Students
Route::middleware(['role:student'])->group(function () {
    // CRUD for Courses
    Route::resource('courses',CourseController::class);

    // Grades Routes for Student
    Route::get('/student/grades', [GradeController::class, 'index'])->name('student.grades.index');
    Route::get('/student/grades/{id}', [GradeController::class, 'show'])->name('student.grades.show');

    // Absences Routes for Student
    Route::get('/student/absences', [AbsenceController::class, 'index'])->name('student.absences.index');
    Route::get('/student/absences/{id}', [AbsenceController::class, 'show'])->name('student.absences.show');
});


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


require __DIR__.'/auth.php';
