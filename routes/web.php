<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VersionsController;
use App\Http\Controllers\TasksController;
use GuzzleHttp\Middleware;

Route::get('/', [UserController::class, 'defineRouteMainOrLogin'])->middleware('auth');
Route::get('login', [UserController::class, 'showLogin'])->name('login');
Route::post('login',[UserController::class, 'doLogin']);
Route::get('logout',[UserController::class, 'doLogout'])->name('logout');

Route::get('/homeUser', [UserController::class, 'home'])->middleware('auth');

Route::get('/pdfTask/{id}', [TasksController::class, 'gerePdf'])->middleware('auth');
Route::get('/download/{file}', [TasksController::class, 'download'])->middleware('auth');
Route::get('/tasks', [TasksController::class, 'showTasksList'])->middleware('auth');
Route::get('/tasks/{id}/edit', [TasksController::class, 'edit'])->middleware('auth');
Route::put('/tasks/{id}', [TasksController::class, 'update'])->middleware('auth');
Route::get('/createTasks', [TasksController::class, 'showCreateTasks'])->name('createTasks')->middleware('auth');
Route::post('/createTasks', [TasksController::class, 'createTasks'])->name('createTaskEnd')->middleware('auth');
Route::delete('/tasks/{id}', [TasksController::class, 'destroy'])->name('tasks.destroy')->middleware('auth');

Route::get('/projects', [ProjectsController::class, 'showProjectList'])->middleware('auth')->name('projects');
Route::get('/projects/{id}/edit', [ProjectsController::class, 'edit'])->middleware('auth');
Route::put('/project/{id}', [ProjectsController::class, 'update'])->middleware('auth');
Route::get('/createProject', [ProjectsController::class, 'showCreateProject'])->middleware('auth')->name('createProject');
Route::post('/createProject', [ProjectsController::class, 'createProject'])->middleware('auth');
Route::delete('/projects/{id}', [ProjectsController::class, 'destroy'])->name('projects.destroy')->middleware('auth');

Route::get('/versions', [VersionsController::class, 'showVersionsList'])->middleware('auth')->middleware('auth')->name('versions');
Route::get('/version/{id}/edit', [VersionsController::class, 'edit'])->middleware('auth');
Route::put('/version/{id}', [VersionsController::class, 'update'])->middleware('auth');
Route::get('/createVersion', [VersionsController::class, 'showCreateVersion'])->middleware('auth')->name('createVersion');
Route::post('/createVersion', [VersionsController::class, 'createVersion'])->middleware('auth');
Route::delete('/versions/{id}', [VersionsController::class, 'destroy'])->name('versions.destroy')->middleware('auth');

Route::get('/users', [UserController::class, 'showUsersList'])->name('users')->middleware('auth');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->middleware('auth');
Route::put('/users/{id}', [UserController::class, 'update'])->middleware('auth');
Route::get('/createUser', [UserController::class, 'showCreateUser'])->name('createUser')->middleware('auth');
Route::post('/createUser',[UserController::class, 'createUser'])->middleware('auth');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('auth');