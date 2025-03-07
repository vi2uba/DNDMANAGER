<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('welcome');});

// Search Route
Route::get('/search', [SearchController::class, 'search'])->name('search');
