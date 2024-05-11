<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
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
    return view('welcome');
});

Route::get('/dashboard', [TaskController::class, 'view'])->middleware(['auth', 'role:admin'])->name('dashboard');

Route::post('/taskstore', [TaskController::class, 'store'])->middleware(['auth', 'role:admin'])->name('tasks.store');

Route::get('/taskview', [TaskController::class, 'show'])->middleware(['auth', 'role:admin'])->name('tasks.view');
Route::post('/updatetask/{id}', [TaskController::class, 'update'])->middleware(['auth', 'role:admin'])->name('task.update');
Route::delete('/deletetask/{id}', [TaskController::class, 'delete'])->middleware(['auth', 'role:admin'])->name('task.delete');


Route::get('/userdashboard', [TaskController::class, 'taskview'])->middleware(['auth', 'verified'])->name('userdashboard');

Route::post('/commentstore/{id}', [CommentController::class, 'store'])->name('comment.store');

Route::get('/comments', [CommentController::class, 'show'])->middleware(['auth', 'role:admin'])->name('comments');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
