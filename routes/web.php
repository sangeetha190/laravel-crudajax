<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/', [TaskController::class, 'getAllData'])->name('tasks.index');

Route::get('/create', [TaskController::class, 'createForm']);
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

// edit
Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/edit/{id}', [TaskController::class, 'update']);
// delete
Route::delete('/delete/{id}', [TaskController::class, 'delete'])->name('tasks.destroy');
