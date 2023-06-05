<?php

use App\Http\Controllers\Project;
use App\Http\Controllers\task;
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

Route::get('/{project?}',[task::class, 'index'])->name('home')->whereNumber('project');

Route::post('/create',[task::class, 'create'])->name('create');

Route::get('/delete/{task}',[task::class, 'delete'])->name('delete')->whereNumber('task');

Route::post('/update',[task::class, 'update'])->name('update');

// Route::post('/update_priority',[task::class, 'update_priority'])->name('update_priority');

Route::prefix('project')->group(function () {

    Route::post('/create',[Project::class, 'create'])->name('create_project');

    Route::get('/delete/{project}',[Project::class, 'delete'])->name('delete_project')->whereNumber('project');
    
});