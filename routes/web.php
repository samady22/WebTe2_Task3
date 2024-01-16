<?php

use App\Http\Controllers\LocationController;
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


Route::post('/dashboard', [LocationController::class, 'store']);
Route::get('/dashboard', [LocationController::class, 'store'])->name('dashboard');
Route::get('/', [LocationController::class, 'store'])->name('dashboard');
Route::get('/info', [LocationController::class, 'create'])->name('info');
Route::get('/table/{country_code}', [LocationController::class, 'visitorsByCity'])->name('visitorsByCity');
Route::post('/home', [LocationController::class, 'home']);
