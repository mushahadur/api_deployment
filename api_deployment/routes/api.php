<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\SubjectController;


Route::resource("/school",SchoolController::class);
Route::resource("/subject",SubjectController::class);