<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/job/{id}', [HomeController::class, 'jobDetails'])->name('job.details');

Route::get('/favorites', [HomeController::class, 'favorites'])->name('favorites');

Route::get('/apply/{id}', [HomeController::class, 'apply'])->name('apply');
Route::post('/apply', [HomeController::class, 'storeApplication'])->name('apply.store');

Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');

Route::get('/policies', [HomeController::class, 'policies'])->name('policies');

Route::get('/settings', [HomeController::class, 'settings'])->name('settings');
Route::put('/settings', [HomeController::class, 'updateSettings'])->name('settings.update');

Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
