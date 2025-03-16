<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;


Route::get('/', function () {return view('welcome');});

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Profile
Route::get('/profile', [DashboardController::class, 'profile'])->name('profile.edit');
Route::put('/profile', [DashboardController::class, 'profileUpdate'])->name('profile.update');
Route::put('/profile/password', [DashboardController::class, 'passwordUpdate'])->name('profile.password.update');

Route::get('/home', [DashboardController::class, 'index'])->name('home');

//Campaign Route
Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index');
Route::get('/campaign/create', [CampaignController::class, 'add'])->name('campaign.add');
Route::post('/campaign', [CampaignController::class, 'store'])->name('campaign.store');
Route::get('/campaign/{id}', [CampaignController::class, 'show'])->name('campaign.show');
Route::get('/campaign/{id}/edit', [CampaignController::class, 'edit'])->name('campaign.edit');
Route::put('/campaign/{id}', [CampaignController::class, 'update'])->name('campaign.update');
Route::delete('/campaign/{id}', [CampaignController::class, 'destroy'])->name('campaign.destroy');

//Character Route
Route::get('/character', [CharacterController::class, 'index'])->name('character.index');
Route::get('/character/create', [CharacterController::class, 'create'])->name('character.create');
Route::post('/character', [CharacterController::class, 'store'])->name('character.store');
Route::get('/character/{id}', [CharacterController::class, 'show'])->name('character.show');
Route::get('/character/{id}/edit', [CharacterController::class, 'edit'])->name('character.edit');
Route::put('/character/{id}', [CharacterController::class, 'update'])->name('character.update');
Route::delete('/character/{id}', [CharacterController::class, 'destroy'])->name('character.destroy');

//User Route
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

//Notification Route
Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index');

//Register Route
Route::get('/register', [RegisterController::class, 'index'])->name('register');
//Login Route
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/passwordrequest', [LoginController::class, 'passwordrequest'])->name('password.request');