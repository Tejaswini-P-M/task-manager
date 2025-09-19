<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::resource('tasks', TaskController::class)->except(['show', 'create']);
Route::post('tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
Route::post('tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');
