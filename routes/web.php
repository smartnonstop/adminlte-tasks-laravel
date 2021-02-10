<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/projects', 'App\Http\Controllers\ProjectController',[
    'names' => [
        'index' => 'projects',
        'create' => 'projects_create',
        'store' => 'projects_store',
        'show' => 'projects_show',
        'edit' => 'projects_edit',
        'update' => 'projects_update',
        'destroy' =>'projects_destroy'
      ]
]);

Route::get('/projects/{id}/status/{status}', [App\Http\Controllers\ProjectController::class, 'showWithTaskStatus'])->name('project_tasks_status');

Route::get('/projects/{id}/tasks/create', [App\Http\Controllers\TaskController::class, 'create'])->name('tasks_create');
Route::post('/projects/{id}/tasks/store', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks_store');
Route::get('/tasks/{id}/edit', [App\Http\Controllers\TaskController::class, 'edit'])->name('tasks_edit');
Route::get('/tasks/{id}', [App\Http\Controllers\TaskController::class, 'show'])->name('tasks_show');
Route::put('/tasks/{id}', [App\Http\Controllers\TaskController::class, 'update'])->name('tasks_update');
Route::delete('/tasks/{id}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('tasks_destroy');

Route::get( '/download/docs/{filename}', [App\Http\Controllers\DownloadController::class, 'download'])->name('download');

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
