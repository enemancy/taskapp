<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;

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


//MyTasks
Route::get('/mytasks', [TaskController::class, 'mytasks'])->name('myTasks');
Route::post('/todos/{id}/update-status', [TaskController::class, 'updateStatus'])->name('todos.updateStatus');

//MakeTask
Route::get('/maketask', function () {
    return view('maketask');
})->name('makeTask');
Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');

//EditTask
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('editTask');
Route::post('/tasks/{id}/update', [TaskController::class, 'update'])->name('tasks.update');

//DeleteTask
Route::post('/tasks/{id}/delete', [TaskController::class, 'delete'])->name('tasks.delete');


//MyTeams
Route::get('/myteams', [TeamController::class, 'myteams'])->name('myTeams');

//MakeTeam
Route::get('maketeam', [TeamController::class, 'maketeam'])->name('makeTeam');
Route::post('teams/store', [TeamController::class, 'store'])->name('teams.store');

//Default
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
