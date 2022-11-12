<?php

use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\Route;
use App\Models\Project;

Route::get('/projects', [ProjectsController::class, 'index']);
Route::get('/projects/{project}', [ProjectsController::class, 'show']);

Route::post('/projects', [ProjectsController::class, 'store']);