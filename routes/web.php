<?php

use Illuminate\Support\Facades\Route;

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
    return view('dashboardtoti');
});
Route::get('/dashboard', function () {
    return view('dashboardtoti');
});
Route::get('/result', function () {
    return view('result');
});




// LEVEL CONTROLLER

use App\Http\Controllers\LevelController;

Route::get('/levels/create', [LevelController::class, 'create'])->name('levels.level_form');
Route::post('/levels', [LevelController::class, 'store'])->name('levels.store');
Route::get('/levels/{level}/edit', [LevelController::class, 'edit'])->name('levels.level_edit');
Route::put('/levels/{level}', [LevelController::class, 'update'])->name('levels.update');
Route::delete('/levels/{level}', [LevelController::class, 'destroy'])->name('levels.destroy');
Route::get('/levels', [LevelController::class, 'index'])->name('levels.level');

// INSTRUCTOR CONTROLLER

use App\Http\Controllers\InstructorController;

Route::get('/instructors/create', [InstructorController::class, 'create'])->name('instructors.instruktur_form');
Route::post('/instructors', [InstructorController::class, 'store'])->name('instructors.store');
Route::get('/instructors/{instructor}/edit', [InstructorController::class, 'edit'])->name('instructors.instruktur_edit');
Route::put('/instructors/{instructor}', [InstructorController::class, 'update'])->name('instructors.update');
Route::delete('/instructors/{instructor}', [InstructorController::class, 'destroy'])->name('instructors.destroy');
Route::get('/instructors', [InstructorController::class, 'index'])->name('instructors.instruktur');

// STUDENT CONTROLLER

use App\Http\Controllers\StudentController;

Route::get('/students/create', [StudentController::class, 'create'])->name('students.murid_form');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.murid_edit');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::get('/students', [StudentController::class, 'index'])->name('students.murid');
Route::post('/students/deleteSelected', [StudentController::class, 'deleteSelected'])->name('students.deleteSelected');

// TEST RESULT CONTROLLER

use App\Http\Controllers\TestResultController;

Route::get('/testResults/create', [TestResultController::class, 'create'])->name('results.result_form');
Route::post('/testResults', [TestResultController::class, 'store'])->name('results.store');
Route::get('/testResults/{id}/edit', [TestResultController::class, 'edit'])->name('results.result_edit');
Route::put('/testResults/{id}', [TestResultController::class, 'updateById'])->name('results.update');
Route::get('/testResults/{id}', [TestResultController::class, 'readById'])->name('results.sawang');
Route::get('/testResults', [TestResultController::class, 'index'])->name('results.result');
Route::post('/testResults/delete-selected', [TestResultController::class, 'deleteSelected'])->name('results.deleteSelected');

use App\Http\Controllers\ExcelController;
Route::post('/import-excel', [ExcelController::class, 'import']);

use App\Http\Controllers\DashboardController;
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);